<?php
$conn = new mysqli('localhost', 'root', '', 'project')
    or die('Cannot connect to db');
header('Content-Type: application/json');
$response = array(
    'id' => null,
);

if (array_key_exists('product', $_POST)) {
    $product = $_POST['product'];

    // Now we fetch the product info from the database.
    // SELECT id FROM product_info WHERE product = $product
    // Imagine the result is stored in $result
    $select = "SELECT * FROM homedecor_product where id = '$product'";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_array($result);
    //$row = null;

    $response['orderNo'] = $row['orderNo'];
    $response['name'] = $row['name'];
    $response['cost'] = $row['cost'];
    $response['thb'] = $row['thb'];
}

echo json_encode($response);
