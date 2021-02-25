<?php

include('../../../src/model/dbconn.php');

// Title
$title = "Receipt";

// Get data from POST
$productID = $_POST['productID'];
$customerID = $_POST['customerID'];
$quantity = $_POST['quantity'];
$invoiceStatus = $_POST['invoiceStatus'];
$paymentType = $_POST['paymentType'];
$invoiceNum = $_POST['invoiceNum'];
$invoiceDate = $_POST['invoiceDate'];
$totalAmount = $_POST['totalAmount'];
$amountPaid = $_POST['amountPaid'];
$paymentReceipt = $_FILES['paymentReceipt']['name'];

// // Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

// Renamed and find a target
$newName = $invoiceNum . '-' . $invoiceDate;
$target = "../../../upload/img/receipt/" . basename($newName);

// Update inventory 1st
if ($invoiceStatus == 'Pending') {
    // Insert into invoice table
    $insert = "INSERT INTO homedecor_invoice (customer_id, invoice_num, invoice_date, invoice_status, total_amount, remaining_amount, created, modified) VALUES ('$customerID','$invoiceNum','$invoiceDate','$invoiceStatus','$totalAmount','$totalAmount','$created','$modified')";
    $resultInsert = mysqli_query($conn, $insert);

    if ($resultInsert) {
        $msg = "Invoice status is pending";
        $alert = "success";
        //header("Location: /project/templates/homedecor/order/view?msg=success");
    } else {
        $msg = "Error occcured" . mysqli_error($conn);
        $alert = "danger";
    }
    echo $msg;
} elseif ($invoiceStatus == 'Full') {
    // Update invoice table if full payment made
    $update = "UPDATE homedecor_invoice SET invoice_status = '$invoiceStatus', payment_receipt = '$newName', payment_type = '$paymentType', amount_paid  = '$amountPaid', modified = '$modified' WHERE customer_id = '$customerID'";
    $resultUpdate = mysqli_query($conn, $update);

    // Update product table
    for ($i = 0; $i < count($productID); $i++) {
        $id = $productID[$i];
        $quantities = $quantity[$i];
        //echo $id . "<br>" . $quantities;
        $update = "UPDATE homedecor_product SET quantity = (quantity - '$quantities'), purchased = '$quantities' WHERE id = '$id'";
        $result = mysqli_query($conn, $update);
    }
    if ($result) {
        move_uploaded_file($_FILES['paymentReceipt']['name'], $target);
        $msg = "Successfull updated the invoice";
        $alert = "success";
        //header("Location: /project/templates/homedecor/order/view?msg=success");
    } else {
        $msg = "Error occcured" . mysqli_error($conn);
        $alert = "danger";
    }
} else {
    // Update invoice table if deposit is made
    $update = "UPDATE homedecor_invoice SET invoice_status = '$invoiceStatus', amount_paid = '$amountPaid', remaining_amount = (remaining_amount-'$amountPaid'), payment_receipt = '$newName', payment_type = '$paymentType' WHERE customer_id = '$customerID'";
    $result = mysqli_query($conn, $update);

    if ($result) {
        move_uploaded_file($_FILES['paymentReceipt']['name'], $target);
        $msg = "Successfull updated the invoice status to " . $invoiceStatus . " made";
        $alert = "success";
        //header("Location: /project/templates/homedecor/order/list");
    } else {
        $msg = "Error occcured" . mysqli_error($conn);
        $alert = 'danger';
    }
}

$selectCustomer = "SELECT * FROM homedecor_customer WHERE id = '$customerID'";
$resultCustomer = mysqli_query($conn, $selectCustomer);
$customer = mysqli_fetch_array($resultCustomer);

?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<div class="container-fluid">
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
                                <img src="/project/upload/img/invoice-logo-1.png" alt="" srcset="" style="height: auto; width: 40%;">
                            </div>
                            <div class="col-4 float-right text-right">
                                <h5 class=""><span class="font-weight-bold">No :</span> <u>100</u></h5>
                                <h5 class=""><span class="font-weight-bold">Date :</span> <u><?= date("d/m/Y"); ?></u></h5>
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
                                Payment for Invoice Number - <?= $invoiceNum; ?>
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
                                <a class="btn btn-secondary" onclick="window.print();"><i class="fas fa-print"></i> Print</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>