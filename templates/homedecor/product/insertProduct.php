<?php
include('../../../src/model/dbconn.php');

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
$created = date('Y-m-d H:i:s');

// Search the last inserted id from the supplier
$search = "SELECT * FROM homedecor_product2 WHERE supplier = '$productSupplier' ORDER BY itemId DESC LIMIT 1";
$resultSearch = mysqli_query($conn, $search);
$lastItemId = mysqli_fetch_assoc($resultSearch);
$tambah1 = $lastItemId['itemId'] + 1;

if ($resultSearch) {
    // Insert into product table
    $insert = "INSERT INTO homedecor_product2 (itemId, supplier, itemCode, name, category, size, variation, costTHB, discTHB, costMYR, sellingMYR, img, created) VALUES ('$tambah1', '$productSupplier', '$productCategoryCode', '$productName', '$productCategory', '$productSize', '$productVariation', '$productCostTHB', '$productAfterDiscTHB', '$productCostMYR', '$productSellingMYR', '$productImg', '$created')";
    $resultInsert = mysqli_query($conn, $insert);

    if ($resultInsert) {
        echo "success <br> Data succesfully inserted.";
        $_SESSION['alert'] = 'success';
        $_SESSION['status'] = "Data succesfully inserted.";
        // header('Location: addProduct.php');
    } else {
        echo "danger <br>" . mysqli_error($conn);
        $_SESSION['alert'] = 'danger';
        $_SESSION['status'] =  mysqli_error($conn);
        // header('Location: addProduct.php');
    }
}
