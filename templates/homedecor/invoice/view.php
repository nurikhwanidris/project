<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Title -->
<?php $title = "Invoice" ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

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

// Get ordered items
$items = "SELECT
homedecor_order2.id,
homedecor_order_item.orderId,
homedecor_order_item.productId,
homedecor_order_item.itemId,
homedecor_order_item.productPrice,
homedecor_order_item.productDiscount,
homedecor_order_item.quantity,
homedecor_product2.id,
homedecor_product2.name,
homedecor_product2.supplier,
homedecor_product2.itemId,
homedecor_product2.itemCode
FROM homedecor_order_item
JOIN homedecor_product2
ON homedecor_order_item.productId = homedecor_product2.id
JOIN homedecor_order2
ON homedecor_order2.id = '$id'
HAVING homedecor_order2.id = homedecor_order_item.orderId";
$resultItems = mysqli_query($conn, $items);
// $rowItems = mysqli_fetch_assoc($resultItems);
?>
<!-- Body -->
<div class="container-fluid">
    <form action="save-invoice.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="poID" id="" class="form-control d-none" value="<?= $id; ?>">
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
                                        Invoice # : <span class="font-weight-bold"><?= date("Ym") . str_pad($id, 4, 0, STR_PAD_LEFT); ?></span>
                                        <input type="text" name="invoiceNum" id="" class="form-control d-none" value="<?= date("Ym") . str_pad($id, 4, 0, STR_PAD_LEFT); ?>"><br>
                                        <span class="text-left">Invoice Date</span>: <?php
                                                                                        if ($rowInvoicee['invoice_date'] != '') : echo '<span class="font-weight-bold">' . date("d/m/Y", strtotime($rowInvoicee['invoice_date'])) . '</span> <input name="invoiceDate" type="" value="' . $rowInvoicee['invoice_date'] . '" class="d-none">';
                                                                                        else : echo '<input type="date" class="border-0 input-sm" name="invoiceDate">';
                                                                                        endif;
                                                                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 col-xl-12">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="align-middle">Description</th>
                                            <th class="align-middle text-center">Product ID</th>
                                            <th class="align-middle text-center">Quantity</th>
                                            <th class="align-middle text-center">Price/Unit</th>
                                            <th class="align-middle text-center">Discount</th>
                                            <th class="align-middle text-center">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($rowOrderItem = mysqli_fetch_assoc($resultItems)) : ?>
                                            <?php $shipping = $rowOrderItem['shipping']; ?>
                                            <tr>
                                                <!-- Item description -->
                                                <td class="align-middle" style="border: 1px solid black;">
                                                    <?= $rowOrderItem['name']; ?>
                                                </td>
                                                <!-- Product ID -->
                                                <td class="align-middle text-center" style="border: 1px solid black;">
                                                    <?= $rowOrderItem['supplier'] . '-' . str_pad($rowOrderItem['itemCode'], 4, 0, STR_PAD_LEFT) . '-' . $rowOrderItem['itemId']; ?>
                                                </td>
                                                <!-- Product Quantity -->
                                                <td class="align-middle text-center" style="border: 1px solid black;">
                                                    <?= $rowOrderItem['quantity']; ?>
                                                </td>
                                                <!-- Selling Price -->
                                                <td class="align-middle text-center" style="border: 1px solid black;">
                                                    RM <?= number_format($rowOrderItem['productPrice'], 2, '.', ''); ?>
                                                </td>
                                                <!-- Discount -->
                                                <td class="align-middle text-center" style="border: 1px solid black;">
                                                    <?= (($rowOrderItem['productPrice'] - $rowOrderItem['productDiscount']) * 100) / 100; ?>%
                                                </td>
                                                <!-- Amount -->
                                                <td class="align-middle text-center" style="border: 1px solid black;">
                                                    RM <?= number_format($rowOrderItem['productDiscount'], 2, '.', ''); ?>
                                                </td>
                                            </tr>
                                            <?= $subTotal = array($rowOrderItmes['productDiscount']); ?>
                                        <?php endwhile ?>
                                        <tr>
                                            <td colspan="5" class="align-middle text-right font-weight-light" style="border: 1px solid black;">
                                                Shipping
                                            </td>
                                            <td class="align-middle text-center" style="border: 1px solid black;">
                                                RM <?= number_format($rowOrder['shipping'], 2, '.', ''); ?>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td colspan="5" class="align-middle font-weight-light text-right " style="border: 1px solid black;">Subtotal</td>
                                            <td class="align-middle text-center " style="border: 1px solid black;">
                                                <?= array_sum($subTotal); ?>
                                            </td>
                                        </tr>
                                        <!-- Promo -->
                                        <?php if ($rowOrderItem['promo'] != 0) : ?>
                                            <tr class="">
                                                <td colspan="5" class="align-middle font-weight-light text-right " style="border: 1px solid black;">Promo</td>
                                                <td class="align-middle text-center " style="border: 1px solid black;">
                                                    Deduct promo too
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="5" class="align-middle text-right " style="border: 1px solid black;">
                                                <h3 class="align-middle font-weight-bold">Total</h3>
                                            </td>
                                            <td class="align-middle text-center " style="border: 1px solid black;">
                                                <h3 class="align-middle font-weight-bold">
                                                    asd
                                                </h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-4">
                            <div class="col-lg-4 col-xl-4">
                                <h6 class="font-weight-light text-secondary">Receipts</h6>
                                <div class="table">
                                    <table class="table table-bordered table-sm" style="border: 1px solid black;">
                                        <thead style="border: 1px solid black;">
                                            <tr style="border: 1px solid black;">
                                                <th style="border: 1px solid black;" class="align-middle text-center">Receipt Num</th>
                                                <th style="border: 1px solid black;" class="align-middle text-center">Date</th>
                                                <th style="border: 1px solid black;" class="align-middle text-center">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody style="border: 1px solid black;">
                                            <tr style="border: 1px solid black;">
                                                <td class="align-middle text-center" style="border: 1px solid black;">
                                                    Payment receipt link goes here
                                                </td>
                                                <td class="align-middle text-center" style="border: 1px solid black;">
                                                    Payment receipt date
                                                </td>
                                                <td class="align-middle text-center" style="border: 1px solid black;">
                                                    Payment receipt amount paid
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
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
                                                Please include the payment slips after the payment was made.
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
                        </div>
                        <div class="row mt-4 d-print-none">
                            <div class="col-lg-12 col-xl-12">
                                <div class="col-lg-4 float-right text-right">
                                    <a class="btn btn-info" onclick="window.print();"><i class="fas fa-print"></i> Print</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xl-3 d-print-none">
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
                <div class="card mt-3 d-none">
                    <div class="card-body">
                        <h6 class="">Receipt Info</h6>
                        <div class="table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">Receipt</th>
                                        <th class="align-middle text-center">Paid</th>
                                        <th class="align-middle text-center">Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($rowReceipt = mysqli_fetch_array($resultReceipt)) : ?>
                                        <tr>
                                            <td class="align-middle text-center">
                                                <a href="receipt.php?id=<?= $rowReceipt['id']; ?>" target="_blank"><?= str_pad($rowReceipt['id'], 4, 0, STR_PAD_LEFT); ?></a>
                                            </td>
                                            <td class="align-middle text-center">
                                                RM<?= $rowReceipt['amountPaid']; ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?php $s = $rowReceipt['created'];
                                                $dt = new DateTime($s);
                                                echo $date = $dt->format('d/m/Y'); ?>
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
    </form>
</div>

<!-- Footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>