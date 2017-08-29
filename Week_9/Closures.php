<?php

$closure = function($x, $y) {
    echo $x + $y.'<br>'.PHP_EOL;
};

$closure(3,5);

function calculate($x, $y) {
    return function() use ($x, $y) {
        echo $x + $y.'<br>'.PHP_EOL;
    };
}

$sum = calculate(5, 7);
$sum();

function calculate2(&$x, &$y) {
    return function() use (&$x, &$y) {
        echo $x + $y.'<br>'.PHP_EOL;
        $x = 0;
        $y = 10;
    };
}

$x = 10;
$y = 20;
$sum = calculate2($x, $y);
$sum();

var_dump($x); // Outputs 0.
var_dump($y); // Outputs 10.


// Using $this with closures.
class Hello
{
    public $name = 'Frank';
    
    public function name()
    {
        return function()
        {
            return 'Hello '.$this->name;
        };
    }
}

$hello = new Hello();
$test = $hello->name();
echo $test();

?>