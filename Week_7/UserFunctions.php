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
        $sql = 'SELECT username, user_id FROM user WHERE user_id = ?';
        $stmt = $mysqli->prepare($sql);
        if($user[0] == $curUser['user_id']) {
            $stmt->bind_param('i', $user[1]);
        }
        if($user[1] == $curUser['user_id']) {
            $stmt->bind_param('i', $user[0]);
        }
        $stmt->execute();
        $friend = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        echo '<tr><td>'.ucfirst(htmlentities($friend['username'])).' <a href = 
        "User.php?r='. $friend['user_id'] . '"><button>Delete</button></a></td></tr>';
    }
    
    if(isset($_GET['r']) && $_GET['r'] == $friend['user_id']) {
        $sql= 'DELETE FROM relation WHERE user_one_id = ? AND user_two_id = ?';
        $stmt = $mysqli->prepare($sql);
        if($user[0] == $curUser['user_id']) {
            $stmt->bind_param('ii', $curUser['user_id'], $friend['user_id']);
        }
        if($user[1] == $curUser['user_id']) {
            $stmt->bind_param('ii', $friend['user_id'], $curUser['user_id']);
        }
        $stmt->execute();
        $stmt->close();
        header('Location: User.php');
    }
    if(!isset($friend)){
    echo "You don't have any friends in your friendlist yet.";
    }
} 

function getFriendRequest($mysqli, $curUser)
{
    // If current user is user_two_id in relation database and status = 0.
    // Get friend request from user_one_id.
    $sql = 'SELECT user_one_id FROM relation WHERE status = ? AND user_two_id = ?';
    $stmt = $mysqli->prepare($sql);
    $i = 0;
    $stmt->bind_param('ii', $i, $curUser['user_id']);
    $stmt->execute();
    $request = $stmt->get_result()->fetch_array();
    $stmt->close();
    
    $sql = 'SELECT username FROM user WHERE user_id = ?';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $request[0]);
    $stmt->execute();
    $userId = $stmt->get_result()->fetch_array();
    $stmt->close();
    
    if(!empty($userId)) {
        echo '<tr><td>'.ucfirst(htmlentities($userId[0])). ' has send you a friend request. '.
            '<a href = "User.php?a=' . $request[0] . '"><button>Accept</button></a> '.
            '<a href = "User.php?d=' .  $request[0] . '"><button>Decline</button></a></td></tr>';
    } else {
        echo 'There are no new friend requests.';
    }
    // If request accepted.
    if(isset($_GET['a']) or isset($_GET['d'])) {
        $sql = 'UPDATE relation SET status = ? WHERE user_two_id = ?';
        $stmt = $mysqli->prepare($sql);
        // If friend request accepted.
        if($_GET['a'] == $request[0]) {
            $i = 1;
        }
        // If friend request declined.
        if($_GET['d'] == $request[0]) {
            $i = 2;
        }
        $stmt->bind_param('ii', $i, $curUser['user_id']);
        $stmt->execute();
        $stmt->close();
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
            $currentId = $mysqli->real_escape_string($curUser['user_id']);
        
            // User to add as friend.
            $userTwoId = $mysqli->real_escape_string($user[0]);
        
            $sql = "INSERT INTO relation(user_one_id, user_two_id, status) VALUES (?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $i = 0;
            $stmt->bind_param('iii', $currentId, $userTwoId, $i);
            $stmt->execute();
            $stmt->close();
        }
    }
}

?>