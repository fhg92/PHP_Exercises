<?php

$countries = new ArrayIterator(['Japan', 'China', 'Thailand', 'India', 
                                'Taiwan', 'Vietnam']);

// Iterate through key 0 to 4.
foreach(new LimitIterator($countries, 0, 4) as $country) {
    echo $country.'<br>'.PHP_EOL;
}

echo '<br>'.PHP_EOL;

// Begin iterating from key 4.
foreach(new LimitIterator($countries, 4) as $country) {
    echo $country.'<br>'.PHP_EOL;
}

?>