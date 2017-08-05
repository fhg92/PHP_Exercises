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
function checkUserDb($pdo, $user, &$error) {
    $sql = "SELECT username FROM user WHERE username = :user";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user', $_POST['user'], PDO::PARAM_STR);
    $stmt->execute();
    $rowCount = $stmt->fetchColumn();
    if($rowCount > 0) {
        $error[] = 'Username already exists.<br>'.PHP_EOL;
        return false;
    }
    return true;
}
function checkPass(&$error)
{
    if(isset($_POST['submit'])) { 
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
function insert($pdo) {
    if(isset($_POST['user']) && isset($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $date = time();
        $lastLogin = 'Not logged in yet.';
        $sql = "INSERT INTO user(username, password, date_registered, last_login_date)
        VALUES (:user, :pass, NOW(), :lastLogin)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user', $_POST['user'], PDO::PARAM_STR);
        $stmt->bindParam(':pass', $password, PDO::PARAM_STR);
        $stmt->bindParam(':lastLogin', $lastLogin, PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
    return false;
}
?>