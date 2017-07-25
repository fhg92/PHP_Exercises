<?php

function userCheck($pdo, &$curUser, &$otherUsers)
{    
    // Select user_id from current user.
    $sql = 'SELECT user_id, username FROM user WHERE username = :user';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user', $_SESSION['user'], PDO::PARAM_STR);
    $stmt->execute();
    $curUser = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // If the current username from database is different from the user session,
    // redirect to login page.
    if($curUser['username'] != $_SESSION['user']){
        header('Location: Login.php');
    }
    
    $sql = 'SELECT * FROM user WHERE user_id != :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $curUser['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $otherUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if(!empty($otherUsers)) {
        return true;
    } else {
        return false;
    }
}

function getFriendList($pdo, $curUser)
{   
    // Get ID from user_one_id and user_two_id.
    $sql = 'SELECT user_one_id, user_two_id FROM relation WHERE status = :status';
    $stmt = $pdo->prepare($sql);
    $i = 1;
    $stmt->bindParam(':status', $i, PDO::PARAM_INT);
    $stmt->execute();
    $relations = $stmt->fetchAll();
    
    foreach($relations as $user) {
        if($user[0] == $curUser['user_id'] OR $user[1] == $curUser['user_id']) {
            $sql = 'SELECT username, user_id FROM user WHERE user_id = :id';
            $stmt = $pdo->prepare($sql);
            if($user[0] == $curUser['user_id']) {
                $stmt->bindParam(':id', $user[1], PDO::PARAM_INT);
            }
            if($user[1] == $curUser['user_id']) {
                $stmt->bindParam(':id', $user[0], PDO::PARAM_INT);
            }
            $stmt->execute();
            $friend = $stmt->fetch(PDO::FETCH_ASSOC);
            echo '<tr><td>'.ucfirst(htmlentities($friend['username'])).' <a href = 
            "User.php?r='. $friend['user_id'] . '"><button>Delete</button></a></td></tr>';
        }
    }
    
    if(isset($_GET['r']) && $_GET['r'] == $friend['user_id']) {
        $sql= 'DELETE FROM relation WHERE user_one_id = :userOne AND user_two_id = :userTwo';
        $stmt = $pdo->prepare($sql);
        if($user[0] == $curUser['user_id']) {
            $stmt->bindParam(':userOne', $curUser['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':userTwo', $friend['user_id'], PDO::PARAM_INT);
        }
        if($user[1] == $curUser['user_id']) {
            $stmt->bindParam(':userOne', $friend['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':userTwo', $curUser['user_id'], PDO::PARAM_INT);
        }
        $stmt->execute();
        header('Location: User.php');
    }
    if(!isset($friend)){
    echo "You don't have any friends in your friendlist yet.";
    }
} 

function getFriendRequest($pdo, $curUser)
{
    // If current user is user_two_id in relation database and status = 0.
    // Get friend request from user_one_id.
    $sql = 'SELECT user_one_id FROM relation WHERE status = :status AND user_two_id = :id';
    $stmt = $pdo->prepare($sql);
    $i = 0;
    $stmt->bindParam(':status', $i, PDO::PARAM_INT);
    $stmt->bindParam(':id', $curUser['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $request = $stmt->fetch(PDO::FETCH_NUM);   
    $sql = 'SELECT username FROM user WHERE user_id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $request[0], PDO::PARAM_INT);
    $stmt->execute();
    $userId = $stmt->fetch(PDO::FETCH_NUM);
    
    if(!empty($userId)) {
        echo '<tr><td>'.ucfirst(htmlentities($userId[0])). ' has send you a friend request. '.
            '<a href = "User.php?a=' . $request[0] . '"><button>Accept</button></a> '.
            '<a href = "User.php?d=' .  $request[0] . '"><button>Decline</button></a></td></tr>';
    } else {
        echo 'There are no new friend requests.';
    }
    // If request accepted.
    if(isset($_GET['a']) or isset($_GET['d'])) {
        $sql = 'UPDATE relation SET status = :status WHERE user_two_id = :id';
        $stmt = $pdo->prepare($sql);
        // If friend request accepted.
        if($_GET['a'] == $request[0]) {
            $i = 1;
        }
        // If friend request declined.
        if($_GET['d'] == $request[0]) {
            $i = 2;
        }
        $stmt->bindParam(':status', $i, PDO::PARAM_INT);
        $stmt->bindParam(':id', $curUser['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        $userId = null;
        header('Location: User.php');
    }
}


function addFriend($pdo, $curUser, $otherUsers)
{
    foreach($otherUsers as $user) {
        echo '<tr><td>'.ucfirst(htmlentities($user['username'])).' <a href = "User.php?add='
            . $user['user_id'] . '"><button>Add</button></a></td></tr>';
    
        if(isset($_GET['add']) && $_GET['add'] == $user['user_id']) {
            // Status.
            $i = 0;
            
            $sql = "INSERT INTO relation(user_one_id, user_two_id, status) VALUES (:curId, :otherId, :status)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':curId', $curUser['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':otherId', $user['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':status', $i, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
}

?>