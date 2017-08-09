<?php

session_start();

require('include/DbConnect.php');
require('include/UserCheck.php');

$sql = 'SELECT first_name, last_name FROM user_personal WHERE user_id = :userId';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':userId', $_SESSION['userid'], PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch();

?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="navbar">
            <a href="Index.php"><?= ucfirst(htmlentities($user[0])); ?></a>
            <a href="Users.php">Users</a>
            <a href="Friends.php">Friends</a>
            <a href="Groups.php">Groups</a>
            <a href="Logout.php">Log out</a>
        </div>
    </body>
</html>