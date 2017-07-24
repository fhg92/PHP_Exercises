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
        
<?php

include('DbConnect.php');
include('RegisterFunctions.php');

$date = date('D d M, Y H:i a');

if(isset($_POST['register'])) {
    if(isset($_POST['user']) && isset($_POST['password'])) {
        $user = $mysqli->real_escape_string($_POST['user']);
        $password = $mysqli->real_escape_string($_POST['password']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    }
    
    echo '<br>';
    
    if(checkUser($error) == true) {
        checkUserDb($mysqli, $user, $error);
    }
    
    checkPass($error);
    
    if(isset($error)) {
        echo '<br>';
        foreach($error as $key => $value) {
            echo '<span style="color:red">'.$value.'</span>';
        }
    } else {
        insert($mysqli, $user, $password, $date);
        $message = "You've succesfully registered. ";
    }
    echo '</div>';
}

?>
            
        </form>
        <a href='Login.php'>
            <?php 
            if(isset($message)) { 
                echo $message;
            }else{
                echo 'Already registered? ';
            }
            ?>
            Click here to log in.</a><br>
    </body>
</html>