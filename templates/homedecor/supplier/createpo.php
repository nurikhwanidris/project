<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<?php
// Get everything from the post
$supplier = $_POST['supplier'];
$productId = implode(',', $_POST['productId']);
$productCost = implode(',', $_POST['productCost']);
$quantity = implode(',', $_POST['quantity']);
$productPrice = implode(',', $_POST['productPrice']);
$staffName = $row['fName'];
$img = implode(',', $_POST['img']);


// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

// Insert into the table
$insert = "INSERT INTO homedecor_supplier_order (supplierID, productID, productCost, productQty, productPrice, staffName, created, modified) VALUES ('$supplier', '$productId', '$productCost', '$quantity', '$productPrice', '$staffName', '$created', '$modified')";

$resInsert = mysqli_query($conn, $insert);

if ($resInsert) {
    $msg = "Successfully created a new purchase order.";
    $alert = "success";
} else {
    $msg = "Error " . mysqli_error($conn);
}
echo $msg;


?>

<!-- Footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>