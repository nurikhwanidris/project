<?php
require '../../../src/model/dbconn.php';

$id = $_POST['id'];

$sql = "DELETE FROM homedecor_order_item WHERE id = '$id'";
if (mysqli_query($conn, $sql)) {
    // Message
    echo "Succesfully deleted the item";
} else {
    // Message
    echo mysqli_error($conn);
}
