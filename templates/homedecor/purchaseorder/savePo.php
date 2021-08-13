<!-- DB Conn -->
<?php
include('../../../src/model/dbconn.php');

// Purchase order details
$poNumber = $_POST['poNumber'];
$poSupplier = $_POST['poSupplier'];
$poBatch = $_POST['poBatch'];
$poCreated = $_POST['poCreated'];
$poExpectedDelivery = $_POST['poExpectedDelivery'];
$poExpectedArrival = $_POST['poExpectedArrival'];

// Product details
$productIds = $_POST['productId'];
$poCostTHBs = $_POST['poCostTHB'];
$poQuantities = $_POST['poQuantity'];
$poAmounts = $_POST['poAmount'];

echo "PO Number = " . $poNumber . "<br>";
echo "PO Supplier = " . $poSupplier . "<br>";
echo "PO Batch = " . $poBatch . "<br>";
echo "PO Created = " . $poCreated . "<br>";
echo "PO ExpectedDeliveryDate = " . $poExpectedDelivery . "<br>";
echo "PO ExpectedArrivalDate = " . $poExpectedArrival . "<br>";
echo "<hr>";

for ($i = 0; $i < count($productIds); $i++) {
    $productId = $productIds[$i];
    $poCostTHB = $poCostTHBs[$i];
    $poQuantity = $poQuantities[$i];
    $poAmount = $poAmounts[$i];
    echo "Product ID = " . $productId . "<br>";
    echo "Product Cost THB = " . $poCostTHB . "<br>";
    echo "Product Quantity = " . $poQuantity . "<br>";
    echo "Product Amount = " . $poAmount . "<br>";
    echo "<hr>";
}

// Get total quantity ordered
$totalQuantity = array_sum($poQuantities);
echo "Total items ordered are = " . $totalQuantity . "<br>";

// Get total amount ordered
$totalAmount = array_sum($poAmounts);
echo "Total amount ordered are = " . $totalAmount . "<br>";

// Create table utk benda alah ni
// 2 tables
// 1. homedecor_po
// 2. homedecor_po_item