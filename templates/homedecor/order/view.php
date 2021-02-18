<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Get data from invoice table -->
<?php
$id = $_GET['id'];
$select = "SELECT * FROM homedecor_invoice WHERE id = '$id'";
$result = mysqli_query($conn, $select);
$rowInvoice = mysqli_fetch_array($result);

// Explode everything boom!
$products = explode(',', $rowInvoice['product_name']);
$quantities = explode(',', $rowInvoice['quantity']);
$prices = explode(',', $rowInvoice['cost']);
$totals = explode(',', $rowInvoice['total']);
?>

<!-- Get customer info -->
<?php
$customer = "SELECT * FROM homedecor_customer where id = '" . $rowInvoice['customer_id'] . "'";
$resultCustomer = mysqli_query($conn, $customer);
$rowCustomer = mysqli_fetch_array($resultCustomer);
?>

<!-- Body -->
<div class="container-fluid">
    <form action="<?php $_SERVER['PHP_SELF']; ?>">
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
                                        53100, Kuala Lumpur
                                    </p>
                                </div>
                                <div class="col-4 float-right text-right">
                                    <h4 class="font-weight-bold">Profoma Invoice</h4>
                                    <img src="/project/upload/img/invoice-logo-1.png" alt="" srcset="" style="height: auto; width: 70%;">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 col-xl-12">
                                <div class="col-3 float-left text-left">
                                    <p>Invoice to:</p>
                                    <p>
                                        <span class="font-weight-bold"><?= $rowCustomer['customerName']; ?></span> <br>
                                        <?= $rowCustomer['address1']; ?> <br>
                                        <?= $rowCustomer['city'] . ", " . $rowCustomer['postcode'] . ", " . $rowCustomer['state'] ?>
                                    </p>
                                    <p>
                                        Contact Number : <span class="font-weight-bold">0123456789</span>
                                    </p>
                                </div>
                                <div class="col-3 float-right text-right">
                                    <p>
                                        Invoice # : <span class="font-weight-bold"><?= date("Ym") . str_pad($id, 4, 0, STR_PAD_LEFT); ?></span><br>
                                        Invoice Date : <span class="font-weight-bold"><?= date("d/m/Y"); ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 col-xl-12">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="align-middle text-center">Quantity</th>
                                            <th class="align-middle">Description</th>
                                            <th class="align-middle text-center">Price/Unit</th>
                                            <th class="align-middle text-center">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($products); $i++) :
                                            $product = $products[$i];
                                            $quantity = $quantities[$i];
                                            $price = $prices[$i];
                                            $total = $totals[$i];
                                        ?>
                                            <tr>
                                                <td class="align-middle text-center"><?= $quantity; ?></td>
                                                <td class="align-middle"><?= $product; ?></td>
                                                <td class="align-middle text-center">RM<?= round($price); ?></td>
                                                <td class="align-middle text-center">RM<?= round($total); ?></td>
                                            </tr>
                                        <?php endfor; ?>
                                        <tr>
                                            <td colspan="3" class="align-middle text-right">
                                                <h3 class="align-middle font-weight-bold">Total</h3>
                                            </td>
                                            <td class="align-middle text-center">
                                                <h3 class="align-middle font-weight-bold">RM<?= round(array_sum($totals)); ?></h3>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 col-xl-12">
                                <div class="col-lg-12">
                                    <p>
                                        Pay to : <br>
                                        <span class="font-weight-bold">Azuwarridah Abdullah</span> <br>
                                        <span class="font-weight-bold">Maybank - 5148 1555 1083</span>
                                    </p>
                                    <span>Terms and Conditions</span>
                                    <ul>
                                        <li>
                                            Please include the payment slips after the payment was made.
                                        </li>
                                        <li>
                                            30% of deposit from the actual amount.
                                        </li>
                                        <li>
                                            Balance payment must be made within 2 days after the invoice billed to you.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 d-print-none">
                            <div class="col-lg-12 col-xl-12">
                                <div class="col-lg-4 float-right text-right">
                                    <a class="btn btn-secondary" onclick="window.print();"><i class="fas fa-print"></i> Print</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xl-3 d-print-none">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Upload Payment Receipt</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <input type="file" name="receiptPayment" id="" class="form-control">
                            </div>
                            <div class="col-lg-4">
                                <button class="btn btn-primary float-right"><i class="fas fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>