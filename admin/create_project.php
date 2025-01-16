<?php

session_start();
if(!isset($_SESSION['username']))
{
    header('location: index.php');
}

include "header.php";
?>

<body class="create_project_body">
    <div class="form-container">
        <h2>Create Project</h2>
        <form enctype="multipart/form-data" method="POST">
            <div class="form-group">
                <label for="project_name">Project name:</label>
                <input type="text" id="project_name" name="project_name" required/>
            </div>

            <div class="form-group">
                <label for="project_location">Project location:</label>
                <input type="text" id="project_location" name="project_location" required/>
            </div>

            <div class="form-group">
                <label for="project_address">Project address:</label>
                <input type="text" id="project_address" name="project_address" required/>
            </div>

            <div class="form-group">
                <label for="project_google_map">Google map:</label>
                <input type="text" id="project_google_map" name="project_google_map"/>
            </div>

            <div class="form-group">
                <label for="project_classification">Project classification:</label>
                <select id="project_classification" name="project_classification">
                    <option value="Residential">Residential</option>
                    <option value="Commercial">Commercial</option>
                    <option value="Government Office">Government Office</option>
                </select>
            </div>

            <div class="form-group">
                <label for="project_details">Project details:</label>
                <input type="text" id="project_details" name="project_details"/>
            </div>

            <div class="form-group">
                <label for="project_plan">Project plan:</label>
                <input type="text" id="project_plan" name="project_plan"/>
            </div>

            <div class="form-group">
                <label for="project_3D">Project 3D Walkthrough:</label>
                <input type="text" id="project_3D" name="project_3D"/>
            </div>

            <div class="form-group">
                <label for="project_teamsize">Project team size:</label>
                <input type="text" id="project_teamsize" name="project_teamsize"/>
            </div>

            <div class="form-group">
                <label for="project_timeline">Project timeline:</label>
                <select id="project_timeline" name="project_timeline">
                    <option value="0-3 Months">0-3 Months</option>
                    <option value="3-6 Months">3-6 Months</option>
                    <option value="6-12 Months">6-12 Months</option>
                </select>
            </div>

            <div class="form-group">
                <label for="project_status">Project current status:</label>
                <select id="project_status" name="project_status">
                    <option>Planning</option>
                    <option>Execution</option>
                    <option>Finishing</option>
                    <option>Completed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="project_budget">Project budget:</label>
                <select id="project_budget" name="project_budget">
                    <option value="5-10 Lacs">5-10 Lacs</option>
                    <option value="10-15 Lacs">10-15 Lacs</option>
                    <option value="15-30 Lacs">15-30 Lacs</option>
                </select>
            </div>

            <div class="form-group">
                <label for="filename">Project image:</label>
                <input type="file" id="filename" name="filename"/>
            </div>

            <div style="flex-basis: 100%; text-align: center;">
                <input type="submit" name="btn_create_project" value="Create"/>
            </div>
        </form>
    </div>
<?php

include "footer.php";            
        
?>

<?php

require_once "./constant.php";
require_once "./database_helper.php";

if (isset($_POST['btn_create_project'])) {

    $conn_obj = establish_connection();

    $project_name = $_POST['project_name'];
    $project_location = $_POST['project_location'];
    $project_address = $_POST['project_address'];
    $project_google_map = $_POST['project_google_map'];
    $project_classification = $_POST['project_classification'];
    $project_details = $_POST['project_details'];
    $project_plan = $_POST['project_plan'];
    $project_3D_walkthrough = $_POST['project_3D'];
    $project_teamsize = $_POST['project_teamsize'];
    $project_timeline = $_POST['project_timeline'];
    $project_status = $_POST['project_status'];
    $project_budget = $_POST['project_budget'];

    $insert_qry = "INSERT INTO projects  VALUES (
                NULL,
                '$project_name',
                '$project_location',
                '$project_address',
                '$project_google_map',
                '$project_classification',
                '$project_details',
                '$project_plan',
                '$project_3D_walkthrough',
                '$project_teamsize',
                '$project_timeline',
                '$project_status',
                '$project_budget'
            )";


    $last_insert_id = insert_data($conn_obj, $insert_qry);

    if ($last_insert_id) {

        $file_name = $_FILES['filename']['name'];
        $temp_name = $_FILES['filename']['tmp_name'];

        $filenameArr = explode(".", $file_name);
        if ($filenameArr[count($filenameArr) - 1] === 'zip') {
            $zip = new ZipArchive();
            if ($zip->open($temp_name)) {
                $zip->extractTo("../" . PROJECT_FOLDER . "/$last_insert_id");
                $zip->close();
            }

        }

        $project_folder = "../".PROJECT_FOLDER."/$last_insert_id";
        $list_images = scandir($project_folder);
        $first_file = $list_images[2];
        $file_extention = explode(".",$first_file)[1];

        rename($project_folder.'/'.$first_file, 
                $project_folder.'/'.$last_insert_id.".$file_extention");

    }

}

?>
