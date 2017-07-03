<?php

$degrees = $_POST['degrees'];

$client = new
    SoapClient('https://www.w3schools.com/xml/tempconvert.asmx?WSDL');

$celsius = array('Celsius'=>$degrees);

$conversion = $client->CelsiusToFahrenheit($celsius);

echo 'Degrees in fahrenheit: '.$conversion->CelsiusToFahrenheitResult;

?>