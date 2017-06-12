<?php 

$hello = false;

if($hello)
{
    echo 'Hello';
}
elseif(!$hello)
{
    echo 'Goodbye';
}

$hi = true;

if(!$hi)
{
    echo 'Hi';
}
elseif($hello)
{
    echo 'Hello';
}
else
{
    echo 'Bye';
}


$a = 8;
$b = 6;
$c = 9;
    
if($a == 8)
{
    {
        if($a < $b)
        {
            echo 'A is less than B.';
        }
        elseif($a > $c)
        {
            echo 'A is greater than C.';
        }
        else
        {
            echo 'A is greater than B and less than C.';
        }
    }
}

?>