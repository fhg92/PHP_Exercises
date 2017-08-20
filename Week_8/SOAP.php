<?php

class mySoapServer
{
    public function getMessage() {
        return 'Hello, World!';
    }
    
    public function addNumbers($num1, $num2) {
        return $num1 + $num2;
    }
}

$options = ['uri' => 'http://localhost/~Frank/PHP_Exercises/Week_8/'];
$server = new SoapServer(NULL, $options);
$server->setClass('MySoapServer');
$server->handle();

?>