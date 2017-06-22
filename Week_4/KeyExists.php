<?php

$array = range(0,9);

$key = 3;

if(array_key_exists($key, $array)){
    echo "Key exists.";
} else {
    echo "Key doesn't exist.";
}

?>