<?php

include('include/Header.php');
include('include/UserFunctions.php');

getUserDetails($pdo, $details, $gender);

?>

<html>
    <head>
        <title><?= ucfirst(htmlentities($user[0])); ?></title>
    </head>
    <div>
        <p>Welcome <?= ucfirst(htmlentities($user[0])); ?>.</p>
    </div>
    <div>
        <p><b>Profile Overview:</b></p>
    </div>
    <table class='info'>
        <tr><td>First name: <?= ucfirst(htmlentities($details['first_name']));
            ?></td></tr>
        <tr><td>Last name: <?= htmlentities($details['last_name']); ?></td></tr>
        <tr><td>Living in: <?= ucfirst(htmlentities($details['city'])); ?></td></tr>
        <?php $date = new DateTime($details['date_of_birth']); ?>
        <tr><td>Birth date: <?= $date->format('F jS'); ?></td></tr>
        <tr><td>Birth year: <?= $date->format('Y'); ?></td></tr>
        <tr><td>Gender: <?= $details['label']; ?></td></tr>
        <?php $date = new DateTime($details['date_registered']); ?>
        <tr><td>Date registered: <?= $date->format('F jS Y'); ?></td></tr>
        <?php $date = new DateTime($details['last_login']); ?>
        <tr><td>Last login: <?= $date->format('F jS Y h:i:s a'); ?></td></tr>
    </table>
    <br>
    <div class ='center'><form method='post'><button type='submit' onclick="return confirm('Are you sure you want to delete your profile?');" name='delete' value='<?= $_SESSION['userid'] ?>'>Delete Profile</button></form></div>
    <?php deleteProfile($pdo); ?>
    </body>
</html>