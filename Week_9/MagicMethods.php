<?php

class Test
{

    private $that;
    protected $nonPublicProperty;
    private $values = [];
    
    public $var1, $var2;
    
    private static function inaccessibleStaticMethod()
    { 
    }
    
    // __get().
    public function __get($property)
	{
		echo "$property does not exist or is not public.<br>".PHP_EOL;
	}
    
    // __set().
    public function __set($name, $value)
    {
        echo "Set $name to $value<br>".PHP_EOL;
        $this->values[$name] = $value;
    }
    
    // __isset(). Check if $name is set.
    public function __isset($name)
    {
        echo "Is '$name' set?<br>".PHP_EOL;
        return isset($this->values[$name]);
    }
    
    // __unset(). Unset $name.
    public function __unset($name)
    {
        echo "Unset $name<br>".PHP_EOL;
        unset($this->values[$name]);
    }
    
    // __call().
    public function __call($name, $arguments)
    {
        echo "Calling non-existent/inaccessible object method $name<br>"
            .PHP_EOL;
    }
    
    // __callStatic().
    public static function __callStatic($name, $arguments)
    {
        echo "Calling non-existent/inaccessible static method $name<br>"
            .PHP_EOL;
    }
    
    // __invoke(). Call object 
    public function __invoke($value)
    {
        echo "Call value of object which is used as a function: $value<br>"
            .PHP_EOL;
    }
    
    // __clone().
    public function __clone()
    {
        $this->that = ++$this->that;
    }
    
    // __set_state().
    public static function __set_state($array)
    {
        $obj = new Test;
        $obj->var1 = $array['var1'];
        $obj->var2 = $array['var2'];
        return $obj;
    }
    
}


// Class Test2 is used for testing __sleep and __wakeup.
class Test2
{
    public $username, $password;
    
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
      
    public function __sleep()
    {
        $this->username = 'Frank';
        return array('username');
    }
    
    public function __wakeup() {
        if($this->username == 'Frank') {
            $this->password = 
                '$2y$10$3ZfERV/uJSa/NVKBFeE4aO5uaPKWSGJ/19Wc.8/W.6TNbGoPsmnA.';
        }
    }

}

// class Test3 is used for testing __toString() and __debugInfo().
class Test3
{
    public $string;
    
    public function __construct($string)
    {
        $this->string = $string;
    }
    
    public function __toString()
    {
        return $this->string;
    }
    
    public function __debugInfo()
    {
        return ['key' => $this->string];
    }
}

// New object.
$obj = new Test();

// Check if name is public. Returns message if not public.
$obj->nonPublicProperty;

// Set abc to hello.
$obj->abc = 'hello';

// Check if abc is set.
var_dump(isset($obj->abc));

// Unset abc.
unset($obj->abc);

// Check again if abc is set.
var_dump(isset($obj->abc));

// Call non-existent/inaccessible object method.
$obj->nonExistingMethod();

// Call non-existent/inaccessible static method.
Test::inaccessibleStaticMethod();

// Call object as a function.
$obj('This is a value.');

$obj2 = clone $obj;
var_dump($obj2);

$obj3 = new Test2('JustSomeUsername', 'ThisIsAPassword');
var_dump($obj3);

$data = serialize($obj3).PHP_EOL;
echo $data.PHP_EOL;

var_dump(unserialize($data));

$obj->var1 = 'value';
$obj->var2 = 'another value';

// Evaluate string as PHP code. var_export outputs parsable string 
// representation of a variable.
eval('$obj4 ='.var_export($obj, true).';');

var_dump($obj4);

$obj5 = new Test3('Hello');
echo $obj5;

var_dump(new Test3('Bye'));

?>