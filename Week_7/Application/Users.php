<?php
include('include/Header.php');
include('include/UserFunctions.php');

getUserDetails($pdo, $details, $gender);
?>

<html>
    <head>
        <title>Users</title>
    </head>
    <body>
        <?php
        if(isset($_GET['id'])) {
        ?>
        <p><b><?= ucfirst(htmlentities($details['first_name'])).' '.
            htmlentities($details['last_name']); ?></b></p>
        <table class='info'>
        <tr><td>Living in: <?= ucfirst(htmlentities($details['city'])); ?></td></tr>
        <?php $date = new DateTime($details['date_of_birth']); ?>
        <tr><td>Birth date: <?= $date->format('F jS'); ?></td></tr>
        <tr><td>Birth year: <?= $date->format('Y'); ?></td></tr>
        <tr><td>Gender: <?= $gender['label']; ?></td></tr>
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
        } else { 
        ?>      
        
        <div>
            <p><b>Search user:</b></p>
            <form method='post' class='search'>
                <input type='text' name='search' placeholder='Search'/>
                <input type="submit" name='submit' value="Submit" />
            </form>
            <?php
            if(userCheck($pdo, $otherUsers) == true) {
                searchUser($pdo); 
            }
            ?>
        </div>
        <div>
            <p><b>Users:</b></p>
            <?php
            if(userCheck($pdo, $otherUsers) == true) {
                getUserList($pdo, $otherUsers);
            } else {
                echo '<p>There are no other registered users yet.</p>';
            }
            ?>
        </div>
        <?php
        }
        ?>
    </body>
</html>