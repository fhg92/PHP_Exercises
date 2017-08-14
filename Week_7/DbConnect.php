<?php

// This config file is only being used for Week_7_p2.php, Create.php and 
// Drop.php 

// For Week_7_p1.php see: Application/include/DbConnect.sample.php

$db = 'shop';

require('Config.php');

try {
    $pdo = new PDO('mysql:host=localhost; dbname='.$db.'', $user, $pass);
} catch (PDOException $e) {
    print '<span style="color:red;">Failed to connect: '.$e->getMessage().'</span><br/>';
    die();
}

?>