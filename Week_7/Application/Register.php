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

include('include/DbConnect.php');
include('include/RegisterFunctions.php');
            
echo '<br>';

if(isset($_POST['user']) && checkUser($error) == true) {
    checkUserDb($pdo, $user, $error);
}

checkPass($error);
    
if(isset($error)) {
    echo '<br>';
    foreach($error as $key => $value) {
        echo '<span style="color:red">'.$value.'</span>';
    }
} else {
    if(insert($pdo) == true) {
        $message = "You've succesfully registered. ";
    }
}
echo '</div>';

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