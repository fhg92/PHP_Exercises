<?php

// In this example $ch stands for cURL handle. 
$ch = curl_init();

// Set options for cURL transfers.
curl_setopt($ch, CURLOPT_URL, 'https://www.google.nl');
curl_setopt($ch, CURLOPT_HEADER, 0);

// Perform cURL session.
curl_exec($ch);

// Close cURL session and remove cURL handle.
curl_close($ch);

?>