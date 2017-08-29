<?php

interface Operator1
{
    public function plus();
    public function minus();
}

interface Operator2
{
    public function times();
    public function divide();
}

class InterfaceCalculator implements Operator1, Operator2
{
    public function __construct($num1, $num2)
    {
        $this->num1 = (int) $num1;
        $this->num2 = (int) $num2;
    }
    
    public function plus()
    {   
        return $this->num1 + $this->num2.'<br>'.PHP_EOL;
    }
    
    public function minus()
    {   
        return $this->num1 - $this->num2.'<br>'.PHP_EOL;
    }
    
    public function times()
    {   
        return $this->num1 * $this->num2.'<br>'.PHP_EOL;
    }
    
    public function divide()
    {   
        return $this->num1 / $this->num2.'<br>'.PHP_EOL;
    }
    
    public function instantiate()
    {
        $calc = new InterfaceCalculator(0,0);
        if($calc instanceof Operator1) {
            echo 'Calculator is a instance of Operator1<br>'.PHP_EOL;
        }
        if($calc instanceof Operator2) {
            echo 'Calculator is a instance of Operator2<br>'.PHP_EOL;
        }
    }
}

$calc = new InterfaceCalculator(3,5);
echo $calc->times();
echo $calc->plus();
echo $calc->instantiate();

?>