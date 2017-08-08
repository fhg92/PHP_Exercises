<?php

include('include/Header.php');
include('include/UserFunctions.php');

userCheck($pdo);
getUserDetails($pdo, $details, $gender);

?>

<html>
    <head>
        <title><?= ucfirst(htmlentities($_SESSION['firstname'])); ?></title>
    </head>
    <div>
        <p>Welcome <?= ucfirst(htmlentities($_SESSION['firstname'])); ?>.</p>
    </div>
    
    <div>
        <p><b>Profile Overview:</b></p>
    </div>
    <table class='info'>
        <tr><td>First name: <?= ucfirst(htmlentities($details['first_name'])); ?></td></tr>
        <tr><td>Last name: <?= htmlentities($details['last_name']); ?></td></tr>
        <tr><td>Living in: <?= ucfirst(htmlentities($details['city'])); ?></td></tr>
        <?php $date = new DateTime($details['date_of_birth']); ?>
        <tr><td>Birth date: <?= $date->format('F jS'); ?></td></tr>
        <tr><td>Birth year: <?= $date->format('Y'); ?></td></tr>
        <tr><td>Gender: <?= $gender['label']; ?></td></tr>
        <?php $date = new DateTime($details['date_registered']); ?>
        <tr><td>Date registered: <?= $date->format('F jS Y'); ?></td></tr>
        <?php $date = new DateTime($details['last_login']); ?>
        <tr><td>Last login: <?= $date->format('F jS Y h:i:s a'); ?></td></tr>
    </table>

    </body>
</html>