<?php
// DB Conn
include('../../../src/model/dbconn.php');

// Post data
$name = $_POST['name'];
$supplier = $_POST['supplier'];
$category = $_POST['category'];
$size = $_POST['size'];
$orderNo = $_POST['orderNo'];
$cost = $_POST['cost'];
$thb = $_POST['thb'];
$quantity = $_POST['quantity'];
$supplierCode = $_POST['supplierCode'];
$sellingPriceRM = $_POST['sellingPriceRM'];
$sellingPriceTHB = $_POST['sellingPriceTHB'];

// Upload image
$image = $_FILES['imgSave']['name'];
$trimmedImage = str_replace(' ', '-', $image);
$target = "../../../upload/img/products/" . basename($trimmedImage);

// Create SKU
$cutName = substr(str_replace(' ', '', strtoupper($name)), 0, 6);
$sku = $cutName . '-' . $size . '-' . $orderNo;

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

// Insert to database
$insert = "INSERT INTO homedecor_product (name, category, supplierCode, thb, sku, size, orderNo, cost, fixedPrice, fixedPriceTHB, quantity, img, created, modified) VALUE ('$name', '$category', '$supplierCode', '$thb', '$sku', '$size', '$orderNo', '$cost', '$sellingPriceRM', '$sellingPriceTHB', '$quantity','$trimmedImage', '$created', '$modified')";

if ($result = mysqli_query($conn, $insert)) {
    move_uploaded_file($_FILES['imgSave']['tmp_name'], $target);
    $msg = "Successfull inserted the product";
    $alert = "success";

    header('Location: /project/templates/homedecor/product/list');
} else {
    $msg = "Error occured." . mysqli_error($conn);
    $alert = "danger";
}
echo $msg;
