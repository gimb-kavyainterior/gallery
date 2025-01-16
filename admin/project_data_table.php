<?php

session_start();
if(!isset($_SESSION['username']))
{
	header('location: ./');
        exit;
}

require_once "./database_helper.php";
require_once "./constant.php";

$conn = establish_connection();
$select_qry = "SELECT project_id, project_name, project_location from projects ";

$result = get_table_data($conn, $select_qry);

include "header.php";
?>


<body class="table_body">
    <h3>Projects</h3>
    <table>
        <tr>
            <th>Project_ID</th>
            <th>Project Name</th>
            <th>Project Location</th>
            <th>Action (View project)</th>
            <th>Action (Delete)</th>
        </tr>
        <?php
            foreach($result as $data)
            {
                 echo "<tr>
                    <td>$data[0]</td>
                    <td>$data[1]</td>
                    <td>$data[2]</td>
                    <td><a href='https://kavya.myartsonline.com/project/project_details.php?id=$data[0]' target='_blank'>View Project</a></td>
                    <td><a href='delete_project.php?id=$data[0]'>Delete Project</a></td>
                </tr>";
            }
        ?>
    </table>

<?php
include "footer.php";      
?>