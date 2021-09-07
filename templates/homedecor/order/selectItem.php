<?php
require '../../../src/model/dbconn.php';

$id = $_POST['id'];

$output = '';

$orderItem = "SELECT 
homedecor_order2.customerId, 
homedecor_order_item.id AS orderItemId,
homedecor_order_item.productId, 
homedecor_order_item.itemId, 
homedecor_order_item.orderId, 
homedecor_order_item.quantity, 
homedecor_order_item.productPrice, 
homedecor_order_item.productDiscount, 
homedecor_product2.name,
homedecor_product2.itemId AS productItemId,
homedecor_product2.supplier,
homedecor_product2.itemCode
FROM homedecor_order_item 
INNER JOIN homedecor_order2 ON homedecor_order_item.orderId = '$id' 
JOIN homedecor_product2 
ON homedecor_order_item.productId = homedecor_product2.id 
JOIN homedecor_customer 
ON homedecor_order2.customerId = homedecor_customer.id 
GROUP BY homedecor_order_item.productId, homedecor_order_item.itemId 
HAVING COUNT(homedecor_order_item.itemId) = COUNT(homedecor_order_item.productId)";
$resultOrderItem = mysqli_query($conn, $orderItem);

$output .= '
<div class="table-responsive"> 
<table class="table table-sm table-stripped table-bordered" id="tblProducts">
    <thead>
        <tr>
            <th class="align-middle text-center">/</th>
            <th class="align-middle text-center">Code</th>
            <th class="align-middle" style="width: 60%;">Product Name</th>
            <th class="align-middle text-center">Quantity</th>
            <th class="align-middle text-right">Unit Price</th>
            <th class="align-middle text-right">Amount</th>
            <th class="align-middle text-center">Dlt</th>
        </tr>
    </thead>
';
$output .= '<tbody>';
while ($rowOrderItem = mysqli_fetch_array($resultOrderItem)) {
    $output .= '
    <tr>
        <td class="text-center align-middle">
            <input type="checkbox" name="record">
        </td>
        <td class="text-center align-middle">' . $rowOrderItem["supplier"] . ' - ' . str_pad($rowOrderItem["itemCode"], 4, 0, STR_PAD_LEFT) . ' - ' . $rowOrderItem["productItemId"] . '
        </td>
        <td class="text-left align-middle">
            ' . $rowOrderItem['name'] . '
            <input type="text" name="productId[]" value="' . $rowOrderItem["productId"] . '" class="d-none">
        </td>
        <td class="text-center align-middle">
            <input type="text" name="quantity[]" class="text-center p-0 border-0 form-control"
                value="' . $rowOrderItem["quantity"] . '">
        </td>
        <td class="text-right align-middle">
            <input type="text" name="productPrice[]" class="text-right p-0 m-0 border-0 form-control"
                value="' . number_format($rowOrderItem['productPrice'], 2, '.', '') . '">
        </td>
        <td class="text-right align-middle">
            <input type="text" name="discountItem[]" class="text-right p-0 m-0 border-0 form-control"
                value="' . number_format($rowOrderItem['productDiscount'], 2, '.', '') . '">
        </td>
        <td class="text-center align-middle">
            <button type="button" class="btn btn-sm btn-danger" id="removeItem" data-removeitem="' . $rowOrderItem['orderItemId'] . '"><i class="far fa-trash-alt"></i></button>
        </td>
    </tr>
    ';
}
$output .= '</tbody>
    </table>  
</div>';
echo $output;
