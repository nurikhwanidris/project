<!-- DB Conn -->
<?php
include('../../../src/model/dbconn.php');

// Purchase order details
$poRev = $_POST['poRev'];
$poSupplier = $_POST['poSupplier'];
$poBatch = $_POST['poBatch'];
$poCreated = $_POST['poCreated'];
$poExpectedDelivery = $_POST['poExpectedDelivery'];
$poExpectedArrival = $_POST['poExpectedArrival'];
$poStatus = "New Order";

// Date created
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');

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
echo "<hr>";

// Get total amount ordered
$totalAmount = array_sum($poAmounts);
echo "Total amount ordered are = " . $totalAmount . "<br>";
echo "<hr>";

// Get total amount ordered
$discount = $totalAmount * .22;
$totalDiscount = $totalAmount - $discount;
echo "Total amount ordered are = " . $totalDiscount . "<br>";
echo "<hr>";

// Insert into PO table
$insertPO = "INSERT INTO homedecor_po (poRev, supplier, batch, expectedDeliveryDate, expectedArrivalDate, totalQuantity, totalAmount, totalDiscount, poStatus, created) VALUES ('$poRev', '$poSupplier', '$poBatch', '$poExpectedDelivery', '$poExpectedArrival', '$totalQuantity', '$totalAmount', '$totalDiscount', '$poStatus', '$created')";
$resultInsertPO = mysqli_query($conn, $insertPO);
$insertId = mysqli_insert_id($conn);

// // Error check
// if ($resultInsertPO) {
//     echo "Succesfully inserted into the homedecor_po. <br>";
// } else {
//     echo mysqli_error($conn);
// }

// Recursive insert for each PO items
for ($i = 0; $i < count($productIds); $i++) {
    $productId = $productIds[$i];
    $poCostTHB = $poCostTHBs[$i];
    $poQuantity = $poQuantities[$i];
    $poAmount = $poAmounts[$i];
    echo "Product ID = " . $productId . "<br>";
    echo "Product Cost THB = " . $poCostTHB . "<br>";
    echo "Product Quantity = " . $poQuantity . "<br>";
    echo "Product Amount = " . $poAmount . "<br>";

    $insertItems = "INSERT INTO homedecor_po_items (poId, productId, costTHB, quantity, amount, created) VALUES ('$insertId', '$productId', '$poCostTHB', '$poQuantity', '$poAmount', '$created')";
    $resultInsertItems = mysqli_query($conn, $insertItems);

    // Error check
    if ($resultInsertItems) {
        echo "Succesfully inserted into the homedecor_po_items. <br>";
        echo "<hr>";
    } else {
        echo mysqli_error($conn);
    }
}

if ($resultInsertPO) {
    $_SESSION['alert'] = 'success';
    $_SESSION['status'] = "Data succesfully updated.";
    header('Location: listPo');
} else {
    $_SESSION['alert'] = 'danger';
    $_SESSION['status'] =  mysqli_error($conn);
    header('Location: listPo');
}
