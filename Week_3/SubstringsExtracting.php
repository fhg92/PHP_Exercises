<?php

$greeting = 'Goodmorning';

echo substr($greeting, 0, 4).'<br/>'.PHP_EOL; // Outputs 'Good'.

echo substr($greeting, 4).'<br/>'.PHP_EOL; // Outputs 'morning'.

echo substr($greeting, -7).'<br/>'.PHP_EOL; // Outputs 'morning'.

echo substr($greeting, 4, 1); // Outputs 'm'.

?>