<?php
    
$fi = finfo_open(FILEINFO_MIME);
echo finfo_file($fi,'files/text.txt').'<br>'.PHP_EOL;

// Below code does the same as above.
$fi = new finfo(FILEINFO_MIME);
echo $fi->file('files/text.txt');

?>