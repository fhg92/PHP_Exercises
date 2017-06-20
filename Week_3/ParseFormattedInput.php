<?php

$string = 'Age: 24 Length: 183cm';
sscanf($string, 'Age: %d Length: %dcm', $age, $length);
var_dump($age, $length);

$string = 'Hello, my name is Frank';
sscanf($string, 'Hello, my name is %s', $name);
echo $name;

?>