<?php

class Groups implements JsonSerializable {
    public function __construct(array $allGroups) {
        $this->data = $allGroups;
    }

    public function jsonSerialize() {
        return $this->data;
    }
}

function json($pdo)
{
    require('include/DbConnect.php');
    $sql = 'SELECT * FROM groups ORDER BY group_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $allGroups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $options = JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT;
    echo json_encode(new Groups($allGroups), $options);
    exit;
}

function formValidation($pdo, &$message)
{
    $sql = "SELECT group_name FROM groups WHERE group_name = :name";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $_POST['group'], PDO::PARAM_STR);
    $stmt->execute();
    $group = $stmt->fetchColumn();
    
    switch($_POST['group']) {
        case null:
            $message[] = 'Please fill in a group name.<br>'.PHP_EOL;
            return false;
            break;
        case strlen($_POST['group']) < 5:
            $message[] = 'Group name has to be at least 5 characters.<br>'
                .PHP_EOL;
            return false;
            break;
        case strlen($_POST['group']) > 60:
            $message[] = 'Group name has to be less than 60 characters.<br>'
                .PHP_EOL;
            return false;
            break;
        case strcasecmp($group, $_POST['group']) == 0:
            $message[] = 'Group name is already taken.<br>'
                .PHP_EOL;
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
            $stmt = $pdo->prepare('INSERT INTO groups(group_name) VALUES 
            (:name)');
            $stmt->execute([':name' => $_POST['group']]);
            $stmt = $pdo->prepare('INSERT INTO group_user(group_id, user_id, 
            status) 
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

function deleteGroup($pdo)
{
    if(isset($_POST['delete']) or isset($_POST['leave'])) {
        foreach($_POST as $value) {
            if($_POST['delete']) {
                $sql = 'DELETE g, gu FROM groups g INNER JOIN group_user gu
                ON g.group_id = gu.group_id WHERE g.group_id = :groupId';
            }
            if($_POST['leave']) {
                $sql = 'DELETE FROM group_user WHERE group_id = :groupId AND 
                user_id = :userId';
            }
            $stmt = $pdo->prepare($sql);
            // Only bind value if the leave button is pressed.
            if($_POST['leave']) {
               $stmt->bindValue(':userId', $_SESSION['userid'], PDO::PARAM_INT); 
            }
            $stmt->bindValue(':groupId', $value, PDO::PARAM_INT);
            $stmt->execute();
            
            // Delete group if there are no users in it.
            if($_POST['leave']) {
                $sql = 'DELETE FROM groups WHERE group_id NOT IN (SELECT 
                group_id FROM group_user)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
            }
            
            header('Location: Groups.php');
        }
    }
}

function getMyGroups($pdo, &$myGroups)
{
    $sql = 'SELECT * FROM groups g INNER JOIN group_user gu ON g.group_id = 
    gu.group_id WHERE gu.user_id = :userId AND gu.status != :status ORDER BY 
    gu.status DESC';
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
    
    deleteGroup($pdo);
}

function pending($pdo, &$pending)
{
    $sql = 'SELECT * FROM groups g INNER JOIN group_user gu ON g.group_id = 
    gu.group_id WHERE gu.user_id = :userId AND gu.status = :status ORDER BY 
    group_name';
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

function deleteIfOnlyPending($pdo)
{
    $sql = 'SELECT group_id FROM group_user WHERE status != :status';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':status', 0, PDO::PARAM_INT);
    $stmt->execute();
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $sql = 'SELECT group_id FROM group_user WHERE status = :status';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':status', 0, PDO::PARAM_INT);
    $stmt->execute();
    $pending = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $a = array_column($pending, 'group_id');
    $b = array_column($members, 'group_id');
    $c = array_unique(array_diff($a, $b));
    
    foreach($c as $id) {
        $sql = 'DELETE gu, g FROM group_user gu INNER JOIN groups g ON 
        gu.group_id = g.group_id WHERE gu.group_id = :groupId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':groupId', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

function getOtherGroups($pdo, $myGroups, $pending)
{
    $sql = 'SELECT * FROM groups ORDER BY group_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $allGroups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get array of group_names of $allGroups.
    $a = array_column($allGroups, 'group_name');
    
    // Get array of group_names of $myGroups.
    $b = array_column($myGroups, 'group_name');
    
    // Get array with sent group requests ($pending).
    $c = array_column($pending, 'group_name');
    
    // Get array with values of $allGroups that are not in $myGroups or $pending.
    $otherGroups = array_unique(array_diff($a, $b, $c));
    
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

function getCurrentGroup($pdo, &$admin)
{
    // Get group name.
    $sql = 'SELECT group_name FROM groups WHERE group_id = :groupId';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':groupId', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $name = $stmt->fetchColumn();
    
    // Get all rows from admin.
    $sql = 'SELECT * FROM group_user gu INNER JOIN groups g ON gu.group_id =
    g.group_id WHERE gu.group_id = :groupId AND gu.status = :status';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':groupId', $_GET['id'], PDO::PARAM_INT);
    $stmt->bindValue(':status', 2, PDO::PARAM_INT);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo '<form method="POST"><p><b>'.
        ucfirst(htmlentities($name)).'</b>';
    
    // If admin exists and the admin's ID is equal to the current user ID.
    if($admin && $admin['user_id'] == $_SESSION['userid']) {
        echo " <button type='submit' name='delete' value='"
            .$_GET['id']."'>Delete Group</button></td></tr>";
    }
    // If admin exists and the admin's ID is not the current user ID.
    elseif($admin && $admin['user_id'] != $_SESSION['userid']) {
        echo " <button type='submit' name='leave' value='"
            .$_GET['id']."'>Leave Group</button></td></tr>";
    }
    
    // If there is no admin.
    elseif(!$admin) {
        echo " <button type='submit' name='admin' value='"
            .$_GET['id']."'>Make Me Admin</button></td></tr>";
        newAdmin($pdo);
    }
    echo '</p></form>';
    
    deleteGroup($pdo);
}

function newAdmin($pdo)
{
    if(isset($_POST['admin'])) {
        $sql = 'UPDATE group_user SET status = :status WHERE group_id = 
        :groupId AND user_id = :userId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':status', 2, PDO::PARAM_INT);
        $stmt->bindValue(':groupId', $_GET['id'], PDO::PARAM_INT);
        $stmt->bindValue(':userId', $_SESSION['userid'], PDO::PARAM_INT);
        $stmt->execute();
        header('Location: Groups.php?id='.$_GET['id'].'');
    }
}

function getMembers($pdo, &$users, $admin)
{
    $sql = 'SELECT u.first_name, u.last_name, u.user_id, g.status FROM 
    user_personal u INNER JOIN group_user g ON u.user_id = g.user_id WHERE
    g.group_id = :groupId ORDER BY status DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':groupId', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo '<form method="POST"><table>';
    foreach($users as $user) {
        // Show users that are status 1 or 2. Only show status 0 for admin.
        if($user['status'] == 1 or $user['status'] == 2 or
           $admin['user_id'] == $_SESSION['userid'] && $user['status'] == 0) {
        echo '<tr><td><a href="Users.php?id='.$user['user_id'].'">
        '.ucfirst(htmlentities($user['first_name'])).' '.
            htmlentities($user['last_name']).'</a>';
        }
        if($user['status'] == 2) {
            echo ' Admin</td></tr>';
        }
        if($admin['user_id'] == $_SESSION['userid']) {
            if($user['status'] == 0) {
                echo " <button type='submit' name='accept' value='"
                    .$user['user_id']."'>Accept</button> <button type='submit'
                    name='decline' value='".$user['user_id']."'>Decline
                    </button></td></tr>";
            }
            elseif($admin && $user['status'] == 1) {
                echo " <button type='submit' name='delete' value='"
                    .$user['user_id']."'>Delete User</button></td></tr>";
            } else {
                echo '</td></tr>';
            }
        } else {
            echo '</td></tr>';
        }
    }
    echo '</table></form>';
    
    if(isset($_POST['accept']) or isset($_POST['decline']) or 
       isset($_POST['delete'])) {
    if($_POST['accept']) {
        $sql = 'UPDATE group_user SET status = :status WHERE group_id = 
        :groupId AND user_id = :userId';
    }
    if($_POST['decline'] or $_POST['delete']) {
        $sql = 'DELETE FROM group_user WHERE group_id = :groupId AND 
        user_id = :userId';
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':groupId', $_GET['id'], PDO::PARAM_INT);
    
    if($_POST['accept']) {
        $stmt->bindValue(':status', 1, PDO::PARAM_INT);
    }
    
    foreach($_POST as $value) {
        $stmt->bindValue(':userId', $value, PDO::PARAM_INT);   
    }
    $stmt->execute();
    header('Location: Groups.php?id='.$_GET['id'].'');
    }
}

function checkIfMember($users)
{
    // Get id's from all members and put them in an array.
    $id = array_column($users, 'user_id');
    
    // Make array with user ID's as keys and statuses as values. 
    $status = array_column($users, 'status', 'user_id');
    
    // If the status of the current user is 0 or not in the array with id's 
    // from all members, redirect.
    if($status[$_SESSION['userid']] == 0 or !in_array($_SESSION['userid'], 
                                                      $id)) {
        header('Location: Groups.php');
    }
}

?>