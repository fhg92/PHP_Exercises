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
               <a href='Login.php'>Already registered? Click here to log in.</a></p><br>
    </body>
</html>
        
<?php

include('DbConnect.php');

if(isset($_POST['user'])) {    
    switch($_POST['user']) {
        case null:
            $error[] = "Don't forget to fill in a username.<br>".PHP_EOL;
            break;
        case strlen($_POST['user']) < 3:
            $error[] = 'Username has to be at least 3 characters.<br>'.PHP_EOL;
            break;
    }
if(isset($_POST['password'])) { 
    switch($_POST['password']) {
        case null:
            $error[] = "Don't forget to fill in a password.<br>".PHP_EOL;
            break;
        case strlen($_POST['password']) < 6:
            $error[] = 'Password has to be at least 6 characters.<br>'.PHP_EOL;
        case !preg_match('/[A-Z]/', $_POST['password']):
            $error[] = 'Password should contain at least 1 uppercase letter.<br>'.PHP_EOL;
        case !preg_match('/[0-9]/', $_POST['password']):
            $error[] = 'Password should contain at least 1 number.
            <br>'.PHP_EOL;
        case !preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/',
            $_POST['password']):
            $error[] = 'Password should contain at least 1 special character.<br>'.PHP_EOL;
            break;
    }
}
if(isset($_POST['user']) && isset($_POST['password'])) {
    $user = mysqli_real_escape_string($mysqli, $_POST['user']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
}
    
if($_POST['password'] != $_POST['confirm']) {
        $error[] = "Passwords do not match.<br>".PHP_EOL;
    }
    
    $select = "SELECT username FROM user WHERE username = '$user'";
    
    $result = mysqli_query($mysqli, $select);
    
    if (mysqli_num_rows(false) > 0) { 
        $error[] = 'Username already exists.';
    }
}

if(!isset($error) && isset($_POST['submit'])) {
    $sql = "INSERT INTO user(username, password) VALUES ('$user', '$password')";
    mysqli_query($mysqli, $sql);
}


if(isset($error)) {
    foreach($error as $key => $value) {
        echo '<span style="color:red">'.$value.'</span>';
    }
}

?>