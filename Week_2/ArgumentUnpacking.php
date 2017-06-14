<?php

function greeting($english, $german, $french)
{   
    // Return variables with spaces between them.
    return $english . ' ' . $german . ' ' . $french;
}

// Give values to $greetings and put them in a array.
$greetings = ['Hello', 'Hallo', 'Bonjour'];

// Unpack $greeting. $english, $german and $french are being replaced 
// by ...$greetings.
echo greeting(...$greetings);

?>