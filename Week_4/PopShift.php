<?php

// array_pop(). Pop off the last element of an array.
$array = array('Aaron','Bas','Christiaan','Dimitri','Erik','Frank');
// $name is the variable for the popped off element.
$name = array_pop($array);
print_r($array);
echo '<br>'.PHP_EOL;
echo $name.'<br>'.PHP_EOL;

// array_shift(). Shifts off an element at the beginning of an array. 
$array = array('Aaron','Bas','Christiaan','Dimitri','Erik','Frank');
// $name is the variable for the shifted element.
$name = array_shift($array);
print_r($array);
echo '<br>'.PHP_EOL;
echo $name.'<br>'.PHP_EOL;

?>