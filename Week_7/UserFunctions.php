<?php

function userCheck($mysqli, &$user, &$curUser, &$otherUsers)
{
    $user = $_SESSION['user'];
    $query = "SELECT * FROM user WHERE username != '$user'";
    $getInfo = mysqli_query($mysqli, $query);
    
    // Select user_id from current user.
    $sql = 'SELECT user_id FROM user WHERE username = "' . mysqli_real_escape_string($mysqli, $user) . '"';
    $result = mysqli_query($mysqli, $sql) or die('Error connecting to database');
    $curUser = mysqli_fetch_assoc($result);
    
    $sql = "SELECT * FROM user WHERE user_id != " .$curUser['user_id'];
    $result = mysqli_query($mysqli, $sql) or die('Error connecting to database');
    $otherUsers = mysqli_fetch_all($result);
        
    if(!empty($otherUsers)) {
        return true;
    } else {
        return false;
    }
}

function getFriendList($mysqli, $curUser)
{   
    // Get ID from user_one_id and user_two_id.
    $sql = "SELECT user_one_id, user_two_id FROM relation WHERE status = 1";
    $result = mysqli_query($mysqli, $sql) or die('Error connecting to database');
    $relations = mysqli_fetch_all($result);
    
    foreach($relations as $user) {
        if($user[0] == $curUser['user_id']) {
            $sql = "SELECT username FROM user WHERE user_id = " .$user[1];
            $result = mysqli_query($mysqli, $sql) or die('Error connecting to database');
            $friend = mysqli_fetch_assoc($result);
            echo '<tr><td>'.$friend['username'].'</td></tr>';
        } 
        if($user[1] == $curUser['user_id']) {
            $sql = "SELECT username FROM user WHERE user_id = " .$user[0];
            $result = mysqli_query($mysqli, $sql) or die('Error connecting to database');
            $friend = mysqli_fetch_assoc($result);
            echo '<tr><td>'.$friend['username'].'</td></tr>';
        }
    }
    if(!isset($friend)){
        echo "You don't have any friends in your friendlist yet.";
    }
} 

function getFriendRequest($mysqli, $curUser)
{
    // If current user is user_id in relation database and status = 0.
    // Get friend request from user_two_id.
    $sql = "SELECT user_one_id FROM relation WHERE status = 0 AND user_one_id != 
    " .$curUser['user_id'];
    $result = mysqli_query($mysqli, $sql) or die('Error connecting to database');
    $request = mysqli_fetch_array($result);
    //echo $request[0];
    
    $sql = "SELECT username FROM user WHERE user_id = '$request[0]'";
    $result = mysqli_query($mysqli, $sql) or die('Error connecting to database');
    $userId = mysqli_fetch_array($result);
    
    if(!empty($userId)) {
        echo $userId[0]. ' has send you a friend request. '.
            '<a href = "User.php?a=' . $request[0] . '"><button>Accept</button></a> '.
            '<a href = "User.php?d=' .  $request[0] . '"><button>Decline</button></a>';
    }
    // If request accepted.
    if(isset($_GET['a']) && $_GET['a'] == $request[0]) {
        $sql = "UPDATE relation SET status = '1' WHERE user_two_id = " . $curUser['user_id'];
        mysqli_query($mysqli, $sql);
    }
    // If request declined.
    if(isset($_GET['d']) && $_GET['d'] == $request[0]) {
        $sql = "UPDATE relation SET status = '2' WHERE user_two_id = " . $curUser['user_id'];
        mysqli_query($mysqli, $sql);
    }
    
}

function addFriend($mysqli, $curUser, $otherUsers)
{
    foreach($otherUsers as $user) {
        echo '<tr><td>'.ucfirst(htmlentities($user[1])).' <a href = "User.php?add='
            . $user[0] . '"><button>Add</button></a></td></tr>';
        
        if(isset($_GET['add']) && $_GET['add'] == $user[0]) {
            // Current user.
            $currentId = mysqli_real_escape_string($mysqli, $curUser['user_id']);
        
            // User to add as friend.
            $userTwoId = mysqli_real_escape_string($mysqli, $user[0]);
        
            $sql = "INSERT INTO relation(user_one_id, user_two_id, status) VALUES ('$currentId', '$userTwoId', '0')";
            mysqli_query($mysqli, $sql);
        }
    }
}

?>