<!-- Title -->
<?php $title = "New Item"; ?>

<!-- Header -->
<?php require('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php require('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/nav.php') ?>

<?php
// Get product details
$product = "SELECT * FROM homedecor_product2";
$resultproduct = mysqli_query($conn, $product);
$productSelectOptions = array();
while ($rowProduct = $resultproduct->fetch_assoc()) {
    $productSelectOptions[$rowProduct['id']] = $rowProduct['name'] . ' | ' . $rowProduct['itemId'];
}
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Items Management</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id="message">

            </div>
        </div>
    </div>
    <form action="#" method="POST" class="was-validated" novalidate>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add New Item</h6>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
                                <div class="row my-2">
                                    <div class="col-lg-12">
                                        <div class="form-group row">
                                            <label for="itemProduct" class="col-sm-1 col-form-label">Product Name</label>
                                            <div class="col-sm-3">
                                                <select name="itemProduct" id="itemProduct" class="selectpicker sku-create form-control" data-live-search="true" required>
                                                    <option value="">Select</option>
                                                    <?php foreach ($productSelectOptions as $val => $text) : ?>
                                                        <option value="<?= $val; ?>"><?= $text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="valid-feedback">Valid.</div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="itemSupplier" class="col-sm-1 col-form-label">Supplier</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="itemSupplier" id="itemSupplier" class="form-control" required readonly>
                                            </div>
                                            <label for="itemSupplier" class="col-sm-1 col-form-label">Item Code</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="itemCode" id="itemCode" class="form-control" required readonly>
                                            </div>
                                            <label for="itemSKU" class="col-sm-1 col-form-label">Item SKU</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="itemSKU" id="itemSKU" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-1 col-form-label">Cost THB</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="itemCostTHB" id="itemCostTHB" class="form-control" readonly>
                                            </div>
                                            <label for="" class="col-sm-1 col-form-label">Cost MYR</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="itemCostMYR" id="itemCostMYR" class="form-control" readonly>
                                            </div>
                                            <label for="" class="col-sm-1 col-form-label">Selling MYR</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="itemSellingMYR" id="itemSellingMYR" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-1 col-form-label">Quantity</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="itemQuantity" id="itemQuantity" class="form-control" required>
                                            </div>
                                            <label for="" class="col-sm-1 col-form-label">Available</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="itemAvailable" id="itemAvailable" class="form-control" required>
                                            </div>
                                            <label for="" class="col-sm-1 col-form-label">Defective</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="itemDefective" id="itemDefective" class="form-control" required>
                                            </div>
                                            <label for="" class="col-sm-1 col-form-label">Sold</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="itemSold" id="itemSold" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary float-right mx-2" id="submit">Submit</button>
                                        <button type="reset" class="btn btn-danger float-left mx-2" id="">Reset</button>
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
    // Product Info
    var $itemProduct = $("#itemProduct");
    var $itemSupplier = $("#itemSupplier");
    var $itemCostTHB = $("#itemCostTHB");
    var $itemCostMYR = $("#itemCostMYR");
    var $itemSellingMYR = $("#itemSellingMYR");
    var $itemCode = $("#itemCode");
    var $itemSKU = $("#itemSKU");

    var apiUrl = 'itemInfo.php';

    function refreshInputs(item) {
        $.post(apiUrl, {
            item: item
        }, function(r) {
            // Item Unique ID
            $itemSupplier.val(r.supplier);
            $itemCostTHB.val(r.costTHB);
            $itemCostMYR.val(r.costMYR);
            $itemSellingMYR.val(r.sellingMYR);
            $itemCode.val(r.supplier + '-' + r.itemCode.padStart(3, '0') + '-' + r.itemId);
            $itemSKU.val(r.itemCode + '-' + r.itemId + '-' + r.name.toUpperCase().substring(0, 3) + '-' + r.variation.toUpperCase() + '-' + r.size);
        });
    }

    $itemProduct.change(function() {
        var item = $(this).val();
        refreshInputs(item);
    });

    $(document).ready(function() {
        var itemProduct = $("#itemProduct").val();
        var itemQuantity = $("#itemQuantity").val();
        var itemAvailable = $("#itemAvailable").val();
        var itemDefective = $("#itemDefective").val();
        var itemSold = $("#itemSold").val();
        var itemStatus = $("#itemStatus").val();

        $("form").submit(function(event) {
            $(".form-group").removeClass("has-error");
            $(".text-danger").remove();

            var formData = {
                itemProduct: $("#itemProduct").val(),
                itemQuantity: $("#itemQuantity").val(),
                itemAvailable: $("#itemAvailable").val(),
                itemDefective: $("#itemDefective").val(),
                itemSold: $("#itemSold").val(),
            };

            $.ajax({
                type: "POST",
                url: "insertItem.php",
                data: formData,
                encode: true,
            }).done(function(data) {
                if (data.success = true) {
                    // console.log(data);
                    $("#message").html(
                        '<div class="alert alert-success">Item quantity succesfully inserted!</div>'
                    );
                    $("#message").fadeTo(4000, 500).slideUp(500, function() {
                        $("#message").slideUp(500);
                    });
                } else {
                    // console.log(data);
                    $("#message").html(
                        '<div class="alert alert-danger">Something went wrong.</div>'
                    );
                }
            }).fail(function(data) {
                $("#message").html(
                    '<div class="alert alert-danger">Could not reach server, please try again later.</div>'
                );
                $("#message").fadeTo(4000, 500).slideUp(500, function() {
                    $("#message").slideUp(500);
                });
            });
            event.preventDefault();
        });
    });
</script>