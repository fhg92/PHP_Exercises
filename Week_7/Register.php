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
        <a href='Login.php'>Already registered? Click here to log in.</a><br>
    </body>
</html>
        
<?php

include('DbConnect.php');
include('RegisterFunctions.php');

if(isset($_POST['register'])) {
    if(isset($_POST['user']) && isset($_POST['password'])) {
        $user = mysqli_real_escape_string($mysqli, $_POST['user']);
        $password = mysqli_real_escape_string($mysqli, $_POST['password']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    }
    
    checkUser($error);
    checkUserDb($mysqli, $user, $error);
    checkPassword($error);
    
    if(isset($error)) {
        foreach($error as $key => $value) {
            echo '<span style="color:red">'.$value.'</span>';
        }
    } else {
        $sql = "INSERT INTO user(username, password) VALUES ('$user', '$password')";
        mysqli_query($mysqli, $sql);   
    }
}

?>