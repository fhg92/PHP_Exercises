<?php

function getFriendList($pdo, $curUser)
{   
    // Get ID from user_one_id and user_two_id.
    $sql = 'SELECT user_one_id, user_two_id FROM relation WHERE status = :status';
    $stmt = $pdo->prepare($sql);
    $i = 1;
    $stmt->bindParam(':status', $i, PDO::PARAM_INT);
    $stmt->execute();
    $relations = $stmt->fetchAll();
    
    echo "<form method='post'><table>";
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
            echo '<tr><td>'.ucfirst(htmlentities($friend['username'])).
                " <button type='submit' name='delete' value='".$friend['user_id'].
                "'>Delete</button></td></tr>";
        }
    }
    
    if(isset($_POST['delete'])) {
        foreach($_POST as $value) {
            $sql= 'DELETE FROM relation WHERE user_one_id = :userOne AND user_two_id = :userTwo';
            $stmt = $pdo->prepare($sql);
            if($user[0] == $curUser['user_id']) {
                $stmt->bindParam(':userOne', $curUser['user_id'], PDO::PARAM_INT);
                $stmt->bindParam(':userTwo', $value, PDO::PARAM_INT);
            }
            if($user[1] == $curUser['user_id']) {
                $stmt->bindParam(':userOne', $value, PDO::PARAM_INT);
                $stmt->bindParam(':userTwo', $curUser['user_id'], PDO::PARAM_INT);
            }
            $stmt->execute();
            header('Location: Friends.php');
        }
    }
    if(!isset($friend)){
        echo "You don't have any friends in your friendlist yet.";
    }
    echo '<table></form>';
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
    $request = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo '<form method="post"><table>';
    foreach($request as $req) {
        $sql = 'SELECT username FROM user WHERE user_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $req['user_one_id'], PDO::PARAM_INT);
        $stmt->execute();
        $name = $stmt->fetch();

        if(!empty($name)) {
            echo '<tr><td>'.ucfirst(htmlentities($name[0])). 
                ' has sent you a friend request.'.
                " <button type='submit' name='accept' value='".$req['user_one_id'].
                "'>Accept</button>
                <button type='submit' name='decline' value='".$req['user_one_id'].
                "'>Decline</button>
                </td></tr>";
        }
    } 
    
    if(empty($request)) {
        echo 'There are no new friend requests.';
    }
    echo '</table></form>';
    
    if(!empty($request) && isset($_POST['accept']) or isset($_POST['decline'])) {
        foreach($_POST as $value) {
            if(isset($_POST['accept']) or isset($_POST['decline'])) {
                // If friend request accepted.
                if($_POST['accept'] == $value) {
                    $i = 1;
                    $sql = 'UPDATE relation SET status = :status WHERE user_one_id 
                    = :id1 AND user_two_id = :id2';
                }
                // If friend request declined.
                if($_POST['decline'] == $value) {
                    $i = 0;
                    $sql = 'DELETE FROM relation WHERE status = :status AND 
                    user_one_id = :id1 AND user_two_id = :id2';
                }
            }
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':status', $i, PDO::PARAM_INT);
            $stmt->bindParam(':id1', $value, PDO::PARAM_INT);
            $stmt->bindParam(':id2', $curUser['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            $userId = null;
            header('Location: Friends.php');
        }
    }
}

?>