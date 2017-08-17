<?php

// Requires DbConnect.php from Week_7. Located in 
// Week_7/Application/Include/DbConnect.php.
// Week_7.sql is located in Week_7. 

require('../Week_7/Application/Include/DbConnect.php');

$sql = 'SELECT last_login FROM user_personal';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$lastLogin = $stmt->fetchColumn();

// DateTime.
function addTime(DateTime $datetime) {
    // Adds 1 day and 8 hours.
    return $datetime->add(new \DateInterval('P1DT8H'))->format('Y-m-d H:i:s');
}

$date = new DateTime($lastLogin);
echo 'DateTime:<br>'.addTime($date).'<br>'.PHP_EOL;
echo $date->format('Y-m-d H:i:s').'<br>'.PHP_EOL;

function addTime2(DateTimeImmutable $dateTime) {
    // Adds 1 day and 8 hours.
    return $dateTime->add(new \DateInterval('P1DT8H'))->format('Y-m-d H:i:s');
}

// DateTimeImmutable. Returns a new object instead of modifying itself.
$date = new DateTimeImmutable($lastLogin);
echo '<br>DateTimeImmutable:<br>'.addTime2($date).'<br>'.PHP_EOL;
echo $date->format('Y-m-d H:i:s').'<br>'.PHP_EOL;

// DateTime and date().
$date = DateTime::createFromFormat('d-m-Y', date('d-m-Y'));
echo '<br>'.$date->format('Y-m-d').'<br>'.PHP_EOL;

// DateTime and mktime().
$date = new DateTime('@'.mktime(0, 0, 0, 8, 7, 1992));
$date->setTimeZone(new DateTimeZone('Europe/Amsterdam'));
echo $date->format('Y-m-d H:i:s').'<br>'.PHP_EOL;
    
// DateTime and strtotime(). strtotime() is not needed with DateTime.
$date = new DateTime('8 July 1992');
$date->setTimeZone(new DateTimeZone('Europe/Amsterdam'));
echo $date->format('Y-m-d H:i:s').'<br>'.PHP_EOL;

// DateTime and time().
$date = new DateTime('@'.time());
$date->setTimeZone(new DateTimeZone('Europe/Amsterdam'));
echo $date->format('Y-m-d H:i:s');

?>