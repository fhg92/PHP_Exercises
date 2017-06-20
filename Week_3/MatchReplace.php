<?php

$str = '1he2Llo';

// Checks if there are uppercase, lowercase characters and digits in $str
if (preg_match('/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).+/', $str))
{
    echo 'match'.'<br>'.PHP_EOL;
} else {
    echo 'no match'.'<br>'.PHP_EOL;    
}

// Checks if there is at least one lowercase letter in $str
if (preg_match_all('/[a-z]/', $str) < 1)
{
    echo 'The string must be at least one lowercase letter.<br>'.PHP_EOL;
}

// Checks if there is at least one uppercase letter in $str
if (preg_match_all('/[A-Z]/', $str) < 1)
{
    echo 'The string must be at least one uppercase letter.<br>'.PHP_EOL;
}

// Checks if there is at least one number in $str
if (preg_match_all('/[0-9]/', $str) < 1)
{
    echo 'The string must have at least one number.<br>'.PHP_EOL;
}

// Checks if there is at least one special character in $str
if (preg_match_all('/[!@#$%^&*()\-_=+{};:,<.>§~]/', $str) < 1)
{
    echo 'The string must have at least one special character.<br>'.PHP_EOL;
}

// Replaces 1993 with 1992 with preg_replace()
$birthday = 'July 8, 1993';
$birthday = preg_replace('([0-9]+93)', '1992', $birthday);

print $birthday;

?>