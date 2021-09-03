<?php require('../../../src/model/dbconn.php');
header('Content-Type: application/json');
$response = array(
    'id' => null,
);

if (array_key_exists('item', $_POST)) {
    $item = $_POST['item'];

    $select = "SELECT * FROM homedecor_product2 WHERE id = '$item'";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_array($result);

    $response['id'] = $row['id'];
    $response['itemId'] = $row['itemId'];
    $response['supplier'] = $row['supplier'];
    $response['itemCode'] = $row['itemCode'];
    $response['itemId'] = $row['itemId'];
    $response['name'] = $row['name'];
    $response['size'] = $row['size'];
    $response['variation'] = $row['variation'];
    $response['costTHB'] = $row['costTHB'];
    $response['costMYR'] = $row['costMYR'];
    $response['sellingMYR'] = $row['sellingMYR'];
}

echo json_encode($response);
