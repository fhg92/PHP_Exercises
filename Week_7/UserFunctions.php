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
        echo "<form method='post'>";
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
        echo '</form>';
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
            header('Location: User.php');
        }
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
    $request = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($request);
    
    foreach($request as $req){
        $sql = 'SELECT username FROM user WHERE user_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $req['user_one_id'], PDO::PARAM_INT);
        $stmt->execute();
        $request = $stmt->fetch();
        
        if(!empty($request)) {
            echo '<tr><td>'.ucfirst(htmlentities($request[0])). ' has send you a friend request'.
            " <button type='submit' name='accept' value='".$req['user_one_id']."'>Accept</button>
            <button type='submit' name='decline' value='".$req['user_one_id']."'>Decline</button>
            </td></tr>";
        }
        // ACCEPTING/DECLINING NOT WORKING YET. UNDER CONSTRUCTION.
        if(isset($_POST['accept']) or isset($_POST['decline'])) {
            $sql = 'UPDATE relation SET status = :status WHERE user_one_id = :id1
            AND user_two_id = :id2';
            $stmt = $pdo->prepare($sql);
            // If friend request accepted.
            if($_POST['accept'] == $req['user_one_id']) {
                $i = 1;
            }
            // If friend request declined.
            if($_POST['decline'] == $req['user_one_id']) {
            $i = 2;
            }
            $stmt->bindParam(':status', $i, PDO::PARAM_INT);
            $stmt->bindParam(':id1', $req['user_one_id'], PDO::PARAM_INT);
            $stmt->bindParam(':id2', $curUser['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            $userId = null;
            header('Location: User.php');
        }
    }
    if(empty($request)) {
        echo 'There are no new friend requests.';
    }
}


function addFriend($pdo, $curUser, $otherUsers)
{
    echo "<form method='post'>";
    foreach($otherUsers as $user) {
        echo '<tr><td>'.ucfirst(htmlentities($user['username'])).
        " <button type='submit' name='add' value='".$user['user_id']."'>Add</button>
        </td></tr>";
        
        if(isset($_POST['add'])) {
            foreach($_POST as $value) {
            // Status.
            $i = 0;
            
            $sql = "INSERT INTO relation(user_one_id, user_two_id, status) VALUES
            (:curId, :otherId, :status)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':curId', $curUser['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':otherId', $value, PDO::PARAM_INT);
            $stmt->bindParam(':status', $i, PDO::PARAM_INT);
            $stmt->execute();
            }
        }
    }
    echo '</form>';
}

?>