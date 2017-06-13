<?php
$bla = "Something"; // Puts 'Something' in a variable.
echo $bla . "<br/>".PHP_EOL; // Echo $bla and start a new line. Outputs 'Something'.

function thisIsAFunction(&$hi) { // Function with passing by reference.
    $hi = 'Hi'; // Puts 'Hi' in a variable.
    echo $hi . "<br/>".PHP_EOL; // Echo $hi and start a new line. Outputs 'Hi'.
}

thisIsAFunction($bla); // Function with $bla argument.

echo $bla // Echo $bla with a new output: 'Hi'.

?>