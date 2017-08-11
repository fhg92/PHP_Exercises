<?php

function checkEmail(&$error)
{
    if(isset($_POST['email']) && !empty($_POST['email'])) {
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = 'Invalid e-mail address.<br>'.PHP_EOL;
            return false;
        }
        return true;
    }
}
function checkUserDb($mysqli, &$error) {
    $sql = "SELECT email FROM user WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $email = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    
    if($email == $_POST['email']) {
        $error[] = 'E-mail already in use.<br>'.PHP_EOL;
        return false;
    }
    return true;
}
function checkPass(&$error)
{
    if(isset($_POST['register']) && !empty($_POST['password'])) { 
         switch($_POST['password']) {
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

function checkInputFields(&$error)
{
    if(isset($_POST['register'])) { 
        $fields = array('firstName', 'lastName', 'dateOfBirth', 'email',
                        'password');
        foreach($fields as $field) { 
            if(empty($_POST[$field])) {
                switch($field) {
                    case 'firstName':
                        $field = 'your first name';
                        break;
                    case 'lastName':
                        $field = 'your last name';
                        break;
                    case 'dateOfBirth':
                        $field = 'your date of birth';
                        break;
                    case 'email':
                        $field = 'your e-mail address';
                        break;
                    case 'password':
                        $field = 'a password';
                        break;
                }
                $error[] = "Don't forget to fill in ".$field.'.<br>';
            }
        }
        if(!empty($_POST['password']) && empty($_POST['confirm'])) {
            $error[] = 'Please confirm your password';
        }
    }
}

function genderSelect($mysqli)
{
    $sql = 'SELECT * FROM gender';
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $label = $stmt->get_result();
    
    echo '<select name="gender">';
    foreach($label as $gender) {
        echo '<option value="'.$gender['gender_id'].'">'.$gender['label'].
            '</option>';
    }
    echo '</select>';
    
}

function insert($mysqli)
{
    if(isset($_POST['register'])) {
        try {
            $mysqli->autocommit(false);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $sql = 'INSERT INTO user(email, password) 
            VALUES (?, ?)';
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('ss', $_POST['email'], $password);
            $stmt->execute();
            $stmt->close();
            
            $sql = 'INSERT INTO user_personal(first_name, last_name, city, 
            date_of_birth, gender_id, date_registered)
            VALUES (?, ?, ?, ?, ?, NOW())';
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('sssss', $_POST['firstName'], $_POST['lastName'], 
                              $_POST['city'], $_POST['dateOfBirth'], 
                            $_POST['gender']);
            $stmt->execute();
            $stmt->close();
            $mysqli->commit();
            return true;
        } catch (Exception $e) {
            $mysqli->rollback();
            echo "Failed: " . $e->getMessage();
            return false;
        }
    }
}

?>