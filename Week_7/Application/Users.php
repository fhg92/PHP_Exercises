<?php
include('include/Header.php');
include('include/UserFunctions.php');
?>

<html>
    <head>
        <title>Users</title>
    </head>
    <body>

<div>
<p><b>Search user:</b></p>
<form method='post' class='search'>
<input type='text' name='search' placeholder='Search'/>
<input type="submit" name='submit' value="Submit" />
</form>
    <?php 
    if(userCheck($pdo, $curUser, $otherUsers) == true) {
        searchUser($pdo, $curUser); 
    }
    ?>
</div>
    <div>
        <p><b>Users:</b></p>
        <?php
        if(userCheck($pdo, $curUser, $otherUsers) == true) {
            getUserList($pdo, $curUser, $otherUsers);
        } else {
            echo '<p>There are no other registered users yet.</p>';
        }
        ?>
        </div>
    </body>
</html>