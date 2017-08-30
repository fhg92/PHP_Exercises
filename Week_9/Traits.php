<?php

// Define a Trait.
trait ThisIsATrait
{
    public function helloWorld()
    {
        echo 'Hello, World!<br>'.PHP_EOL;
    }
}

class ThisIsAClass
{
    use ThisIsATrait;
}

$obj = new ThisIsAClass;
$obj->helloWorld();

// Define 2 Traits and use it in another trait.
trait Hello
{
    public function hello()
    {
        echo 'Hello, ';
    }
}

trait Introduce
{
    public function introduce()
    {
        echo 'my name is ';
    }
}

trait Name
{
    use Hello, Introduce;
    
    public $name;
    
    public function __construct($name)
    {
        $this->name = $name;
    }
    
    public function name()
    {
        echo $this->name.'.<br>'.PHP_EOL;
    }
}

class Test
{
    use Name;
}

$obj = new Test('Frank');
$obj->hello();
$obj->introduce();
$obj->name();

// Define 2 Traits with different methods; define a class with the same methods
// and apply the trait. Describe which method has priority.
trait Trait1
{
    public function method1()
    {
        echo 'Hello.<br>'.PHP_EOL;
    }
}

trait Trait2
{
    public function method2()
    {
        echo 'Good morning.<br>'.PHP_EOL;
    }
}

class Class1
{
    use Trait1, Trait2;
    
    public function method1()
    {
        echo 'Hallo.<br>'.PHP_EOL;
    }
    
    public function method2()
    {
        echo 'Goedemorgen.<br>'.PHP_EOL;
    }
}

$obj = new Class1();
$obj->method1();
$obj->method2();
// The methods of Class1 have priority.

// Define 2 Traits with the same method. Solve the fatal error with insteadof.
trait ThisIsTrait1
{
    public function method()
    {
        echo 'Hey.<br>'.PHP_EOL;
    }
}

trait ThisIsTrait2
{
    public function method()
    {
        echo 'Hi.<br>'.PHP_EOL;
    }
}

class TheClass
{
    use ThisIsTrait1, ThisIsTrait2 {
        ThisIsTrait2::method insteadof ThisIsTrait1;
    }
}

$obj = new TheClass();
$obj->method();

// Create 2 aliases of various methods from 1 Trait.
trait ThisIsAnotherTrait
{
    public function hi()
    {
        echo 'Hi.';
    }
    
        public function hey()
    {
        echo 'Hey.';
    }
    
        private function hello()
    {
        echo 'Hello.';
    }
}

class Aliasing
{
    use ThisIsAnotherTrait {
        // Make private function public.
        ThisIsAnotherTrait::hello as public;
        ThisIsAnotherTrait::hey as greeting;
    }
}

$obj = new Aliasing();
var_dump($obj->hello());
$obj->greeting();

?>