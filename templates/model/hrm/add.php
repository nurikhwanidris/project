<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customers Management</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <form action="save-customer.php" method="POST">
        <div class="row">
            <div class="col xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="font-weight-bold text-primary">Add Employee</h6>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active">
                                <h6 class="font-weight-bold text-info">Basic Information</h6>
                                <div class="row my-2">
                                    <div class="col-6">
                                        <label for="">Name</label>
                                        <input type="text" name="" id="" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label for="">Employee ID</label>
                                        <input type="text" name="" id="" class="form-control" readonly value="1001">
                                    </div>
                                    <div class="col-3">
                                        <label for="">Employee Image</label>
                                        <input type='file' id="imgInp" name="img-save" class="form-control" accept="image/x-png,image/gif,image/jpeg">
                                    </div>
                                </div>
                                <hr>
                                <h6 class="font-weight-bold text-info">Login Information</h6>
                                <div class="row my-2">
                                    <div class="col-4">
                                        <label for="">Username</label>
                                        <input type="text" name="" id="" class="form-control">
                                    </div>
                                    <div class="col-4">
                                        <label for="">Password</label>
                                        <input type="password" name="" id="" class="form-control">
                                    </div>
                                    <div class="col-4">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name="" id="" class="form-control">
                                    </div>
                                </div>
                                <hr>
                                <h6 class="font-weight-bold text-info">Contact Info</h6>
                                <div class="row my-2">
                                    <div class="col-4">
                                        <label for="">Phone</label>
                                        <input type="text" name="" id="" class="form-control">
                                    </div>
                                    <div class="col-4">
                                        <label for="">Email</label>
                                        <input type="email" name="" id="" class="form-control">
                                    </div>
                                </div>
                                <hr>
                                <h6 class="font-weight-bold text-info">Residence</h6>
                                <div class="row my-2">
                                    <div class="col-3">
                                        <label for="">Address</label>
                                        <input type="text" name="" id="" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label for="">Postcode</label>
                                        <input type="text" name="" id="" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label for="">City</label>
                                        <input type="text" name="" id="" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label for="">State</label>
                                        <input type="text" name="" id="" class="form-control">
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
<?php include('../../elements/admin/dashboard/footer.php') ?>