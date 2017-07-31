<?php

// Fill in db details here.
$db = '';
$user = '';
$pass = '';

try {
    $pdo = new PDO('mysql:host=localhost; dbname='.$db.'', $user, $pass);
} catch (PDOException $e) {
    print 'Failed to connect: ' . $e->getMessage() . '<br/>';
    die();
}

?>