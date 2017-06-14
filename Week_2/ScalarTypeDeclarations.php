<?php

function sum()
{
    // Returns the array_sum and specifies what type of data it is.
    return array_sum(array(8, 4.6, 5.3, 6));
}

var_dump(sum()); // Shows output.


function number()
{
    $number = 1; // Gives $number a value.
    return $number; // Returns a value and specifies what type of data it is.
}

var_dump(number()); // Shows output.

?>