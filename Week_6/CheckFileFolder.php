<?php

// is_dir(). Checks if filename is a directory.
// In this example $fn stands for the filename.
$file = 'files';
if(!is_dir($file))
    echo "$file is not a directory.<br>".PHP_EOL;
else
    echo "$file is a directory.<br>".PHP_EOL;

// is_executable().
// Tested on Mac OS and Windows. Only worked on Windows.
$file = 'Setup.exe';
if(is_executable($file))
    echo "$file is executable.<br>".PHP_EOL;
else
    echo "$file is not executable.<br>".PHP_EOL;

// is_file().
$file = 'file.txt';
if(!file_exists($file)) {
    $write = fopen($file,'w');
    fwrite($write, 'This is a txt file.');
    fclose($write);
}
if(is_file($file))
    echo "$file is a file.<br>".PHP_EOL;
else
    echo "$file is not a file.<br>".PHP_EOL;

// is_link().
$link = 'files';
if(is_link($link))
  echo "$link is a link.<br>".PHP_EOL;
else
  echo "$link is not a link.<br>".PHP_EOL;

// is_readable().
if(is_readable($file))
    echo "$file is readable.<br>".PHP_EOL;
else
    echo "$file is not readable.<br>".PHP_EOL;

// is_writable().
if(is_writable($file))
    echo "$file is writable.<br>".PHP_EOL;
else
    echo "$file is not writable.<br>".PHP_EOL;

// is_uploaded_file().
if(is_uploaded_file($file))
    echo "$file is uploaded via POST method.<br>".PHP_EOL;
else
    echo "$file is not uploaded via POST method.<br>".PHP_EOL;

?>