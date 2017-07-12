<!-- WORK IN PROGRESS -->

<html>
    <body>
        <form method='post'>
            <div>
                <input type='text' name='user' placeholder='Username'/>
            </div>
            <br>
            <div>
                <input type='password' name='password' placeholder='Password'/>
            </div>
            <br>
            <div>
                <input type='password' name='confirm' placeholder='Password confirm'/>
            </div>
            <br>
            <input type='submit' name='register' value='Register'/>
        </form>
        
<?php
        
session_start();
// Fill in login details in the empty parameters.
$mysqli = new mysqli('localhost', '', '', 'Week_7');;

if(isset($_POST['register'])) {
    $user = mysqli_real_escape_string($mysqli, $_POST['user']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    $sql = "INSERT INTO user(username, password) VALUES('$user', '$password')";
    
    if($_POST['password'] != $_POST['confirm']) {
        echo "<span style='color:red'>Passwords do not match.</span><br>";
    }
    
    $select = "SELECT FROM user(username) VALUES('$user') WHERE 1";
    
    if ($result = mysqli_query($mysqli, $select)) { 
        if (mysqli_num_rows($result) > 0) { 
            echo 'Username already exists.';
        }
    }
}       
        
if(isset($_POST['user'])) {
    echo "<span style='color:red'>";
    switch($_POST['user']) {
        case null:
            echo "Don't forget to fill in a username.<br>".PHP_EOL;
            break;
        case strlen($_POST['user']) < 3:
            echo 'Username has to be at least 3 characters.<br>'.PHP_EOL;
            break;
        default:
            $sql = "INSERT INTO user(username, password) VALUES ('$user', '$password')";
            mysqli_query($mysqli, $sql);
            // Redirect.
            break;
    }
    echo '</span>';
}
    
if(isset($_POST['password'])) {
    echo "<span style='color:red'>";
    switch($_POST['password']) {
        case null:
            echo "Don't forget to fill in a password.<br>".PHP_EOL;
            break;
        case strlen($_POST['password']) < 6:
            echo 'Password has to be at least 6 characters.<br>'.PHP_EOL;
        case !preg_match('/[A-Z]/', $_POST['password']):
            echo 'Password should contain at least 1 uppercase letter.<br>'.PHP_EOL;
        case !preg_match('/[0-9]/', $_POST['password']):
            echo 'Password should contain at least 1 number.
            <br>'.PHP_EOL;
        case !preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $_POST['password']):
            echo 'Password should contain at least 1 special character.<br>'.PHP_EOL;
            break;
        default:
            $sql = "INSERT INTO user(username, password) VALUES ('$user', '$password')";
            mysqli_query($mysqli, $sql);
            // Redirect.
            break;
    }
    echo '</span>';
}

?>
        <br>
        <a href='Login.php'>Already registered? Click here to log in.</a>
    </body>
</html>