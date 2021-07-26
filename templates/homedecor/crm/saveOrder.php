<?php
include('../../../src/model/dbconn.php');

// Customer details
$customerID = $_POST['customerID'];
$staffName  = $_POST['staffName'];
$source = $_POST['source'];
$customerName = $_POST['customerName'];
$customerPhone = $_POST['customerPhone'];
$customerEmail = $_POST['customerEmail'];
$customerBirthday = $_POST['customerBirthday'];
$strippedSpace = str_replace(' ', '', $customerPhone);
$address1 = $_POST['address1'];
$city = $_POST['city'];
$postcode = $_POST['postcode'];
$state = $_POST['state'];
$status = 'New Order';
$shipping = $_POST['shipping'];
// $discountAll = $_POST['discountAll'];

// Order details
$itemIds = $_POST['itemIds'];
$status = "New Order";
$productIds = $_POST['productId'];
$quantities = $_POST['quantity'];
$productPrices = $_POST['productPrice'];
$discountItems = $_POST['discountItem'];
$promo = 0;
$subTotal = array_sum($_POST['productPrice']);
$itemDiscount = array_sum($_POST['discountItem']);

// Total include shipping
$total = array_sum($discountItems) + $shipping;

// Total discount after promo
if ($promo != 0) {
    // Calculate total discount
    $discAfterPromo = $total - $promo;

    // Calculate grandtotal
    $grandTotal = $discAfterPromo;
} else {
    // Calculate total discount
    $discAfterPromo = $total;

    // Calculate grandtotal
    $grandTotal = $discAfterPromo;
}


// Date time
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');

// Insert customer details 1st
$insertCustomer = "INSERT INTO homedecor_customer (staffName, source, customerName, customerEmail, customerBirthday, customerPhone, address1, city, postcode, state, created) VALUES ('$staffName', '$source', '$customerName', '$customerEmail', '$customerBirthday', '$strippedSpace', '$address1', '$city', '$postcode', '$state', '$created')";
$resultInsertCustomer = mysqli_query($conn, $insertCustomer);
$lastInsertCustomer = mysqli_insert_id($conn);

// Error check
if ($resultInsertCustomer) {
    echo "Succesfully inserted the customer details  <br>";
} else {
    echo mysqli_error($conn) . '<br>';
}

// Insert order details 2nd
$insertOrder = "INSERT INTO homedecor_order2 (customerId, status, subTotal,  itemDiscount, shipping, total, promo, discount, grandTotal, created) VALUES ('$lastInsertCustomer', '$status', '$subTotal', '$itemDiscount', '$shipping', '$total', '$promo', '$discAfterPromo','$grandTotal', '$created')";
$resultInsertOrder = mysqli_query($conn, $insertOrder);
$lastInsertId = mysqli_insert_id($conn);

// Error check
if ($resultInsertOrder) {
    echo "Succesfully inserted the order details <br>";
} else {
    echo mysqli_error($conn) . '<br>';
}

// Insert order items detail 3rd
for ($i = 0; $i < count($productIds); $i++) {
    // Count the items
    $productId = $productIds[$i];
    $itemId = $itemIds[$i];
    $quantity = $quantities[$i];
    $productPrice = $productPrices[$i];
    $discountItem = $discountItems[$i];

    // Insert into order details
    $insertOrderItems = "INSERT INTO homedecor_order_item (orderId, productId, itemId, productPrice, productDiscount, quantity, created) VALUES ('$lastInsertId', '$productId', '$itemId', '$productPrice', '$discountItem', '$quantity', '$created')";
    $resultOrderItems = mysqli_query($conn, $insertOrderItems);

    // Update the quantity
    $updateOrderItems = "UPDATE homedecor_item2 SET itemAvailable = itemAvailable - '$quantity', itemSold = itemSold + '$quantity' WHERE productId = '$productId'";
    $resultUpdateItems = mysqli_query($conn, $updateOrderItems);

    if ($resultOrderItems && $resultUpdateItems) {
        echo "Succesfully insert and update the order with item details <br>";
    } else {
        echo mysqli_error($conn) . '<br>';
    }
}
