<?php

session_start();

$file = basename($_FILES['file']['name']);

$error = $_FILES['file']['error'];

switch ($error) {
    case 1:
        echo 'The uploaded file exceeds the maximum filesize for this form.';
        break;
    case 2:
        $_SESSION['message'] = 'The uploaded file exceeds the maximum filesize for this form.';
        break;
    case 3:
        $_SESSION['message'] = 'The uploaded file was only partially uploaded.';
        break;
    case 4:
        $_SESSION['message'] = "No file was uploaded.";
        break;
    case 6:
        $_SESSION['message'] = 'Missing a temporary folder.';
        break;
    case 7:
        $_SESSION['message'] = 'Failed to write file to disk.';
        break;
    case 8:
        $_SESSION['message'] = 'Something went wrong.';
        break;
    default:
        $name = 'Name: '.$_FILES['file']['name'];
        $type = 'Type: '.mime_content_type($file);
        $size = 'Size: '.($_FILES['file']['size'] / 1024) . ' kb';
        $tmp = 'Temporary file location: '.$_FILES['file']['tmp_name'];
        $_SESSION['message'] = 'File succesfully uploaded.';
}

$txt = $name.PHP_EOL.$type.PHP_EOL.$size.PHP_EOL.$tmp;
$newfile = preg_replace('/[^A-Za-z0-9\-]/', '', $file);
$write = fopen('files/'.$newfile.'.txt','w');
fwrite($write, $txt);
fclose($write);
header('Location: UploadForm.php');

?>