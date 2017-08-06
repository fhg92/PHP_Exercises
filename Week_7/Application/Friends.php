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
            userCheck($pdo, $otherUsers);
            echo '<p><b>Friend requests:</b></p>';
            getFriendRequest($pdo);
            echo '<p><b>Friends:</b></p>';
            getFriendList($pdo);
            ?>
        </div>
    </body>
</html>