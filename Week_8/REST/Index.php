<?php

require_once('DbConnect.php');

// Get the HTTP method.
$method = $_SERVER['REQUEST_METHOD'];

// Get request body.
$data = json_decode(file_get_contents('php://input'));

switch($method) {
    case 'GET':
        if($_GET['json'] != '') {
            $sql = 'SELECT * FROM gender WHERE gender_id = :id';
        } else {
            $sql = 'SELECT * FROM gender';
        }
        $stmt = $pdo->prepare($sql);
        if($_GET['json'] != '') {
            $stmt->bindValue(':id', $_GET['json'], PDO::PARAM_INT);
        }
        $stmt->execute();
        $details = $stmt->fetchAll(PDO::FETCH_OBJ);
        // Replace brackets with empty space.
        echo str_replace(['[', ']'], '', json_encode($details));
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