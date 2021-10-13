<!-- Get DB conn -->
<?php require('../../../src/model/dbconn.php') ?>

<!-- Title -->
<?php $title = "Invoice" ?>

<!-- Header -->
<?php require('../../elements/admin/dashboard/header.php') ?>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/nav.php') ?>

<?php
// Get data from invoice table
$id = $_GET['id'];
$select = "SELECT * FROM homedecor_order2 WHERE id = '$id'";
$result = mysqli_query($conn, $select);
$rowOrder = mysqli_fetch_array($result);

// Get customer info
$customer = "SELECT * FROM homedecor_customer where id = '" . $rowOrder['customerId'] . "'";
$resultCustomer = mysqli_query($conn, $customer);
$rowCustomer = mysqli_fetch_array($resultCustomer);

// Get receipt info if exist
$selectReceipt = "SELECT * FROM homedecor_receipt WHERE customerID = '" . $rowOrder['customer_id'] . "'";
$resultReceipt = mysqli_query($conn, $selectReceipt);

// Get order details
$order = "SELECT * FROM homedecor_order2 WHERE id = '$id'";
$resultOrder = mysqli_query($conn, $order);
$rowOrder = mysqli_fetch_assoc($resultOrder);

// Get invoice details
$invoice = "SELECT * FROM homedecor_invoice2 WHERE orderId = '$id'";
$resultInvoice = mysqli_query($conn, $invoice);
$rowInvoice = mysqli_fetch_assoc($resultInvoice);

// Get ordered items
$items = "SELECT
homedecor_order2.id,
homedecor_order2.hasPreOrder,
homedecor_order_item.id AS idOrder,
homedecor_order_item.orderId,
homedecor_order_item.productId,
homedecor_order_item.itemId,
homedecor_order_item.productPrice,
homedecor_order_item.productDiscount,
homedecor_order_item.discount,
homedecor_order_item.quantity,
homedecor_order_item.preOrder,
homedecor_item2.itemAvailable,
homedecor_product2.id,
homedecor_product2.name,
homedecor_product2.supplier,
homedecor_product2.itemId,
homedecor_product2.itemCode
FROM homedecor_order_item
JOIN homedecor_product2
ON homedecor_order_item.productId = homedecor_product2.id
JOIN homedecor_item2
ON homedecor_order_item.productId = homedecor_item2.productId
JOIN homedecor_order2
ON homedecor_order2.id = '$id'
HAVING homedecor_order2.id = homedecor_order_item.orderId";
$resultItems = mysqli_query($conn, $items);

// Get receipt
$receipt = "SELECT * FROM homedecor_receipt2 WHERE orderId = '$id'";
$resultReceipt = mysqli_query($conn, $receipt);
?>
<!-- Body -->
<div class="container-fluid">
    <form action="saveInvoice.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="orderId" id="" class="form-control d-none" value="<?= $id; ?>">
        <input type="text" name="invoiceID" id="" class="form-control d-none" value="<?= $id; ?>">
        <?php if (isset($_GET['msg']) == 'success') : ?>
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Succesfully update the invoice.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row mt-4">
            <div class="col-lg-9 col-xl-9">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12">
                                <div class="col-4 float-left text-left">
                                    <h4 class="font-weight-bold">Arzu Home & Living</h4>
                                    <p>
                                        243B, Jalan Bandar 13 <br>
                                        Taman Melawati <br>
                                        53100, Kuala Lumpur<br>
                                        Office : <b>03-4162 8179</b> <br>
                                        Mobile : <b>011-1675 8179</b>
                                    </p>
                                </div>
                                <div class="col-4 float-right text-right">
                                    <h4 class="font-weight-bold">Invoice</h4>
                                    <img src="/project/upload/img/invoice-logo-1.png" alt="" srcset="" style="height: auto; width: 70%;">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 col-xl-12">
                                <div class="col-4 float-left text-left">
                                    <p>Invoice to:</p>
                                    <p>
                                        <input type="text" name="customerID" id="" class="form-control d-none" value="<?= $rowCustomer['id']; ?>">
                                        <span class="font-weight-bold"><?= $rowCustomer['customerName']; ?></span> <br>
                                        <?= $rowCustomer['address1']; ?> <br>
                                        <?= $rowCustomer['city'] . ", " . $rowCustomer['postcode'] . ", " . $rowCustomer['state'] ?>
                                    </p>
                                    <p>
                                        Contact : <span class="font-weight-bold"><?= $rowCustomer['customerPhone']; ?></span>
                                    </p>
                                </div>
                                <div class="col-3 float-right text-right">
                                    <p>
                                        Invoice # : <span class="font-weight-bold"><?= date("Ym") . str_pad($id, 4, 0, STR_PAD_LEFT); ?></span><br>
                                        <span class="text-left">Invoice Date</span>: <?php
                                                                                        if ($rowInvoice['invoiceDate'] != '') : echo '<span class="font-weight-bold text-right">' . date("d/m/Y", strtotime($rowInvoice['invoiceDate'])) . '</span> <input name="invoiceDate" type="" value="' . $rowInvoice['invoiceDate'] . '" class="d-none">';
                                                                                        else : echo '<input type="date" class="border-0 input-sm text-right" name="invoiceDate">';
                                                                                        endif;
                                                                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 col-xl-12">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="align-middle">Description</th>
                                            <th class="align-middle text-left">Product ID</th>
                                            <th class="align-middle text-right">Price/Unit</th>
                                            <th class="align-middle text-right">Quantity</th>
                                            <th class="align-middle text-right">Discount</th>
                                            <th class="align-middle text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($rowOrderItem = mysqli_fetch_assoc($resultItems)) : ?>
                                            <?php $shipping = $rowOrderItem['shipping']; ?>
                                            <tr>
                                                <!-- Item description -->
                                                <td class="align-middle">
                                                    <?= $rowOrderItem['idOrder']; ?>
                                                    <?php if ($rowOrderItem['hasPreOrder'] == true && $rowOrderItem['preOrder'] == true) : ?>
                                                        <?= $rowOrderItem['name']; ?> [Pre-order]
                                                    <?php elseif ($rowOrderItem['itemAvailable'] <= 0 && $rowOrderItem['hasPreOrder'] == false) : ?>
                                                        <?= $rowOrderItem['name']; ?> [Pre-order]
                                                    <?php else : ?>
                                                        <?= $rowOrderItem['name']; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <!-- Product ID -->
                                                <td class="align-middle text-left">
                                                    <?= $rowOrderItem['supplier'] . '-' . str_pad($rowOrderItem['itemCode'], 4, 0, STR_PAD_LEFT) . '-' . $rowOrderItem['itemId']; ?>
                                                </td>
                                                <!-- Selling Price -->
                                                <td class="align-middle text-right">
                                                    <?php $sellingPrice = $rowOrderItem['productPrice'] ?>
                                                    RM <?= number_format($rowOrderItem['productPrice'], 2, '.', ''); ?>
                                                </td>
                                                <!-- Product Quantity -->
                                                <td class="align-middle text-right">
                                                    <?= $rowOrderItem['quantity']; ?>
                                                </td>
                                                <!-- Discount -->
                                                <td class="align-middle text-right">
                                                    <?= $rowOrderItem['discount']; ?>%
                                                </td>
                                                <!-- Amount -->
                                                <td class="align-middle text-right">
                                                    RM <?= number_format($rowOrderItem['productDiscount'], 2, '.', ''); ?>
                                                </td>
                                            </tr>
                                        <?php endwhile ?>
                                        <tr class="">
                                            <td colspan="5" class="align-middle font-weight-light text-right ">Subtotal</td>
                                            <td class="align-middle text-right ">
                                                RM <?= number_format($rowOrder['itemDiscount'], 2, '.', ','); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="align-middle text-right font-weight-light">
                                                Shipping
                                            </td>
                                            <td class="align-middle text-right">
                                                RM <?= number_format($rowOrder['shipping'], 2, '.', ''); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="align-middle text-right font-weight-light">
                                                Total
                                            </td>
                                            <td class="align-middle text-right">
                                                RM <?= number_format($rowOrder['total'], 2, '.', ''); ?>
                                            </td>
                                        </tr>
                                        <!-- Voucher -->
                                        <?php if ($rowOrder['voucher'] != 0) : ?>
                                            <tr class="">
                                                <td colspan="5" class="align-middle font-weight-light text-right ">Voucher</td>
                                                <td class="align-middle text-right ">
                                                    - RM <?= number_format($rowOrder['voucher'], 2, '.', ','); ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="5" class="align-middle text-right ">
                                                <h3 class="align-middle font-weight-bold">Grand Total</h3>
                                            </td>
                                            <td class="align-middle text-right ">
                                                <h3 class="align-middle font-weight-bold">
                                                    RM <?= number_format($rowOrder['grandTotal'], 2, '.', ','); ?>
                                                </h3>
                                                <input type="text" name="grandTotal" id="" class="d-none" value="<?= number_format($rowOrder['grandTotal'], 2, '.', ''); ?>">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <hr>
                         -->
                        <!-- <div class="row mt-4 d-none">
                            <div class="col-lg-12 col-xl-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>
                                            Pay to : <br>
                                            <span class="font-weight-bold">Azuwarridah Abdullah</span> <br>
                                            <span class="font-weight-bold">Maybank - 5148 1555 1083</span>
                                        </p>
                                        <span>Terms and Conditions</span>
                                        <ul>
                                            <li>
                                                Price will be rounded up to the nearest point.
                                            </li>
                                            <li>
                                                Pleaserequire the payment slips after the payment was made.
                                            </li>
                                            <li>
                                                Balance payment must be made within 2 days after the invoice billed to you.
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 text-right">
                                        <small class="">This is a computer generated document. No signature is required.</small>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row mt-4 d-print-none">
                            <div class="col-lg-12 col-xl-12">
                                <div class="col-lg-4 float-right text-right">
                                    <a href="print?id=<?= $rowOrder['id']; ?>" target="_blank" class="btn btn-info float-right"><i class="fas fa-print"></i> Print</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xl-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="">Invoice Status</label>
                                <select name="invoiceStatus" id="" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Full">Full</option>
                                    <option value="Remaining">Remaining</option>
                                    <option value="Deposit">Deposit</option>
                                    <option value="Refund">Refund</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-lg-12">
                                <label for="">Amount Paid</label>
                                <input type="text" name="amountPaid" id="" class="form-control" placeholder="Insert amount paid if exist">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-lg-12">
                                <label for="">Payment Type</label>
                                <select name="paymentType" id="" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Online Banking">Online Banking</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Checks">Checks</option>
                                    <option value="Credit Cards">Credit Cards</option>
                                    <option value="Debit Cards">Debit Cards</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-3 ">
                            <div class="col-lg-12">
                                <label for="">Upload Payment Receipt</label>
                                <input type="file" name="paymentReceipt" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <button type="submit" name="saveInvoice" class="btn btn-primary float-right"><i class="fas fa-save"></i> Save</button>
                                <button type="submit" name="createReceipt" class="btn btn-info float-left d-none"><i class="fas fa-receipt"></i> Receipt</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-primary font-weight-bold">
                        Receipts
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="row mt-4">
                                    <div class="table">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle text-left">Receipt Num</th>
                                                    <th class="align-middle text-center">Date</th>
                                                    <th class="align-middle text-right">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($rowReceipt = mysqli_fetch_assoc($resultReceipt)) : ?>
                                                    <tr>
                                                        <td class="align-middle text-left">
                                                            <a href="receipt.php?id=<?= $rowReceipt['id']; ?>"><?= str_pad($rowReceipt['id'], 4, '0', STR_PAD_LEFT); ?></a>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <?= $rowReceipt['invoiceDate']; ?>
                                                        </td>
                                                        <td class="align-middle text-right">
                                                            RM <?= number_format($rowReceipt['amountPaid'], 2, '.', ''); ?>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Footer -->
<?php require('../../elements/admin/dashboard/footer.php') ?>