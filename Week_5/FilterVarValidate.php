<?php

$email = 'frank@example.com';

if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo("$email is a valid email address.").'<br>'.PHP_EOL;
} else {
    echo("$email is not a valid email address.").'<br>'.PHP_EOL;
}

$boolean = true;
var_dump($boolean);

if (!filter_var($boolean, FILTER_VALIDATE_BOOLEAN) === false) {
    echo("$boolean is a boolean.").'<br>'.PHP_EOL;
} else {
    echo("$boolean is not a boolean.").'<br>'.PHP_EOL;
}

$float = '3.14';
var_dump($float);

if (!filter_var($float, FILTER_VALIDATE_FLOAT) === false) {
    echo("$float is a float.").'<br>'.PHP_EOL;
} else {
    echo("$float is not a float.").'<br>'.PHP_EOL;
}

$int = 3;
var_dump($int);

if (!filter_var($int, FILTER_VALIDATE_INT) === false) {
    echo("$int is a int.").'<br>'.PHP_EOL;
} else {
    echo("$int is not a int.").'<br>'.PHP_EOL;
}

$ip = "192.168.1.1";

if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
    echo("$ip is a valid IP adress.").'<br>'.PHP_EOL;
} else {
    echo("$ip is not a valid IP adress.").'<br>'.PHP_EOL;
}

$mac = "06-00-00-00-00-00";

if (!filter_var($mac, FILTER_VALIDATE_MAC) === false) {
    echo("$mac is a valid MAC adress.").'<br>'.PHP_EOL;
} else {
    echo("$mac is not a valid MAC adress.").'<br>'.PHP_EOL;
}

$string = 'hello';

$options = array('options' => array('regexp' => '/[a-z]/'));

if (!filter_var($string, FILTER_VALIDATE_REGEXP, $options) === false) {
    echo("$string matches the regular expression.").'<br>'.PHP_EOL;
} else {
    echo("$string does not match the regular expression.").'<br>'.PHP_EOL;
}

$url = 'http://www.google.nl/';
    
if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
    echo("$url is a valid URL.").'<br>'.PHP_EOL;
} else {
    echo("$url is not a valid URL.").'<br>'.PHP_EOL;
}

?>