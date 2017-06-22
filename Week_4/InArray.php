<?php

$array = array('England','Germany','France');

$value = 'Germany';

if(in_array($value, $array)){
    echo 'Value exists.';
} else {
    echo "Value doesn't exist.";
}

?>