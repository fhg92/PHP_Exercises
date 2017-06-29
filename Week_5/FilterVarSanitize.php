<?php

// FILTER_SANITIZE_EMAIL removes all characters except letters, digits and
// !#$%&'*+-=?^_`{|}~@.[].
$email = 'f/ra)n(k@e,xam\ple.com';
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
echo $email.'<br>'.PHP_EOL;

// FILTER_SANITIZE_ENCODED URL-encodes string, optionally strips or encodes
// special characters.
$url = 'http://www.google.nl/';
$url = filter_var($url, FILTER_SANITIZE_ENCODED);
echo $url.'<br>'.PHP_EOL;

// Applies addslashes().
$string = "Hi. How's you?";
$string = filter_var($string, FILTER_SANITIZE_MAGIC_QUOTES);
echo $string.'<br>'.PHP_EOL;

// Removes all characters except digits, +- and optionally .,eE.
$characters = 'fd42!3h-g76;5.h87+g1,3j';
$digits = filter_var($characters, FILTER_SANITIZE_NUMBER_FLOAT);
echo $digits.'<br>'.PHP_EOL;

// Removes all characters except digits, plus and minus sign.
$characters = 'fd42!3h-g76;5.h87+g1,3j';
$digits = filter_var($characters, FILTER_SANITIZE_NUMBER_INT);
echo $digits.'<br>'.PHP_EOL;

// FILTER_SANITIZE_SPECIAL_CHARS HTML-escapes '"<>& and characters with ASCII value less than 32.
// Optionally strips or encodes other special characters.
// The browser will output the value of $string, in view source you'll see
// a different output with ASCII value.
$string = '<h1>Hallo. </h1><p>Dit is een test.</p>';
$specialchars = filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS);
echo $specialchars.'<br>'.PHP_EOL;

$string = '<h1>Hallo. </h1><p>Dit is een test.</p>';
$specialchars = filter_var($string, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
echo $specialchars.'<br>'.PHP_EOL;

// FILTER_SANITIZE_STRING strips tags, optionally strips or encodes special characters.
$string = '<p>This is a test.</p';
$string = filter_var($string, FILTER_SANITIZE_STRING);
echo $string.'<br>'.PHP_EOL;

// FILTER_SANITIZE_STRING alias of 'string' filter.
$string = '<p>This is a test.</p';
$string = filter_var($string, FILTER_SANITIZE_STRIPPED);
echo $string.'<br>'.PHP_EOL;

// FILTER_SANITIZE_URL removes all characters except letters, digits and 
// $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
$url = 'http://www.goo€gle.nl/';
$url = filter_var($url, FILTER_SANITIZE_URL);
echo $url.'<br>'.PHP_EOL;

// Do nothing, optionally strip or encode special characters. 
// This filter is also aliased to FILTER_DEFAULT.
$string = 'http://www.goo&gle.nl/';
$string = filter_var($string, FILTER_UNSAFE_RAW, FILTER_FLAG_ENCODE_AMP);
echo $string;

?>