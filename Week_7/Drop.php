<html>
    <form method='post'>
        <input type='submit' name='table' value='Drop Table'>
        <input type='submit' name='schema' value='Drop Schema'>
    </form>
</html>

<?php

require('DbConnect.php');

if(isset($_POST['table'])) {
    $pdo->exec('DROP TABLE product_details');
    echo '<span style="color:green;">Succesfully dropped table.</span>';
}

if(isset($_POST['schema'])) {
    $pdo->exec('DROP SCHEMA shop');
    echo '<span style="color:green;">Succesfully dropped schema.</span>';
}

?>