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
        $sql = "INSERT INTO groups(group_name) VALUES (:name)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $_POST['group'], PDO::PARAM_STR);
        $stmt->execute();
        
        // Get name of group by id.
        $sql = 'SELECT group_id FROM groups WHERE group_name = :name';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $_POST['group'], PDO::PARAM_STR);
        $stmt->execute();
        $groupName = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $sql = "INSERT INTO group_user(group_id, user_id, status) VALUES (:groupId, :userId, :status)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':groupId', $groupName['group_id'], PDO::PARAM_STR);
        $stmt->bindParam(':userId', $_SESSION['userid'], PDO::PARAM_STR);
        // Status 2 has admin rights.
        $i = 2;
        $stmt->bindParam(':status', $i, PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
    return false;
}

function getGroups($pdo) {
    $sql = 'SELECT group_id FROM group_user WHERE user_id = :userId';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $_SESSION['userid'], PDO::PARAM_STR);
    $stmt->execute();
    $groupId = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<form method='post'><table>";
    foreach($groupId as $row) {
        $sql = 'SELECT group_name FROM groups WHERE group_id = :groupId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':groupId', $row['group_id'], PDO::PARAM_INT);
        $stmt->execute();
        $groupName = $stmt->fetch();
        
        if(!empty($groupName)) {
            echo '<tr><td>'.ucfirst(htmlentities($groupName[0])). 
                " <button type='submit' name='Leave' value='".$row['group_id'].
                "'>Leave</button>
                <button type='submit' name='Delete' value='".$row['group_id'].
                "'>Delete</button>
                </td></tr>";
        }
    }
    if(empty($groupName)) {
        echo "You're not in any group yet.";
    }
    echo '</table></form>';
}

?>