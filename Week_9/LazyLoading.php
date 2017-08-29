<?php

// Loads the classes of the include folder.
spl_autoload_register(function ($class) {
    include 'include/'.$class.'.class.php';
});

$obj = new Test1();
echo $obj->method();

$obj2 = new Test2();
echo $obj2->method();

?>