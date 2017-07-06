<?php

$file = fopen('files/date.txt','w');
fprintf($file, nl2br("Today it's %s the %s.\n"), date('l'), date('jS'));
fprintf($file, nl2br("Tomorrow it's %s the %s.\n"), date('l', strtotime('+1 day')),
        date('jS', strtotime('+1 day')));
fprintf($file, nl2br("The day after tomorrow it's %s the %s.\n"), 
        date('l', strtotime('+2 day')), date('jS', strtotime('+2 day')));

$file = fopen('files/date.txt', 'r');
fpassthru($file);

?>