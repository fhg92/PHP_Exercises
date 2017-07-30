<?php
include('include/Header.php');
?>

<html>
    <head>
        <title><?= ucfirst(htmlentities($_SESSION['user'])); ?></title>
    </head>
        <div>
            <p>Welcome <?= ucfirst(htmlentities($_SESSION['user'])); ?>.</p>
        </div>
    </body>
</html>