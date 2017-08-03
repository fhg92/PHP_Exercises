<?php

function addUser($pdo, $curUser)
{
    if(isset($_POST['add'])) {
        foreach($_POST as $value) {
            // Status.
            $i = 0;
            
            $sql = 'INSERT INTO relation(user_one_id, user_two_id, status) VALUES
            (:curId, :otherId, :status)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':curId', $curUser['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':otherId', $value, PDO::PARAM_INT);
            $stmt->bindParam(':status', $i, PDO::PARAM_INT);
            $stmt->execute();
        }
        header('Location: Users.php');
    }
}

function requestCheck($pdo, $curUser, $user)
{
    $sql = 'SELECT status FROM relation WHERE user_one_id = :u1 AND user_two_id = :u2';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':u1', $curUser['user_id'], PDO::PARAM_INT);
    $stmt->bindParam(':u2', $user['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    // Status of sent requests.
    $sent = $stmt->fetch();
    
    $sql = 'SELECT status FROM relation WHERE user_one_id = :u1 AND user_two_id = :u2';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':u1', $user['user_id'], PDO::PARAM_INT);
    $stmt->bindParam(':u2', $curUser['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    // Status of received requests.
    $rec = $stmt->fetch();  
    
    if(!isset($rec[0])) {
        if(isset($sent[0])) {
            if($sent[0] == 0) {
                echo " <button type='submit' name='add' disabled value='"
                    .$user['user_id']."'>Request sent</button>";
            }
            if($sent[0] == 1) {
                echo '';
            }
        }
        if(!isset($sent[0])) {
            echo " <button type='submit' name='add' value='"
                .$user['user_id']."'>Add</button>";
        }
    } 
}

function searchUser($pdo, $curUser)
{
    if(isset($_POST['search']) && strlen($_POST['search']) >= 3) {
    $search = $_POST['search'];
    $sql = "SELECT user_id, username FROM user WHERE username LIKE '%$search%'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, '%$search%', PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if(empty($_POST['search'])) {
            echo '';
        }
        elseif(!$stmt->rowCount() == 0) {
            foreach($result as $user) {
                if($user['username'] != $_SESSION['user']) {
                    echo "<form method='post'><table><tr><td>".ucfirst(htmlentities($user['username']));
                    requestCheck($pdo, $curUser, $user);
                    echo '</td></tr></table>';
                    addUser($pdo, $curUser);
                }
            }
            
        } else {
            echo '<p>No user found matching your search.</p>';
        }
    }
    if(isset($_POST['search']) && strlen($_POST['search']) < 3) {
        echo '<p>No results found. Your search has to be at least 3 characters long.</p>';
    }
}

function getUserList($pdo, $curUser, $otherUsers)
{
    echo "<form method='post'>";
    foreach($otherUsers as $user) {
        echo '<table><tr><td>'.ucfirst(htmlentities($user['username']));
        requestCheck($pdo, $curUser, $user);
        echo '</td></tr></table>';
        addUser($pdo, $curUser);
    }
    echo '</form>';
}

?>