<?php
include('../../../src/model/dbconn.php');

$errors = [];
$data = [];

$editId = $_POST['editId'];
$editProductSet = $_POST['editProductSet'];
$editProductQty = $_POST['editProductQty'];
$editProductRemarks = $_POST['editProductRemarks'];

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$modified = date('Y-m-d H:i:s');

// Update into db
$Update = "UPDATE homedecor_display_product SET productQty = '$editProductQty', productRemarks = '$editProductRemarks', productSet = '$editProductSet' WHERE id = '$editId'";
$result = mysqli_query($conn, $Update);

if ($result) {
    // Message
    $data['success'] = true;
    $data['message'] = 'Display product has been updated!';
} else {
    // Message
    $data['success'] = false;
    $data['message'] = 'Something went wrong. ' . mysqli_error($conn);
}

echo json_encode($data);
