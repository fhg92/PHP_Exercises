<?php

$options = [
    'location' => 'http://localhost/~Frank/PHP_Exercises/Week_8/SOAP.php',
    'uri' => 'http://localhost/~Frank/PHP_Exercises/Week_8/'
];
$client = new SoapClient(NULL, $options);

echo $client->getMessage() . "\n";
echo $client->addNumbers(3, 5) . "\n";

?>