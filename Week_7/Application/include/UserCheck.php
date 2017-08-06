<?php

function userCheck($pdo, &$otherUsers)
{    
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header('Location: Login.php');
    }
    
    $sql = 'SELECT * FROM user_personal WHERE user_id != :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['userid'], PDO::PARAM_INT);
    $stmt->execute();
    $otherUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if(!empty($otherUsers)) {
        return true;
    } else {
        return false;
    }
}

?>