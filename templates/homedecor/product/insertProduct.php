<?php
include('../../../src/model/dbconn.php');


$errors = [];
$data = [];

if (empty($_POST['productName'])) {
    $errors['productName'] = 'Product name is required.';
} else {
    $productName = $_POST['productName'];
}

if (empty($_POST['productCategory'])) {
    $errors['productCategory'] = 'Category is required.';
} else {
    $productCategory = $_POST['productCategory'];
}

if (empty($_POST['productCategoryCode'])) {
    $errors['productCategoryCode'] = 'Category code is required.';
} else {
    $productCategoryCode = $_POST['productCategoryCode'];
}

$productSize = $_POST['productSize'];

if (empty($_POST['productSupplier'])) {
    $errors['productSupplier'] = 'Product supplier is required.';
} else {
    $productSupplier = $_POST['productSupplier'];
}

if (empty($_POST['productVariation'])) {
    $errors['productVariation'] = 'Product variation is required.';
} else {
    $productVariation = $_POST['productVariation'];
}

if (empty($_POST['productCostTHB'])) {
    $errors['productCostTHB'] = 'Cost in THB is required.';
} else {
    $productCostTHB = $_POST['productCostTHB'];
}

if (empty($_POST['productAfterDiscTHB'])) {
    $errors['productAfterDiscTHB'] = 'After discount in THB is required.';
} else {
    $productAfterDiscTHB = $_POST['productAfterDiscTHB'];
}

if (empty($_POST['productCostMYR'])) {
    $errors['productCostMYR'] = 'Cost in MYR is required.';
} else {
    $productCostMYR = $_POST['productCostMYR'];
}

if (empty($_POST['productSellingMYR'])) {
    $errors['productSellingMYR'] = 'Selling in MYR is required.';
} else {
    $productSellingMYR = $_POST['productSellingMYR'];
}

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {

    // Search the last inserted id from the supplier
    $search = "SELECT * FROM homedecor_product2 WHERE supplier = '$productSupplier' ORDER BY itemId DESC LIMIT 1";
    $resultSearch = mysqli_query($conn, $search);
    $lastItemId = mysqli_fetch_assoc($resultSearch);
    $tambah1 = $lastItemId['itemId'] + 1;

    if ($resultSearch) {
        // Insert into product table
        $insert = "INSERT INTO homedecor_product2 (itemId, supplier, itemCode, name, category, size, variation, costTHB, discTHB, costMYR, sellingMYR) VALUES ('$tambah1', '$productSupplier', '$productCategoryCode', '$productName', '$productCategory', '$productSize', '$productVariation', '$productCostTHB', '$productAfterDiscTHB', '$productCostMYR', '$productSellingMYR')";
        $resultInsert = mysqli_query($conn, $insert);

        if ($resultInsert) {
            // Message
            $data['success'] = true;
            $data['message'] = 'Product succesfully inserted!';
        }
    }
}
echo json_encode($data);
