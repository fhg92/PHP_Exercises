<?php

// In this file I'll treat the subjects I haven't used in my application.

require('Application/Include/DbConnect.php');

// GROUP BY.
$stmt = $pdo->prepare('SELECT first_name, last_name FROM user_personal GROUP BY
first_name');
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<table>';
foreach($users as $user) {
    echo '<tr><td>'.$user['first_name'].' '.$user['last_name'].'</td></tr>';
}
echo '</table><br>';

// AVG and COUNT. Will calculate the average number of groups per user.
$sql = 'SELECT AVG(count) FROM (SELECT COUNT(gu.group_id) AS 
count FROM group_user gu INNER JOIN user u WHERE gu.user_id = u.user_id AND 
gu.status != :i GROUP BY gu.user_id) nested';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':i', 0, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchColumn();

echo 'The average amount of groups per user is '.floatval($result).'<br>';

// DISTINCT and COUNT. Will count the number of a certain value. Because of 
// distinct it won't return double values.
$sql = 'SELECT COUNT(DISTINCT group_id) FROM group_user WHERE status != :i';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':i', 0, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchColumn();

echo 'The amount of groups with members is '.$result.'<br>';

// MIN.
$sql = 'SELECT MIN(age) FROM (SELECT FLOOR(DATEDIFF(NOW(), date_of_birth) / 365.25)
AS age FROM user_personal GROUP BY user_id) nested';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchColumn();

echo 'The youngest user is '.$result.' years old.<br>';

// MAX.
$sql = 'SELECT MAX(age) FROM (SELECT FLOOR(DATEDIFF(NOW(), date_of_birth) / 365.25)
AS age FROM user_personal GROUP BY user_id) nested';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchColumn();

echo 'The oldest user is '.$result.' years old.<br>';

// SUM.

// CREATE DATABASE & CREATE TABLE.

// SQL DROP for table and for schema.

// RIGHT JOIN.

?>