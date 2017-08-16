<?php

echo 'Local time: '.date('D, d M Y H:i:s').'<br>'.PHP_EOL;
date_default_timezone_set('Asia/Tokyo');
echo 'Time in Japan: '.date('D, d M Y H:i:s');

?>