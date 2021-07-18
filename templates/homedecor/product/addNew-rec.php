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
                                        <input type="text" class="form-control" id="itemName" value="Default">
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
                                        <input type="text" name="variantType" id="variantType" class="form-control" placeholder="eg: Size">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name="size" id="size" class="form-control variant" placeholder="eg: 8, 9, 10">
                                    </div>
                                </div>
                                <div class="form-group row" id="rowVariant">
                                    <div class="col-sm-2 clearfix"></div>
                                    <div class="col-sm-2">
                                        <input type="text" name="variantType" id="variantType" class="form-control" placeholder="eg: Color">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name="color" id="color" class="form-control variant" placeholder="eg: Red, Green, Blue">
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
                                                        Cost (THB)
                                                    </th>
                                                    <th class="text-center align-middle">
                                                        Cost (MYR)
                                                    </th>
                                                    <th class="text-center align-middle">
                                                        Selling Price (MYR)
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

        $("input.variant").change(function() {
            var itemName = $("#itemName").val();
            var itemSupplier = $("#itemSupplier").val();
            var variantType = $("#variantType").val();
            var color = $("#color").val();
            var size = $("#size").val();

            // Check if value of size is empty or not
            if (color !== '' && size !== '') {
                // split the value
                var splitSize = size.split(',');
                var splitColor = color.split(',');

                splitSize.forEach((item, index) => {
                    // Create SKU
                    var itemSku = itemName.substring(0, 3) + '/' + item;

                    var pattern = "000"
                    var key = index + 1;

                    var rows = '<tr id="key' + index + '"><td class="text-left align-middle">' + itemName + ' - ' + item + ' - ' + splitColor[index] + '</td><td class="text-center align-middle">' + itemSku + '/' + (pattern + key).slice(-3) + '</td><td class="text-center align-middle"><input type="text" class="getTHB form-control border-0 text-center" name="itemCostThb[]" id="costTHB' + index + '"></td><td class="text-center align-middle"><input type="text" class="form-control border-0 text-center" name="itemCostMyr" id="costMYR' + index + '" readonly></td><td><input type="text" class="form-control border-0 text-center" name="itemSellingMyr[]" id="sellingMYR' + index + '"></td></tr>';
                    $("table tbody").append(rows);
                });

            } else if (size !== '') {
                // split the value
                var splitSize = size.split(',');

                splitSize.forEach((item, index, arr) => {
                    // Create SKU
                    var itemSku = itemName.substring(0, 3) + '/' + item;

                    var index = 1;

                    var pattern = "000"
                    var key = index + 1;

                    var rows = '<tr id="key' + index + '"><td class="text-left align-middle">' + itemName + ' - ' + item + '</td><td class="text-center align-middle">' + itemSku + '/' + (pattern + key).slice(-3) + '</td><td class="text-center align-middle"><input type="text" class="getTHB form-control border-0 text-center" name="itemCostThb[]" id="costTHB' + index + '"></td><td class="text-center align-middle"><input type="text" class="form-control border-0 text-center" name="itemCostMyr" id="costMYR' + index + '" readonly></td><td><input type="text" class="form-control border-0 text-center" name="itemSellingMyr[]" id="sellingMYR' + index + '"></td></tr>';
                    $("table tbody").append(rows);

                    alert(index);
                });
            } else {
                // split the value
                var splitValue = color.split(',');

                splitValue.forEach((item, index, arr) => {
                    // Create SKU
                    var itemSku = itemName.substring(0, 3) + '/' + item.substring(0, 3);
                    var pattern = "000"
                    var key = index + 1;

                    var rows = '<tr id="key' + index + '"><td class="text-left align-middle">' + itemName + ' - ' + item + '</td><td class="text-center align-middle">' + itemSku + '/' + (pattern + key).slice(-3) + '</td><td class="text-center align-middle"><input type="text" class="getTHB form-control border-0 text-center" name="itemCostThb[]" id="costTHB' + index + '"></td><td class="text-center align-middle"><input type="text" class="form-control border-0 text-center" name="itemCostMyr" id="costMYR' + index + '" readonly></td><td><input type="text" class="form-control border-0 text-center" name="itemSellingMyr[]" id="sellingMYR' + index + '"></td></tr>';
                    $("table tbody").append(rows);
                });
            }
        });

        $("body").on("change", ".getTHB", function() {

            var i = $(this).attr("id").replace(/costTHB/, '');

            var costTHB = $("#costTHB" + i).val();

            // Calculate that shit
            var discTHB = (costTHB * .8);
            var costMYR = (discTHB / 100) * 15;
            var sellingMYR = (costMYR * 2.5) + 6 + 10;

            $("#costMYR" + i).val(costMYR);
            $("#sellingMYR" + i).val(sellingMYR);
        })
    });
</script>