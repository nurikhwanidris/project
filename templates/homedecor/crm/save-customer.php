<?php

include('../../../src/model/dbconn.php');

// Customer details
$customerID = $_POST['customerID'];
$staffName = $_POST['staffName'];
$source = $_POST['source'];
$customerName = $_POST['customerName'];
$customerEmail = $_POST['customerEmail'];
$customerPhone = $_POST['customerPhone'];
$strippedSpace = str_replace(' ', '', $customerPhone);
$address1 = $_POST['address1'];
$city = $_POST['city'];
$postcode = $_POST['postcode'];
$state = $_POST['state'];
$status = 'Pending';
$discountAll = $_POST['discountAll'];

// Item details
$productId = implode(',', $_POST['productId']);
$quantity = implode(',', $_POST['quantity']);
$productPrice = implode(',', $_POST['productPrice']);
$discountItem = implode(',', $_POST['discountItem']);

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

// Insert into customer table
$customer = "INSERT INTO homedecor_customer (staffName, source, customerName, customerEmail, customerPhone, address1, city, postcode, state, created, modified) VALUES ('$staffName','$source','$customerName','$customerEmail','$strippedSpace','$address1','$city','$postcode','$state','$created','$modified')";
$resultInsert = mysqli_query($conn, $customer);

// Insert into purchase table
$purchase = "INSERT INTO homedecor_purchase_order (customer_id, product_id, quantity, price, discount_all, discount_items, status, created, modified) VALUES ('$customerID', '$productId', '$quantity', '$productPrice', '$discountAll', '$discountItem', '$status', '$created', '$modified')";
$resultPurchase = mysqli_query($conn, $purchase);

if ($resultInsert) {
    $msg = "Successfully inserted <br>";
    $alert = "success";
    //header('Location:/project/template/homedecor/purchase/list');
} else {
    $msg = "Error occured. " . mysqli_error($conn);
}
if ($resultPurchase) {
    $msg = "Successfully inserted <br>";
    $alert = "success";
    //header('Location:/project/template/homedecor/purchase/list');
} else {
    $msg = "Error occured. " . mysqli_error($conn);
}
echo $msg;
