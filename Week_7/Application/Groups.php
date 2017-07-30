<?php
include('include/Header.php');
include('include/GroupFunctions.php');
?>

<html>
    <head>
        <title>Groups</title>
    </head>
        <div>
            <p><b>Add group:</b></p>
            <form method='post'>
                <div>
                    <input type='text' name='group' placeholder='Group name'/>
                    <input type='submit' name='add' value='Add'/>
                </div>
                    <?php
                    if(userCheck($pdo, $curUser, $otherUsers) == true) {
                        if(isset($_POST['add'])) {
                            checkGroupName($message);
                            if(isset($message)) {
                                foreach($message as $key => $value) {
                                    echo '<span style="color:red">'.$value.'</span>';
                                }
                            } else {
                                createGroup($pdo, $curUser);
                            }
                        }
                        echo '<br><div><b>My groups:</b></div><br>';
                        getGroups($pdo, $curUser);
                    }
                    ?>
            </form>
        </div>
    </body>
</html>