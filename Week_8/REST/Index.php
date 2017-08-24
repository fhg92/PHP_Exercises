<?php

require_once('DbConnect.php');

$method = $_SERVER['REQUEST_METHOD'];

$data = json_decode(file_get_contents('php://input'));

switch($method) {
    case 'GET':
        $sql = 'SELECT * FROM gender WHERE gender_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['json'], PDO::PARAM_INT);
        $stmt->execute();
        $details = $stmt->fetch(PDO::FETCH_OBJ);
        echo json_encode($details);
        break;
    case 'POST':
        $stmt = $pdo->prepare('INSERT INTO gender(label) VALUES (?)');
        $stmt->execute([$data->label]);
        break;
    case 'PUT':
        $sql = 'UPDATE gender SET label = :label WHERE gender_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':label', $data->label, PDO::PARAM_STR);
        $stmt->bindValue(':id', $_GET['json'], PDO::PARAM_INT);
        $stmt->execute();
        break;
    case 'DELETE':
        $sql = 'DELETE FROM gender WHERE gender_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['json'], PDO::PARAM_INT);
        $stmt->execute();
        break;
}

?>