<html>
    <body>
        <form action='UploadScript.php' method='post' enctype="multipart/form-data">
            <input type='file' name='file'/>
            <input type='submit' value='Upload File'/>
        </form>
    </body>
</html>

<?php

session_start();

if(isset($_SESSION['message']))
    echo $_SESSION['message'];

session_unset();

?>