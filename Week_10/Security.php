<?php

session_start();

// Seems like a static session ID.
echo 'This is a session ID: '.session_id().'<br>'.PHP_EOL;

// Because of this function the session ID will be regenerated after refreshing.
session_regenerate_id();

// htmlspecialchars.
$value = '&amp';
echo htmlspecialchars($value).'<br>'.PHP_EOL;

$html = '<p><b>This is a paragraph</b></p><br>';
echo strip_tags($html, '<b>').'<br>'.PHP_EOL;

$pass = 'This is a password';

$hash = crypt($pass, 'Dit is een salt');
echo $hash.'<br>'.PHP_EOL;

// Not safe.
$hash = md5($pass);
echo $hash.'<br>'.PHP_EOL;

// Not safe.
$hash = sha1($pass);
echo $hash.'<br>'.PHP_EOL;

$options = ['cost' => 12];
$hash = password_hash($pass, PASSWORD_BCRYPT, $options);
echo $hash.'<br>'.PHP_EOL;

?>