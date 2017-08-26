<html>
    <form method='post'>
        <input type='number' name='num1'>
        <select name='op'>
            <option value='+'>+</option>
            <option value='-'>-</option>
            <option value='*'>*</option>
            <option value='/'>/</option>
        </select>
        <input type='number' name='num2'>
        <input type='submit' name='submit'>
    </form>
</html>

<?php

abstract class Calculator
{
    private $num1;
    private $num2;
    private $op;
    
    abstract public function calc();
    
    public function result()
    {
        echo $this->calc();
    }
}

class Extend extends Calculator
{
    public function __construct($num1, $op ,$num2)
    {
        $this->num1 = (int) $num1;
        $this->op = $op;
        $this->num2 = (int) $num2;
    }
    
    public function calc()
    {   
        switch($this->op) {
            case '+':
                return $this->num1 + $this->num2;
                break;
            case '-':
                return $this->num1 - $this->num2;
                break;
            case '*':
                return $this->num1 * $this->num2;
                break;
            case '/':
                return $this->num1 / $this->num2;
                break;
        }   
    }
}

if(isset($_POST['submit'])) {
    $calc = new Extend($_POST['num1'], $_POST['op'], $_POST['num2']);
    $calc->result();
}