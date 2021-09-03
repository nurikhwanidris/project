<!-- Title -->
<?php $title = "Settings for Accounting" ?>

<!-- Header -->
<?php require('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php require('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/nav.php') ?>

<!-- Get PV categories -->
<?php
$pvCat = "SELECT * FROM homedecor_pv_category";
$resCat = mysqli_query($conn, $pvCat);
?>

<!-- Add new category -->
<?php
if (isset($_POST['addCategory'])) {
    $nameCategory = mysqli_real_escape_string($conn, $_POST['nameCategory']);

    // Date created and modified
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $created = date('Y-m-d H:i:s');
    $modified = date('Y-m-d H:i:s');

    // Check for existing name
    $check = "SELECT * FROM homedecor_pv_category WHERE name = '$nameCategory'";
    $resultCheck = mysqli_query($conn, $check);
    $rowCheck = mysqli_fetch_row($resultCheck);

    if ($rowCheck >= 0) {
        // Add that shit
        $insertCat = "INSERT INTO homedecor_pv_category (name, created, modified) VALUES ('$nameCategory', '$created', '$modified')";
        $resultInsertCat = mysqli_query($conn, $insertCat);

        if ($resultInsertCat) {
            $msg = "Succesfully created a new category";
            $alert = "success";
        } else {
            $msg = "Error occured " . mysqli_error($conn);
            $alert = "danger";
        }
    } else {
        $msg = "Error occured " . mysqli_error($conn);
        $alert = "danger";
    }
}
if (isset($_GET['dlt'])) {
    $dlt = $_GET['dlt'];

    // Dlete from table
    $dlete = "DELETE FROM homedecor_pv_category WHERE id = '$dlt'";
    $resdlt = mysqli_query($conn, $dlete);

    if ($resdlt) {
        $msg = "Succesfully deleted the category";
        $alert = "success";
    } else {
        $msg = "Error occured " . mysqli_error($conn);
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
        <h1 class="h3 mb-0 text-gray-800">Settings</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Settings</h6>
                </div>
                <div class="card-body">
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" onSubmit="if(!confirm('Adding new category?')){return false;}">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nameCategory" id="categories">
                                        <datalist list="categories">
                                            <?php
                                            $rows = array();
                                            while ($rowPV = mysqli_fetch_array($resCat)) :
                                                $rows[] = $rowPV;
                                            ?>
                                                <option value="<?= $rowPV['name']; ?>">
                                                <?php endwhile; ?>
                                        </datalist>
                                    </div>
                                    <div class="col-sm-1">
                                        <button class="btn btn-primary" type="submit" name="addCategory">Add</button>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-info" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="false" aria-controls="#collapseCategory" type="button">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row collapse" id="collapseCategory">
                            <div class="col-lg-6">
                                <div class="table">
                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="align-middle text-center">/</th>
                                                <th class="align-middle">Category</th>
                                                <th class="align-middle text-center">Created</th>
                                                <th class="align-middle text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rows as $rowPV) : ?>
                                                <tr>
                                                    <td class="align-middle text-center"><input type="checkbox" name="delete" id=""></td>
                                                    <td class="align-middle"><?= $rowPV['name']; ?></td>
                                                    <td class="align-middle text-center"><?= $rowPV['created']; ?></td>
                                                    <td class="align-middle text-center"><a href="settings?dlt=<?= $rowPV['id']; ?>" class="btn btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt"></i></a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" class="d-none">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Bank</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nameBank" id="categories">
                                        <datalist list="categories">
                                            <?php
                                            $rows = array();
                                            while ($rowPV = mysqli_fetch_array($resCat)) :
                                                $rows[] = $rowPV;
                                            ?>
                                                <option value="<?= $rowPV['name']; ?>">
                                                <?php endwhile; ?>
                                        </datalist>
                                    </div>
                                    <div class="col-sm-1">
                                        <button class="btn btn-primary" type="submit" name="addBank">Add</button>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-info" data-toggle="collapse" data-target="#collapseBank" aria-expanded="false" aria-controls="#collapseBank" type="button">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row collapse" id="collapseBank">
                            <div class="col-lg-6">
                                <div class="table">
                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                            <tr>
                                                <th>/</th>
                                                <th>Bank</th>
                                                <th>Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rows as $rowPV) : ?>
                                                <tr>
                                                    <td><input type="checkbox" name="delete" id=""></td>
                                                    <td><?= $rowPV['name']; ?></td>
                                                    <td><?= $rowPV['created']; ?></td>
                                                    <td><a href="settings?dlt=<?= $rowPV['id']; ?>" class="btn btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt"></i></a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php require('../../elements/admin/dashboard/footer.php') ?>