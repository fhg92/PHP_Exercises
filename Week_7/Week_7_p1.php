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
    echo '<tr><td>'.$user['first_name'].'</td> <td>'.$user['last_name'].'</td></tr>';
}
echo '</table>';

// AVG and COUNT. Will calculate the average number of groups per user.
$sql = 'SELECT AVG(count) FROM (SELECT COUNT(gu.group_id) AS 
count FROM group_user gu INNER JOIN user u WHERE gu.user_id = u.user_id AND 
gu.status != :i GROUP BY gu.user_id) nested';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':i', 0, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchColumn();

echo '<p>The average amount of groups per user is '.floatval($result).'</p>';

// DISTINCT and COUNT. Will count the number of a certain value. Because of 
// distinct it won't return double values.
$sql = 'SELECT COUNT(DISTINCT group_id) FROM group_user WHERE status != :i';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':i', 0, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchColumn();

echo '<p>The amount of groups with members is '.$result.'</p>';

// MIN.
$sql = 'SELECT MIN(age) FROM (SELECT FLOOR(DATEDIFF(NOW(), date_of_birth) / 365.25)
AS age FROM user_personal GROUP BY user_id) nested';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchColumn();

echo '<p>The youngest user is '.$result.' years old.</p>';

// MAX.
$sql = 'SELECT MAX(age) FROM (SELECT FLOOR(DATEDIFF(NOW(), date_of_birth) / 365.25)
AS age FROM user_personal GROUP BY user_id) nested';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchColumn();

echo '<p>The oldest user is '.$result.' years old.</p>';

// RIGHT JOIN. Returns surname and first name by group ID even when the user
// doesn't have a group ID / status.

$sql = 'SELECT g.group_id, u.last_name, u.first_name FROM 
group_user g RIGHT JOIN user_personal u ON g.user_id = u.user_id ORDER BY 
g.group_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':i', 0, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<table border="1">';
foreach($result as $r) {
    echo '<tr><td>'.$r['group_id'].'</td><td> '.$r['last_name'].'</td><td> '
        .$r['first_name'].'</td></tr>';
}
echo '</table><br>';

?>