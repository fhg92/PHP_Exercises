<?php

echo number_format('312932143.4539835').'<br/>'.PHP_EOL;

// Splits number into groups of 3 characters and replaces comma's with spaces.
echo number_format('312932143.4539835', '3', ',', ' ').'<br/>'.PHP_EOL;

// Dutch.
setlocale(LC_MONETARY, 'nl_NL');
echo money_format('%.2n', 312932143.4539835).'<br/>'.PHP_EOL;

// English, US.
setlocale(LC_MONETARY, 'en_US');
echo money_format('%.2n', 312932143.4539835).'<br/>'.PHP_EOL;

// English, UK.
setlocale(LC_MONETARY, 'en_GB');
echo money_format('%.2n', 312932143.4539835).'<br/>'.PHP_EOL;

// Japan.
setlocale(LC_MONETARY, 'ja_JP');
echo money_format('%.2n', 312932143.4539835).'<br/>'.PHP_EOL;

?>