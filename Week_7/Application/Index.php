<?php

include('include/Header.php');

if(userCheck($pdo, $curUser, $otherUsers) == false) {
    header('Location: Login.php');
}

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