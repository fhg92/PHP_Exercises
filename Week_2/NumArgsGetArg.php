<?php

function greeting()
{
    $numargs = func_num_args(); // Puts func_num_args() in a variable.
    echo "Number of arguments: $numargs" . PHP_EOL; // Echo number of arguments and the value of $numargs.
    // Use double quotes while echoing, with single quotes it will output 'Number of arguments: $numargs'. 
    echo "The second argument is: " . func_get_arg(2) . PHP_EOL;
    // Echos the value which belongs to the key defined between the parenthesis of func_get_arg().
}

greeting('Hi', 'Hey', 'Hello');  // Displays the echos of function greeting().