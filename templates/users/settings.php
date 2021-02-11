<!-- Header -->
<?php include('../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../elements/admin/dashboard/nav.php') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employee Profile</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <?php if (isset($_POST['submit'])) : ?>
        <div class="row">
            <div class="col-lg-12">
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
        <div class="col-lg-12 col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="font-weight-bold text-primary">Settings</h6>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active">
                            <h6 class="font-weight-bold text-info">Change Password</h6>
                            <div class="row my-2">
                                <div class="col-lg-3">
                                    label.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include('../elements/admin/dashboard/footer.php') ?>