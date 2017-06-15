<?php
 
$string = 'abcdef';
// $middlechar = (int) (round(strlen($string)-1) / 2);
$middlechar = (int) (round(strlen($string) / 2, 0, PHP_ROUND_HALF_DOWN));
//echo round(strlen($string) / 2, 0, PHP_ROUND_HALF_DOWN);
echo $string[$middlechar].'<br/>'.PHP_EOL;

$z = [$string[$middlechar] => 'z'];
echo strtr($string[$middlechar], $z);

?>