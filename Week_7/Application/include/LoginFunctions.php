<?php

function checkUser(&$error) {
    switch($_POST['user']) {
        case null:
            $error .= 'Please fill in your username.<br>'.PHP_EOL;
            return false;
            break;
        case strlen($_POST['user']) < 3:
            // Username is shorter than 3 characters.
            return false;
            break;
        }
    return true;
}
function checkUserDb($pdo, &$error) {
    $sql = 'SELECT username FROM user WHERE username = :user';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user', $_POST['user'], PDO::PARAM_STR);
    $stmt->execute();
    $rowCount = $stmt->fetchColumn();
    if($_POST['user'] != null && $_POST['password'] != null) {
        if($rowCount == 0) {
            // Username doesn't exist.
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
                 return false;
                 break;
             case !preg_match('/[A-Z]/', $_POST['password']):
                 return false;
                 break;
             case !preg_match('/[0-9]/', $_POST['password']):
                 return false;
                 break;
             case !preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/',
                             $_POST['password']):
                 return false;
                 break;
         }
        return true;
    }
}
function checkPassDb($pdo, &$hash, &$error) {
    $sql = "SELECT password FROM user WHERE username = :user";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user', $_POST['user'], PDO::PARAM_STR);
    $stmt->execute();
    $hash = $stmt->fetchColumn();
    if($_POST['user'] != null && $_POST['password'] != null) {
        if($hash == 0) {
            // Password hash doesn't exist in database.
            return false;
        }
        return true;
    }
}
function logIn($pdo, $hash, &$error) {
    $password = $_POST['password'];
    
    if(password_verify($password, $hash) && $_POST['password'] != null) {
        session_start();  
        $_SESSION['user'] = $_POST['user'];
        $sql = 'UPDATE user SET last_login_date = :date WHERE username = :user';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':date', date('D d M, Y H:i a'), PDO::PARAM_STR);
        $stmt->bindParam(':user', $_SESSION['user'], PDO::PARAM_STR);
        $stmt->execute();
        header('Location: Index.php');
    } else {
        $error = 'Login failed.<br>'.PHP_EOL;
    }
}

?>