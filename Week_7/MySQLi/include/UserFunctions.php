<?php

function getUserDetails($mysqli, &$details, &$gender)
{
    $sql = 'SELECT * FROM user_personal u INNER JOIN gender g ON u.gender_id = g.gender_id WHERE user_id = ?';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $_SESSION['userid']);
    $stmt->execute();
    $details = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
function deleteProfile($mysqli)
{
    if(isset($_POST['delete'])) {
        $sql = 'DELETE u, up FROM user u INNER JOIN user_personal
        up ON u.user_id = up.user_id WHERE u.user_id = ?';
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $_SESSION['userid']);
        $stmt->execute();
        session_destroy();
        header('Location: Login.php');
        $stmt->close();
    }
}

?>