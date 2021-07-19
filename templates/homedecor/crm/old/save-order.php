<?php

include('../../../src/model/dbconn.php');

// Customer Details
$customerID = $_POST['customerID'];
$staffName = $_POST['staffName'];
$source = $_POST['source'];
$customerName = $_POST['customerName'];
$customerPhone = $_POST['customerPhone'];
$customerEmail = $_POST['customerEmail'];
$strippedSpace = str_replace(' ', '', $customerPhone);
$address1 = $_POST['address1'];
$city = $_POST['city'];
$postcode = $_POST['postcode'];
$state = $_POST['state'];
$status = 'Pending';

// Item details
$productId = implode(',', $_POST['productId']);
$quantity = implode(',', $_POST['quantity']);
$productPrice = implode(',', $_POST['productPrice']);
$discountItem = implode(',', $_POST['discountItem']);
$discountAll = $_POST['discountAll'];

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

// Create customer
$createCustomer = "INSERT INTO homedecor_customer (staffName, source, customerName, customerEmail, customerPhone, address1, city, postcode, state, created, modified) VALUES ('$staffName','$source','$customerName','$customerEmail','$strippedSpace','$address1','$city','$postcode','$state','$created','$modified')";
$resultCustomer = mysqli_query($conn, $createCustomer);

// Create order
$createOrder = "INSERT INTO inventory_order (customerID, status, subTotal, tax, shipping, total, promo, discount, grandTotal, created, modified) VALUES ('$customerID', '$status',)";
$resultOrder = mysqli_query($conn, $createOrder);
