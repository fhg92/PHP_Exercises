<?php

$array = ['<test>','&',"'test'",'"test"', "'1'", '12345678', 
          'http://www.google.nl/', '€'];

echo 'NO OPTIONS: '.json_encode($array).'<br>'.PHP_EOL;

echo 'JSON_HEX_TAG: '.json_encode($array, JSON_HEX_TAG).'<br>'.PHP_EOL;

echo 'JSON_HEX_AMP: '.json_encode($array, JSON_HEX_AMP).'<br>'.PHP_EOL;

echo 'JSON_HEX_APOS: '.json_encode($array, JSON_HEX_APOS).'<br>'.PHP_EOL;

echo 'JSON_HEX_QUOT: '.json_encode($array, JSON_HEX_QUOT).'<br>'.PHP_EOL;

echo 'JSON_FORCE_OBJECT: '.json_encode($array, JSON_FORCE_OBJECT).'<br>'
    .PHP_EOL;

echo 'JSON_NUMERIC_CHECK: '.json_encode($array, JSON_NUMERIC_CHECK).'<br>'
    .PHP_EOL;

echo 'JSON_BIGINT_AS_STRING: '.json_encode($array, JSON_BIGINT_AS_STRING).
    '<br>'.PHP_EOL;

echo 'JSON_PRETTY_PRINT: '.json_encode($array, JSON_PRETTY_PRINT).'<br>'
    .PHP_EOL;

echo 'JSON_UNESCAPED_SLASHES: '.json_encode($array, JSON_UNESCAPED_SLASHES).
    '<br>'.PHP_EOL;

echo 'JSON_UNESCAPED_UNICODE: '.json_encode($array, JSON_UNESCAPED_UNICODE).
    '<br>'.PHP_EOL;

?>