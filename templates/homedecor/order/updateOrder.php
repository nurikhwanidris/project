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
$orderItemIds = $_POST['orderItemId'];
$id = $_POST['id'];
$itemIds = $_POST['itemIds'];
$status = "New Order";
$productIds = $_POST['productId'];
$productItemIds = $_POST['productItemId'];
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
$modified = date('Y-m-d H:i:s');

// Update customer details 1st
$updateCustomer = "UPDATE homedecor_customer SET staffName = '$staffName', source = '$source', customerName = '$customerName', customerPhone = '$strippedSpace', address1 = '$address1', city = '$city', postcode = '$postcode', state = '$state', modified = '$modified' WHERE id  = '$customerID'";
$resultUpdateCustomer = mysqli_query($conn, $updateCustomer);

// Error check
if ($resultUpdateCustomer) {
    echo "Succesfully inserted the customer details  <br>";
} else {
    echo mysqli_error($conn) . '<br>';
}

// Update order details 2nd
$updateOrder = "UPDATE homedecor_order2 SET customerId = '$customerID', status = '$status', subTotal = '$subTotal', itemDiscount = '$itemDiscount', shipping = '$shipping', total = '$total', promo = '$promo', discount = '$discAfterPromo', grandTotal = '$grandTotal', modified = '$modified' WHERE id = '$id'";
$resultUpdateOrder = mysqli_query($conn, $updateOrder);

// Error check
if ($resultUpdateOrder) {
    echo "Succesfully inserted the order details <br>";
} else {
    echo mysqli_error($conn) . '<br>';
}

// Insert order items detail 3rd
for ($i = 0; $i < count($productIds); $i++) {
    // Count the items
    $orderItemId = $orderItemIds[$i];
    $productId = $productIds[$i];
    // $productItemId = $productItemIds[$i];
    $itemId = $itemIds[$i];
    $quantity = $quantities[$i];
    $productPrice = $productPrices[$i];
    $discountItem = $discountItems[$i];

    // Check if id already existed. If id existed, update the product. Else insert a new item with new id.
    if ($orderItemId) {
        // Update into order details
        $updateOrderDetails = "UPDATE homedecor_order_item SET productId = '$productId', itemId = '$itemId', productPrice = '$productPrice', productDiscount = '$discountItem', quantity = '$quantity', modified = '$modified' WHERE id = '$orderItemId'";
        $resultUpdateOrderDetails = mysqli_query($conn, $updateOrderDetails);

        if ($resultUpdateOrderDetails) {
            // Update the quantity
            $updateOrderItems = "UPDATE homedecor_item2 SET itemAvailable = itemAvailable - '$quantity', itemSold = itemSold + '$quantity' WHERE productId = '$productId'";
            $resultUpdateItems = mysqli_query($conn, $updateOrderItems);

            if ($resultUpdateItems) {
                echo "Succesfully updated the order with item details <br>";
            } else {
                echo mysqli_error($conn) . '<br>';
            }
        } else {
            echo mysqli_error($conn) . '<br>';
        }
    } else {
        // Insert into homedecor_order_item
        $insertOrderDetails = "INSERT INTO homedecor_order_item (orderId, productId, itemId, productPrice, productDiscount, quantity, created) VALUES ('$id', '$productId', '$itemId', '$productPrice', '$discountItem', '$quantity', '$modified')";
        $resultInsertOrderDetails = mysqli_query($conn, $insertOrderDetails);

        if ($resultInsertOrderDetails) {
            // Update the quantity
            $updateOrderItems = "UPDATE homedecor_item2 SET itemAvailable = itemAvailable - '$quantity', itemSold = itemSold + '$quantity' WHERE productId = '$productId'";
            $resultUpdateItems = mysqli_query($conn, $updateOrderItems);

            if ($resultUpdateItems) {
                echo "Succesfully inserted the order with item details <br>";
            } else {
                echo mysqli_error($conn) . '<br>';
            }
            $_SESSION['items'] = 'Successfully created the order and update item details';
            header("Location: orderList.php");
        } else {
            echo mysqli_error($conn) . '<br>';
        }
    }
}
