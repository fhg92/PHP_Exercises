<?php

for($i = 0; $i <= 10; $i++){
    echo $i;
}

echo '<br>'.PHP_EOL;

$array = [0,1,2,3,4,5,6,7,8,9];

foreach($array as $a){
    echo $a;
}

echo '<br>'.PHP_EOL;

$i = 0;

foreach($array as $a){
    echo "\$array[$i] => $a\n";
    $i++;
}

?>