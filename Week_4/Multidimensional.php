<?php

$a[] = array('a','b','c');
$a[] = array('d','e','f');

// Outputs 'b' and 'd'.
echo $a[0][1].' '.$a[1][0].'<br>'.PHP_EOL;

var_dump($a);

?>