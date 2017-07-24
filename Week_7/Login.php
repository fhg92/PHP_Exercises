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
            <input type='submit' name='login' value='Login'/>
        </form>
        
<?php
  
include('DbConnect.php');
include('LoginFunctions.php');

if(isset($_POST['login'])) {
    
    if(checkUser($error) == true) {
        checkUserDb($mysqli, $error, $user);
    }
    
    if(checkPass($error) == true) {
        checkPassDb($mysqli, $dbPassword, $error, $user);
        logIn($mysqli, $dbPassword, $error);
    }
    
    if(isset($error)) {
        echo '<span style="color:red">'.$error.'</span><br>';
    }
}

?>
        
        <a href='Register.php'>Not registered? Click here to register.</a><br>
    </body>
</html>