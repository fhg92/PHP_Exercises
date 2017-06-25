<?php

$array = array('a' => 'Russia', 'b' => 'Germany', 'c' => 'England', 'd' => 'France');
$arrayObject = new ArrayObject($array);

// append() adds a new value.
$arrayObject->append('Italy');
print_r($arrayObject);
echo '<br>'.PHP_EOL;

// asort() sorts the array and maintains index association.
$arrayObject->asort();
print_r($arrayObject);
echo '<br>'.PHP_EOL;

// natsort() uses the natural order algorithm.
$arrayObject->natsort();
print_r($arrayObject);  

?>