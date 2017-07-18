<?php

function checkUser(&$error) {
    switch($_POST['user']) {
        case null:
            $error .= 'Please fill in your username.<br>'.PHP_EOL;
            return false;
            break;
        case strlen($_POST['user']) < 3:
            $error = 'Login failed.<br>'.PHP_EOL;
            return false;
            break;
        }
    return true;
}

function checkUserDb($mysqli, &$error) {
    $user = mysqli_real_escape_string($mysqli, $_POST['user']);
    $select = "SELECT username FROM user WHERE username = '$user'";
    $result = mysqli_query($mysqli, $select);
    if($_POST['user'] != null && $_POST['password'] != null) {
        if(mysqli_num_rows($result) == 0) {
            $error = 'Login failed.<br>'.PHP_EOL;
            return false;
        }
        return true;
    }
}

function checkPass(&$error) {
    if(isset($_POST['password'])) { 
         switch($_POST['password']) {
             case null:
                 $error .= "Don't forget to fill in your password.<br>".PHP_EOL;
                 return false;
                 break;
             case strlen($_POST['password']) < 6:
                 $error = 'Login failed.<br>'.PHP_EOL;
                 return false;
                 break;
             case !preg_match('/[A-Z]/', $_POST['password']):
                 $error = 'Login failed.<br>'.PHP_EOL;
                 return false;
                 break;
             case !preg_match('/[0-9]/', $_POST['password']):
                 $error = 'Login failed.<br>'.PHP_EOL;
                 return false;
                 break;
             case !preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/',
                             $_POST['password']):
                 $error = 'Login failed.<br>'.PHP_EOL;
                 return false;
                 break;
         }
        return true;
    }
}

function checkPassDb($mysqli, &$dbPassword, &$error) {
    $user = mysqli_real_escape_string($mysqli, $_POST['user']);
    $selectPwd = "SELECT password FROM user WHERE username = '$user'";
    $dbPassword = mysqli_query($mysqli, $selectPwd);
    if($_POST['user'] != null && $_POST['password'] != null) {
        if(mysqli_num_rows($dbPassword) == 0) {
            $error = 'Login failed.<br>'.PHP_EOL;
            return false;
        }
        return true;
    }
}

function logIn($mysqli, $dbPassword, &$error) {
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    
    while($row = mysqli_fetch_assoc($dbPassword)) {
        $passresult = $row;
    }
    
    if(isset($passresult)) {
        $hash = $passresult['password'];
    } else {
        $hash = null;
    }
    
    if(password_verify($password, $hash) && $_POST['password'] != null) {
        session_start();  
        $_SESSION['user'] = $_POST['user'];
        header('Location: User.php');
    } else {
        $error = 'Login failed.<br>'.PHP_EOL;
    }
}

?>