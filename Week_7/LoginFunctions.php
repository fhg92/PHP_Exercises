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

function checkUserDb($mysqli, &$error, &$user) {
    $user = $mysqli->real_escape_string($_POST['user']);
    $sql = "SELECT username FROM user WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s',$user);
    $stmt->execute();
    if($_POST['user'] != null && $_POST['password'] != null) {
        if($stmt->num_rows() == 0) {
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

function checkPassDb($mysqli, &$dbPassword, &$error, $user) {
    $sql = "SELECT password FROM user WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s',$user);
    $stmt->execute();
    $dbPassword = $stmt->get_result();
    if($_POST['user'] != null && $_POST['password'] != null) {
        if($stmt->num_rows() == 0) {
            $error = 'Login failed.<br>'.PHP_EOL;
            return false;
        }
        return true;
    }
}

function logIn($mysqli, $dbPassword, &$error) {
    $password = $mysqli->real_escape_string($_POST['password']);

    while($row = $dbPassword->fetch_assoc()) {
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
        $user = $_SESSION['user'];
        $date = date('D d M, Y H:i a');
        $sql = "UPDATE user SET last_login_date = ? WHERE username = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ss', $date, $user);
        $stmt->execute();
        header('Location: User.php');
    } else {
        $error = 'Login failed.<br>'.PHP_EOL;
    }
}

?>