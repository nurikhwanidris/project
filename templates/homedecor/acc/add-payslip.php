<!-- Title -->
<?php $title = "Add Payment Voucher" ?>

<!-- Header -->
<?php require('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php require('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/nav.php') ?>

<?php
if (isset($_POST['submit'])) {
    // Fetch the parameters
    $employeeName = $_POST['employeeName'];
    $ic = $_POST['ic'];
    $jobTitle = $_POST['jobTitle'];
    $daterange = $_POST['daterange'];
    $period = $_POST['period'];
    $paymentDate = $_POST['paymentDate'];
    $accNum = $_POST['accNum'];
    $accBank = $_POST['accBank'];
    $basicSalary = $_POST['basicSalary'];
    $salesComm = $_POST['salesComm'];
    $totalEarn = $_POST['totalEarn'];
    $epf = $_POST['epf'];
    $socso = $_POST['socso'];
    $socso2 = $_POST['socso2'];
    $epfEmp = $_POST['epfEmp'];
    $socsoEMP = $_POST['socsoEMP'];
    $socso2EMP = $_POST['socso2EMP'];

    // Date created and modified
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $created = date('Y-m-d H:i:s');
    $modified = date('Y-m-d H:i:s');

    // Sanitize bank acc
    $accNum = $_POST['accNum'];
    $sanitizeAccNum = preg_replace('/[^0-9]/', '', $accNum);

    // Insert into the table
    $insert = "INSERT INTO homedecor_payslip (employeeName, ic, jobTitle, daterange, period, paymentDate, accNum, accBank, basicSalary, salesComm, totalEarn, epf, socso, socso2, epfEmp, socsoEMP, socso2EMP, created, modified) VALUES ('$employeeName','$ic','$jobTitle','$daterange','$period','$paymentDate','$sanitizeAccNum','$accBank','$basicSalary','$salesComm','$totalEarn','$epf','$socso','$socso2','$epfEmp','$socsoEMP','$socso2EMP','$created','$modified')";
    $result = mysqli_query($conn, $insert);

    if ($result) {
        $msg = "Succesfully saved the vouchers";
        $alert = "success";
    } else {
        $msg = mysqli_error($conn);
        $alert = "danger";
    }
}
?>

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

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Payment Slip</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" onSubmit="if(!confirm('Is the form filled out correctly?')){return false;}">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add Payment Slip</h6>
                    </div>
                    <div class="card-body">
                        <div class="row clear-fix">
                            <div class="col-lg-6">
                                <h6 class="text-info font-weight-light">Employee Information</h6>
                            </div>
                        </div>
                        <div class="row my-2 clearfix">
                            <div class="col-lg-4">
                                <label for="">Employee Name</label>
                                <input type="text" name="employeeName" id="" class="form-control">
                            </div>
                            <div class="col-lg-2">
                                <label for="">IC Number</label>
                                <input type="text" name="ic" class="form-control" value="" />
                            </div>
                            <div class="col-lg-3">
                                <label for="">Job Title</label>
                                <input type="text" name="jobTitle" id="" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="row clear-fix">
                            <div class="col-lg-6">
                                <h6 class="text-info font-weight-light">Date</h6>
                            </div>
                        </div>
                        <div class="row my-2 clearfix">
                            <div class="col-lg-2">
                                <label for="">Date Range</label>
                                <input type="text" name="daterange" class="form-control" value="" />
                            </div>
                            <div class="col-lg-2">
                                <label for="">Period</label>
                                <input type="text" name="period" class="form-control" value="<?= date('M-y'); ?>" />
                            </div>
                            <div class="col-lg-2">
                                <label for="">Payment Date</label>
                                <input type="date" name="paymentDate" id="" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="row clear-fix">
                            <div class="col-lg-6">
                                <h6 class="text-info font-weight-light">Account Information</h6>
                            </div>
                        </div>
                        <div class="row my-2 clearfix">
                            <div class="col-lg-3">
                                <label for="">Account Number</label>
                                <input type="text" name="accNum" id="" class="form-control">
                            </div>
                            <div class="col-lg-3">
                                <label for="">Bank</label>
                                <select name="accBank" id="" class="form-control">
                                    <option value="">Select</option>
                                    <option value="ABB">Affin Bank Berhad</option>
                                    <option value="AGRO">Agro Bank</option>
                                    <option value="ABMB">Alliance Bank Malaysia Berhad</option>
                                    <option value="BIMB">Bank Islam Malaysia Berhad</option>
                                    <option value="BKRM">Bank Kerjasama Rakyat Malaysia</option>
                                    <option value="CIMB">CIMB Malaysia Berhad</option>
                                    <option value="CITI">Citibank Berhad</option>
                                    <option value="HSBC">HSBC Bank Berhad</option>
                                    <option value="MBB">Malayan Banking Berhad</option>
                                    <option value="OCBC">OCBC Bank Malaysia Berhad</option>
                                    <option value="PBB">Public Bank Berhad</option>
                                    <option value="RHB">RHB Bank Berhad</option>
                                    <option value="SCB">Standard Chartered Bank Malaysia Berhad</option>
                                    <option value="UOB">United Overseas Bank</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row my-2 clearfix">
                            <div class="col-lg-12">
                                <h6 class="text-info font-weight-light">Earnings</h6>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Basic Salary</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                    </div>
                                    <input type="text" name="basicSalary" class="form-control calculate" id="basicSalary" value="0.00">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Allowance</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                    </div>
                                    <input type="text" name="salesComm" class="form-control calculate" id="salesComm" value="0.00" aria-label="0.00">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Total Earnings</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                    </div>
                                    <input type="text" name="totalEarn" class="form-control calculate" id="totalEarn" value="" readonly>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row clear-fix">
                            <div class="col-lg-6">
                                <div class="row">
                                    <h6 class="text-info font-weight-light col-lg-12">Employee Contribution</h6>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="">EPF Employee</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                            </div>
                                            <input type="text" name="epf" class="form-control calculate" id="epf" value="0.00" aria-label="0.00">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">SOCSO</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                            </div>
                                            <input type="text" name="socso" class="form-control calculate" id="socso" value="0.00" aria-label="0.00">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">SOCSO 2</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                            </div>
                                            <input type="text" name="socso2" class="form-control calculate" id="socso2" value="0.00" aria-label="0.00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <h6 class="text-info font-weight-light col-lg-12">Employer Contribution</h6>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="">EPF Employer</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                            </div>
                                            <input type="text" name="epfEmp" class="form-control calculate" id="epfEmp" value="0.00" aria-label="0.00">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">SOCSO Employer</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                            </div>
                                            <input type="text" name="socsoEMP" class="form-control calculate" id="socsoEMP" value="0.00" aria-label="0.00">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">SOCSO 2 Employer</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                            </div>
                                            <input type="text" name="socso2EMP" class="form-control calculate" id="socso2EMP" value="0.00" aria-label="0.00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-success float-right align-self-end" name="submit" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Footer -->
<?php require('../../elements/admin/dashboard/footer.php') ?>

<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        });
    });
</script>

<!-- Calculate that shit -->
<script>
    $(document).ready(function() {
        $(".calculate").change(function() {
            var basicSalary = parseFloat($('#basicSalary').val());
            var salesComm = parseFloat($('#salesComm').val());
            var epf = parseFloat($('#epf').val());
            var socso = parseFloat($('#socso').val());
            var socso2 = parseFloat($('#socso2').val());

            // Always shot for the stars
            var calculate1 = basicSalary + salesComm;
            var calculate2 = epf + socso + socso2;
            $("#totalEarn").val(calculate1 - calculate2);
        });
    });
</script>