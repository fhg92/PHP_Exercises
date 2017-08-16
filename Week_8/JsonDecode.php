<?php

$array = [3 => '<test>', 6 => '&', 1 => "'test'", 4 => '"test"', 7 => "'1'", 5 => '12345678', 
          2 => 'http://www.google.nl/', 8 => '€'];

$json = json_encode($array);

// Default. Returns JSON as object.
var_dump(json_decode($json, false));

echo '<br><br>';

// True. Returns JSON as array.
var_dump(json_decode($json, true));

?>