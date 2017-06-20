<?php

// printf() outputs a formatted string.
// Outputs 3.1

$pi = 3.14159265;

printf("%.1f",$pi);
echo '<br/>'.PHP_EOL;

// sprintf() returns a formatted string.
// Outputs 'Frank was born in 1992'

$name = 'Frank';
$year = 1992;

$sentence = '%s was born in %d';
echo sprintf($sentence, $name, $year);


// fprintf() writes a formatted string to a stream.
// Outputs string $input in test.txt

$input = 'Hello World!';
$file = fopen("test.txt","w");
   
fprintf($file,"%s",$input);

?>