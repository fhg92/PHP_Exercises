<?php

// Dutch.
setlocale(LC_ALL, 'nl_NL');
echo strftime('%A %d %B %Y', mktime(0, 0, 0, 7, 8, 1992)).'<br/>'.PHP_EOL;

// German.
setlocale(LC_ALL, 'de_DE');
echo strftime('%A %d %B %Y').'<br/>'.PHP_EOL;;

// English, US.
setlocale(LC_ALL, 'en_US');
echo strftime('%a %D');

?>