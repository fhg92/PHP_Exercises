<?php

$greeting = 'Goodmorning sir.'; 

// strspn() is used to find the amount of matching characters in strings.
// Stops when it reaches a character that doesn't exist in the second string.
// Outputs 11, because 11 characters are matching.
echo strspn($greeting, 'Goodmorning').'<br/>'.PHP_EOL;

$letters = array('o','d','m','r','n','i','G');

// Outputs 0 for each character until it finds 'G'.  
foreach($letters as $test){
echo strspn($greeting, $test).'<br/>'.PHP_EOL;
}

// strcspn() is used to find the amount of nonmatching characters in strings.
// Outputs 0 because there are no nonmatching characters.
echo strcspn($greeting, 'Goodmorning').'<br/>'.PHP_EOL;

// Replaces 'Goodmorning sir.' with 'Goodmorning madam.'.
echo str_replace('sir', 'madam', $greeting).'<br/>'.PHP_EOL;

// Outputs 'Goodmorning sir.' because 'Sir' cannot be found. 
// str_replace() is case sensitive.
echo str_replace('Sir', 'madam', $greeting).'<br/>'.PHP_EOL;

$sentence = 'The quick brown fox jumps over the lazy dog.';
$fox = array('quick', 'fox', 'jumps', 'over');
$lion = array('hungry', 'bear' , 'eats', '');
echo str_replace($fox, $lion, $sentence).'<br/>'.PHP_EOL;

// Starts replacing at the 12th position of $greeting.
echo substr_replace($greeting, 'madam.', 12).'<br/>'.PHP_EOL;

// Starts replacing at the 4th position from the end of $greeting.
echo substr_replace($greeting, 'madam.', -4).'<br/>'.PHP_EOL;

// Outputs 'Goodmorning madam.' because str_ireplace is case insensitive    
echo str_ireplace('Sir', 'madam', $greeting);

?>