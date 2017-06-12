<?php 

// While

$i = 1;

while($i <= 10)
{
    echo $i++;
}


// Do While

$i = 1;
do {
    echo $i++;
}
while($i <= 10);
    

// For
    
for ($i = 1; $i <= 10; $i++) 
{
    echo $i;
}


// Foreach with continue and break

$array = array(1,2,3,4,5,6,7,8,9,10);

foreach ($array as $value)
{
    if($value % 2 == 1) continue; 
    if($value > 8) break;
    echo $value;
}

?>