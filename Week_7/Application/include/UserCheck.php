<?php

function userCheck()
{    
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header('Location: Login.php');
    }
}

?>