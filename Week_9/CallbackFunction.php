<?php

$array = ['a' => 'Russia', 'b' => 'Germany', 'c' => 'England', 'd' => 'France'];

// User defined sort function (sorts in natural order by last character).
function sortByLastCharacter()
{
    return function($a, $b)
    {
        // strnatcmp() is being used for natural order string comparison.
        // strrev() is being used for string reverse.
        return strnatcmp(strrev($a), strrev($b));
    };
}

// usort($array, sortByLastCharacter());
// print_r($array);

class invokeCallback
{
    public function __invoke()
    {    
        return sortByLastCharacter();
    }
}

$callback = new invokeCallback();

uasort($array, $callback());
print_r($array);

?>