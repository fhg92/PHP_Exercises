<?php 

$a = 1;
echo $a + 8;

// Arithmetic Operators

$b = 3;
$c = 4;    
echo $b + $c;
echo $c / $b;
echo $c - $b;
echo $c * $b;

$d = 24 % 9;
echo $d;

$e = 2 ** 1;
echo $e;


// String Operator

$a = 'String ';
echo $b = $a . 'Operator';

echo $a .='Operator';


// Comparison Operators

if(1 == 1)
    echo 'Equivalence';

if('Bob' === 'Bob')
    echo 'Identity';

if(3 != 4)
    echo 'Not-equivalent operator';

if(3 !== '3')
    echo 'Not-identical operator';


if(3 < 4)
    echo 'less than';

if(3 >= 3) 
    echo 'greater than or equal to';

// Bitwise Operators

$hello = 'Hello ';
$world = 'World!';

if($hello & $world)
    echo 'AND';

if($hello | $world)
    echo 'OR';

if($hello ^ $world)
    echo 'XOR';

// 128 64 32 16 8 4 2 1

// decbin() can be used to convert decimal number to binary number.
$i = 4;
echo $i << 2; // Outputs 16
echo decbin($i << 2);
echo $i << 3; // Outputs 32
echo $i << 4; // Outputs 64

$i= 8;
echo $i >> 1; // Outputs 4
echo $i >> 2; // Outputs 2
echo $i >> 3; // Outputs 1
echo $i >> 4; // Outputs 0
echo $i >> 5; // Outputs 0

// Incrementing/Decrementing Operators

$a = 3;
echo ++$a; // Outputs 4
$a = 3;
echo $a++; // Outputs 3
$a = 3;
echo --$a; // Outputs 2
$a = 3;
echo $a--; // Outputs 3

// Type Operators

class ThisIsAClass
{
}

$a = new ThisIsAClass;
var_dump($a instanceof ThisIsAClass); // Outputs true

var_dump(!($a instanceof stdClass)); // Checks if not an instance of object, outputs true

// Execution Operators

$output = `ls -al`;
echo "<pre>$output</pre>";

$output = `ls -l`;
echo "<pre>$output</pre>";

// Error Control Operator

(@include("file.php"))
OR die("Could not find file.php");

?>