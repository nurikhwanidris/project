<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<?php
$payTo = $_POST['payTo'];
$bankAcc = $_POST['bankAcc'];

// Implode
$description = implode(',', $_POST['description']);
$amount = implode(',', $_POST['amount']);

// Sanitize bank acc
$numAcc = $_POST['numAcc'];
$sanitizeAccNum = preg_replace('/[^0-9]/', '', $numAcc);

if (isset($_POST['save'])) {
    $insert = "INSERT INTO homedecor_pv () VALUES ()";
    $result = mysqli_query($conn, $insert);
}
?>

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
                            <div class="col-lg-2 col-xl-2 align-self-end mb-1">
                                <input type="text" name="pvNum" id="" class="form-control text-right border-0 font-weight-bold" value="PV2021/00/0000">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-10 clearfix">

                            </div>
                            <div class="col-lg-2 float-right text-right">
                                <input type="text" name="pvType" id="" class="form-control text-right border-0" placeholder="Type of PV">
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-lg-12 col-xl-12 mb-0">
                                <div class="form-group row">
                                    <label for="staticPayTo" class="col-sm-2 col-form-label">Payable to</label>
                                    <span class="col-sm-1">:</span>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control text-capitalize border-0 font-weight-bold" name="payTo" id="staticPayTo" value="<?= $payTo; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-lg-12 col-xl-12 mb-0">
                                <div class="form-group row">
                                    <label for="staticPayTo" class="col-sm-2 col-form-label">Account Number</label>
                                    <span class="col-sm-1">:</span>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control text-capitalize border-0 font-weight-bold" name="numAcc" id="staticPayTo" value="<?= $numAcc; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-lg-12 col-xl-12 mb-0">
                                <div class="form-group row">
                                    <label for="staticPayTo" class="col-sm-2 col-form-label">Bank Name</label>
                                    <span class="col-sm-1">:</span>
                                    <div class="col-sm-3">
                                        <select name="bankAcc" id="" class="form-control border-0 font-weight-bold">
                                            <option value="">Select</option>
                                            <option value="ABB" <?= ($_POST['bankAcc'] == 'ABB' ? 'selected' : '') ?>>Affin Bank Berhad</option>
                                            <option value="AGRO" <?= ($_POST['bankAcc'] == 'AGRO' ? 'selected' : '') ?>>Agro Bank</option>
                                            <option value="ABMB" <?= ($_POST['bankAcc'] == 'ABMB' ? 'selected' : '') ?>>Alliance Bank Malaysia Berhad</option>
                                            <option value="BIMB" <?= ($_POST['bankAcc'] == 'BIMB' ? 'selected' : '') ?>>Bank Islam Malaysia Berhad</option>
                                            <option value="BKRM" <?= ($_POST['bankAcc'] == 'BKRM' ? 'selected' : '') ?>>Bank Kerjasama Rakyat Malaysia</option>
                                            <option value="CIMB" <?= ($_POST['bankAcc'] == 'CIMB' ? 'selected' : '') ?>>CIMB Malaysia Berhad</option>
                                            <option value="CITI" <?= ($_POST['bankAcc'] == 'CITI' ? 'selected' : '') ?>>Citibank Berhad</option>
                                            <option value="HSBC" <?= ($_POST['bankAcc'] == 'HSBC' ? 'selected' : '') ?>>HSBC Bank Berhad</option>
                                            <option value="MBB" <?= ($_POST['bankAcc'] == 'MBB' ? 'selected' : '') ?>>Malayan Banking Berhad</option>
                                            <option value="OCBC" <?= ($_POST['bankAcc'] == 'OCBC' ? 'selected' : '') ?>>OCBC Bank Malaysia Berhad</option>
                                            <option value="PBB" <?= ($_POST['bankAcc'] == 'PBB' ? 'selected' : '') ?>>Public Bank Berhad</option>
                                            <option value="RHB" <?= ($_POST['bankAcc'] == 'RHB' ? 'selected' : '') ?>>RHB Bank Berhad</option>
                                            <option value="SCB" <?= ($_POST['bankAcc'] == 'SCB' ? 'selected' : '') ?>>Standard Chartered Bank Malaysia Berhad</option>
                                            <option value="UOB" <?= ($_POST['bankAcc'] == 'UOB' ? 'selected' : '') ?>>United Overseas Bank</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-">
                            <div class="col-lg-12 table">
                                <table class="table table-bordered border" style="border: 1px solid black;">
                                    <thead class="thead-dark">
                                        <tr style="border: 1px solid black;">
                                            <th class="align-middle text-center" style="width: 2%;">Item</th>
                                            <th class="align-middle" style="width: 80%;">Description</th>
                                            <th class="align-middle text-center" style="width: 18%;">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody style="border: 1px solid black;">
                                        <?php //while() :
                                        ?>
                                        <tr style="border: 1px solid black;">
                                            <td class="align-middle text-center" style="border: 1px solid black;">1</td>
                                            <td class="align-middle" style="border: 1px solid black;"><?= $description; ?></td>
                                            <td class="align-middle text-center" style="border: 1px solid black;"><?= $amount; ?></td>
                                        </tr>
                                        <?php // endwhile;
                                        ?>
                                        <tr style="border: 1px solid black;">
                                            <td colspan="2" style="border: 1px solid black;" class="align-middle text-right">Total</td>
                                            <td class="align-middle text-center" style="border: 1px solid black;">123.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row my-2 d-print-none">
                            <div class="col-lg-12">
                                <div class="col-lg-1 float-left border p-0">
                                    <button class="btn btn-success">Print</button>
                                </div>
                                <div class="col-lg-1 float-right border p-0">
                                    <button class="btn btn-success float-right">Print</button>
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