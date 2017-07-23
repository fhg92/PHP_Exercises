<?php   

// Fill in login details in the empty parameters.
$mysqli = new mysqli('localhost', '', '', 'Week_7');
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>