<?php

session_start();

include('DbConnect.php');
include('MainFunctions.php');

if(!isset($_SESSION['user'])) {
    header('Location: Login.php');
}

?>

<html>
    <body>
        <div>
            <p>Welcome <?= ucfirst($_SESSION['user']); ?>.</p>
        </div>
        <div>
            <p>Users:</p>
            <?php
            $user = $_SESSION['user'];
            $query = "SELECT username FROM user WHERE username != '$user'";
            $result = mysqli_query($mysqli, $query);
        
            echo '<table>';
            while($user = mysqli_fetch_array($result)){
                echo '<tr>
                <td>'.$user['username'].' <a href="User.php?add">Add</a></td>
                </tr>';
            }
            echo '</table>';
            ?>
        </div>
        <div>
            <br><a href='Logout.php'>Log out</a>
        </div>
    </body>
</html>