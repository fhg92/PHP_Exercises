<?php
include('include/Header.php');
include('include/UserFunctions.php');
include('include/UserSearch.php');
?>

<html>
    <head>
        <title>Users</title>
    </head>
    <body>

<div>
<p><b>Search user:</b></p>
<form method='post'>
<input type='text' name='search' placeholder='Search'/>
<input type="submit" value="Submit" />
</form>
<?php search($pdo); ?>
</div>
    <div>
            <p><b>Users:</b></p>
            <?php
            echo '<table>';
            if(userCheck($pdo, $curUser, $otherUsers) == true) {
                getUserList($pdo, $curUser, $otherUsers);
            } else{
                echo 'There are no other registered users yet.';
            }
            ?>
        </div>
    </body>
</html>