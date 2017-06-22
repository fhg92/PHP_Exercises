<?php

// array_push(). Add elements to the end of an array.
$a = array('a','b','c','d','e','f');
array_push($a, 'g','h','i','j','k');
print_r($a);

echo '<br>'.PHP_EOL;

// array_unshift(). Add elements to the beginning of an array.
$b = array(4,5,6,7,8);
array_unshift($b, 1,2,3);
print_r($b);

?>