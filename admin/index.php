<?php
include "header.php";
?>
<body class="login_body">
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="action_login.php">
            <label for="username">Enter Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Enter Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login" name="login_btn">
        </form>
    </div>

<?php

include "footer.php";            
        
?>