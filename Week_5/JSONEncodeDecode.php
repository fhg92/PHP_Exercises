<?php

$japan = array(
    'country' => 'Japan',
    'continent' => 'Asia',
    'language' => 'Japanese'
);

$encode = json_encode($countries);
echo $encode.'<br>'.PHP_EOL;
var_dump(json_decode($encode));
echo '<br>'.PHP_EOL;

$decode = json_decode($encode);
echo $decode->language.'<br>'.PHP_EOL;

$whitespace = array('This line contains whitespace' => 'Some text');
echo json_decode(json_encode($whitespace))->{'This line contains whitespace'};

?>