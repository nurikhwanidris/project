<!-- Title -->
<?php $title = "Add New Inventory"; ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Item</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" class="form-group">
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
                        <hr>
                        <h6 class="text-info">In</h6>
                        <div class="row my-2">
                            <div class="col-lg-6">
                                <label for="">Cost</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">RM</span>
                                    </div>
                                    <input type="text" name="itemCost" id="" class="form-control" data-toggle="tooltip" data-placement="top" title="Cost must include shipping">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row my-2">
                            <div class="col-lg-6">
                                <label for="">Quantity</label>
                                <input type="number" name="itemQtyIn" id="" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="">In (Date)</label>
                                <input type="date" name="itemInDate" id="" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <h6 class="text-info">Out</h6>
                        <div class="row my-2">
                            <div class="col-lg-6">
                                <label for="">Quantity</label>
                                <input type="number" name="itemQtyOut" id="" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Out (Date)</label>
                                <input type="date" name="itemOutDate" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <button class="btn btn-success float-right" onclick="return confirm('Click Ok if everything is right');">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-8 col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Item Summary</h6>
                </div>
                <div class="card-body">
                    <div class="col-lg-12" style="height: 400px; overflow-y: scroll;">
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center align-middle">#</th>
                                    <th class="text-center align-middle">In (Date)</th>
                                    <th class="text-center align-middle">Qty</th>
                                    <th class="text-center align-middle">Out (Date)</th>
                                    <th class="text-center align-middle">Qty</th>
                                    <th class="text-center align-middle">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">07/04/2021</td>
                                    <td class="text-center align-middle">10</td>
                                    <td class="text-center align-middle">19/04/2021</td>
                                    <td class="text-center align-middle">4</td>
                                    <td class="text-center align-middle">20</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>