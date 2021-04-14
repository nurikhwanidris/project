<!-- Title -->
<?php $title = 'Payment Voucher'; ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- View PV -->
<?php
// Get info
$pvNum = $_GET['pv'];

// Get info from PV table
$sql = "SELECT * FROM homedecor_pv WHERE pvNum = '$pvNum'";
$result = mysqli_query($conn, $sql);
$rowPV = mysqli_fetch_assoc($result);

// Explode desc and amount
$descriptions = explode(',', $rowPV['description']);
$amounts = explode(',', $rowPV['amount']);
$categories = explode(',', $rowPV['category']);

?>

<style>
    @media print {
        @page {
            size: A4;
            /* DIN A4 standard, Europe */
            margin: 0;
        }

        html,
        body {
            width: 210mm;
            /* height: 297mm; */
            height: 282mm;
            font-size: 11px;
            background: #FFF;
            overflow: visible;
        }

        body {
            padding-top: 15mm;
        }

        table,
        tr,
        th,
        td {
            border: 3px solid black;
        }

        th,
        td {
            font-size: 17px;
        }

        .pvNum {
            font-size: 25px;
        }

        .pvType {
            font-size: 20px;
        }

        .misc {
            font-size: 17px;
        }

        .hehe {
            font-size: 22px;
        }
    }
</style>

<!-- This is where the magic happens -->
<div class="container-fluid">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between d-print-none">
                        <h6 class="m-0 font-weight-bold text-primary">Payment Voucher</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-10 col-xl-10 justify-content-start">
                                <img src="/project/upload/img/invoice-logo-1.png" alt="" srcset="" style="height: auto; width: 200px;" class="my-3">
                                <h3 class="font-weight-bold text-uppercase">Payment Voucher</h3>
                            </div>
                            <div class="col-lg-2 col-xl-2 align-self-end mb-1 text-right">
                                <span class="font-weight-bold pvNum"><?= $rowPV['pvNum']; ?></span>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-lg-12 col-xl-12 mb-0 misc">
                                <div class="form-group row">
                                    <label for="staticPayTo" class="col-sm-2 col-form-label">Payable to</label>
                                    <span class="col-sm-1">:</span>
                                    <div class="col-sm-8">
                                        <span class="text-capitalize font-weight-bold"><?= $rowPV['payTo']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-lg-12 col-xl-12 mb-0 misc">
                                <div class="form-group row">
                                    <label for="staticPayTo" class="col-sm-2 col-form-label">Account Number</label>
                                    <span class="col-sm-1">:</span>
                                    <div class="col-sm-8">
                                        <span class="text-capitalize font-weight-bold"><?= $rowPV['accNum']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-lg-12 col-xl-12 mb-0 misc">
                                <div class="form-group row">
                                    <label for="staticPayTo" class="col-sm-2 col-form-label">Bank Name</label>
                                    <span class="col-sm-1">:</span>
                                    <div class="col-sm-3">
                                        <span class="font-weight-bold">
                                            <?= ($rowPV['accBank'] == 'ABB' ? 'Affin Bank Berhad' : '') ?>
                                            <?= ($rowPV['accBank'] == 'AGRO' ? 'Agro Bank' : '') ?>
                                            <?= ($rowPV['accBank'] == 'ABMB' ? 'Alliance Bank Malaysia Berhad' : '') ?>
                                            <?= ($rowPV['accBank'] == 'BIMB' ? 'Bank Islam Malaysia Berhad' : '') ?>
                                            <?= ($rowPV['accBank'] == 'BKRM' ? 'Bank Kerjasama Rakyat Malaysia' : '') ?>
                                            <?= ($rowPV['accBank'] == 'CIMB' ? 'CIMB Malaysia Berhad' : '') ?>
                                            <?= ($rowPV['accBank'] == 'CITI' ? 'Citibank Berhad' : '') ?>
                                            <?= ($rowPV['accBank'] == 'HSBC' ? 'HSBC Bank Berhad' : '') ?>
                                            <?= ($rowPV['accBank'] == 'OCBC' ? 'OCBC Bank Malaysia Berhad' : '') ?>
                                            <?= ($rowPV['accBank'] == 'PBB' ? 'Public Bank Berhad' : '') ?>
                                            <?= ($rowPV['accBank'] == 'RHB' ? 'RHB Bank Berhad' : '') ?>
                                            <?= ($rowPV['accBank'] == 'SCB' ? 'Standard Chartered Bank Malaysia Berhad' : '') ?>
                                            <?= ($rowPV['accBank'] == 'UOB' ? 'United Overseas Bank' : '') ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg-12 table">
                                <table class="table table-bordered border table-sm" style="border: 1px solid black;">
                                    <thead class="thead-dark">
                                        <tr style="border: 1px solid black;">
                                            <th class="align-middle text-center" style="width: 5%;">Item</th>
                                            <th class="align-middle" style="width: 60%;">Description</th>
                                            <th class="align-middle text-center" style="width: 20%;">Category</th>
                                            <th class="align-middle text-center" style="width: 15%;">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody style="border: 1px solid black;">
                                        <?php $x = 1;
                                        for ($i = 0; $i < count($descriptions); $i++) :
                                            $description = $descriptions[$i];
                                            $amount = $amounts[$i];
                                            $category = $categories[$i];
                                        ?>
                                            <tr style="border: 1px solid black;">
                                                <td class="align-middle text-center" style="border: 1px solid black;"><?= $x++; ?></td>
                                                <td class="align-middle" style="border: 1px solid black;"><?= $description; ?></td>
                                                <td class="align-middle text-center" style="border: 1px solid black;"><?= $category; ?></td>
                                                <td class="align-middle text-center font-weight-bold" style="border: 1px solid black;">RM<?= number_format($amount, 2, '.', ','); ?></td>
                                            </tr>
                                        <?php endfor;
                                        ?>
                                        <tr style="border: 1px solid black;">
                                            <td colspan="3" style="border: 1px solid black;" class="align-middle text-right">
                                                <h4 class="font-weight-bold">Total</h4>
                                            </td>
                                            <td class="align-middle text-center" style="border: 1px solid black;">
                                                <h4 class="font-weight-bold hehe">RM<?= number_format(round(array_sum($amounts), 2), 2, '.', ''); ?></h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col- misc">Date created</label>
                                    <span class="col-sm-1 misc">:</span>
                                    <div class="col-sm-7">
                                        <input type="text" readonly class="form-control-plaintext border-bottom misc" id="staticEmail" style="border-bottom: 2px solid black;" value="<?= $rowPV['created']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col- misc">Prepared by</label>
                                    <span class="col-sm-1 misc">:</span>
                                    <div class="col-sm-7">
                                        <input type="text" readonly class="form-control-plaintext border-bottom misc" id="staticEmail" value="<?= $rowPV['staffName']; ?>" style="border-bottom: 2px solid black;">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col- misc">Approved by</label>
                                    <span class="col-sm-1 misc">:</span>
                                    <div class="col-sm-7">
                                        <input type="text" readonly class="form-control-plaintext border-bottom misc" id="staticEmail" style="border-bottom: 2px solid black;" value="Arzu Abdullah">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-4 clearfix">

                        </div>
                        <div class="row my-2 text-center">
                            <div class="col-lg-12 text-center">
                                <h3 class="font-weight-bold">Arzu Home & Living</h3>
                                <span>No 243B, Jalan Bandar 13, Taman Melawati, 53100 Kuala Lumpur</span><br>
                                <span>Tel : +603 4162 8179 | info@arzuhome.com</span>
                            </div>
                        </div>
                        <div class="row my-2 d-print-none">
                            <div class="col-lg-12">
                                <div class="col-lg-2 float-right p-0">
                                    <a href="pdf-pv.php?id=<?= $rowPV['id']; ?>" class="btn btn-info float-right"><i class="fas fa-print"></i> Print</a>
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
<?php include('../../elements/admin/dashboard/footer.php') ?>