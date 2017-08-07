<?php

function checkGroupName(&$message)
{
    switch($_POST['group']) {
        case null:
            $message[] = 'Please fill in a group name.<br>'.PHP_EOL;
            return false;
            break;
        case strlen($_POST['group']) < 5:
            $message[] = 'Group name has to be at least 5 characters.<br>'.PHP_EOL;
            return false;
            break;
        case strlen($_POST['group']) > 60:
            $message[] = 'Group name has to be less than 60 characters.<br>'.PHP_EOL;
            return false;
            break;
        }
    return true;
}

function createGroup($pdo) {
    if(isset($_POST['add'])) {
        try {  
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();
            $stmt = $pdo->prepare('INSERT INTO groups(group_name) VALUES (:name)');
            $stmt->execute([':name' => $_POST['group']]);
            $stmt = $pdo->prepare('INSERT INTO group_user(group_id, user_id, status) 
            VALUES (:groupId, :userId, :status)');
            $stmt->bindValue(':groupId', $pdo->lastInsertId(), PDO::PARAM_INT);
            $stmt->bindValue(':userId', $_SESSION['userid'], PDO::PARAM_INT);
            // Status 2 has admin rights.
            $stmt->bindValue(':status', 2, PDO::PARAM_INT);
            $stmt->execute();
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Failed: " . $e->getMessage();
        }
        header('Location: Groups.php');
    }
}

function getGroups($pdo) {
    $sql = 'SELECT * FROM groups g LEFT JOIN group_user gu ON g.group_id = 
    gu.group_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<form method='post'><table>";
    foreach($groups as $row) {
        if(!empty($groups)) {
            echo '<tr><td>'.ucfirst(htmlentities($row['group_name'])). 
                " <button type='submit' name='leave' value='".$row['group_id'].
                "'>Leave</button>
                <button type='submit' name='delete' value='".$row['group_id'].
                "'>Delete</button>
                </td></tr>";
        }
    }
    if(isset($_POST['delete'])) {
        foreach($_POST as $value) {
            $sql = 'DELETE g, gu FROM groups g INNER JOIN group_user gu
            ON g.group_id = gu.group_id WHERE g.group_id = :groupId';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':groupId', $value, PDO::PARAM_INT);
            $stmt->execute();
            
            header('Location: Groups.php');
        }
    }
    
    if(empty($groups)) {
        echo "You're not in any group yet.";
    }
    echo '</table></form>';
}

?>