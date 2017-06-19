<?php

$abc = 'abcdefghijklmnopqrstuvwxyz';
$string = 'hijkl';

// Checks if $string is found in $abc.
if (strpos($abc, $string) == true){
    echo 'String found.';
}

// Checks on what position $string is starting in $abc.
echo strpos($abc, $string, 1); // Outputs 7. $string starts at position 7 of $abc.

// Starts $abc from the position where $string begins.
echo strstr($abc, $string);

$iabc = 'AbcDeFgHiJkLmNoPqRsTuVwXyZ';

// Case insensitive version of strpos().
echo stripos($abc, $string, 1); // Outputs 7. $string starts at position 7 of $abc.

// Case insensitive version of strstr().
echo stristr($abc, $string);

?>