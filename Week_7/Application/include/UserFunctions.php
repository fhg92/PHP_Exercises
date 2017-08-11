<?php

function requestCheck($pdo, $user)
{
    $sql = 'SELECT status FROM relation WHERE user_one_id = :u1 AND user_two_id
    = :u2';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':u1', $_SESSION['userid'], PDO::PARAM_INT);
    if(isset($_GET['id'])) {
        $stmt->bindParam(':u2', $_GET['id'], PDO::PARAM_INT);
    } else {
        $stmt->bindParam(':u2', $user['user_id'], PDO::PARAM_INT);
    }
    $stmt->execute();
    // Status of sent requests.
    $sent = $stmt->fetch();
    
    $sql = 'SELECT status FROM relation WHERE user_one_id = :u1 AND user_two_id
    = :u2';
    $stmt = $pdo->prepare($sql);
    if(isset($_GET['id'])) {
        $stmt->bindParam(':u1', $_GET['id'], PDO::PARAM_INT);
    } else {
        $stmt->bindParam(':u1', $user['user_id'], PDO::PARAM_INT);
    }
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
                if(isset($_GET['id'])) {
                    echo " <button type='submit' name='delete' value='".$_GET['id']."'>Delete</button>";
                } else {
                    echo '';   
                }
            }
        }
        if(!isset($sent[0])) {
            echo " <button type='submit' name='add' value='";
            if(isset($_GET['id'])) {
                echo $_GET['id'];
            } else {
                echo $user['user_id'];
            }
            echo "'>Add</button>";
        }
    } else {
        if(isset($_GET['id'])) {
            echo " <button type='submit' name='delete' value='".$_GET['id']."'>Delete</button>";
        } else {
            echo '';
        }
    }
}

function addUser($pdo)
{
    if(isset($_POST['add'])) {
        $sql = 'INSERT INTO relation(user_one_id, user_two_id, status) 
        VALUES(:curId, :otherId, :status)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':curId', $_SESSION['userid'], PDO::PARAM_INT);
        foreach($_POST as $value) {
            $stmt->bindParam(':otherId', $value, PDO::PARAM_INT);
        }
        $stmt->bindValue(':status', 0, PDO::PARAM_INT);
        $stmt->execute();
        if(isset($_GET['id'])){
            header('Location: Users.php?id='.$_GET['id'].'');
        } else {
            header('Location: Users.php');
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
            echo "<form method='post'>";
            foreach($users as $user) {
                $result .= '<tr><td><a href="Users.php?id='.$user['user_id'].'">
                '.ucfirst(htmlentities($user['first_name'])).' '.
                    htmlentities($user['last_name']).'</a></td></tr>';
            }
            echo 'hoi';
        } else {
            $result = '<tr><td>No users found matching your search.</td></tr>';
        }
        echo '</form>';
    }
    if(isset($_POST['search']) && strlen($_POST['search']) < 3) {
        $result = '<tr><td>No results found. Your search has to be at 
        least 3 characters long.</td></tr>';
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
                htmlentities($user['last_name']).'</a>';
            requestCheck($pdo, $user);
            echo '</td></tr>';
            addUser($pdo);
        }
        echo '</table></form>';
    }
}

function getUserDetails($pdo, &$details, &$gender)
{
    $sql = 'SELECT * FROM user_personal u INNER JOIN gender g ON u.gender_id 
    = g.gender_id WHERE user_id = :userId';
    $stmt = $pdo->prepare($sql);
    if(isset($_GET['id'])) {
        $stmt->bindValue(':userId', $_GET['id'], PDO::PARAM_INT);
    } else {
        $stmt->bindValue(':userId', $_SESSION['userid'], PDO::PARAM_INT);
    }
    $stmt->execute();
    $details = $stmt->fetch();
}

function deleteProfile($pdo)
{
    if(isset($_POST['delete'])) {
        $sql = 'DELETE u, up, gu, one, two FROM user u INNER JOIN user_personal
        up ON u.user_id = up.user_id LEFT JOIN group_user gu ON u.user_id = 
        gu.user_id LEFT JOIN relation one ON u.user_id = one.user_one_id LEFT JOIN
        relation two ON u.user_id = two.user_two_id WHERE u.user_id = :userId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':userId', $_SESSION['userid'], PDO::PARAM_INT);
        $stmt->execute();
        session_destroy();
        header('Location: Login.php');
    }
}

?>