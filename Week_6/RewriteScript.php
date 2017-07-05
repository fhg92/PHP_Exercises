<?php

// Variable to put content in.
$text = 'Input: '.$_POST['input'].chr(10).chr(10).'Last edited on: '.
    date('D, d M Y H:i:s');

// Open file.
$write = fopen('files/rewrite.txt','w');

// Write file with content.
fwrite($write, $text);

// Close open file.
fclose($write);

// Put filepath in variable to re-use later.
$file = 'files/rewrite.txt';

// Read file into string.
// nl2br() is used for HTML line breaks where newlines occur.
$output = nl2br(file_get_contents($file));

// Set cookie with output variable to use in RewriteForm.php.
setcookie('output', $output);

// Put new content in variable.
$new = chr(10).chr(10).'Just testing file_put_contents.';

// Append new content to the txt file.
file_put_contents($file, $new, FILE_APPEND);

// Redirect to form.
header('Location: RewriteForm.php');

?>