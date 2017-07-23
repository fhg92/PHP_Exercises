<?php

session_start();

include('DbConnect.php');
include('UserFunctions.php');

if(!isset($_SESSION['user'])) {
    header('Location: Login.php');
}

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
            if(userCheck($mysqli, $user, $curUser, $otherUsers) == true) {
                addFriend($mysqli, $curUser, $otherUsers);
            } else{
                echo 'There are no other registered users yet.';
            }
            echo '</table><p><b>Friend requests:</b></p><table>';
            getFriendRequest($mysqli, $curUser);
            echo '</table><p><b>Friends:</b></p><table>';
            getFriendList($mysqli, $curUser);
            echo '</table>';
            ?>
        </div>
        <div>
            <br><a href='Logout.php'>Log out</a>
        </div>
    </body>
</html>