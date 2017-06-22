<?php

$array = array('f' => 'Frank', 'e' => 'Erik', 'd' => 'Dimitri', 
               'c' => 'Christiaan', 'b' => 'Bas', 'a' => 'Aaron');

function callbackFunction($value, $key)
{
    echo "$key. $value<br>".PHP_EOL;
}

function multiply($value){
    echo $value  * 2;
}

array_walk($array, 'callbackFunction');

$range = range(0,9);

array_walk($range, 'multiply');

?>