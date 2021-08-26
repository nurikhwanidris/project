<?php
include('../../../src/model/dbconn.php');

$data = [];

$sql = "DELETE FROM homedecor_display_product WHERE id = '" . $_POST["id"] . "'";
if (mysqli_query($conn, $sql)) {

    // Message
    $data['success'] = true;
    $data['message'] = "A display item was succesfully deleted";
}

echo json_encode($data);
