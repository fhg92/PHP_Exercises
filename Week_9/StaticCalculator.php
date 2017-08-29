<?php

class StaticCalculator
{
    static function plus($num1, $num2)
    {
        echo $num1 + $num2.'<br>';
    }
    
    static function minus($num1, $num2)
    {
        echo $num1 - $num2.'<br>';
    }
}


StaticCalculator::plus(1,5);
StaticCalculator::minus(5,1);

?>