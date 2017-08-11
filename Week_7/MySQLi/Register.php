<?php
include('include/DbConnect.php');
include('include/RegisterFunctions.php');
?>

<html>
    <body>
        <form method='post'>
            <div>
                <input type='text' name='firstName' placeholder='First name'/>
            </div>
            <br>
            <div>
                <input type='text' name='lastName' placeholder='Last name'/>
            </div>
            <br>
            <div>
                <input type="text" name='city' placeholder='City'/>
            </div>
            <br>
            <div>
                <input type='date' min='1917-01-01' max='2017-01-01' name='dateOfBirth'/>
            </div>
            <br>
            <div>
                <?php genderSelect($mysqli); ?>
            </div>
            <br>
            <div>
                <input type='text' name='email' placeholder='E-mail address'/>
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
            echo '<br>';
            if(isset($_POST['email']) && !empty($_POST['email'])) {
                checkEmail($error);
                checkUserDb($mysqli, $error);
            }
            checkPass($error);
            checkInputFields($error);
    
            if(isset($error)) {
                echo '<br>';
                foreach($error as $key => $value) {
                    echo '<span style="color:red">'.$value.'</span>';
                }
            } else {
                if(insert($mysqli) == true) {
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