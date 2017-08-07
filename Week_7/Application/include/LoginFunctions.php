<?php

function checkUser(&$error) {
    switch($_POST['email']) {
        case null:
            $error .= 'Please fill in your E-mail.<br>'.PHP_EOL;
            return false;
            break;
        case strlen($_POST['email']) < 3:
            return false;
            break;
        case !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL):
            // Not a validate e-mail.
            return false;
            break;
        }
    return true;
}
function checkUserDb($pdo, &$error) {
    $sql = 'SELECT email FROM user WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->execute();
    $rowCount = $stmt->fetchColumn();
    if($_POST['email'] != null && $_POST['password'] != null) {
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
    $sql = "SELECT password FROM user WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->execute();
    $hash = $stmt->fetchColumn();
    if($_POST['email'] != null && $_POST['password'] != null) {
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
        
        // Query to select user ID to put in a session later.
        $sql = 'SELECT user_id FROM user WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $stmt->execute();
        $userId = $stmt->fetchColumn();
        
        $sql = 'UPDATE user_personal SET last_login = NOW() WHERE user_id = :user';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user', $userId, PDO::PARAM_STR);
        $stmt->execute();
        
        session_start(); 
        $_SESSION['loggedin'] = true;
        $_SESSION['userid'] = $userId;
        $_SESSION['email'] = $_POST['email'];
        header('Location: Index.php');
    } else {
        $error = 'Login failed.<br>'.PHP_EOL;
    }
}

?>