<?php

include('../../../src/model/dbconn.php');

$productId = $_POST['productId'];
$quantity = $_POST['quantity'];
$productPrice = $_POST['productPrice'];
$discountItem = $_POST['discountItem'];

if ($_POST['shipping'] != '') {
    $shipping = $_POST['shipping'];
}

// The status of the order can be New, Checkout, Paid, Failed, Shipped, Delivered, Returned, and Complete.
$status = "New";


// Check if there's any discount for each items
if ($productPrice != $discountItem) {
    $itemDiscount = array_sum($discountItem);
}

// Create order first
$createOrder = "INSERT INTO inventory_order () VALUES ()";
$resultCreateOrder = mysqli_query($conn, $createOrder);
