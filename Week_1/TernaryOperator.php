<?php 

$hello = (isset($goodbye)) ? 'Goodbye' : 'Hello';

echo $hello;

/*

The above lines of code do the same thing as:

if(isset($goodbye))
{
    $hello = 'Goodbye';
}
else
{
    $hello = 'Hello';
}

echo $hello;

*/

?>