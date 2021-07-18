<?php
include('../../../src/model/dbconn.php');

$errors = [];
$data = [];

$itemId = $_POST['itemProduct'];
$itemQuantity = $_POST['itemQuantity'];
$itemAvailable = $_POST['itemAvailable'];
$itemDefective = $_POST['itemDefective'];
$itemSold = $_POST['itemSold'];

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');

$insert = "INSERT INTO homedecor_item2 (itemId, itemQuantity, itemAvailable, itemDefective, itemSold, created) VALUES ('$itemId', '$itemQuantity', '$itemAvailable', '$itemDefective', '$itemSold', '$created')";
$result = mysqli_query($conn, $insert);

if ($result) {
    // Message
    $data['success'] = true;
    $data['message'] = 'Item quantity successfully inserted!';
} else {
    // Message
    $data['success'] = false;
    $data['message'] = 'Something went wrong. ' . mysqli_error($conn);
}

echo json_encode($data);
