<!-- Title -->
<?php $title = "Add New Inventory"; ?>

<!-- Header -->
<?php require('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php require('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/nav.php') ?>

<!-- Save tje item -->
<?php

if (isset($_POST['submit'])) {

    //Get the item
    $itemName = $_POST['itemName'];
    $itemCategory = $_POST['itemCategory'];
    $itemSupplier = $_POST['itemSupplier'];
    $itemBrand = $_POST['itemBrand'];
    $itemDescription = $_POST['itemDescription'];

    // Date created and modified
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $created = date('Y-m-d H:i:s');
    $modified = date('Y-m-d H:i:s');

    // Insert into the table
    $insert = "INSERT INTO homedecor_item (itemName, itemCategory, itemSupplier, itemBrand, itemDescription, created, modified) VALUES ('$itemName', '$itemCategory', '$itemSupplier', '$itemBrand', '$itemDescription', '$created', '$modified')";
    $result = mysqli_query($conn, $insert);

    if ($result) {
        $msg = "Succesfully inserted the item";
        $alert = "success";
    } else {
        $msg = "Error occcured. " . mysqli_error($conn);
        $alert = "danger";
    }
}

?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Item</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <?php if (isset($msg)) : ?>
        <div class="row mt-3 d-print-none">
            <div class="col-lg-6 col-xl-6">
                <div class="alert alert-<?= $alert; ?> alert-dismissible fade show" role="alert">
                    <?= $msg; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-6 col-xl-6">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" class="form-group" method="POST">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Item Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-lg-12">
                                <label for="">Name</label>
                                <input type="text" name="itemName" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg-4">
                                <label for="">Category</label>
                                <input type="text" name="itemCategory" id="" class="form-control">
                            </div>
                            <div class="col-lg-4">
                                <label for="">Supplier</label>
                                <select name="itemSupplier" id="" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Advanco">Advanco</option>
                                    <option value="Shopee">Shopee</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="">Brand</label>
                                <input type="text" name="itemBrand" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg-12">
                                <label for="">Description</label>
                                <textarea name="itemDescription" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <button class="btn btn-success float-right" name="submit" onclick="return confirm('Click Ok if everything is right');">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<?php require('../../elements/admin/dashboard/footer.php') ?>