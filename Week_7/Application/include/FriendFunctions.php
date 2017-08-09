<?php

function searchFriend($pdo)
{
    if(isset($_POST['submit']) && strlen($_POST['search']) >= 3) {
        $sql = 'SELECT * FROM user_personal u INNER JOIN relation r WHERE 
        (u.first_name LIKE :search OR u.last_name LIKE :search OR u.city like 
        :search) AND r.status = :status AND u.user_id = r.user_one_id AND 
        r.user_two_id = :curUser OR r.status = :status AND u.user_id = 
        r.user_two_id AND r.user_one_id = :curUser';
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':search', '%'.$_POST['search'].'%');
        $stmt->bindValue(':curUser', $_SESSION['userid']);
        $stmt->bindValue(':status', 1);
        $stmt->execute();
        $friends = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if(!$stmt->rowCount() == 0) {
            foreach($friends as $friend) {
                $result .= '<tr><td><a href="Users.php?id='.$friend['user_id'].'">'
                    .ucfirst(htmlentities($friend['first_name'])).' '.
                htmlentities($friend['last_name'])."</a> <button type='submit'
                name='delete' value='".$friend['user_id']."'>Delete</button>
                </td></tr>";
            }
        } else {
            $result = '<tr><td>No users found matching your search.</td></tr>';
        }
    }
    if(isset($_POST['submit']) && strlen($_POST['search']) < 3) {
        $result = '<tr><td>No results found. Your search has to be at least 3 
        characters long.</td></tr>';
    }
    if(isset($result)) {
        setcookie('result', $result, time()+1);
    }
    if(isset($_POST['submit'])) {
        header('Location: Friends.php');
    }
    if(isset($_COOKIE['result'])) {
        echo '<table>'.$_COOKIE['result'].'</table>';
    }
}

function getFriendList($pdo, $relations)
{   
    echo "<form method='post'><table>";
    foreach($relations as $user) {
        if($user[0] == $_SESSION['userid'] OR $user[1] == $_SESSION['userid']) {
            $sql = 'SELECT * FROM user_personal WHERE user_id = :id';
            $stmt = $pdo->prepare($sql);
            if($user[0] == $_SESSION['userid']) {
                $stmt->bindParam(':id', $user[1], PDO::PARAM_INT);
            }
            if($user[1] == $_SESSION['userid']) {
                $stmt->bindParam(':id', $user[0], PDO::PARAM_INT);
            }
            $stmt->execute();
            $friend = $stmt->fetch(PDO::FETCH_ASSOC);
            echo '<tr><td><a href="Users.php?id='.$friend['user_id'].'">'.
                ucfirst(htmlentities($friend['first_name'])).' '.
                htmlentities($friend['last_name'])."<a> <button type='submit'
                name='delete' value='".$friend['user_id']."'>Delete</button>
                </td></tr>";
        }
    }
        if(!isset($friend)){
        echo "<p>You don't have any friends in your friendlist yet.</p>";
    }
    echo '<table></form>';
    deleteFriend($pdo, $relations);
}

function getFriendRequest($pdo)
{
    $sql = 'SELECT user_id, first_name, last_name FROM user_personal u INNER 
    JOIN relation r WHERE r.user_one_id = u.user_id AND r.user_two_id = :id
    AND status = :status';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_SESSION['userid']);
    $stmt->bindValue(':status', 0, PDO::PARAM_INT);
    $stmt->execute();
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo '<form method="post"><table>';
    foreach($requests as $data) {
        if(!empty($data)) {
            echo '<tr><td>'.ucfirst(htmlentities($data['first_name'])).' '.htmlentities($data['last_name']).
                ' has sent you a friend request.'.
                " <button type='submit' name='accept' value='".$data['user_id'].
                "'>Accept</button>
                <button type='submit' name='decline' value='".$data['user_id'].
                "'>Decline</button>
                </td></tr>";
        }
    } 
    if(empty($requests) or empty($data)) {
        echo '<tr><td>There are no new friend requests.</td></tr>';
    }
    echo '</table></form>';
    
    if(!empty($requests) && isset($_POST['accept']) or isset($_POST['decline'])) {
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
            $stmt->bindParam(':id2', $_SESSION['userid'], PDO::PARAM_INT);
            $stmt->execute();
            $userId = null;
            header('Location: Friends.php');
        }
    }
}

?>