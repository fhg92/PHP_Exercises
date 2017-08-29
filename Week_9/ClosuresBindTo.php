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

$newClosure = $closure->bindTo($b, 'B');
$newClosure();

?>