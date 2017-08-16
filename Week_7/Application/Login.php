<?php
ob_start();
session_start();
?>

<html>
    <body>
        <form method='post'>
            <div>
                <input type='text' name='email' placeholder='E-mail'/>
            </div>
            <br>
            <div>
                <input type='password' name='password' placeholder='Password'/>
            </div>
            <br>
            <input type='submit' name='login' value='Login'/>
        </form>
        
<?php
        
session_start();
  
include('include/DbConnect.php');
include('include/LoginFunctions.php');
if(isset($_POST['login'])) {
    if(checkUser($error) == true) {
        checkUserDb($pdo, $error);
    }
    if(checkPass($error) == true) {
        checkPassDb($pdo, $hash, $error);
    }
    logIn($pdo, $hash, $error);
}
if(isset($error)) {
    echo '<span style="color:red">'.$error.'</span><br>';
}
        
?>
        
        <a href='Register.php'>Not registered? Click here to register.</a><br>
    </body>
</html>