<?php

include('include/Header.php');
include('include/FriendFunctions.php');

?>

<html>
    <head>
        <title>Friends</title>
    </head>
    <body>
        <div>
            <?php
            if(userCheck($pdo, $curUser, $otherUsers) == true) {
            echo '<p><b>Friend requests:</b></p>';
            getFriendRequest($pdo, $curUser);
            echo '<p><b>Friends:</b></p>';
            getFriendList($pdo, $curUser);
            }
            ?>
        </div>
    </body>
</html>