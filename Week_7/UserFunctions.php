<?php

function userCheck($mysqli, &$user, &$curUser, &$otherUsers)
{
    $user = $mysqli->real_escape_string($_SESSION['user']);
    
    $sql = 'SELECT * FROM user WHERE username != ?';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $stmt->close();
    
    // Select user_id from current user.
    $sql = 'SELECT user_id FROM user WHERE username = ?';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $curUser = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    
    $sql = 'SELECT * FROM user WHERE user_id != ?';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $curUser['user_id']);
    $stmt->execute();
    $otherUsers = $stmt->get_result()->fetch_all();
    $stmt->close();
    
    if(!empty($otherUsers)) {
        return true;
    } else {
        return false;
    }
}

function getFriendList($mysqli, $curUser)
{   
    // Get ID from user_one_id and user_two_id.
    $sql = 'SELECT user_one_id, user_two_id FROM relation WHERE status = ?';
    $stmt = $mysqli->prepare($sql);
    $i = 1;
    $stmt->bind_param('i', $i);
    $stmt->execute();
    $relations = $stmt->get_result()->fetch_all();
    $stmt->close();
    
    foreach($relations as $user) {
        if($user[0] == $curUser['user_id']) {
            $sql = "SELECT username, user_id FROM user WHERE user_id = " .$user[1];
            $result = mysqli_query($mysqli, $sql) or die('Error connecting to database');
            $friend = mysqli_fetch_assoc($result);
            echo '<tr><td>'.ucfirst(htmlentities($friend['username'])).' <a href = "User.php?r='
            . $friend['user_id'] . '"><button>Delete</button></a></td></tr>';
        } 
        if($user[1] == $curUser['user_id']) {
            $sql = "SELECT username, user_id FROM user WHERE user_id = " .$user[0];
            $result = mysqli_query($mysqli, $sql) or die('Error connecting to database');
            $friend = mysqli_fetch_assoc($result);
            echo '<tr><td>'.ucfirst(htmlentities($friend['username'])).' <a href = "User.php?r='
            . $friend['user_id'] . '"><button>Delete</button></a></td></tr>';
        }
        if(isset($_GET['r']) && $_GET['r'] == $friend['user_id']) {
            if($user[0] == $curUser['user_id']) {
                $sql = "DELETE FROM relation WHERE user_one_id = ".$curUser['user_id']."
                AND user_two_id = ".$friend['user_id'];
            }
            if($user[1] == $curUser['user_id']) {
                $sql = "DELETE FROM relation WHERE user_two_id = ".$curUser['user_id']."
                AND user_one_id = ".$friend['user_id'];
            }
            mysqli_query($mysqli, $sql);
            header('Location: User.php');
        }
    }
    if(!isset($friend)){
        echo "You don't have any friends in your friendlist yet.";
    }
} 

function getFriendRequest($mysqli, $curUser)
{
    // If current user is user_two_id in relation database and status = 0.
    // Get friend request from user_one_id.
    $sql = "SELECT user_one_id FROM relation WHERE status = 0 AND user_two_id = 
    " .$curUser['user_id'];
    $result = mysqli_query($mysqli, $sql) or die('Error connecting to database');
    $request = mysqli_fetch_array($result);
    
    $sql = "SELECT username FROM user WHERE user_id = '$request[0]'";
    $result = mysqli_query($mysqli, $sql) or die('Error connecting to database');
    $userId = mysqli_fetch_array($result);
    
    if(!empty($userId)) {
        echo '<tr><td>'.ucfirst(htmlentities($userId[0])). ' has send you a friend request. '.
            '<a href = "User.php?a=' . $request[0] . '"><button>Accept</button></a> '.
            '<a href = "User.php?d=' .  $request[0] . '"><button>Decline</button></a></td></tr>';
    } else {
        echo 'There are no new friend requests.';
    }
    // If request accepted.
    if(isset($_GET['a']) && $_GET['a'] == $request[0]) {
        $sql = "UPDATE relation SET status = '1' WHERE user_two_id = " . $curUser['user_id'];
        mysqli_query($mysqli, $sql);
        $userId = null;
        header('Location: User.php');
    }
    // If request declined.
    if(isset($_GET['d']) && $_GET['d'] == $request[0]) {
        $sql = "UPDATE relation SET status = '2' WHERE user_two_id = " . $curUser['user_id'];
        mysqli_query($mysqli, $sql);
        $userId = null;
        header('Location: User.php');
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