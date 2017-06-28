<?php

session_start();

$_SESSION['greeting'] = 'Hello';

echo $_SESSION['greeting'].'<br>'.PHP_EOL;

echo session_id();

session_destroy();

?>