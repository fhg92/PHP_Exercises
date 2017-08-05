<?php

session_start();

require('include/DbConnect.php');
require('include/UserCheck.php');

?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="navbar">
            <a href="Index.php"><?= ucfirst(htmlentities($_SESSION['user'])); ?></a>
            <a href="Users.php">Users</a>
            <a href="Friends.php">Friends</a>
            <a href="Groups.php">Groups</a>
            <a href="Logout.php">Log out</a>
        </div>
    </body>
</html>