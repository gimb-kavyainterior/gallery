<?php

session_start();
if(!isset($_SESSION['username']))
{
    header('location: ./');
}

require_once "./constant.php";
require_once "./database_helper.php";

$conn = establish_connection();
$project_id = $_GET['id'];
$select_qry = "SELECT * FROM projects WHERE project_id = $project_id";
$result = get_table_data($conn, $select_qry);
$project = $result[0];

include "header.php";
?>

<body class="view_body">
    <div class="details-container">
        <h2 class="h2">Project Details</h2>
        <div class="detail">
            <label>Project Name:</label>
            <span><?php echo $project['project_name']; ?></span>
        </div>
        <div class="detail">
            <label>Location:</label>
            <span><?php echo $project['project_location']; ?></span>
        </div>
        <div class="detail">
            <label>Address:</label>
            <span><?php echo $project['project_address']; ?></span>
        </div>
        <div class="detail">
            <label>Google Map:</label>
            <span><a href="<?php echo $project['google_map']; ?>" target="_blank"><?php echo $project['google_map']; ?></a></span>
        </div>
        <div class="detail">
            <label>Classification:</label>
            <span><?php echo $project['project_type']; ?></span>
        </div>
        <div class="detail">
            <label>Details:</label>
            <span><?php echo $project['project_details']; ?></span>
        </div>
        <div class="detail">
            <label>Plan:</label>
            <span><?php echo $project['project_plan']; ?></span>
        </div>
        <div class="detail">
            <label>3D Walkthrough:</label>
            <span><?php echo $project['3D_walkthrough']; ?></span>
        </div>
        <div class="detail">
            <label>Team Size:</label>
            <span><?php echo $project['project_teamsize']; ?></span>
        </div>
        <div class="detail">
            <label>Timeline:</label>
            <span><?php echo $project['project_timeline']; ?></span>
        </div>
        <div class="detail">
            <label>Status:</label>
            <span><?php echo $project['project_cuurent_state']; ?></span>
        </div>
        <div class="detail">
            <label>Budget:</label>
            <span><?php echo $project['project_budget']; ?></span>
        </div>
    </div>

<?php
        
include "footer.php";  
        
?>