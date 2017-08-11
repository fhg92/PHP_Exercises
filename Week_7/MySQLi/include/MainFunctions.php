<?php

function deleteFriend($pdo, &$relations)
{   
    // Get ID from user_one_id and user_two_id.
    $sql = 'SELECT user_one_id, user_two_id FROM relation WHERE status = :status';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':status', 1, PDO::PARAM_INT);
    $stmt->execute();
    $relations = $stmt->fetchAll();  
    
    if(isset($_POST['delete'])) {
        foreach($_POST as $value) {
            $sql= 'DELETE FROM relation WHERE user_one_id = :userOne AND user_two_id = :userTwo';
            $stmt = $pdo->prepare($sql);
            foreach($relations as $user) {
                if($user[0] == $_SESSION['userid']) {
                    $stmt->bindParam(':userOne', $_SESSION['userid'], PDO::PARAM_INT);
                    $stmt->bindParam(':userTwo', $value, PDO::PARAM_INT);
                }
                if($user[1] == $_SESSION['userid']) {
                    $stmt->bindParam(':userOne', $value, PDO::PARAM_INT);
                    $stmt->bindParam(':userTwo', $_SESSION['userid'], PDO::PARAM_INT);
                }
            }
            $stmt->execute();
            if(!isset($_GET['id'])) {
                header('Location: Friends.php');
            } else {
                header('Location: Users.php?id='.$_GET['id'].'.php');
            }
        }
    }
}

?>