<?php

include('../../../src/model/dbconn.php');

$customerID = $_POST['customerID'];
$productName = implode(',', $_POST['productName']);
$productQuantity = implode(',', $_POST['productQuantity']);
$productCost = implode(',', $_POST['productCost']);
$productPrice = implode(',', $_POST['productPrice']);

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

$insert = "INSERT INTO homedecor_order (customer_id, product_id, quantity, cost, price, created, modified) VALUES ('$customerID','$productName','$productQuantity','$productCost','$productPrice','$created','$modified')";

$result = mysqli_query($conn, $insert);

if ($result) {
    $msg = 'Successfully inserted';
    $alert = 'success';
} else {
    $msg = 'Error occured. ' . mysqli_error($conn);
    $alert = 'danger';
}

echo $msg;
