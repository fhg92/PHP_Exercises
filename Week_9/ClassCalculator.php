<?php

class Calculator
{
    function plus($num1, $num2)
    {
        echo $num1 + $num2.'<br>';
    }
    
    function minus($num1, $num2)
    {
        echo $num1 - $num2.'<br>';
    }

    function times($num1, $num2)
    {
        echo $num1 * $num2.'<br>';
    }
    
    function divide($num1, $num2)
    {
        echo $num1 / $num2;
    }
}

$calc = new Calculator();
$calc->plus(4,2);
$calc->minus(8,5);
$calc->times(9,3);
$calc->divide(52,2);


?>