<?php
include('../../../src/model/dbconn.php');

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
$productImgPath = '../../../upload/img/product/2021/' . $productImg;

// Temp Image name
$tmp_name = $_FILES['productImg']['tmp_name'];

// Move uploaded file
move_uploaded_file($tmp_name, $productImgPath);

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$modified = date('Y-m-d H:i:s');

// Update the thing
$update = "UPDATE homedecor_product2 SET itemId  = '$productId', name = '$productName', category = '$productCategory', itemCode = '$productCategoryCode', size = '$productSize', supplier = '$productSupplier', variation = '$productVariation', costTHB = '$productCostTHB', discTHB = '$productAfterDiscTHB', costMYR = '$productCostMYR', sellingMYR = '$productSellingMYR', img = '$productImg',modified = '$modified' WHERE id = '$id'";
$result = mysqli_query($conn, $update);

// if ($result) {
//     echo "Berjaya simpan semua benda";
// } else {
//     echo mysqli_error($conn);
// }

if ($result) {
    $_SESSION['alert'] = 'success';
    $_SESSION['status'] = "Data succesfully inserted.";
    header('Location: viewProduct?id=' . $id);
} else {
    $_SESSION['alert'] = 'danger';
    $_SESSION['status'] =  mysqli_error($conn);
    header('Location: viewProduct?id=' . $id);
}

// // Search the last inserted id from the supplier
// $search = "SELECT * FROM homedecor_product2 WHERE supplier = '$productSupplier' ORDER BY itemId DESC LIMIT 1";
// $resultSearch = mysqli_query($conn, $search);
// $lastItemId = mysqli_fetch_assoc($resultSearch);
// $tambah1 = $lastItemId['itemId'] + 1;

// if ($resultSearch) {
//     // Insert into product table
//     $insert = "INSERT INTO homedecor_product2 (itemId, supplier, itemCode, name, category, size, variation, costTHB, discTHB, costMYR, sellingMYR, img, created) VALUES ('$tambah1', '$productSupplier', '$productCategoryCode', '$productName', '$productCategory', '$productSize', '$productVariation', '$productCostTHB', '$productAfterDiscTHB', '$productCostMYR', '$productSellingMYR', '$productImg', '$created')";
//     $resultInsert = mysqli_query($conn, $insert);

//     if ($resultInsert) {
//         $_SESSION['alert'] = 'success';
//         $_SESSION['status'] = "Data succesfully inserted.";
//         header('Location: viewProduct.php?id=' . $productId);
//     } else {
//         $_SESSION['alert'] = '-danger';
//         $_SESSION['status'] =  mysqli_error($conn);
//         header('Location: viewProduct.php?id=' . $productId);
//     }
// }
