<?php

class Hello
{
    function __construct($name = null)
    {
        if($name == null) {
            $name = 'World';
        }
        echo 'Hello, '.$name.'!<br>';
    }

    function name($name = null)
    {
        if($name == null) {
            $name = 'World';
        }
        echo 'Hello, '.$name.'!<br>';
    }

    function __destruct()
    {
        $this->name();
    }
}

$hello = new Hello('Jan');
$hello->name('Gijs');

?>