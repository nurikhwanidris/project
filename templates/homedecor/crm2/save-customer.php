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
$productId = implode(',', $_POST['productId2']);
$quantity = implode(',', $_POST['quantity2']);
$productPrice = implode(',', $_POST['productPrice2']);
$discountItem = implode(',', $_POST['discountItem2']);

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

// Update database
if (isset($_POST['update-order'])) {
    // Update customer details
    $updateCustomer = "UPDATE homedecor_customer SET customerName = '$customerName', customerEmail = '$customerEmail', customerPhone = '$strippedSpace', address1 = '$address1', city = '$city', postcode = '$postcode', state = '$state', modified = '$modified' WHERE id = '$customerID'";
    $resUpdateCustomer = mysqli_query($conn, $updateCustomer);

    // New code
    $updateProduct = "UPDATE homedecor_order SET product_id2 = '$productId', quantity2 = '$quantity', price2 = '$productPrice', discount_items2 = '$discountItem', modified = '$modified' WHERE id = '$id'";
    $resUpdateProduct = mysqli_query($conn, $updateProduct);

    if ($resUpdateCustomer && $resUpdateProduct) {
        for ($i = 0; $i < count($_POST['productId2']); $i++) {
            $prodId = $_POST['productId2'][$i];
            $quantityItem = $_POST['quantity2'][$i];

            // Update the quantity
            $updateOrderItems = "UPDATE homedecor_item2 SET itemAvailable = itemAvailable - '$quantityItem', itemSold = itemSold + '$quantityItem' WHERE productId = '$prodId'";
            $resultUpdateItems = mysqli_query($conn, $updateOrderItems);

            if ($resultUpdateItems) {
                echo "Succesfully inserted the order with item details <br>";
            } else {
                echo mysqli_error($conn) . '<br>';
            }
        }

        echo $msg = "Succesfully updated the customer details";
        $alert = "success";
        // header('Location:/project/templates/homedecor/order2/view?id=' . $id);
    }

    // Legacy code
    // // Update order details
    // $updateProduct = "UPDATE homedecor_order SET product_id = '$productId', quantity = '$quantity', price = '$productPrice', discount_all ='$discountAll',discount_items = '$discountItem', modified = '$modified' WHERE id = '$id'";
    // $resUpdateProduct = mysqli_query($conn, $updateProduct);


} else {

    // Insert into customer table
    $customer = "INSERT INTO homedecor_customer (staffName, source, customerName, customerEmail, customerPhone, address1, city, postcode, state, created, modified) VALUES ('$staffName','$source','$customerName','$customerEmail','$strippedSpace','$address1','$city','$postcode','$state','$created','$modified')";
    $resultInsert = mysqli_query($conn, $customer);

    // Insert into purchase table
    $purchase = "INSERT INTO homedecor_order (customer_id, product_id, quantity, price, discount_all, discount_items, status, created, modified) VALUES ('$customerID', '$productId', '$quantity', '$productPrice', '$discountAll', '$discountItem', '$status', '$created', '$modified')";
    $resultPurchase = mysqli_query($conn, $purchase);

    if ($resultInsert) {
        $msg = "Successfully inserted <br>";
        $alert = "success";
        // header('Location:/project/templates/homedecor/order2/list');
    } else {
        $msg = "Error occured. " . mysqli_error($conn);
    }
    if ($resultPurchase) {
        $msg = "Successfully inserted <br>";
        $alert = "success";
        // header('Location:/project/templates/homedecor/order2/list');
    } else {
        $msg = "Error occured. " . mysqli_error($conn);
    }
    echo $msg;
}
