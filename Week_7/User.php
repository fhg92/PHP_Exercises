<?php

session_start();

include('DbConnect.php');
include('UserFunctions.php');

if(!isset($_SESSION['user'])) {
    header('Location: Login.php');
}

$user = $_SESSION['user'];
$query = "SELECT * FROM user WHERE username != '$user'";
$result = mysqli_query($mysqli, $query);
?>

<html>
    <body>
        <div>
            <p>Welcome <?= ucfirst(htmlentities($_SESSION['user'])); ?>.</p>
        </div>
        <div>
            <p>Users:</p>
            <?php
            echo '<table>';
            while($row = mysqli_fetch_array($result)){
                echo '<tr>
                <td>'.htmlentities($row['username']).' <a href = "User.php?add=' . $row['user_id'] . '">Add</a></td>
                </tr>';
                addFriend($row, $user, $mysqli, $curUser);
            }
            echo '</table>';
            getFriendRequest($mysqli, $row, $curUser);
            ?>
        </div>
        <div>
            <br><a href='Logout.php'>Log out</a>
        </div>
    </body>
</html>