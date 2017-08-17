<?php

$date = new DateTime(date('d-m-Y'));
$date->modify('-1 year');
echo $date->format('Y-m-d');

?>