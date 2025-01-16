<?php

session_start();

if(isset($_POST['login_btn']))
{

require_once "database_helper.php";
require_once "constant.php";

$username = $_POST['username'];
$password = $_POST['password'];

$conn = establish_connection();

$check_qry = "SELECT * FROM admin WHERE username = '$username' and password = '$password'";

$result = get_table_data($conn, $check_qry);
if($result)
{
    
    $_SESSION['username'] = $username;
    
        echo headers_sent();
    header('location: admin.php');
        exit;
}
else{
    header('location: ./');
}

}