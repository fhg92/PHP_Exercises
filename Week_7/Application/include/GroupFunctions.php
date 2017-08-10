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

function getMyGroups($pdo, &$myGroups)
{
    $sql = 'SELECT * FROM groups g INNER JOIN group_user gu ON g.group_id = 
    gu.group_id WHERE gu.user_id = :userId AND gu.status != :status ORDER BY group_name';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':userId', $_SESSION['userid'], PDO::PARAM_INT);
    $stmt->bindValue(':status', 0, PDO::PARAM_INT);
    $stmt->execute();
    $myGroups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<form method='post'><table>";
    foreach($myGroups as $group) {
        echo '<tr><td><a href="Groups.php?id='.$group['group_id'].'">'
            .ucfirst(htmlentities($group['group_name']));
        if($group['status'] == 1) {
            echo "</a> <button type='submit' name='leave' value='".
                $group['group_id']."'>Leave</button></td></tr>";
        }
        if($group['status'] == 2) {
            echo "</a> <button type='submit' name='delete' value='"
                .$group['group_id']."'>Delete</button></td></tr>";
        }
    }
    
    if(empty($myGroups)) {
        echo "<tr><td>You're not in any group.</td></tr>";
    }
    
    echo '</table></form>';
    
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

function pending($pdo, &$pending)
{
    $sql = 'SELECT * FROM groups g INNER JOIN group_user gu ON g.group_id = 
    gu.group_id WHERE gu.user_id = :userId AND gu.status = :status ORDER BY group_name';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':userId', $_SESSION['userid'], PDO::PARAM_INT);
    $stmt->bindValue(':status', 0, PDO::PARAM_INT);
    $stmt->execute();
    $pending = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<form method='post'><table>";
    foreach($pending as $group) {
        echo '<tr><td>'.ucfirst(htmlentities($group['group_name'])).
            " <button disabled>Pending...</button></td></tr>";
    }
    
    if(empty($pending)) {
        echo '<tr><td>No pending requests.</td></tr>';
    }
    
    echo '</table></form>';
}

function getOtherGroups($pdo, $myGroups, $pending)
{
    $sql = 'SELECT * FROM groups g INNER JOIN group_user gu ON g.group_id = 
    gu.group_id ORDER BY group_name';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':userId', $_SESSION['userid']);
    $stmt->execute();
    $allGroups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get array of group_names of $allGroups.
    $a = array_column($allGroups, 'group_name');
    
    // Get array of group_names of $myGroups.
    $b = array_column($myGroups, 'group_name');
    
    $c = array_column($pending, 'group_name');
    
    // Get array with values of $allGroups that are not in $myGroups or $pending.
    $otherGroups = array_diff($a, $b, $c);
    
    echo '<form method="post"><table>';
    foreach($otherGroups as $group) {
        // Get ID's by group names.
        $sql = 'SELECT group_id FROM groups WHERE group_name = :name';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $group, PDO::PARAM_STR);
        $stmt->execute();
        $id = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo '<tr><td>'.ucfirst(htmlentities($group)).
            " <button type='submit' name='join' value='"
            .$id[0]['group_id']."'>Join</button></td></tr>";
        
    }
    
    if(empty($otherGroups)) {
        echo '<tr><td>There are no other groups.</td></tr>'; 
    }
    
    echo '</table></form>';
    
    if(isset($_POST['join'])) {
        $sql = 'INSERT INTO group_user(group_id, user_id, status) VALUES 
        (:groupId, :userId, :status)';
        $stmt = $pdo->prepare($sql);
        foreach($_POST as $value) {
            $stmt->bindValue(':groupId', $value, PDO::PARAM_INT);
        }
        $stmt->bindValue(':userId', $_SESSION['userid'], PDO::PARAM_INT);
        // Status 0 is pending.
        $stmt->bindValue(':status', 0, PDO::PARAM_INT);
        $stmt->execute();
        header('Location: Groups.php');
    }
}

function getCurrentGroupName($pdo, &$groupName)
{
    $sql = 'SELECT group_name FROM groups WHERE group_id = :groupId';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':groupId', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $groupName = $stmt->fetchColumn();
}

function getMembers($pdo)
{
    $sql = 'SELECT u.first_name, u.last_name, u.user_id, g.status FROM user_personal u 
    INNER JOIN group_user g ON u.user_id = g.user_id WHERE g.group_id = 
    :groupId GROUP BY g.status DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':groupId', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo '<table>';
    foreach($users as $user) {
        echo '<tr><td><a href="Users.php?id='.$user['user_id'].'">
        '.ucfirst(htmlentities($user['first_name'])).' '.
            htmlentities($user['last_name']).'</a>';
        if($user['status'] == 2) {
            echo ' Admin</td></tr>';
        }
    }
    echo '</table>';
}

?>