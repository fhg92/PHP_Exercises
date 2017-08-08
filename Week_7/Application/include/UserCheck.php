<?php

function userCheck($pdo)
{    
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header('Location: Login.php');
    }
}

?>