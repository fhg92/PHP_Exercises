<?php

$input = $_POST['input'];

foreach($input as $value) {
    print $value.'<br>'.PHP_EOL;
    urlencode($value);
}

?>