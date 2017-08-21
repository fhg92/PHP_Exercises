<?php

$db = 'Week_7';

require_once('Config.php');

try {
    $pdo = new PDO('mysql:host=localhost; dbname='.$db.'', $user, $pass);
} catch (PDOException $e) {
    print '<span style="color:red;">Failed to connect: '.$e->getMessage().'</span><br/>';
    die();
}

?>