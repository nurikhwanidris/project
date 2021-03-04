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
$poID = $_POST['poID'];

// // Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

// Renamed and find a target
$paymentReceipt = $_FILES['paymentReceipt']['name'];
$newName = "INV" . $invoiceNum . '-' . $invoiceDate . ".pdf";
$target = "../../../upload/invoice/" . basename($newName);

// Check for existing invoice
$checkInvoice = "SELECT * FROM homedecor_invoice WHERE invoice_num = '$invoiceNum'";
$resultCheck = mysqli_query($conn, $checkInvoice);
$rowCheck = mysqli_fetch_assoc($resultCheck);
//$checkRow = mysqli_num_rows($resultCheck);

if ($resultCheck) {
    if (mysqli_num_rows($resultCheck) > 0) {
        if ($rowCheck['remaining_amount'] = 0 || $invoiceStatus == 'Full') {
            // Update invoice table if full payment made
            $update = "UPDATE homedecor_invoice SET invoice_status = '$invoiceStatus', payment_receipt = '$newName', payment_type = '$paymentType', amount_paid  = '$amountPaid', remaining_amount = round((remaining_amount-'$amountPaid'),2), modified = '$modified' WHERE po_id = '$poID'";
            $resultUpdate = mysqli_query($conn, $update);
            move_uploaded_file($_FILES['paymentReceipt']['tmp_name'], $target);

            // Update product table
            for ($i = 0; $i < count($productID); $i++) {
                $id = $productID[$i];
                $quantities = $quantity[$i];
                $update = "UPDATE homedecor_product SET quantity = (quantity - '$quantities'), purchased = '$quantities' WHERE id = '$id'";
                $result = mysqli_query($conn, $update);
            }
            if ($result) {
                move_uploaded_file($_FILES['paymentReceipt']['tmp_name'], $target);
                $msg = "Successfull updated the invoice #" . $invoiceNum;
                $alert = "success";
            } else {
                $msg = "Error occcured" . mysqli_error($conn);
                $alert = "danger";
            }
        } else {
            // Update invoice table if deposit is made
            $update = "UPDATE homedecor_invoice SET invoice_status = '$invoiceStatus', amount_paid = '$amountPaid', remaining_amount = round((remaining_amount-'$amountPaid'),2), payment_receipt = '$newName', payment_type = '$paymentType' WHERE po_id = '$poID'";
            $result = mysqli_query($conn, $update);

            if ($result) {
                move_uploaded_file($_FILES['paymentReceipt']['tmp_name'], $target);
                $msg = "Successfull updated the invoice status to " . $invoiceStatus . " made";
                $alert = "success";
            } else {
                $msg = "Error occcured" . mysqli_error($conn);
                $alert = 'danger';
            }
        }
    } else {
        $insert = "INSERT INTO homedecor_invoice (customer_id, invoice_num, invoice_date, invoice_status, payment_receipt, payment_type, total_amount, amount_paid, remaining_amount, created, modified, po_id) VALUES ('$customerID', '$invoiceNum', '$invoiceDate', '$invoiceStatus', '$newName', '$paymentType', '$totalAmount', '$amountPaid', round('$totalAmount'-'$amountPaid',2), '$created', '$modified', '$poID')";
        $resultInsert = mysqli_query($conn, $insert);

        move_uploaded_file($_FILES['paymentReceipt']['tmp_name'], $target);

        if ($resultInsert) {
            $msg = "Deposit made for invoice #" . $invoiceNum;
            $alert = "success";
            //header("Location: /project/templates/homedecor/order/view?msg=success");
        } else {
            $msg = "Error occcured" . mysqli_error($conn);
            $alert = "danger";
        }
    }
} else {
    echo "Error " . mysqli_error($conn);
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
                                <a class="btn btn-info" onclick="window.print();"><i class="fas fa-print"></i> Print</a>
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