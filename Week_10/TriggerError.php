<?php

class Calculator
{
    private $num1;
    private $num2;
    
    public function __construct($num1, $num2)
    {
        $this->num1 = (int) $num1;
        $this->num2 = (int) $num2;
    }
    
    public function divide()
    {   
        if ($this->num2 == 0) {
            trigger_error("Woops. You can't divide by zero", 
                          E_USER_WARNING);
        } else {
            return $this->num1 / $this->num2;
        }
    }
}

$calc = new Calculator(3, 0);
echo $calc->divide();

$oldHandler = '';

function newHandler($num, $string, $file, $line, $context)
{
    $oldHandler;
    
    logToFile("Error $string in $file at line $line");
    
    if($oldErrorHandler) {
        $oldErrorHandler($num, $string, $file, $line, $context);
    }
}

$oldHandler = set_error_handler('newHandler', E_ALL);


?>