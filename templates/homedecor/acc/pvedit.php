<!-- Title -->
<?php $title = "Edit Payment Voucher" ?>

<!-- Header -->
<?php require('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php require('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/nav.php') ?>

<?php
// Get data
$id = $_GET['edit'];

$select = "SELECT * FROM homedecor_pv WHERE id = '$id'";
$res = mysqli_query($conn, $select);
$rowPV = mysqli_fetch_assoc($res);

// Explode certain stuffs
$descriptions = explode(',', $rowPV['description']);
$categories = explode(',', $rowPV['category']);
$amounts = explode(',', $rowPV['amount']);

?>

<?php
if (isset($_POST['submit'])) {
    // Fetch the parameters
    $payTo = $_POST['payTo'];
    $accBank = $_POST['accBank'];
    $staffName = $_POST['staffName'];
    $pvNum = $_POST['pvNum'];

    // Implode
    $description = implode(',', $_POST['description']);
    $amount = implode(',', $_POST['amount']);
    $category = implode(',', $_POST['category']);

    // Date created and modified
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $created = date('Y-m-d H:i:s');
    $modified = date('Y-m-d H:i:s');

    // Sanitize bank acc
    $accNum = $_POST['accNum'];
    $sanitizeAccNum = preg_replace('/[^0-9]/', '', $accNum);

    // Insert into the table
    $update = "UPDATE homedecor_pv SET pvNum = '$pvNum', payTo = '$payTo', accNum = '$sanitizeAccNum', accBank = '$accBank', description = '$description', amount = '$amount', category = '$category', modified = '$modified' WHERE id = '$id'";
    $result = mysqli_query($conn, $update);

    if ($result) {
        $msg = "Succesfully saved the PV";
        $alert = "success";
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
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" onSubmit="if(!confirm('Is the form filled out correctly?')){return false;}">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Payment Voucher</h6>
                    </div>
                    <div class="card-body">
                        <div class="row my-2 clearfix">
                            <div class="col-lg-3">
                                <label for="">PV Number</label>
                                <input type="text" name="pvNum" id="" class="form-control" value="<?= $rowPV['pvNum']; ?>">
                            </div>
                        </div>
                        <div class="row my-2 clearfix">
                            <div class="col-lg-6">
                                <label for="">Payable to</label>
                                <input type="text" name="payTo" id="" class="form-control" value="<?= $rowPV['payTo']; ?>">
                                <input type="text" name="staffName" id="" class="form-control d-none" value="<?= $row['fName']; ?>" readonly>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Account Number</label>
                                <input type="text" name="accNum" id="" class="form-control" value="<?= $rowPV['accNum']; ?>">
                            </div>
                            <div class="col-lg-3">
                                <label for="">Bank</label>
                                <select name="accBank" id="" class="form-control">
                                    <option value="">Select</option>
                                    <option value="ABB" <?= ($rowPV['accBank'] == 'ABB' ? 'selected' : '') ?>>Affin Bank Berhad</option>
                                    <option value="AGRO" <?= ($rowPV['accBank'] == 'AGRO' ? 'selected' : '') ?>>Agro Bank</option>
                                    <option value="ABMB" <?= ($rowPV['accBank'] == 'ABMB' ? 'selected' : '') ?>>Alliance Bank Malaysia Berhad</option>
                                    <option value="BIMB" <?= ($rowPV['accBank'] == 'BIMB' ? 'selected' : '') ?>>Bank Islam Malaysia Berhad</option>
                                    <option value="BKRM" <?= ($rowPV['accBank'] == 'BKRM' ? 'selected' : '') ?>>Bank Kerjasama Rakyat Malaysia</option>
                                    <option value="CIMB" <?= ($rowPV['accBank'] == 'CIMB' ? 'selected' : '') ?>>CIMB Malaysia Berhad</option>
                                    <option value="CITI" <?= ($rowPV['accBank'] == 'CITI' ? 'selected' : '') ?>>Citibank Berhad</option>
                                    <option value="HSBC" <?= ($rowPV['accBank'] == 'HSBC' ? 'selected' : '') ?>>HSBC Bank Berhad</option>
                                    <option value="MBB" <?= ($rowPV['accBank'] == 'MBB' ? 'selected' : '') ?>>Malayan Banking Berhad</option>
                                    <option value="OCBC" <?= ($rowPV['accBank'] == 'OCBC' ? 'selected' : '') ?>>OCBC Bank Malaysia Berhad</option>
                                    <option value="PBB" <?= ($rowPV['accBank'] == 'PBB' ? 'selected' : '') ?>>Public Bank Berhad</option>
                                    <option value="RHB" <?= ($rowPV['accBank'] == 'RHB' ? 'selected' : '') ?>>RHB Bank Berhad</option>
                                    <option value="SCB" <?= ($rowPV['accBank'] == 'SCB' ? 'selected' : '') ?>>Standard Chartered Bank Malaysia Berhad</option>
                                    <option value="UOB" <?= ($rowPV['accBank'] == 'UOB' ? 'selected' : '') ?>>United Overseas Bank</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-2 clearfix">
                            <div class="col-lg-7">
                                <label for="">Payment Description</label>
                                <input type="text" id="description" class="form-control clear" placeholder="Write something here">
                            </div>
                            <div class="col-lg-2">
                                <label for="">Category</label>
                                <select id="category" class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                    $resultAsd = mysqli_query($conn, "SELECT * FROM homedecor_pv_category");
                                    while ($rowCategory = mysqli_fetch_array($resultAsd)) :
                                    ?>
                                        <option value="<?= $rowCategory['name']; ?>"><?= $rowCategory['name']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Amount</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                    </div>
                                    <input type="text" id="amount" class="form-control clear" placeholder="00.00" aria-label="Amount" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-lg-1 ">
                                <label for="">&nbsp;</label>
                                <div class="form-group col-md-12 align-self-end">
                                    <button class="btn btn-info float-right add-row" id="btn" name="btn" type="button"><i class="far fa-plus-square"></i></button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row my-2 clearfix">
                            <div class="col-lg-12">
                                <div class="row my-2">
                                    <div class="col-lg-10">
                                        <label for="">Output</label>
                                        <table class="table table-stripped table-bordered table-md">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle text-center" style="width: 5%;">/</th>
                                                    <th class="align-middle" style="width: 60%;">Decription</th>
                                                    <th class="align-middle text-center" style="width: 20%;">Category</th>
                                                    <th class="align-middle text-center">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                for ($i = 0; $i < count($categories); $i++) :
                                                    $description = $descriptions[$i];
                                                    $category = $categories[$i];
                                                    $amount = $amounts[$i];
                                                ?>
                                                    <tr>
                                                        <td class='align-middle text-center'>
                                                            <input type='checkbox' name='record'>
                                                        </td>
                                                        <td class='align-middle text-left'>
                                                            <input type='text' name='description[]' value="<?= $description; ?>" class='border-0 text-left form-control' />
                                                        </td>
                                                        <td>
                                                            <input type='text' name='category[]' value="<?= $category; ?>" class='border-0 text-center form-control' />
                                                        </td>
                                                        <td>
                                                            <input name='amount[]' class='text-center align-middle form-control border-0' value="<?= $amount; ?>" />
                                                        </td>
                                                    </tr>
                                                <?php endfor; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">&nbsp;</label>
                                        <div class="form-group col-md-12 align-self-end">
                                            <button type="button" class="btn btn-danger delete-row float-right mx-0"><i class="far fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clear-fix">
                            <div class="col-lg-10">
                                <div class="row my-2">
                                    <div class="col-lg-12">
                                        <button class="btn btn-success float-right align-self-end" name="submit" type="submit">Submit</button>
                                    </div>
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
<?php require('../../elements/admin/dashboard/footer.php') ?>

<script>
    // Give it a meaning
    $(document).ready(function() {
        $(".add-row").click(function() {

            // Declare that shit
            var description = $('#description').val();
            var amount = parseFloat($('#amount').val());
            var category = $('#category').val();

            // Create table rows
            var markup = "<tr><td class='align-middle text-center'><input type='checkbox' name='record'><td class='align-middle text-left'><input type='text' name='description[]' value='" + description + "' class='border-0 text-left form-control'/></td><td><input type='text' name='category[]' value='" + category + "' class='border-0 text-center form-control'/></td><td><input name='amount[]' class='text-center align-middle form-control border-0' value='" + amount.toFixed(2) + "' /></td></tr>";
            $("table tbody").append(markup);

            // Clear all values after insert
            var clear = $('.clear').val('');
        });

        // Find and remove selected table rows
        $(".delete-row").click(function() {
            $("table tbody").find('input[name="record"]').each(function() {
                if ($(this).is(":checked")) {
                    $(this).parents("tr").remove();
                }
            });
        });
    });
</script>