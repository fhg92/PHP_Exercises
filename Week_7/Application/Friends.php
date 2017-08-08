<?php

include('include/Header.php');
include('include/FriendFunctions.php');

?>

<html>
    <head>
        <title>Friends</title>
    </head>
    <body>
        <div>
            <?php
            userCheck($pdo);
            echo '<p><b>Friend Requests:</b></p>';
            getFriendRequest($pdo);
            echo "<p><b>Search Friends:</b></p>
                <form method='post' class='search'>
                <input type='text' name='search' placeholder='Search'/>
                <input type='submit' name='submit' value='Submit' />
                </form>";
            
            searchFriend($pdo); 
            echo '<p><b>Friends:</b></p>';
            getFriendList($pdo);
            ?>
        </div>
    </body>
</html>