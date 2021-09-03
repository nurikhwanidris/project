<?php require('../../../src/model/dbconn.php');
header('Content-Type: application/json');

$response = array(
    'id' => null,
);

if (array_key_exists('product', $_POST)) {
    $product = $_POST['product'];

    $selectProduct = "SELECT
    homedecor_product2.id,
    homedecor_product2.itemId,
    homedecor_product2.name,
    homedecor_product2.supplier,
    homedecor_product2.itemCode,
    homedecor_product2.category,
    homedecor_product2.size,
    homedecor_product2.variation,
    homedecor_product2.costTHB,
    homedecor_product2.img
    FROM homedecor_product2
    WHERE homedecor_product2.id = '$product'";

    $resultProduct = mysqli_query($conn, $selectProduct);
    $rowProduct = mysqli_fetch_assoc($resultProduct);

    // Relate the rows
    $response['productId'] = $rowProduct['id'];
    $response['productItemId'] = $rowProduct['itemId'];
    $response['productName'] = $rowProduct['name'];
    $response['productSupplier'] = $rowProduct['supplier'];
    $response['productItemCode'] = $rowProduct['itemCode'];
    $response['productCategory'] = $rowProduct['category'];
    $response['productSize'] = $rowProduct['size'];
    $response['productVariation'] = $rowProduct['variation'];
    $response['productCostTHB'] = $rowProduct['costTHB'];
    if (empty($rowProduct['img'])) {
        $response['productImg'] = 0;
    } else {
        $response['productImg'] = $rowProduct['img'];
    }
}

echo json_encode($response);
