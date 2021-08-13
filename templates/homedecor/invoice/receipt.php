<!-- Title -->
<?php $title = 'Receipt No. ' . str_pad($_GET['id'], 4, 0, STR_PAD_LEFT) ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- DB Conn -->
<?php include('../../../src/model/dbconn.php'); ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<?php
$receiptId = $_GET['id'];

// Select receipt
$selectReceipt = "SELECT * FROM homedecor_receipt2 WHERE id = '$receiptId'";
$resultReceipt = mysqli_query($conn, $selectReceipt);
$rowReceipt = mysqli_fetch_assoc($resultReceipt);

// Select order
$selectOrder = "SELECT * FROM homedecor_order2 WHERE id = '" . $rowReceipt['orderId'] . "'";
$resultOrder = mysqli_query($conn, $selectOrder);
$rowOrder = mysqli_fetch_assoc($resultOrder);

// Select customer
$selectCustomer = "SELECT * FROM homedecor_customer WHERE id = '" . $rowOrder['customerId'] . "'";
$resultCustomer = mysqli_query($conn, $selectCustomer);
$customer = mysqli_fetch_array($resultCustomer);

// Return receipt data
$invoice = "SELECT * FROM homedecor_invoice2 WHERE orderId = '" . $rowReceipt['orderId'] . "'";
$resultInvoice = mysqli_query($conn, $invoice);
$rowInvoice = mysqli_fetch_assoc($resultInvoice);
?>

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
    <div class="row mt-3" id="printReceipt">
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
                                <h5 class=""><span class="font-weight-bold">No :</span> <u><?= str_pad($rowReceipt['id'], 6, 0, STR_PAD_LEFT); ?></u></h5>
                                <h5 class=""><span class="font-weight-bold">Date :</span> <u><?= $rowInvoice['invoiceDate']; ?></u></h5>
                                <h5 class=""><span class="font-weight-bold">Payment Method :</span><u>
                                        <?= $rowInvoice['paymentType']; ?>
                                    </u>
                                </h5>
                                <h5 class=""><span class="font-weight-bold">Amount :</span>
                                    <u>
                                        RM<?= number_format($rowInvoice['amountPaid'], 2, '.', ''); ?>
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
                                Payment for Invoice Number - INV<?= date("Ym", strtotime($rowInvoice['invoiceDate'])) . str_pad($rowReceipt['orderId'], 4, 0, STR_PAD_LEFT); ?>
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
                                <a class="btn btn-info" id="printThis"><i class="fas fa-print"></i> Print</a>
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

<script>
    $(document).ready(function() {
        $("#printThis").click(function() {
            var element = document.getElementById('printReceipt');
            var opt = {
                margin: 1,
                filename: '<?= str_pad($rowReceipt['id'], 6, 0, STR_PAD_LEFT); ?>.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A4',
                    orientation: 'landscape'
                }
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();

            // Old monolithic-style usage:
            html2pdf(element, opt);
        });
    });
</script>