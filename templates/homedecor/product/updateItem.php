<?php
include('../../../src/model/dbconn.php');

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$modified = date('Y-m-d H:i:s');

// Product Details
$id = $_POST['id'];
$productId = $_POST['productId'];
$productName = $_POST['productName'];
$productCategory = $_POST['productCategory'];
$productCategoryCode = $_POST['productCategoryCode'];
$productSize = $_POST['productSize'];
$productSupplier = $_POST['productSupplier'];
$productVariation = $_POST['productVariation'];
$productCostTHB = $_POST['productCostTHB'];
$productAfterDiscTHB = $_POST['productAfterDiscTHB'];
$productCostMYR = $_POST['productCostMYR'];
$productSellingMYR = $_POST['productSellingMYR'];
$productImg = $_FILES['productImg']['name'];

// Image folder
$productImgPath = '../../../upload/img/product/2021/';

// Temp Image name
$temp = explode(".", $_FILES["productImg"]["name"]);
$newfilename = $id . '-' . date("Ymd") . '.' . end($temp);

// Move uploaded file
move_uploaded_file($_FILES["productImg"]["tmp_name"], $productImgPath . $newfilename);

// Update the product 1st
$updateProduct = "UPDATE homedecor_product2 SET itemId  = '$productId', name = '$productName', category = '$productCategory', itemCode = '$productCategoryCode', size = '$productSize', supplier = '$productSupplier', variation = '$productVariation', costTHB = '$productCostTHB', discTHB = '$productAfterDiscTHB', costMYR = '$productCostMYR', sellingMYR = '$productSellingMYR', img = '$newfilename', modified = '$modified' WHERE id = '$id'";
$resultUpdateProduct = mysqli_query($conn, $updateProduct);

// // Error checking
// if ($resultUpdateProduct && $resultUpdateItem) {
//     echo "Berjaya simpan semua benda";
// } else {
//     echo mysqli_error($conn);
// }

if ($resultUpdateProduct) {
    $_SESSION['alert'] = 'success';
    $_SESSION['status'] = "Data succesfully updated.";
    header('Location: viewItem?id=' . $id);
} else {
    $_SESSION['alert'] = 'danger';
    $_SESSION['status'] =  mysqli_error($conn);
    header('Location: viewItem?id=' . $id);
}
