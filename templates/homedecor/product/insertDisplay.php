<?php
include('../../../src/model/dbconn.php');

$errors = [];
$data = [];

$uniqueId = $_POST['uniqueId'];
$productId = $_POST['productId'];
$productName = $_POST['productName'];
$productQty = $_POST['productQty'];
$productSet = $_POST['productSet'];
$productRemarks = $_POST['productRemarks'];

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');

// Insert into db
$insert = "INSERT INTO homedecor_display_product (productId, uniqueId, productName, productQty, productRemarks, productSet, created) VALUES ('$productId', '$uniqueId', '$productName', '$productQty', '$productRemarks', '$productSet', '$created')";
$result = mysqli_query($conn, $insert);

if ($result) {
    // Message
    $data['success'] = true;
    $data['message'] = 'Item quantity succesfully inserted!';
} else {
    // Message
    $data['success'] = false;
    $data['message'] = 'Something went wrong. ' . mysqli_error($conn);
}

echo json_encode($data);
