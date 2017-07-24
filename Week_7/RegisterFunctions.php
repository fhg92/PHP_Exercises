<?php

function checkUser(&$error)
{
    switch($_POST['user']) {
        case null:
            $error[] = "Don't forget to fill in a username.<br>".PHP_EOL;
            return false;
            break;
        case strlen($_POST['user']) < 3:
            $error[] = 'Username has to be at least 3 characters.<br>'.PHP_EOL;
            return false;
            break;
        }
    return true;
}

function checkUserDb($mysqli, $user, &$error) {
    $sql = "SELECT username FROM user WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s',$user);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0) {
        $error[] = 'Username already exists.<br>'.PHP_EOL;
        return false;
    }
    return true;
}

function checkPass(&$error)
{
    if(isset($_POST['password'])) { 
         switch($_POST['password']) {
            case null:
                $error[] = "Don't forget to fill in a password.<br>".PHP_EOL;
                return false;
                break;
            case strlen($_POST['password']) < 6:
                $error[] = 'Password has to be at least 6 characters.<br>'.PHP_EOL;
                return false;
            case !preg_match('/[A-Z]/', $_POST['password']):
                $error[] = 'Password should contain at least 1 uppercase letter.<br>'.PHP_EOL;
                return false;
            case !preg_match('/[0-9]/', $_POST['password']):
                $error[] = 'Password should contain at least 1 number.
                <br>'.PHP_EOL;
                return false;
            case !preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/',
                             $_POST['password']):
                $error[] = 'Password should contain at least 1 special character.<br>'.PHP_EOL;
                return false;
                break;
            case $_POST['password'] != $_POST['confirm']:
                $error[] = "Passwords do not match.<br>".PHP_EOL;
                return false;
         }
        return true;
    }
}

function insert($mysqli, $user, $password, $date) {
    $sql = "INSERT INTO user(username, password, registered_date, last_login_date)
    VALUES (?, ?, ?, 'Not logged in yet.')";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sss', $user, $password, $date);
    $stmt->execute();
}

?>