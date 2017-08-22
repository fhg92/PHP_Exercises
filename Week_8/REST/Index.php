<!-- Not done yet. -->

<?php

require_once('DbConnect.php');

$method = $_SERVER['REQUEST_METHOD'];

$data = json_decode(file_get_contents('php://input'));

switch($method) {
    case 'GET':
        $sql = 'SELECT * FROM user u INNER JOIN user_personal up ON u.user_id 
        = up.user_id WHERE u.user_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['json'], PDO::PARAM_INT);
        $stmt->execute();
        $details = $stmt->fetch(PDO::FETCH_OBJ);
        echo json_encode($details);
        break;
    case 'POST':
        $stmt = $pdo->prepare('INSERT INTO user(email, password) 
        VALUES (?, ?)');
        $stmt->execute([$data->email, $data->password]);
            
        $sql = 'INSERT INTO user_personal(first_name, last_name, city, 
        date_of_birth, gender_id) VALUES (?, ?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$data->first_name, $data->last_name, $data->city,
                      $data->date_of_birth, $data->gender]);
        break;
    case 'PUT':
        $sql = 'UPDATE user_personal SET first_name = :first, last_name = :last
        , city = :city, date_of_birth = :dob, gender_id = :gender WHERE 
        user_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['json'], PDO::PARAM_INT);
        $stmt->bindValue(':first', $data->first_name, PDO::PARAM_STR);
        $stmt->bindValue(':last', $data->last_name, PDO::PARAM_STR);
        $stmt->bindValue(':city', $data->city, PDO::PARAM_STR);
        $stmt->bindValue(':dob', $data->date_of_birth, PDO::PARAM_STR);
        $stmt->bindValue(':gender', $data->gender_id, PDO::PARAM_INT);
        $stmt->execute();
        break;
    case 'DELETE':
        $sql = 'DELETE FROM user WHERE user_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['json'], PDO::PARAM_INT);
        $stmt->execute();
        break;
}

?>