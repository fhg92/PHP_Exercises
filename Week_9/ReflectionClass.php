<?php
/** 
* Test Class.
* 
* This class is made to test with ReflectionClass.
*/
class Test {
    
    static $property1;
    public $property2;
    protected $property3;
    private $property4;
    
    function __construct($property1)
    {   
    }
    
    /**
    *
    * This comment is to test getDocComment() in a method.
    *
    */
    function method1()
    {
    }
    
    static function method2()
    {
    }
}

$rc = new ReflectionClass('Test');
echo 'Comment: <pre>'.$rc->getDocComment().'</pre>'.
    'Filename: '.$rc->getFileName().'<br>'.PHP_EOL.
    'Lines: '.$rc->getStartLine().' - '.$rc->getEndLine().'<br>'.PHP_EOL;

echo 'Methods with Params: <pre>';
foreach($rc->getMethods() as $method) {
    echo $method;
}
echo '</pre>';

echo 'Get all properties: <pre>';
foreach($rc->getProperties() as $property) {
    echo $property;
}
echo '</pre>';

// Easy way to get all information of a class is just to echo the object.
echo 'All information of the class:
<pre>'.$rc.'</pre>';

?>