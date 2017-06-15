<?php

// Get the string length of the value of $string with strlen.
$string = 'Hello sir.';
echo strlen($string).'<br/>'; // Outputs '10'.

// $madam replaces 'sir' with 'madam' with the use of strtr.
$madam = array('sir' => 'madam');
echo strtr('Hello sir.', $madam ) // Outputs 'Hello madam.'.

?>