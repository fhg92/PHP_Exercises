<?php
    
$greeting = 'Hi'; // Puts 'Hi' in variable $greeting.

function greeting() {
    $greeting = 'Hello'; // Puts 'Hello' in variable $greeting. 
    $greetinginfunction = 'Hi'; 
}

greeting();

echo $greeting . '<br/>'.PHP_EOL; // Outputs 'Hi'.
echo $greetinginfunction . '<br/>'.PHP_EOL; // Emits a notice.


// Using global.

$greeting = 'Hello, ';
$name = 'Frank';

function greeting1() {
    global $greeting, $name; // Puts $greeting and $name into a global.
    echo "$greeting $name!". '<br/>'.PHP_EOL;
    // Use double quotes while echoing, with single quotes it will output '$greeting $name!'. 
}

greeting1(); // Outputs 'Hello, Frank!'.

// $GLOBALS array

$greeting = 'Hello, ';
$name = 'Frank';

function greeting2() {
    echo $GLOBALS['greeting'] . ''. $GLOBALS['name'].'!'; 
}

greeting2(); // Outputs 'Hello, Frank!'.

?>