<?php

class Huh extends Exception
{   
	public function __construct($message, $code = 0, Exception $previous = null)
	{
        parent::__construct($message, $code, $previous);
        
        error_log('Exception: '.$this->getMessage().' in '.$this->getFile().
                  ' on line '.$this->getLine(), 0);
	}
}

function testingExceptions($error)
{
    if($error == true) {
        throw new Exception('Error!');
    } else {
        throw new Huh("This exception shouldn't exist.");
    }
}

try {
    $error = false;
    
    testingExceptions($error);
}
catch(Huh $h)
{
	echo 'Exception: '.$h->getMessage().'<br>Class: '.get_class($h);
}
catch(Exception $e)
{
	echo 'Exception: '.$e->getMessage().'<br>Class: '.get_class($e);
}

?>