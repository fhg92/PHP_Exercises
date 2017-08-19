<?php

include('include/GroupFunctions.php');

if(isset($_GET['json']) && $_GET['json'] == 'true') {
    json($pdo);
}

include('include/Header.php');

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
        formValidation($pdo, $message);
        if(isset($message)) {
            foreach($message as $key => $value) {
                echo '<p><span style="color:red">'.$value.'</span></p>';
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
    
    deleteIfOnlyPending($pdo);
    
    } else {
        getCurrentGroup($pdo, $admin);
        getMembers($pdo, $users, $admin);
        checkIfMember($users);
    }
    ?>
    
    </body>
</html>