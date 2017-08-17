<?php

$dateOfBirth = new \Datetime('8-7-1992',
                            new \DateTimeZone('Europe/Amsterdam'));
$currentTimeTokyo = new \Datetime(date('d-m-Y', 
                            new \DateTimeZone('Asia/Tokyo')));

var_dump($dateOfBirth->diff($currentTimeTokyo));

?>