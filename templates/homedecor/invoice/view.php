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
$select = "SELECT * FROM homedecor_order WHERE id = '$id'";
$result = mysqli_query($conn, $select);
$rowOrder = mysqli_fetch_array($result);

// Explode everything boom!
$products = explode(',', $rowOrder['product_id']);
$quantities = explode(',', $rowOrder['quantity']);
$prices = explode(',', $rowOrder['price']);
$discountItems = explode(',', $rowOrder['discount_items']);
$discountAll = explode(',', $rowOrder['discount_all']);
?>

<!-- Get customer info -->
<?php
$customer = "SELECT * FROM homedecor_customer where id = '" . $rowOrder['customer_id'] . "'";
$resultCustomer = mysqli_query($conn, $customer);
$rowCustomer = mysqli_fetch_array($resultCustomer);
?>

<!-- Get receipt info if exist -->
<?php
$selectReceipt = "SELECT * FROM homedecor_receipt WHERE customerID = '" . $rowOrder['customer_id'] . "'";
$resultReceipt = mysqli_query($conn, $selectReceipt);
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
                                        Invoice Date : <span class="font-weight-bold"><?= date("d/m/Y"); ?><input type="text" name="invoiceDate" id="" class="form-control d-none" value="<?= date("Y-m-d"); ?>"></span>
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
                                            <?php if ($rowOrder['discount_items'] != '') : ?>
                                                <th class="align-middle text-center">Discount</th>
                                            <?php endif; ?>
                                            <th class="align-middle text-center">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($products); $i++) :
                                            $product = $products[$i];
                                            $quantity = $quantities[$i];
                                            $price = $prices[$i];
                                            $discount = $discountItems[$i];
                                            $selectProduct = "SELECT * FROM homedecor_product WHERE id = '$product'";
                                            $resultProduct = mysqli_query($conn, $selectProduct);
                                            $rowProduct = mysqli_fetch_array($resultProduct);
                                        ?>
                                            <tr>
                                                <!-- Item description -->
                                                <td class="align-middle">
                                                    <?= $rowProduct['name']; ?>
                                                    <input type="text" name="productID[]" id="" class="form-control d-none" value="<?= $product; ?>">
                                                </td>
                                                <!-- Product ID -->
                                                <td class="align-middle text-center">
                                                    <?= $rowProduct['orderNo']; ?>
                                                </td>
                                                <!-- Product Quantity -->
                                                <td class="align-middle text-center">
                                                    <?= $quantity; ?>
                                                    <input type="text" name="quantity[]" id="" class="form-control d-none" value="<?= $quantity; ?>">
                                                </td>
                                                <!-- Selling Price -->
                                                <td class="align-middle text-center">
                                                    RM
                                                    <?php
                                                    if ($rowProduct['name'] == 'Shipping') {
                                                        echo number_format($discount, 2, '.', ',');
                                                    } else {
                                                        if (!empty($rowProduct['fixedPrice'])) :
                                                            echo number_format($rowProduct['fixedPrice'], 2, '.', ',');
                                                        else :
                                                            echo $sellingPrice = number_format(round(($rowProduct['cost'] * 2.5) + 6), 2, '.', ',');
                                                        endif;
                                                    }
                                                    ?>
                                                </td>
                                                <!-- Discount -->
                                                <?php if ($rowOrder['discount_items'] != '' || $rowOrder['discount_all'] != '') : ?>
                                                    <td class="align-middle text-center">
                                                        <?php
                                                        if ($price == 0) :
                                                            echo 0;
                                                        else :
                                                            $differences = $price - $discount;
                                                            $percent = ($differences / $price) * 100;
                                                            echo round($percent, 2);
                                                        endif;
                                                        ?>%
                                                    </td>
                                                <?php endif; ?>
                                                <!-- Amount -->
                                                <td class="align-middle text-center">
                                                    RM <?= $amount = number_format($discount, 2, '.', ''); ?>
                                                </td>
                                            </tr>
                                        <?php endfor; ?>
                                        <tr class="">
                                            <td colspan="5" class="align-middle font-weight-light text-right ">Subtotal</td>
                                            <td class="align-middle text-center ">
                                                RM<?= number_format(round(array_sum($discountItems), 2), 2, '.', ''); ?>
                                            </td>
                                        </tr>
                                        <?php if ($rowOrder['discount_all'] != 0) : ?>
                                            <tr>
                                                <td colspan="5" class="text-right font-weight-bold ">Discount</td>
                                                <td class="align-middle text-center "><?= $rowOrder['discount_all']; ?>%</td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="5" class="align-middle text-right ">
                                                <h3 class="align-middle font-weight-bold">Total</h3>
                                            </td>
                                            <td class="align-middle text-center ">
                                                <h3 class="align-middle font-weight-bold">
                                                    <?php if ($rowOrder['discount_items'] != 0 && $rowOrder['price'] != $rowOrder['discount_items']) : ?>
                                                        RM<?= number_format(round(array_sum($discountItems), 2), 2, '.', ''); ?>
                                                        <input type="text" name="totalAmount" id="totalAmount" class="form-control d-none" value="<?= number_format(round(array_sum($discountItems), 2), 2, '.', ''); ?>">
                                                    <?php elseif ($rowOrder['discount_all'] != 0) : ?>
                                                        <?php
                                                        $total = explode(',', $rowOrder['price']);
                                                        $totalSum = array_sum($total);
                                                        $percent = $rowOrder['discount_all'] / 100;
                                                        $discount = $totalSum - ($totalSum * $percent);
                                                        echo "RM" . number_format($discount, 2, '.', '');
                                                        ?>
                                                        <input type="text" name="totalAmount" id="totalAmount" class="form-control d-none" value="<?= number_format($discount, 2, '.', ''); ?>">
                                                    <?php else : ?>
                                                        RM<?= number_format(round(array_sum($prices), 2), 2, '.', '') ?>
                                                        <input type="text" name="totalAmount" id="totalAmount" class="form-control d-none" value="<?= number_format(round(array_sum($prices)), 2, '.', '') ?>">
                                                    <?php endif; ?>
                                                </h3>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                        <p class="">This is a computer generated document. No signature is required.</p>
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
                        <div class="row my-3">
                            <div class="col-lg-12">
                                <label for="">Upload Payment Receipt</label>
                                <input type="file" name="paymentReceipt" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <button type="submit" name="saveInvoice" class="btn btn-primary float-right"><i class="fas fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
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