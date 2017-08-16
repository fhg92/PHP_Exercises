<?php

$json = '{ "1": "This is a value", 2: "This is another value" }';

json_decode($json);

echo 'JSON Error: '.json_last_error().'<br>'.PHP_EOL;

echo 'JSON Error as string: '.json_last_error_msg();

?>