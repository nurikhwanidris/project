<!-- Title -->
<?php $title = "Add Payment Voucher" ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Payment Voucher</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <form action="save-pv.php" method="post">
        <div class="row">
            <div class="col-lg-10">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add PV</h6>
                    </div>
                    <div class="card-body">
                        <div class="row my-2 clearfix">
                            <div class="col-lg-6">
                                <label for="">Payable to</label>
                                <input type="text" name="payTo" id="" class="form-control">
                            </div>
                            <div class="col-lg-3">
                                <label for="">Account Number</label>
                                <input type="text" name="numAcc" id="" class="form-control">
                            </div>
                            <div class="col-lg-3">
                                <label for="">Bank</label>
                                <select name="bankAcc" id="" class="form-control">
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
                        <div class="row my-2 clearfix">
                            <div class="col-lg-8">
                                <label for="">Payment Description</label>
                                <input type="text" name="Description" id="" class="form-control">
                            </div>
                            <div class="col-lg-2">
                                <label for="">Amount</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="00.00" aria-label="Amount" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-lg-2 ">
                                <label for="">&nbsp;</label>
                                <div class="form-group col-md-12 align-self-end">
                                    <button class="btn btn-primary" id="btn" name="btn" type="button"><i class="far fa-plus-square"></i> Add</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row my-2 clearfix">
                            <div class="col-lg-12">
                                <div class="row my-2">
                                    <div class="col-lg-10">
                                        <label for="">Output</label>
                                        <table class="table table-stripped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle text-center">/</th>
                                                    <th class="align-middle text-center">Product ID</th>
                                                    <th class="align-middle" style="width: 60%;">Product Name</th>
                                                    <th class="align-middle text-center">Quantity</th>
                                                    <th class="align-middle text-center">Price</th>
                                                    <th class="align-middle text-center">Discount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-2 ">
                                        <label for="">&nbsp;</label>
                                        <div class="form-group col-md-12 align-self-end">
                                            <button type="button" class="btn btn-danger delete-row"><i class="far fa-trash-alt"></i> Delete</button>
                                        </div>
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