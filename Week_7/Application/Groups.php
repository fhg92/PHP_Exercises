<?php
include('include/Header.php');
include('include/GroupFunctions.php');
?>

<html>
    <head>
        <title>Groups</title>
    </head>
    <?php if(!isset($_GET['id'])) { ?>
    <p><b>Add Group:</b></p>
    <form method='post' class='search'>
        <input type='text' name='group' placeholder='Group name'/>
        <input type='submit' name='add' value='Add'/>
    </form>
    <?php
    if(isset($_POST['add'])) {
        formValidation($message);
        if(isset($message)) {
            foreach($message as $key => $value) {
                echo '<span style="color:red">'.$value.'</span>';
            }
        } else {
            createGroup($pdo);
        }
    }
    echo '<p><b>Your Groups:</b></p>';
    getMyGroups($pdo, $myGroups);
    echo '<p><b>Pending Requests:</b></p>';
    pending($pdo, $pending);
    echo '<p><b>Other Groups:</b></p>';
    getOtherGroups($pdo, $myGroups, $pending);
    
    } else {
        getCurrentGroup($pdo, $admin);
        getMembers($pdo, $users, $admin);
        checkIfMember($users);
    }
    ?>
    
    </body>
</html>