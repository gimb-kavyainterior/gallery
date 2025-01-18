<?php

session_start();
if(!isset($_SESSION['username']))
{
    header('location: index.php');
}

require_once "./database_helper.php";
require_once "./constant.php";

$conn = establish_connection();

#get projet_id from query string
$project_id = $_GET['id'];

#project folder path
$path = "../" . PROJECT_FOLDER . "/$project_id";

#deleting image from project folder

$files = scandir($path);
foreach ($files  as $file)
{
    if ($file != "." && $file != "..") 
    {
        unlink("$path/$file");
    }
}
#removing project folder
$remove_project_folder = rmdir($path);

#deleting project from database

function delete_project($flag, $conn, $project_id)
{  
    if($flag)
    {
    $delete_qry = "DELETE FROM projects WHERE project_id = $project_id";
    $delete_data = delete_table_data($conn, $delete_qry);
    }
}

$delete_data = delete_project($remove_project_folder, $conn, $project_id);
close_database_connect($conn);
// if($delete_data){
    header('location: project_data_table.php');
    // }
?>