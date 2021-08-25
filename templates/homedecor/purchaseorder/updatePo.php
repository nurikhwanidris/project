<?php
include('../../../src/model/dbconn.php');

// $id = $_POST['id'];

// Purchase order details
$poId = $_POST['poId'];
$poRev = $_POST['poRev'];
$poSupplier = $_POST['poSupplier'];
$poBatch = $_POST['poBatch'];
$poCreated = $_POST['poCreated'];
$poExpectedDelivery = $_POST['poExpectedDelivery'];
$poExpectedArrival = $_POST['poExpectedArrival'];
$poStatus = "Updated";

// Date created
date_default_timezone_set("Asia/Kuala_Lumpur");
$modified = date('Y-m-d H:i:s');

// Product details
$productIds = $_POST['productId'];
$poCostTHBs = $_POST['poCostTHB'];
$poQuantities = $_POST['poQuantity'];
$poAmounts = $_POST['poAmount'];

echo "PO Revision = " . $poRev . "<br>";
echo "PO Supplier = " . $poSupplier . "<br>";
echo "PO Batch = " . $poBatch . "<br>";
echo "PO Created = " . $poCreated . "<br>";
echo "PO ExpectedDeliveryDate = " . $poExpectedDelivery . "<br>";
echo "PO ExpectedArrivalDate = " . $poExpectedArrival . "<br>";
echo "<hr>";

// Get total quantity ordered
$totalQuantity = array_sum($poQuantities);
echo "Total items ordered are = " . $totalQuantity . "<br>";

// Get total amount ordered
$totalAmount = array_sum($poAmounts);
echo "Total amount ordered are = " . $totalAmount . "<br>";

// Update the po table
$updatePo = "UPDATE homedecor_po SET poRev = '$poRev', supplier = '$poSupplier', batch = '$poBatch', expextedDeliveryDate = '$poExpectedDelivery', expectedArrivalDate = '$poExpectedDelivery', totalQuantity = '$totalQuantity', totalAmount = '$totalAmount', poStatus = '$poStatus' WHERE id = '$poId'";
$resultupdatePo = mysqli_query($conn, $updatePo);

if ($resultupdatePo) {
    echo "PO table has been updated. Thanks.<br>";
    echo "<hr>";
} else {
    echo mysqli_error($conn);
}

for ($i = 0; $i < count($productIds); $i++) {

    // Count the items
    $productId = $productIds[$i];
    $poCostTHB = $poCostTHBs[$i];
    $poQuantity = $poQuantities[$i];
    $poAmount = $poAmounts[$i];

    // Info items
    echo "Product ID = " . $productId . "<br>";
    echo "Product Cost THB = " . $poCostTHB . "<br>";
    echo "Product Quantity = " . $poQuantity . "<br>";
    echo "Product Amount = " . $poAmount . "<br>";

    // Select using poId and productId
    $checkExisting = "SELECT * FROM homedecor_po_items WHERE poId = '$poId' AND productId = '$productId'";
    $resultCheck = mysqli_query($conn, $checkExisting);

    if (mysqli_num_rows($resultCheck) > 0) {
        echo "Product already existed inside the table. Thank you. Next. <hr><br>";
        // $_SESSION['items'] = 'Product already existed inside the table. Check next item';
        // header("Location: orderView.php?id=" . $id);
    } else {
        $insertItems = "INSERT INTO homedecor_po_items (poId, productId, costTHB, quantity, amount, created) VALUES ('$poId', '$productId', '$poCostTHB', '$poQuantity', '$poAmount', '$modified')";
        $resultInsertItems = mysqli_query($conn, $insertItems);

        // Error check
        if ($resultInsertItems) {
            echo "Succesfully inserted into the homedecor_po_items. <br>";
            echo "<hr>";
        } else {
            echo mysqli_error($conn);
        }
    }
}
