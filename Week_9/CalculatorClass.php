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
        echo $num1 / $num2.'<br>';
    }
}

class DefectiveCalculator extends Calculator
{
    function plus($num1, $num2)
    {
        parent::minus($num1, $num2);
    } 
    
    function minus($num1, $num2)
    {
        parent::plus($num1, $num2);
    }
    
    function show()
    {
        print_r(get_class($this));
        print_r(get_class_methods($this));
        echo '<br>';
    }
}

$calc = new DefectiveCalculator();
$calc->plus(4,2);
$calc->minus(8,5);
$calc->times(9,3);
$calc->divide(52,2);
$calc->show();

$syntax = 'divide';
$calc->$syntax(8,4);
$calc->{$syntax}(3,5);

?>