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
            echo '<p><b>Friend requests:</b></p><table>';
            getFriendRequest($pdo, $curUser);
            echo '</table><p><b>Friends:</b></p><table>';
            getFriendList($pdo, $curUser);
            echo '</table>';
            }
            ?>
        </div>
    </body>
</html>