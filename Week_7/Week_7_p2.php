<?php

require('DbConnect.php');

?>

<html>
    <p><b>Add new product:</b></p>
    <form method='post'><table>
        <tr><td>Product name: <input type='text' name='name'></td></tr>
        <tr><td>Price: <input type='number' name='price' placeholder='0'
                      min='0' value='0' step='0.01'>
        <input type="submit" name='submit' value="Submit"></td></tr>
    </table></form>
    <p><?php if(isset($message)) { echo $message; } ?></p>
</html>

<?php

if(isset($_POST['submit']) && !empty($_POST['name'])) {
    $sql = 'INSERT INTO product_details(product_name, price)
            VALUES (:name, :price)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $stmt->bindParam(':price', $_POST['price'], PDO::PARAM_STR);
    $stmt->execute();
    $message = 'Product succesfully added';
}

$stmt = $pdo->prepare('SELECT product_name, price FROM product_details ORDER BY
product_id');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<table border="1">';
foreach($products as $product) {
    echo '<tr><td>'.$product['product_name'].'</td><td> $ '.$product['price'].'</td></tr>';
}
echo '</table><br>';

// SUM.
$stmt = $pdo->prepare('SELECT SUM(price) AS total FROM product_details');
$stmt->execute();
$total = $stmt->fetchColumn();

if(!empty($products)) {
    echo 'The total price of all products together is: $'.$total;
}

?>