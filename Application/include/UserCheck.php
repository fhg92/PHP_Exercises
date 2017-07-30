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
    if($curUser['username'] != $_SESSION['user'] or $curUser['username'] == null) {
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

?>