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
$shipping = $_POST['shipping'];
// $discountAll = $_POST['discountAll'];

// Order details
$id = $_POST['id'];
$status = "New Order";
$productIds = $_POST['productId'];
// $productItemIds = $_POST['productItemId'];
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

// Check for existing product ids
// If product id already existed, skip and go next
for ($i = 0; $i < count($productIds); $i++) {

    // Count the items
    $productId = $productIds[$i];
    $quantity = $quantities[$i];
    $productPrice = $productPrices[$i];
    $discountItem = $discountItems[$i];

    // Select using orderId and productId homedecor_order_items
    $checkExisting = "SELECT * FROM homedecor_order_item WHERE orderId = '$id' AND productId = '$productId'";
    $resultCheck = mysqli_query($conn, $checkExisting);

    if (mysqli_num_rows($resultCheck) > 0) {
        echo "Product already existed inside the table. Check next item. <hr><br>";
        $_SESSION['items'] = 'Product already existed inside the table. Check next item';
        header("Location: orderView.php?id=" . $id);
    } else {
        // Insert into homedecor_order_item
        $insertOrderDetails = "INSERT INTO homedecor_order_item (orderId, productId, productPrice, productDiscount, quantity, created) VALUES ('$id', '$productId', '$productPrice', '$discountItem', '$quantity', '$modified')";
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
            header("Location: orderView.php?id=" . $id);
        } else {
            echo mysqli_error($conn) . '<br>';
        }
    }
}
