<?php

function stringReverse($value)
{
    return strrev($value);
}

$string = 'Hello World!';
$string = filter_var($string, FILTER_CALLBACK, array('options' => 'stringReverse'));
echo $string.'<br>'.PHP_EOL;

?>