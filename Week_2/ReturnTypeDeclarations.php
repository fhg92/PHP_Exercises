<?php

// Start function and declare the type of value that will be returned
// by the function.
function sum() : int
{
    // Returns a rounded answer of the sum of values of an array.
    return round(array_sum(array(8, 4.6, 5.3, 6)));
} // End function sum().

var_dump(sum()); // Shows output as integer.


// Start function and declare the type of value that will be returned
// by the function.
function number() : float
{
    $pi = 3.14159265; // Puts the value in the variable $pi.
    return $pi; // Returns the value of $pi.
} // End function number().

var_dump(number()); // Shows output as float.

?>