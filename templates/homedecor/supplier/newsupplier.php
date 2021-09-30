<!-- Title -->
<?php $title = "New Supplier" ?>

<!-- Header -->
<?php require '../../elements/admin/dashboard/header.php' ?>

<!-- Get DB conn -->
<?php require('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/nav.php') ?>

<!-- List all Suppliers -->
<?php
// Supplier goes here
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product Management</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <?php if (isset($_SESSION['status'])) : ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-<?= $_SESSION['alert'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['status'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php unset($_SESSION['status']);
    endif; ?>
    <form action="insertSupplier.php" class="was-validated">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">New Supplier</h6>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>