<?php
require '../../../src/model/dbconn.php';

// Date time
date_default_timezone_set("Asia/Kuala_Lumpur");
$modified = date('Y-m-d H:i:s');

// order_item id
$id = $_POST['id'];

// Read data from the homedecor_order_item
$select = "SELECT productId, quantity FROM homedecor_order_item WHERE id = '$id'";
$result = mysqli_query($conn, $select);
$rowSelect = mysqli_fetch_assoc($result);
$productId = $rowSelect['productId'];
$quantity = $rowSelect['quantity'];

// Insert back into homedecor_item2
$insert = "UPDATE homedecor_item2 SET itemAvailable = itemAvailable + '$quantity', itemSold  = itemSold - '$quantity', modified = '$modified' WHERE productId = '$productId'";
if (mysqli_query($conn, $insert)) {
    // Message
    echo "Item quantity has been updated. <br>";
} else {
    // Message
    echo "Something went wrong. <br>" . mysqli_error($conn);
}

// Delete from order_item
$sql = "DELETE FROM homedecor_order_item WHERE id = '$id'";
if (mysqli_query($conn, $sql)) {
    // Message
    echo "Succesfully deleted the item";
} else {
    // Message
    echo mysqli_error($conn);
}
