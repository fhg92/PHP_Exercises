<?php

function counter() {
    for($i = 1; $i <= 10; $i++) {
        yield $i;
    }
}

$generator = counter();
foreach ($generator as $value) {
    echo $value.'<br>'.PHP_EOL;
}

?>