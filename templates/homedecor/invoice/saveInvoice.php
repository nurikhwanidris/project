<?php

include('../../../src/model/dbconn.php');

// Title
$title = "Receipt";

// POST Data
$orderId = $_POST['orderId'];
$invoiceStatus = $_POST['invoiceStatus'];
$invoiceDate = $_POST['invoiceDate'];
$paymentDate = $_POST['paymentDate'];
$amountPaid = $_POST['amountPaid'];
$paymentType = $_POST['paymentType'];
$grandTotal = $_POST['grandTotal'];

// Date time
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');

// Check if invoice already existed
$checkInvoice = "SELECT * FROM homedecor_invoice2 WHERE orderid = '$orderId'";
$resultCheckInvoice = mysqli_query($conn, $checkInvoice);

if (mysqli_num_rows($resultCheckInvoice) > 0) {
    // Renamed and find a target
    $paymentReceipt = explode(".", $_FILES["paymentReceipt"]["name"]);
    $newfilename = "INV" . $orderId . '-' . round(microtime(true)) . '.' . end($paymentReceipt);
    $target = $_SERVER['DOCUMENT_ROOT'] . "/project/upload/invoice/" . $newfilename;

    $updateInvoice = "UPDATE homedecor_invoice2 SET invoiceStatus = '$invoiceStatus', paymentProof = '$newfilename', paymentType = '$paymentType', amountPaid = '$amountPaid', remainingAmount = remainingAmount - '$amountPaid' WHERE orderId = '$orderId'";
    $resultInsert = mysqli_query($conn, $updateInvoice);
} else {
    // Renamed and find a target
    $paymentReceipt = explode(".", $_FILES["paymentReceipt"]["name"]);
    $newfilename = "INV" . $orderId . '-' . round(microtime(true)) . '.' . end($paymentReceipt);
    $target = $_SERVER['DOCUMENT_ROOT'] . "/project/upload/invoice/" . $newfilename;

    move_uploaded_file($_FILES['paymentReceipt']['tmp_name'], $target);

    // Insert the invoice table
    $insert = "INSERT INTO homedecor_invoice2 (orderId, invoiceDate, invoiceStatus, paymentProof, paymentType, grandTotal, amountPaid, remainingAmount, created) VALUES ('$orderId', '$invoiceDate', '$invoiceStatus', '$newfilename', '$paymentType', '$grandTotal', '$amountPaid',  '$grandTotal' - '$amountPaid', '$created')";
    $resultInsert = mysqli_query($conn, $insert);
}

// Insert the receipt table
$insertReceipt = "INSERT INTO homedecor_receipt2 (orderId, invoiceDate, amountPaid, created) VALUES ('$orderId', '$paymentDate', '$amountPaid', '$created')";
$resultReceipt = mysqli_query($conn, $insertReceipt);

if ($resultInsert && $resultReceipt) {
    $msg = "Successfully save the invoice #" . str_pad($orderId, 6, '0', STR_PAD_LEFT);
    $alert = "success";
} else {
    $msg = "Error occcured" . mysqli_error($conn);
    $alert = "danger";
}

$selectOrder = "SELECT * FROM homedecor_order2 WHERE id = '$orderId'";
$resultOrder = mysqli_query($conn, $selectOrder);
$rowOrder = mysqli_fetch_assoc($resultOrder);

// Select customer
$selectCustomer = "SELECT * FROM homedecor_customer WHERE id = '" . $rowOrder['customerId'] . "'";
$resultCustomer = mysqli_query($conn, $selectCustomer);
$customer = mysqli_fetch_array($resultCustomer);

// Return receipt data
$receipt = "SELECT * FROM homedecor_receipt2 ORDER BY id DESC";
$resultReceipt = mysqli_query($conn, $receipt);
$rowReceipt = mysqli_fetch_assoc($resultReceipt);
?>

<!-- Header -->
<?php require('../../elements/admin/dashboard/header.php') ?>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/nav.php') ?>

<div class="container">
    <?php if (isset($msg)) : ?>
        <div class="row mt-3 d-print-none">
            <div class="col-lg-12 col-xl-12">
                <div class="alert alert-<?= $alert; ?> alert-dismissible fade show" role="alert">
                    <?= $msg; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row mt-3">
        <div class="col-lg-12 col-xl-12">
            <div class="card mb-4">
                <div class="card-body border">
                    <div class="row">
                        <div class="col-lg-12 col-xl-12">
                            <div class="col-4 float-left text-left">
                                <h4 class="font-weight-bold">Payment Receipt</h4>
                                <img src="/upload/img/invoice-logo-1.png" alt="" srcset="" style="height: auto; width: 40%;">
                            </div>
                            <div class="col-4 float-right text-right">
                                <h5 class=""><span class="font-weight-bold">No :</span> <u><?= str_pad($rowReceipt['id'], 6, 0, STR_PAD_LEFT); ?></u></h5>
                                <h5 class=""><span class="font-weight-bold">Date :</span> <u><?= $paymentDate; ?></u></h5>
                                <h5 class=""><span class="font-weight-bold">Payment Method :</span><u>
                                        <?= $paymentType; ?>
                                    </u>
                                </h5>
                                <h5 class=""><span class="font-weight-bold">Amount :</span>
                                    <u>
                                        RM<?= $amountPaid; ?>
                                    </u>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-lg-12 col-xl-12">
                            <div class="col-12">
                                <h5><?= $customer['customerName']; ?></h5>
                                <h5><?= $customer['address1']; ?>, <?= $customer['city']; ?></h5>
                                <h5><?= $customer['postcode']; ?>, <?= $customer['state']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-lg-12">
                            <div class="col-2 float-left">
                                <h5 class="font-weight-bold">For : </h5>
                            </div>
                            <div class="col-10 border-bottom float-right">
                                Payment for Invoice Number - <?= str_pad($rowReceipt['id'], 6, 0, STR_PAD_LEFT); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-lg-12">
                            <div class="col-2 float-left">
                                <h5 class="font-weight-bold">Received by : </h5>
                            </div>
                            <div class="col-10 border-bottom float-right">
                                Arzu Home & Living, 243B, Jalan Bandar 13, Taman Melawati, Kuala Lumpur
                            </div>
                        </div>
                    </div>
                    <div class="row my-2 d-print-none">
                        <div class="col-lg-12">
                            <div class="col-2 float-right text-right">
                                <!-- <a class="btn btn-info" onclick="window.print();"><i class="fas fa-print"></i> Print</a> -->
                                <a href="printReceipt?id=<?= $rowReceipt['id']; ?>" target="_blank" class="btn btn-primary">Print</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php require('../../elements/admin/dashboard/footer.php') ?>