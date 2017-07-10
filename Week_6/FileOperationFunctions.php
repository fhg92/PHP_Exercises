<?php

// chdir().
echo getcwd().'<br>';
chdir('files');
echo getcwd().'<br>';

// chroot(). (Not working)

/* 
* FROM PHP.NET:
* This function is only available to GNU and BSD systems, 
* and only when using the CLI, CGI or Embed SAPI. 
* Also, this function requires root privileges.
*/

//chroot('files/test');
//echo getcwd();

// readdir().
// Open directory.
if ($handle = opendir('../files')) {
    echo $handle.'<br>'.PHP_EOL;

    // Read content.
    while(false !== ($entry = readdir($handle))) {
            echo $entry.'<br>'.PHP_EOL;
    }
    // Close directory handle.
    closedir($handle);
}

// rmdir().
// If directory 'test' does not exist. Make directory 'test'.
if(!is_dir('test')) {
    mkdir('test');
}
// Remove directory 'test'.
rmdir('test');

// basename().
// Show filename without extension.
echo basename('directory/blabla/file.php','.php').'<br>'.PHP_EOL;
// Show filename with extension.
echo basename('directory/file.php').'<br>'.PHP_EOL;

// chmod().
// Read/write for owner only.
chmod('../files/rewrite.txt', 0600);

// Read/write for owner, read for everybody else.
chmod('../files/rewrite.txt', 0644);

// Execute/read/write for owner, execute/read for others.
chmod('../files/rewrite.txt', 0755);

// Execute/read/write for owner, execute/read for owner's group.
chmod('../files/rewrite.txt', 0750);

// copy().
chdir('../files');
$file = 'rewrite.txt';
$newfile = 'rewrite.txt.bak';

// If copying fails, show message.
if (!copy($file, $newfile))
    echo "Failed to copy $file".'<br>'.PHP_EOL;

// file_exists().
if(file_exists($file))
    echo "$file exists".'<br>'.PHP_EOL;

// fputs(). Alias of fwrite().
$file = fopen('test.txt','w');
// When echoing content with fputs() it will output the amount of bytes.
// The third parameters stands for the amount of bytes to write to $file.
echo fputs($file, 'Just testing fputs() function.', 20);

fclose($file);

// rename(). Renames test.txt to text.txt.
rename('test.txt','text.txt');

// unlink().
// If file 'test' does not exist. Make file 'delete.txt'.
if(!file_exists('delete.txt')) {
    $file = fopen('delete.txt','w');
    fwrite($file, 'This file will be deleted.');
    fclose($file);
}
// Remove file 'delete.txt'.
unlink('delete.txt');

?>