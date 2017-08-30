<?php

// User-defined error handler.
// The fifth parameter 'errcontext' is deprecated since PHP 7.2.0.
function errorHandler($errno, $errstr, $errfile, $errline) {
    echo "<b>Error:</b> [$errno] $errstr on line $errline in $errfile<br>"
        .PHP_EOL;
}

// Sets a user-defined error handler function.
set_error_handler('errorHandler');

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
            // Generate a user level error/warning/notice.
            trigger_error("You can't divide by zero", 
                          E_USER_WARNING);
        } else {
            return $this->num1 / $this->num2;
        }
    }
}

$calc = new Calculator(3, 0);
echo $calc->divide(); 

?>