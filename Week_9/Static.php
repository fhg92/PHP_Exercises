<?php

/* 
* Playing and testing with the code of:
* http://chipersoft.com/p/PHP-many-meanings-of-static/
*/

class Foo {
    
    public $memberProperty;
    
    static $staticProperty = array(10, 23, 104);

    function memberFunction () {
        $localVariable = 1;
        echo $localVariable;
    }
    
    static function staticFunction () {
        echo self::$staticProperty = 2;
    }

    function exampleA () {
        $this->memberProperty = 3;
    }

    function exampleB () {
        static $staticVariable = 4;
    }
    
    function test() {
        self::memberFunction();
        //$this->memberFunction();
        //static::memberFunction();
    }
    
}

class Bar extends Foo {
    
    static $staticProperty = array(11, 24, 105);
    
    function memberFunction () {
        $localVariable = 2;
        echo $localVariable;
    }
    
    function test2() {
        parent::staticFunction();
    }
    
}

Foo::staticFunction();

$blah = new Foo();
$blah->memberProperty = 7;
var_dump($blah);

$bar = new Bar();
$bar->test();
echo '<br>';
$bar->test2();

?>