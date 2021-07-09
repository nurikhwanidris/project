<!-- Title -->
<?php $title = 'New Item' ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product Management</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <form action="save-product.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">New Product</h6>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
                                <div class="form-group row">
                                    <label for="itemName" class="col-sm-2 col-form-label">Item Group Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="itemName" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="itemDesc" class="col-sm-2 col-form-label">Item Description</label>
                                    <div class="col-sm-6">
                                        <textarea name="itemDesc" id="itemDesc" cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="itemUnit" class="col-sm-2 col-form-label">Unit</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="itemUnit" id="itemUnit" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="itemSupplier" class="col-sm-2 col-form-label">Supplier</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="itemSupplier" id="itemSupplier" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="itemVariant" class="col-sm-2 col-form-label">Variant</label>
                                    <div class="col-sm-4 align-middle">
                                        <div class="form-check align-middle">
                                            <input class="form-check-input" type="checkbox" value="" id="itemVariant" checked>
                                            <label class="form-check-label" for="itemVariant">
                                                Check if item has more than 1 variant
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" id="rowVariant">
                                    <div class="col-sm-2 clearfix"></div>
                                    <div class="col-sm-2">
                                        <input type="text" name="itemVariant1" id="itemVariant1" class="form-control" placeholder="eg: Color">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name="variant" id="variant" class="form-control" placeholder="eg: Red, Green, Blue">
                                    </div>
                                    <div class="col-sm-1">
                                        <a href="#" class="btn btn-danger" id="removeVariant"><i class="fas fa-minus-circle"></i></a>
                                    </div>
                                </div>
                                <div id="appendHere"></div>
                                <div class="form-group row">
                                    <div class="col-sm-2 clearfix"></div>
                                    <div class="col-sm-3">
                                        <a href="#" id="addVariant"><i class="fas fa-plus-circle fa-xs"></i> Add more variant</a>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-12">
                                        <table class="table table-hover table-bordered table-sm">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="text-left align-middle">
                                                        Item Name
                                                    </th>
                                                    <th class="text-center align-middle">
                                                        Item Code
                                                    </th>
                                                    <th class="text-center align-middle">
                                                        Cost Per Unit
                                                    </th>
                                                    <th class="text-center align-middle">
                                                        Selling Price
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
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

<script>
    $(document).ready(function() {
        var count = 1;
        $("#addVariant").click(function() {
            if (count < 10) {
                // Create tabel rows
                var markup = '<div class="form-group row nextRow" id="rowVariant"><div class="col-sm-2 clearfix"></div><div class="col-sm-2"><input type="text" name="itemVariant1" id="itemVariant1" class="form-control" placeholder="eg: color"></div><div class="col-sm-3"><input type="text" name="variant[]" id="variant" class="form-control" placeholder="eg: Red, Green, Blue"></div><div class="col-sm-1"><a href="#" class="btn btn-danger closebtn" id="removeVariant"><i class="fas fa-minus-circle"></i></a></div></div>';
                $("#appendHere").append(markup);

                count++;
            }
        });

        $("#removeVariant").click(function() {
            $(this).parents("rowVariant").remove();
        })
    });
</script>