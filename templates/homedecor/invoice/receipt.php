<!-- Title -->
<?php $title = 'Receipt No. ' . str_pad($_GET['id'], 4, 0, STR_PAD_LEFT) ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- DB Conn -->
<?php include('../../../src/model/dbconn.php'); ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Display receipt data -->
<?php
// Fetch from receipt table
$receipt = "SELECT * FROM homedecor_receipt WHERE id = '" . $_GET['id'] . "'";
$resultReceipt = mysqli_query($conn, $receipt);
$rowReceipt = mysqli_fetch_assoc($resultReceipt);

// Fetch from customer table
$customer = "SELECT * FROM homedecor_customer WHERE id = '" . $rowReceipt['customerID'] . "'";
$resultCustomer = mysqli_query($conn, $customer);
$rowCustomer = mysqli_fetch_assoc($resultCustomer);
?>

<div class="container-fluid">
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
                                <h5 class=""><span class="font-weight-bold">No :</span> <u><?= str_pad($rowReceipt['id'], 4, 0, STR_PAD_LEFT); ?></u></h5>
                                <h5 class="">
                                    <span class="font-weight-bold">Date :</span>
                                    <u>
                                        <?php
                                        $s = $rowReceipt['created'];
                                        $dt = new DateTime($s);
                                        echo $date = $dt->format('d/m/Y');
                                        ?>
                                    </u>
                                </h5>
                                <!-- <h5 class=""><span class="font-weight-bold">Payment Method :</span><u><?= $rowReceipt['amountPaid']; ?></u></h5> -->
                                <h5 class=""><span class="font-weight-bold">Amount :</span>
                                    <u>
                                        RM<?= $rowReceipt['amountPaid']; ?>
                                    </u>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-lg-12 col-xl-12">
                            <div class="col-12">
                                <h5><?= $rowCustomer['customerName']; ?></h5>
                                <h5><?= $rowCustomer['address1']; ?>, <?= $rowCustomer['city']; ?></h5>
                                <h5><?= $rowCustomer['postcode']; ?>, <?= $rowCustomer['state']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-lg-12">
                            <div class="col-2 float-left">
                                <h5 class="font-weight-bold">For : </h5>
                            </div>
                            <div class="col-10 border-bottom float-right">
                                Payment for Invoice Number - <?= $rowReceipt['invoiceNum']; ?>
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