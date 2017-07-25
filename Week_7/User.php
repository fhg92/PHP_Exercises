<?php

session_start();

include('DbConnect.php');
include('UserFunctions.php');

?>

<html>
    <body>
        <div>
            <p>Welcome <?= ucfirst(htmlentities($_SESSION['user'])); ?>.</p>
        </div>
        <div>
            <p><b>Users:</b></p>
            <?php
            echo '<table>';
            if(userCheck($pdo, $curUser, $otherUsers) == true) {
                addFriend($pdo, $curUser, $otherUsers);
            } else{
                echo 'There are no other registered users yet.';
            }
            
            echo '</table><p><b>Friend requests:</b></p><table>';
            getFriendRequest($pdo, $curUser);
            echo '</table><p><b>Friends:</b></p><table>';
            getFriendList($pdo, $curUser);
            echo '</table>';
            ?>
        </div>
        <div>
            <br><a href='Logout.php'>Log out</a>
        </div>
    </body>
</html>