<?php

$array = array('a' => 'Russia', 'b' => 'Germany', 'c' => 'England', 'd' => 'France');

// array_change_key_case(). Changes the case of all keys.
// In this example the keys will be in uppercase.
print_r(array_change_key_case($array, CASE_UPPER));
echo '<br>'.PHP_EOL;

// array_chunk() splits the array into chunks.
// In this example the array will be split into chunks of 2 values.
print_r(array_chunk($array, 2));
echo '<br>'.PHP_EOL;
// In this example the array will be split into chunks of 2 values and preserve keys.
print_r(array_chunk($array, 2, true));
echo '<br>'.PHP_EOL;

$countries = array(
    array(
        'country' => 'Japan',
        'continent' => 'Asia',
        'language' => 'Japanese',
    ),
    array(
        'country' => 'The Netherlands',
        'continent' => 'Europe',
        'language' => 'Dutch',
    ),
    array(
        'country' => 'Morocco',
        'continent' => 'Africa',
        'language' => 'Arabic',
    ),
);

// Return values of a single column in an array.
print_r(array_column($countries, 'language'));
echo '<br>'.PHP_EOL;

// array_count_values() counts how many times a value is found in an array.
$test = array('a', 'b', 'c', 'b', 'c', 'd', 'e', 'd');
print_r(array_count_values($test));
echo '<br>'.PHP_EOL;

// array_fill() fills an array with values.
// In this example the start index is -2, the amount of values is 6.
// The last parameter is for the value.
print_r(array_fill(-2, 6, 'value'));
echo '<br>'.PHP_EOL;

$names = array('Aaron', 'Benjamin', 'Alex', 'Franklin', 'Adam', 'George');

// Function that will be used for array_filter().
// In this example $v is being used for the values.
function startsWithA($v)
{
    // Only returns values that start with 'A'.
    return substr($v, 0, 1) === 'A';
}

// array_filter() is used to filter elements of an array with
// a callback function.
// Only the names of $names that start with an 'A' will be printed.
print_r(array_filter($names, 'startsWithA'));
echo '<br>'.PHP_EOL;

// array_flip() flips all keys with it's values.
print_r(array_flip($array));
echo '<br>'.PHP_EOL;

$timeOfDay = array('morning', 'afternoon', 'evening');

// This function is being used for array_map().
// In this example $v is being used for the values.
function greeting($v)
{
    return 'Good '. $v . ', sir.';
}

// array_map() uses a callback function to run for each element
// of an array. Can also be used for multidimensional arrays.
print_r(array_map('greeting', $timeOfDay));
echo '<br>'.PHP_EOL;

$japan = array('countries' => array('country' => 'Japan'), 1);
$netherlands = array('countries' => array('country' => 'The Netherlands'), 2);
$morocco = array('countries' => array('country' => 'Morocco'), 3);

// array_merge_recursive is used to merge multiple arrays recursively.
print_r(array_merge_recursive($japan, $netherlands, $morocco));
echo '<br>'.PHP_EOL;

// array_multisort() is used to sort multiple or multi-dimensional arrays.
array_multisort($japan, $netherlands, $morocco);
print_r($japan);
echo '<br>'.PHP_EOL;
print_r($netherlands);
echo '<br>'.PHP_EOL;
print_r($morocco);
echo '<br>'.PHP_EOL;

// array_pad(). Pad the array with a value to the specified length.
print_r(array_pad($names, 7, 'Frank'));
echo '<br>'.PHP_EOL;

// array_product(). Calculates the product of values in the array.
print_r(array_product(array(1, 9, 8, 5)));
echo '<br>'.PHP_EOL;

// array_rand() returns a random key from the array when you specify that 1 key
// should be returned.
print_r(array_rand($names, 1));
echo '<br>'.PHP_EOL;

// array_rand() returns a array with random keys as values from the array when
// you specify that more keys should be returned.
print_r(array_rand($names, 2));
echo '<br>'.PHP_EOL;

// The functions below are being used for array_reduce().
// In this example $c stands for carry and $i stands for item.
function minus($c, $i)
{
    $c -= $i;
    return $c;
}

// In this example $c stands for carry and $i stands for item.
function times($c, $i)
{
    $c *= $i;
    return $c;
}

// In this example $p stands for the return value of the previous iteration
// and $c stands for the return value of the current iteration.
function callback($p, $c)
{
    return $p . ', ' . $c;
}

$numbers = array(1, 3, 5, 7);

// array_reduce() is being used to reduce the array iteratively to single 
// value(s) by using a callback function.
print_r(array_reduce($numbers, 'minus'));
echo '<br>'.PHP_EOL;

print_r(array_reduce($numbers, 'times', 4));
echo '<br>'.PHP_EOL;

// In this example array_reduce() is being used to reduce the array to
// single values with comma's between them.
print_r(array_reduce($names, 'callback'));
echo '<br>'.PHP_EOL;

// array_replace() is being used to replace values in a array with new values.
// In this example 'Hank' is being added to the array because $names has no 6th
// key yet before array_replace() is being executed.
$eric = array(2 => 'Eric');
$hank = array(6 => 'Hank');
print_r(array_replace($names, $eric, $hank));
echo '<br>'.PHP_EOL;

$norway = array(
    '1' => array(
    'country' => 'Norway',
    'continent' => 'Europe',
    'language' => 'Norwegian',
));
// array_replace_recursive is used to replace values in a array with new values
// recursively.
print_r(array(array_replace_recursive($countries, $norway)));
echo '<br>'.PHP_EOL;

// array_reverse() returns the array with the elements in reverse order.
print_r(array_reverse($names));
echo '<br>'.PHP_EOL;

// If set to 'true', keys will be preserved.
print_r(array_reverse($names, true));
echo '<br>'.PHP_EOL;

$numbers = array('one', 'five', 8, 'twentyone');

// array_search() returns the key of the value being searched.
// If not set to true, it doesn't check type of the value.
echo 'The index of the found value: ';
print_r(array_search('8', $numbers));
echo '<br>'.PHP_EOL;

// If the third paramater is set to true, it will perform a strict type comparison.
echo 'The index of the found value: ';
print_r(array_search(8, $numbers, true));
echo '<br>'.PHP_EOL;

// array_splice() removes elements from an array and replaces them.
array_splice($names, 3, 2, array('John', 'Michael'));
print_r($names);
echo '<br>'.PHP_EOL;

// array_sum()
$sum = [8, 10, 5];
echo array_sum($sum).'<br>'.PHP_EOL;

$a = [1 => 'a', 2 => 'b', 0 => 'c', 4 => 'd', 5 => 'g', 6 => 'h'];
$b = [3 => 'c', 2 => 'b', 1 => 'a', 4 => 'd', 5 => 'f'];

// Function keys is used for the array_udiff and array_uintersect functions.
function keys($a, $b) {
    if ($a !== $b) {
        return 0;
    }
    return ($a <=> $b);
}

// Function values is used for the array_udiff and array_uintersect functions.
function values($a, $b) {
    if ($a === $b) {
        return 0;
    }
    return ($a <=> $b);
}

// array_udiff_assoc() compares the arrays with additional index check and
// returns the differences.
// Unlike array_diff_assoc() It uses a user-defined callback function.
print_r(array_udiff_assoc($a, $b, 'values'));
echo '<br>'.PHP_EOL;

// array_udiff_uassoc() compares the arrays with additional index check.
// Compares data and indexes by a callback function and returns the differences.
// Keys are used in the comparison unlike array_diff() and array_udiff().
print_r(array_udiff_uassoc($a, $b, 'keys', 'values'));
echo '<br>'.PHP_EOL;

// array_udiff() compares the arrays by using a callback function for data
// comparison and return the differences.
print_r(array_udiff($a, $b, 'values'));
echo '<br>'.PHP_EOL;

// array_uintersect_assoc() compares 2 arrays by it's values, using a callback
// function and returns the matches.
print_r(array_uintersect_assoc($a, $b, 'values'));
echo '<br>'.PHP_EOL;

// array_uintersect_assoc() compares 2 arrays by it's keys and values, using 2 
// callback functions and returns the matches.
print_r(array_uintersect_uassoc($a, $b, 'keys', 'values'));
echo '<br>'.PHP_EOL;

// array_uintersect() compares 2 arrays by it's values, using a callback
// function and returns the matches.
print_r(array_uintersect($a, $b, 'values'));
echo '<br>'.PHP_EOL;

// array_unique() removes duplicate values from an array.
print_r(array_unique($test));
echo '<br>'.PHP_EOL;

// compact() creates an array from variables and their values.
$country = 'Japan';
$continent = 'Asia';
$language = 'Japanese';
print_r(compact('country', 'continent', 'language'));
echo '<br>'.PHP_EOL;

// count() / sizeof(). Both functions return the amount of elements in an array.
print_r(count($names));
echo '<br>'.PHP_EOL;
print_r(sizeof($names));
echo '<br>'.PHP_EOL;

// current() returns the element in an array.
echo current($names).'<br>'.PHP_EOL;

// next() returns the next element in an array.
echo next($names).'<br>'.PHP_EOL;

// pos() does the same as current().
echo pos($names).'<br>'.PHP_EOL;

// prev() returns the previous element in an array.
echo prev($names).'<br>'.PHP_EOL;

// each() returns the current element key and value and goes to the next element.
// Deprecated as of PHP 7.2.0.
print_r(each($names));
echo '<br>'.PHP_EOL;

// end() sets the index of an array to it's last element.
print_r(end($names));
echo '<br>'.PHP_EOL;

// extract()
// Don't use this on untrusted data (user input, like $_GET or $_FILES). 
print_r(extract($names));
echo '<br>'.PHP_EOL;

// key() retrieves a key from an array.
print_r(key($names));
echo '<br>'.PHP_EOL;

// range() creates an array with a range of elements.
print_r(range(0, 6));
echo '<br>'.PHP_EOL;
print_r(range('a', 'e'));

?>