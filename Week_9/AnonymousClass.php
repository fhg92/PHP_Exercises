<?php

$obj = new class() {
    
    function test() {
        return 'Hello, World!';
    }
};

var_dump($obj);
echo $obj->test();

?>