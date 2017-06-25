<?php

$array = array('a' => 'Russia', 'b' => 'Germany', 'c' => 'England', 'd' => 'France');
print_r($array);
echo '<br>'.PHP_EOL;

sort($array, SORT_NUMERIC);
print_r($array);
echo '<br>'.PHP_EOL;

sort($array, SORT_REGULAR);
print_r($array);
echo '<br>'.PHP_EOL;

sort($array, SORT_STRING);
print_r($array);
echo '<br>'.PHP_EOL;

// Reverse sort.
rsort($array);
print_r($array);
echo '<br>'.PHP_EOL;

// Sort an array and maintain index association.
asort($array);
print_r($array);
echo '<br>'.PHP_EOL;

// Reverse sort and maintain index association.
arsort($array);
print_r($array);
echo '<br>'.PHP_EOL;

// Sort by key.
ksort($array);
print_r($array);
echo '<br>'.PHP_EOL;

// Sort by key in reverse order.
krsort($array);
print_r($array);
echo '<br>'.PHP_EOL;

// 'Natural order' sort. Sorts by name.
natsort($array);
print_r($array);
echo '<br>'.PHP_EOL;   

// User defined sort function (sorts in natural order by last character).
function sortByLastCharacter($a, $b)
{
    // strnatcmp() is being used for natural order string comparison.
    // strrev() is being used for string reverse.
    return strnatcmp(strrev($a), strrev($b));
}

// User-defined sort.
usort($array, 'sortByLastCharacter');
print_r($array);

?>