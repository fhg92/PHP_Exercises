<?php

function getUserList($pdo, $curUser, $otherUsers)
{
    echo "<form method='post'>";
    foreach($otherUsers as $user) {
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
        
        echo '<tr><td>'.ucfirst(htmlentities($user['username']));
        
        if(!isset($rec[0])) {
            if(isset($sent[0])) {
                if($sent[0] == 0){
                    echo " <button type='submit' name='add' disabled value='"
                        .$user['user_id']."'>Request sent</button></td></tr>";
                }
                if($sent[0] == 1) {
                    echo '';
                }
            }
            if(!isset($sent[0])) {
                echo " <button type='submit' name='add' value='"
                    .$user['user_id']."'>Add</button></td></tr>";
            }
        }
            
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
    echo '</form>';
}
?>