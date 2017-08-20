<?php

// Make a parser from this tutorial:
// https://php-and-symfony.matthiasnoback.nl/2012/04/php-create-an-object-oriented-xml-parser-using-the-built-in-xml_-functions/

ob_start();

$xml = simplexml_load_file('Books.xml');
$encoding = 'UTF-8';
$parser = xml_parser_create($encoding);

function startElement($parser, $name, array $attributes)
{
}

function endElement($parser, $name)
{
}

xml_set_element_handler($parser, 'startElement', 'endElement');

function cdata($parser, $cdata)
{
}

xml_set_character_data_handler($parser, 'cdata');

$result = xml_parse($parser, $xml);

$error = ob_get_contents();
ob_end_clean();

if(!empty($error)) {
    echo $error;
} else {
    echo 'There are no errors.';
}

?>