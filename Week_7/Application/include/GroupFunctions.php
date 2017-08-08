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

function createGroup($pdo)
{
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

function getMyGroups($pdo)
{
    $sql = 'SELECT * FROM groups g INNER JOIN group_user gu ON g.group_id = 
    gu.group_id WHERE gu.user_id = :userId AND status != :status ORDER BY
    gu.status DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':userId', $_SESSION['userid'], PDO::PARAM_INT);
    $stmt->bindValue(':status', 0, PDO::PARAM_INT);
    $stmt->execute();
    $myGroups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<form method='post'><table>";
    foreach($myGroups as $group) {
        echo '<tr><td>'.ucfirst(htmlentities($group['group_name']));
        if($group['status'] == 2) {
            echo " <button type='submit' name='delete' value='".
                $group['group_id']."'>Delete</button></td></tr>";
        }
        if($group['status'] == 1) {
            echo " <button type='submit' name='leave' value='"
                .$group['group_id']."'>Leave</button></td></tr>";
        }
    }
    echo '</table></form>';
    if(empty($myGroups)) {
        echo "<p>You're not in any group yet.</p>";
    }
    
    if(isset($_POST['delete']) or isset($_POST['leave'])) {
        foreach($_POST as $value) {
            if($_POST['delete']) {
                $sql = 'DELETE g, gu FROM groups g INNER JOIN group_user gu
                ON g.group_id = gu.group_id WHERE g.group_id = :groupId';
            }
            if($_POST['leave']) {
                $sql = 'DELETE FROM group_user WHERE group_id = :groupId and user_id = :userId';
            }
            $stmt = $pdo->prepare($sql);
            if($_POST['leave']) {
               $stmt->bindValue(':userId', $_SESSION['userid'], PDO::PARAM_INT); 
            }
            $stmt->bindValue(':groupId', $value, PDO::PARAM_INT);
            $stmt->execute();
            
            header('Location: Groups.php');
        }
    }
}

function getAllGroups($pdo)
{
    // UNDER CONSTRUCTION.
    $sql = 'SELECT * FROM groups g INNER JOIN group_user gu ON g.group_id = gu.group_id
    WHERE gu.user_id != :userId OR (gu.user_id = :userId AND gu.status = :status) GROUP BY gu.group_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('userId', $_SESSION['userid'], PDO::PARAM_INT);
    $stmt->bindValue('status', 0, PDO::PARAM_INT);
    $stmt->execute();
    $allGroups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($allGroups);
    
    echo "<form method='post'><table>";
    foreach($allGroups as $row) {
        echo '<tr><td>'.ucfirst(htmlentities($row['group_name']));
    }
    if(empty($allGroups)) {
        echo '<tr><td>There are no other groups yet.</td></tr>';
    }
    echo '</table></form>';
    
    if(isset($_POST['join'])) {
        foreach($_POST as $value) {
            $sql = 'INSERT INTO group_user (group_id, user_id, status) VALUES
            (:groupId, :userId, :status)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':groupId', $value, PDO::PARAM_INT);
            $stmt->bindValue(':userId', $_SESSION['userid'], PDO::PARAM_INT); 
            $stmt->bindValue(':status', 0, PDO::PARAM_INT); 
            $stmt->execute();
            
            header('Location: Groups.php');
        }
    }
}

?>