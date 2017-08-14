<html>
    <p>Don't forget to change DB details in this file.</p>
    <form method='post'>
        <input type='submit' name='create' value='Create DB & Table'>
    </form>
</html>

<?php

require('Config.php');

if(isset($_POST['create'])) {
    try {
        $pdo = new PDO('mysql:host=localhost', $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('CREATE DATABASE IF NOT EXISTS shop');
        $pdo->exec('USE shop');
        $sql = 'CREATE TABLE IF NOT EXISTS product_details(product_id int(11)
        AUTO_INCREMENT PRIMARY KEY, product_name varchar(30), price 
        DECIMAL(10,2) NOT NULL)';
        $pdo->exec($sql);
        print '<span style="color:green;">Succesfully created DB & table.
        </span>';
    } catch (PDOException $e) {
        print '<span style="color:red;">Failed to connect: ' . $e->getMessage()
            .'</span>';
        die();
    }
}

?>