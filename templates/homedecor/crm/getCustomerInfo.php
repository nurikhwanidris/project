<?php
$conn = new mysqli('localhost', 'root', '', 'project')
    or die('Cannot connect to db');
header('Content-Type: application/json');
$response = array(
    'id' => null,
);

if (array_key_exists('customer', $_POST)) {
    $customer = $_POST['customer'];

    // Now we fetch the product info from the database.
    // SELECT id FROM product_info WHERE product = $product
    // Imagine the result is stored in $result
    $select = "SELECT * FROM homedecor_customer where customerName = '$customer'";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_array($result);
    //$row = null;

    $response['customerName'] = $row['customerName'];
    $response['customerPhone'] = $row['customerPhone'];
    $response['customerEmail'] = $row['customerEmail'];
    $response['customerAddress'] = $row['address1'];
    $response['customerCity'] = $row['city'];
    $response['customerPostcode'] = $row['postcode'];
    $response['customerState'] = $row['state'];
}

echo json_encode($response);
