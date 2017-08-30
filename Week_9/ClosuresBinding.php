<?php

class A
{   
    public function method()
    {
        return function()
        {
            $this->anotherMethod();
            echo $this->property.'!';
        };
    }
}

class B
{
    public $property = 'World';
    
    public function anotherMethod()
    {
        echo 'Hello, ';
    }
}

$a = new A();
$closure = $a->method();

$b = new B();

// bindTo().
//$new = $closure->bindTo($b, 'B');
//$new();

// Static bind.
//$new = Closure::bind($closure, $b, 'B');
//$new();

// PHP7 substitute of bindTo.
$closure->call($b);

?>