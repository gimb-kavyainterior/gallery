<?php

session_start();
if(!isset($_SESSION['username']))
{
	header('location: ./');
        exit;
}

include "header.php";
?>

<body class="admin_body">
    <div class="admin-container">
        <h1>Kavya Interior</h1>
        <p>Welcome to the admin panel.</p>
        <a href="./create_project.php">Create Projects</a>
        <a href="./project_data_table.php">List of Projects</a>
        <a href="./logout.php">Logout</a>
    </div>

<?php

include "footer.php";            
        
?>