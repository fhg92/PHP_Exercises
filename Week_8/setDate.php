<?php

// Requires DbConnect.php from Week_7. Located in 
// Week_7/Application/Include/DbConnect.php.
// Week_7.sql is located in Week_7. 

require('../Week_7/Application/Include/DbConnect.php');

$sql = 'SELECT date_of_birth FROM user_personal';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$dob = $stmt->fetchColumn();

$date = new DateTime($dob);
$date->setDate($dob);
echo $date->format('Y-m-d');

?>