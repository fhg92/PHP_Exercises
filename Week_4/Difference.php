<?php

$a = [1 => 'a', 2 => 'b', 0 => 'c', 4 => 'd', 5 => 'g'];
$b = [1 => 'b', 2 => 'c', 3 => 'a', 4 => 'd', 5 => 'f'];

// array_diff(). Only shows values from the first array which are not in
// the second (or any other array if there were more).
print_r(array_diff($a, $b));
echo '<br>'.PHP_EOL;

// array_diff_assoc(). Compares the arrays with index check (by keys and values).
// Returns values from the first array which are different from other array(s),
// or that are assigned to a different key.
print_r(array_diff_assoc($a, $b));
echo '<br>'.PHP_EOL;

// array_diff_key(). Compares only by key. Returns the values from the keys of the
// first array, where the keys are different from the other array(s).
print_r(array_diff_key($a, $b));
echo '<br>'.PHP_EOL;

// This function does the same as array_diff_assoc() and array_diff_key().
// This is going to be used for the array_diff_uassoc() and array_diff_ukey()
// functions.
function compare($a, $b) {
    if ($a === $b) {
        return 0;
    }
    return ($a <=> $b);
}

// array_diff_uassoc() Compares the arrays with index check (by keys and values).
// Unlike array_diff_assoc() It uses a user-defined callback function.
print_r(array_diff_uassoc($a, $b, 'compare'));
echo '<br>'.PHP_EOL;

// array_diff_uassoc() Compares the arrays by keys.
// Unlike array_diff_key() It uses a user-defined callback function.
print_r(array_diff_ukey($a, $b, 'compare'));

?>