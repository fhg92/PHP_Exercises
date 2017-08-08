<?php

function addUser($pdo)
{
    if(isset($_POST['add'])) {
        foreach($_POST as $value) {
            // Status.
            $i = 0;
            
            $sql = 'INSERT INTO relation(user_one_id, user_two_id, status) 
            VALUES(:curId, :otherId, :status)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':curId', $_SESSION['userid'], PDO::PARAM_INT);
            $stmt->bindParam(':otherId', $value, PDO::PARAM_INT);
            $stmt->bindParam(':status', $i, PDO::PARAM_INT);
            $stmt->execute();
        }
        header('Location: Users.php');
    }
}

function requestCheck($pdo, $user)
{
    $sql = 'SELECT status FROM relation WHERE user_one_id = :u1 AND user_two_id
    = :u2';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':u1', $_SESSION['userid'], PDO::PARAM_INT);
    $stmt->bindParam(':u2', $user['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    // Status of sent requests.
    $sent = $stmt->fetch();
    
    $sql = 'SELECT status FROM relation WHERE user_one_id = :u1 AND user_two_id
    = :u2';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':u1', $user['user_id'], PDO::PARAM_INT);
    $stmt->bindParam(':u2', $_SESSION['userid'], PDO::PARAM_INT);
    $stmt->execute();
    // Status of received requests.
    $rec = $stmt->fetch();  
    
    if(!isset($rec[0])) {
        if(isset($sent[0])) {
            if($sent[0] == 0) {
                echo " <button disabled>Request sent</button>";
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

function searchUser($pdo)
{
    if(isset($_POST['search']) && strlen($_POST['search']) >= 3) {
        $sql = 'SELECT * FROM user_personal WHERE user_id != :curUser AND 
        first_name LIKE :search OR last_name LIKE :search OR city like :search';
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':search', '%'.$_POST['search'].'%');
        $stmt->bindValue(':curUser', $_SESSION['userid']);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if(!$stmt->rowCount() == 0) {
            echo "<form method='post'><table>";
            foreach($users as $user) {
                $result .= '<tr><td><a href="Users.php?id='.$user['user_id'].'">
                '.ucfirst(htmlentities($user['first_name'])).' '.
                    htmlentities($user['last_name']).'</a></td></tr>';
            }
        } else {
            $result = '<p>No users found matching your search.</p>';
        }
        echo '</table></form>';
    }
    if(isset($_POST['search']) && strlen($_POST['search']) < 3) {
        $result = '<p>No results found. Your search has to be at 
        least 3 characters long.</p>';
    }
    if(isset($result)) {
        setcookie('result', $result, time()+1);
    }
    if(isset($_POST['submit'])) {
        header('Location: Users.php');
    }
    if(isset($_COOKIE['result'])) {
        echo '<table>'.$_COOKIE['result'].'</table>';
    }
}

function getUserList($pdo)
{
    $sql = 'SELECT * FROM user_personal WHERE user_id != :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['userid'], PDO::PARAM_INT);
    $stmt->execute();
    $otherUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if(empty($otherUsers)) {
        echo '<p>There are no other users yet.</p>';
    } else {
        echo "<form method='post'><table>";
        foreach($otherUsers as $user) {
            echo '<tr><td><a href="Users.php?id='.$user['user_id'].'">'.
                ucfirst(htmlentities($user['first_name'])).' '.
                htmlentities($user['last_name']);
            echo '</a>';
            requestCheck($pdo, $user);
            echo '</td></tr>';
            addUser($pdo);
        }
        echo '</table></form>';
    }
}

function getUserDetails($pdo, &$details, &$gender)
{
    $sql = 'SELECT * FROM user_personal WHERE user_id = :userId';
    $stmt = $pdo->prepare($sql);
    if(isset($_GET['id'])) {
        $stmt->bindValue(':userId', $_GET['id'], PDO::PARAM_INT);
    } else {
        $stmt->bindValue(':userId', $_SESSION['userid'], PDO::PARAM_INT);
    }
    $stmt->execute();
    $details = $stmt->fetch();
    
    $sql = 'SELECT label FROM gender WHERE gender_id = :gender';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':gender', $details['gender_id'], PDO::PARAM_INT);
    $stmt->execute();
    $gender = $stmt->fetch();
}

?>