<?php

session_start();

require('include/DbConnect.php');
require('include/UserCheck.php');

$sql = 'SELECT first_name FROM user_personal WHERE user_id = ?';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $_SESSION['userid']);
$stmt->execute();
$stmt->bind_result($user);
$stmt->fetch();
$stmt->close();

?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="navbar">
            <a href="Index.php"><?= ucfirst(htmlentities($user)); ?></a>
            <a href="Logout.php">Log out</a>
        </div>
    </body>
</html>