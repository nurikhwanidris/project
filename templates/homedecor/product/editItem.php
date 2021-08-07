<?php
include('../../../src/model/dbconn.php');

$erros = [];
$data = [];

if (empty($_POST['id'])) {
    $errors['id'] = 'Item id is required.';
} else {
    $id = $_POST['id'];
}
if (empty($_POST['name'])) {
    $errors['name'] = 'Item name is required.';
} else {
    $name = $_POST['name'];
}
if (empty($_POST['variation'])) {
    $errors['variation'] = 'Item id is required.';
} else {
    $variation = $_POST['variation'];
}
if (empty($_POST['size'])) {
    $errors['size'] = 'Item size is required.';
} else {
    $size = $_POST['size'];
}
if (empty($_POST['costTHB'])) {
    $errors['costTHB'] = 'Item costTHB is required.';
} else {
    $costTHB = $_POST['costTHB'];
}
if (empty($_POST['discTHB'])) {
    $errors['discTHB'] = 'Item discTHB is required.';
} else {
    $discTHB = $_POST['discTHB'];
}
if (empty($_POST['costMYR'])) {
    $errors['costMYR'] = 'Item costMYR is required.';
} else {
    $costMYR = $_POST['costMYR'];
}
if (empty($_POST['sellingMYR'])) {
    $errors['sellingMYR'] = 'Item sellingMYR is required.';
} else {
    $sellingMYR = $_POST['sellingMYR'];
}
if (empty($_POST['quantity'])) {
    $errors['quantity'] = 'Item quantity is required.';
} else {
    $quantity = $_POST['quantity'];
}
if (empty($_POST['available'])) {
    $errors['available'] = 'Item available is required.';
} else {
    $available = $_POST['available'];
}
if (empty($_POST['sold'])) {
    $errors['sold'] = 'Item sold is required.';
} else {
    $sold = $_POST['sold'];
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    // Insert into category table
    $updateItem = "UPDATE homedecor_item2 SET itemQuantity = '$quantity', itemAvailable = '$available', itemSold = '$sold' WHERE productId = '$id'";
    $resultCategory = mysqli_query($conn, $updateItem);

    if ($resultCategory) {
        // Message
        $data['success'] = true;
        $data['message'] = 'Item succesfully updated!';
    }
}
