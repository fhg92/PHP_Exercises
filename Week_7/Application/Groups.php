<?php
include('include/Header.php');
include('include/GroupFunctions.php');
?>

<html>
    <head>
        <title>Groups</title>
    </head>
        <div>
            <p><b>Add Group:</b></p>
            <form method='post' class='search'>
                <input type='text' name='group' placeholder='Group name'/>
                <input type='submit' name='add' value='Add'/>
            </form>
            <?php
            userCheck($pdo);
            if(isset($_POST['add'])) {
                checkGroupName($message);
                if(isset($message)) {
                    foreach($message as $key => $value) {
                        echo '<span style="color:red">'.$value.'</span>';
                    }
                } else {
                    createGroup($pdo);
                }
            }
            echo '<p><b>My Groups:</b></p>';
            getMyGroups($pdo);
            echo '<p><b>Other Groups:</b></p>';
            getAllGroups($pdo);
            ?>
        </div>
    </body>
</html>