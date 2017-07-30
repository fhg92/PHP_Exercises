<?php
include('include/Header.php');
include('include/UserFunctions.php');
?>

<html>
    <head>
        <title>Users</title>
    </head>
        <div>
            <p><b>Users:</b></p>
            <?php
            echo '<table>';
            if(userCheck($pdo, $curUser, $otherUsers) == true) {
                getUserList($pdo, $curUser, $otherUsers);
            } else{
                echo 'There are no other registered users yet.';
            }
            ?>
        </div>
    </body>
</html>