<?php

// Make a function with $english and ...$greetings.
// $english stands for the first argument, and ...$greetings for anything else.
function greeting($english, ...$greetings)
{ 
    // Echo $english with a space.
    echo $english . ' ';
    
    // Iterate through array of $greetings and get the single values as $greeting.
    foreach ($greetings as $greeting) {
        // Echo $greeting with a space.
        echo $greeting . ' ';
    }
}

// Give value 'Hello' to the first argument ($english) and all other values to ...$greetings.
greeting('Hello', 'Hallo', 'Bonjour');

?>