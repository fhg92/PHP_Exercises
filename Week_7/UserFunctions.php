<?php

function addFriend($row, $user, $mysqli, &$curUser)
{
// Select user_id from current user.
$sql = 'SELECT user_id FROM user WHERE username = "' . mysqli_real_escape_string($mysqli, $user) . '"';
$result = mysqli_query($mysqli, $sql) or die('Error connecting to database');
$curUser = mysqli_fetch_assoc($result);

    if(isset($_GET['add']) && $_GET['add'] == $row['user_id']) {
        // Current user.
        $currentId = $curUser['user_id'];
        
        // User to add as friend.
        $userTwoId = $row['user_id'];
        
        $sql = "INSERT INTO relation(user_one_id, user_two_id, status) VALUES ('$currentId', '$userTwoId', '0')";
        mysqli_query($mysqli, $sql);
    }
}

function getFriendRequest($mysqli, $row, $curUser)
{
    // IF I'M USER_TWO_ID IN RELATION DATABASE AND STATUS = 0. GET FRIEND REQUEST FROM USER ONE.
    $sql = "SELECT user_one_id FROM relation WHERE status = 0 AND user_one_id != " .$curUser['user_id'];
    $result = mysqli_query($mysqli, $sql) or die('Error connecting to database');
    $request = mysqli_fetch_array($result);
    //echo $request[0];
    
    $sql = "SELECT username FROM user WHERE user_id = '$request[0]'";
    $result = mysqli_query($mysqli, $sql) or die('Error connecting to database');
    $userId = mysqli_fetch_array($result);
    
    if(!empty($userId)) {
        echo '<br>'.$userId[0]. ' has send you a friend request. '.
            '<a href = "User.php?a=' . $request[0] . '">Accept</a> '.
            '<a href = "User.php?d=' .  $request[0] . '">Decline</a>';
    }
}

?>