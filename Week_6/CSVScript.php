<?php

// Variable to put content in.
$rows = array($_POST['row1'], $_POST['row2'], $_POST['row3']);

// Open file.
$write = fopen('files/'.$_POST['fileName'].'.csv','w');

// Iterate through $rows and write each field to csv.
foreach ($rows as $field) {
    fputcsv($write, $field);
}

// Close open file.
fclose($write);

// Redirect to form.
header('Location: CSVForm.php');

?>