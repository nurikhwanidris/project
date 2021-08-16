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

if (empty($_FILES['productImg']['name'])) {
    $productImg = 'Empty';
} else {
    $productImg = $_FILES['productImg']['name'];
}

if ((!empty($_FILES['productImgUpdate']['name']))) {
    // Get img value
    $productImgUpdate = $_FILES['productImgUpdate']['name'];

    // Image folder
    $productImgPath = '../../../upload/img/product/2021/';

    // Change image file name
    $temp = explode(".", $_FILES['productImgUpdate']['name']);
    $newfilename = $id . '.' . end($temp);

    // Move uploaded file
    move_uploaded_file($_FILES["productImgUpdate"]["tmp_name"], $productImgPath . $newfilename);

    // Date created and modified
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $modified = date('Y-m-d H:i:s');

    // Update the thing
    $update = "UPDATE homedecor_product2 SET itemId  = '$productId', name = '$productName', category = '$productCategory', itemCode = '$productCategoryCode', size = '$productSize', supplier = '$productSupplier', variation = '$productVariation', costTHB = '$productCostTHB', discTHB = '$productAfterDiscTHB', costMYR = '$productCostMYR', sellingMYR = '$productSellingMYR', img = '$newfilename',modified = '$modified' WHERE id = '$id'";
    $resultUpdateProduct = mysqli_query($conn, $update);
} else if ($_POST['productImgValue'] && empty($_FILES['productImgUpdate']['name'])) {
    // Get img value
    $productImgValue = $_POST['productImgValue'];

    // Date created and modified
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $modified = date('Y-m-d H:i:s');

    // Update the thing
    $update = "UPDATE homedecor_product2 SET itemId  = '$productId', name = '$productName', category = '$productCategory', itemCode = '$productCategoryCode', size = '$productSize', supplier = '$productSupplier', variation = '$productVariation', costTHB = '$productCostTHB', discTHB = '$productAfterDiscTHB', costMYR = '$productCostMYR', sellingMYR = '$productSellingMYR', img = '$productImgValue',modified = '$modified' WHERE id = '$id'";
    $resultUpdateProduct = mysqli_query($conn, $update);
} else {
    if (!empty($_FILES['productImg']['name'])) {
        $productImg = $_FILES['productImg']['name'];
    }
    // // Get img value
    // $productImg = $_FILES['productImg']['name'];

    // Image folder
    $productImgPath = '../../../upload/img/product/2021/';

    // Change image file name
    $temp = explode(".", $_FILES['productImg']['name']);
    $newfilename = $id . '.' . end($temp);

    // Move uploaded file
    move_uploaded_file($_FILES["productImg"]["tmp_name"], $productImgPath . $newfilename);

    // Date created and modified
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $modified = date('Y-m-d H:i:s');

    // Update the thing
    $update = "UPDATE homedecor_product2 SET itemId  = '$productId', name = '$productName', category = '$productCategory', itemCode = '$productCategoryCode', size = '$productSize', supplier = '$productSupplier', variation = '$productVariation', costTHB = '$productCostTHB', discTHB = '$productAfterDiscTHB', costMYR = '$productCostMYR', sellingMYR = '$productSellingMYR', img = '$newfilename',modified = '$modified' WHERE id = '$id'";
    $result = mysqli_query($conn, $update);
}

// if ($resultUpdateProduct) {
//     echo "Berjaya simpan semua benda";
// } else {
//     echo mysqli_error($conn);
// }

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
