<?php
include('../../../src/model/dbconn.php');

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$modified = date('Y-m-d H:i:s');

// Product Details
$id = $_POST['id'];

// Item details
$itemQuantity = $_POST['itemQuantity'];
$itemAvailable = $_POST['itemAvailable'];
$itemDefect = $_POST['itemDefect'];
$itemSold = $_POST['itemSold'];

// Update the item table 2nd
$updateItem = "UPDATE homedecor_item2 SET itemQuantity = '$itemQuantity', itemAvailable = '$itemAvailable', itemDefective = '$itemDefect', itemSold = '$itemSold', modified = '$modified' WHERE productId = '$id'";
$resultUpdateItem = mysqli_query($conn, $updateItem);

// // Error checking
// if ($resultUpdateProduct && $resultUpdateItem) {
//     echo "Berjaya simpan semua benda";
// } else {
//     echo mysqli_error($conn);
// }

if ($resultUpdateItem) {
    echo json_encode(array("success" => 1));
} else {
    echo json_encode(array("success" => 0));
}
