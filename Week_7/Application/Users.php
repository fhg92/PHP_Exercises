<?php

include('include/UserFunctions.php');

json($pdo);

include('include/Header.php');

if(isset($_GET['id'])) {
    include('include/MainFunctions.php');
}

getUserDetails($pdo, $details, $gender);
?>

<html>
    <head>
        <title>
        <?php
        if(isset($_GET['id'])) {
            date_default_timezone_set('Europe/Amsterdam');
            echo ucfirst(htmlentities($details['first_name'])).' '.
            htmlentities($details['last_name']);
        } else {
            echo 'Users';
        }
        ?>
        </title>
    </head>
    <body>
        <?php
        if(isset($_GET['id'])) {
        ?>
        <form method='post'><p><b><?= ucfirst(
            htmlentities($details['first_name'])).' '.
            htmlentities($details['last_name']); ?>
            <?php requestCheck($pdo, $user); ?></b></p></form>
        <?php addUser($pdo); deleteFriend($pdo, $relations); ?>
        
        <table class='info'>
        <tr><td>Living in: <?= ucfirst(htmlentities($details['city'])); ?></td></tr>
        <?php $date = new DateTime($details['date_of_birth']); ?>
        <tr><td>Birth date: <?= $date->format('F jS'); ?></td></tr>
        <tr><td>Birth year: <?= $date->format('Y'); ?></td></tr>
        <tr><td>Gender: <?= $details['label']; ?></td></tr>
        <?php $date = new DateTime($details['date_registered']); ?>
        <tr><td>Date registered: <?= $date->format('F jS Y'); ?></td></tr>
        <?php $date = new DateTime($details['last_login']); ?>
        <tr><td>Last login:
            <?php
            if($details['last_login'] == '0000-00-00 00:00:00') {
                echo 'Not logged in yet';
            } else {
               echo $date->format('F jS Y h:i:s a'); 
            }
            ?>
            </td></tr>
        </table>
        <?php
        if(!isset($details['first_name'])) {
            header('Location: Users.php');
        }
        if($_GET['id'] == $_SESSION['userid']) {
            header('Location: Index.php');
        }
            
        } else { 
        ?>      
        <div>
            <p><b>Search User:</b></p>
            <form method='post' class='search'>
                <input type='text' name='search' placeholder='Search'/>
                <input type="submit" name='submit' value="Submit" />
            </form>
            <?php
                searchUser($pdo, $user); 
            ?>
        </div>
        <div>
            <p><b>Users:</b></p>
            <?php
                getUserList($pdo);
            ?>
        </div>
        <?php
        }
        ?>
    </body>
</html>