<?php

include('../../../src/model/dbconn.php');

// Customer details
$id = $_POST['id'];
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

// Update database
if (isset($_POST['update-order'])) {
    // Update customer details
    $updateCustomer = "UPDATE homedecor_customer SET customerName = '$customerName', customerEmail = '$customerEmail', customerPhone = '$strippedSpace', address1 = '$address1', city = '$city', postcode = '$postcode', state = '$state', modified = '$modified' WHERE id = '$customerID'";
    $resUpdateCustomer = mysqli_query($conn, $updateCustomer);

    // Update order details
    $updateProduct = "UPDATE homedecor_order SET product_id = '$productId', quantity = '$quantity', price = '$productPrice', discount_all ='$discountAll',discount_items = '$discountItem', modified = '$modified' WHERE id = '$id'";
    $resUpdateProduct = mysqli_query($conn, $updateProduct);

    // Update the deducted items
    $product1 = $_POST['productId'];
    $quantityProduct1 = $_POST['quantity'];
    for ($i = 0; $i < count($product1); $i++) {
        $product2 = $product1[$i];
        $quantityProduct2 = $quantityProduct1[$i];
        $deduct = "UPDATE homedecor_product SET purchased = (purchased + '$quantityProduct2') WHERE id = '$product2'";
        $resultDeduct = mysqli_query($conn, $deduct);
        if ($resultDeduct) {
            echo "WEEEE WOOOO BERJAYA";
        } else {
            echo "WEEE WOOO YOU'RE FUCKED";
        }
    }

    if ($resUpdateCustomer && $resUpdateProduct) {
        $msg = "Succesfully updated the customer details";
        $alert = "success";
        header('Location:/project/templates/homedecor/order/list');
    }
} else {

    // Insert into customer table
    $customer = "INSERT INTO homedecor_customer (staffName, source, customerName, customerEmail, customerPhone, address1, city, postcode, state, created, modified) VALUES ('$staffName','$source','$customerName','$customerEmail','$strippedSpace','$address1','$city','$postcode','$state','$created','$modified')";
    $resultInsert = mysqli_query($conn, $customer);

    // Insert into purchase table
    $purchase = "INSERT INTO homedecor_order (customer_id, product_id, quantity, price, discount_all, discount_items, status, created, modified) VALUES ('$customerID', '$productId', '$quantity', '$productPrice', '$discountAll', '$discountItem', '$status', '$created', '$modified')";
    $resultPurchase = mysqli_query($conn, $purchase);

    // Update the deducted items
    $product1 = $_POST['productId'];
    $quantityProduct1 = $_POST['quantity'];
    for ($i = 0; $i < count($product1); $i++) {
        $product2 = $product1[$i];
        $quantityProduct2 = $quantityProduct1[$i];
        $deduct = "UPDATE homedecor_product SET purchased = (purchased + '$quantityProduct2') WHERE id = '$product2'";
        $resultDeduct = mysqli_query($conn, $deduct);
        if ($resultDeduct) {
            echo "WEEEE WOOOO BERJAYA";
        } else {
            echo "WEEE WOOO YOU'RE FUCKED";
        }
    }

    if ($resultInsert && $resultPurchase && $resultDeduct) {
        $msg = "Successfully inserted <br>";
        $alert = "success";
        //header('Location:/project/templates/homedecor/order/list');
    } else {
        $msg = "Error occured. " . mysqli_error($conn);
    }
    echo $msg;
}
