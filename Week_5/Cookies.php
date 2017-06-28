<?php

$v = 'Value.';

setcookie('test', $v);

setrawcookie('raw', $v);

if(!isset($_COOKIE['test'])) {
    echo 'Cookie is not set.'.'<br>'.PHP_EOL;
} else {
    echo ($_COOKIE['test']).'<br>'.PHP_EOL;
}

if(!isset($_REQUEST['raw'])) {
    echo 'Cookie is not set.'.'<br>'.PHP_EOL;
} else {
    echo ($_REQUEST['raw']).'<br>'.PHP_EOL;
}

?>