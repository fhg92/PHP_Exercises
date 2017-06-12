<?php 

$array = array('Hello','dear','humans');
print_r($array);
var_dump($array);
debug_zval_dump($array);

$obj = new StdClass();
$obj->hello = 'earth';
$obj->earth = 'song';
print_r($obj);


?>