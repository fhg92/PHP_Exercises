<?php

$string1 = 'cAse sEnsItIvItY';
$string2 = 'case sensitivity';

// Outputs false. strcmp() is case sensitive.
if (strcmp($string1, $string2) === 0){
    var_dump(true);
} else {
    var_dump(false);
}

// Outputs true. strcmp() is case insensitive.
if (strcasecmp($string1, $string2) === 0) {
    var_dump(true);
} else {
    var_dump(false);
}


// substr_compare(first string,second tring,startpos,length,case) Length and case are optional.
// If 0 : two strings are equal.
// If <0 : first string is less than second string.
// If >0 : first string is greater than second string.

$string1 = '0123456789';
$string2 = '12';

echo substr_compare($string1, $string2, 1, 2 ); // Outputs 0.
echo substr_compare($string1, $string2, 1, 3 ); // Outputs 1.
echo substr_compare($string1, '13', 1, 2 ); // Outputs -1.
echo substr_compare($string1, '12', 1, 3 ); // Outputs 1.
echo substr_compare($string1, '23', 2, 2 ); // Outputs 0.
echo substr_compare('abcdefg', 'bcde', 1, 4 ); // Outputs 0.

?>