<?php

function search($pdo)
{
    if(isset($_POST['search'])) {
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
                    echo '<table><tr><td>'.ucfirst(htmlentities($user['username'])).'</td></tr></table>';
                }
            }
        } else {
            echo '<p>No user found matching your search.</p>';
        }
    }
}

?>