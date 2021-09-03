<?php require('../../../src/model/dbconn.php');
header('Content-Type: application/json');

$response = array(
    'id' => null,
);

if (array_key_exists('product', $_POST)) {
    $product = $_POST['product'];

    $selectProduct = "SELECT
    homedecor_product2.itemId AS productId,
    homedecor_product2.name AS productName,
    homedecor_product2.supplier AS productSupplier,
    homedecor_product2.itemCode AS productItemCode,
    homedecor_product2.category AS productCategory,
    homedecor_product2.size AS productSize,
    homedecor_product2.variation AS productVariation,
    homedecor_product2.sellingMYR AS productSellingMYR
    FROM homedecor_product2
    WHERE homedecor_product2.id = '$product'";

    $resultProduct = mysqli_query($conn, $selectProduct);
    $rowProduct = mysqli_fetch_assoc($resultProduct);

    $selectItem = "SELECT
    homedecor_item2.id AS itemId,
    homedecor_item2.productId AS itemProductId,
    homedecor_item2.itemAvailable AS itemAvailable,
    homedecor_item2.itemDefective AS itemDefect,
    homedecor_item2.itemSold As itemSold
    FROM homedecor_item2
    WHERE homedecor_item2.productId = '$product'";

    $resultItem = mysqli_query($conn, $selectItem);
    $rowItem = mysqli_fetch_assoc($resultItem);

    // relate the rows
    $response['productId'] = $rowProduct['productId'];
    $response['productName'] = $rowProduct['productName'];
    $response['productSupplier'] = $rowProduct['productSupplier'];
    $response['productItemCode'] = $rowProduct['productItemCode'];
    $response['productCategory'] = $rowProduct['productCategory'];
    $response['productSize'] = $rowProduct['productSize'];
    $response['productVariation'] = $rowProduct['productVariation'];
    $response['productSellingMYR'] = $rowProduct['productSellingMYR'];
    $response['itemId'] = $rowItem['itemId'];
    $response['itemProductId'] = $rowItem['itemProductId'];
    $response['itemAvailable'] = $rowItem['itemAvailable'];
    $response['itemDefect'] = $rowItem['itemDefect'];
    $response['itemSold'] = $rowItem['itemSold'];
}

echo json_encode($response);
