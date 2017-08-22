<?php

class Test
{
    const HELLO = 'Hello<br>';
    
    function hello()
    {
        echo Test::HELLO;
    }
}

echo Test::HELLO;

$test = new Test();
$test->hello();

?>