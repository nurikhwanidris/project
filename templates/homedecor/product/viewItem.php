<!-- Title -->
<?php $title = 'View Product | ' . $_GET['id'] ?>

<!-- Header -->
<?php require('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php require('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/nav.php') ?>

<!-- Get Source -->
<?php
$selectSource = "SELECT * FROM homedecor_category";
$resultSource = mysqli_query($conn, $selectSource);
?>

<!-- Get Product Details -->
<?php
$id = $_GET['id'];

// Select product
$selectProduct = "SELECT * FROM homedecor_product2 WHERE id = '$id'";
$resultSelectProduct = mysqli_query($conn, $selectProduct);
$rowProduct = mysqli_fetch_assoc($resultSelectProduct);

// Select item
$selectItem = "SELECT * FROM homedecor_item2 WHERE productId = '$id'";
$resultSelectItem = mysqli_query($conn, $selectItem);
$rowItem = mysqli_fetch_assoc($resultSelectItem);
?>

<!-- Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
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
    <div class="row">
        <!-- Update product details -->
        <div class="col-xl-6 col-lg-6">
            <form action="updateItem.php" method="POST" class="was-validated" novalidate enctype="multipart/form-data">
                <div class="col-lg-6 d-none">
                    <input type="text" name="id" id="id" class="form-control" value="<?= $_GET['id']; ?>">
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Update Product's Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="row form-group">
                                <label for="productId" class="col-sm-6 col-form-label">Product Last Modified</label>
                                <div class="col-sm-6">
                                    <input type="text" name="productId" class="form-control text-capitalize" id="productId" value="<?= $rowProduct['modified']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row" id="productId-group">
                                <label for="productId" class="col-sm-6 col-form-label">Product Id</label>
                                <div class="col-sm-6">
                                    <input type="text" name="productId" class="form-control text-capitalize" id="productId" value="<?= $rowProduct['itemId']; ?>">
                                </div>
                            </div>
                            <div class="form-group row" id="productName-group">
                                <label for="productName" class="col-sm-6 col-form-label">Product Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="productName" class="form-control text-capitalize" id="productName" value="<?= $rowProduct['name']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row" id="productSupplier-group">
                                <label for="productSupplier" class="col-sm-6 col-form-label">Supplier Name</label>
                                <div class="col-sm-6">
                                    <select name="productSupplier" id="productSupplier" class="form-control">
                                        <option value="">Select</option>
                                        <option value="JPUI" <?= ($rowProduct['supplier'] == 'JPUI') ? 'selected' : ''; ?>>Jpui</option>
                                        <option value="NEE" <?= ($rowProduct['supplier'] == 'NEE') ? 'selected' : ''; ?>>Nee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="productCategory-group">
                                <label for="productCategory" class="col-sm-6 col-form-label">Product Category</label>
                                <div class="col-sm-6">
                                    <select name="category" id="category" class="form-control" required>
                                        <option value="<?= $rowProduct['itemCode']; ?>"><?= $rowProduct['category']; ?></option>
                                        <?php while ($rowSource = mysqli_fetch_assoc($resultSource)) : ?>
                                            <option value="<?= $rowSource['id']; ?>"><?= $rowSource['name']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="productCategory-group">
                                <label for="productCategoryCode" class="col-sm-6 col-form-label">Category Code</label>
                                <div class="col-sm-6">
                                    <input type="text" name="productCategoryCode" id="productCategoryCode" class="form-control" value="<?= $rowProduct['itemCode']; ?>" readonly>
                                </div>
                                <label for="productCategory" class="col-sm-1 col-form-label d-none">Name</label>
                                <div class="col-sm-6 d-none">
                                    <input type="text" name="productCategory" id="productCategory" class="form-control" value="<?= $rowProduct['category']; ?>">
                                </div>
                            </div>
                            <div class="form-group row" id="productSize-group">
                                <label for="productSize" class="col-sm-6 col-form-label">Size</label>
                                <div class="col-sm-6">
                                    <input type="text" name="productSize" id="productSize" class="form-control" value="<?= $rowProduct['size']; ?>">
                                </div>
                            </div>
                            <div class="form-group row" id="productVariation-group">
                                <label for="productVariation" class="col-sm-6 col-form-label">Variation</label>
                                <div class="col-sm-6">
                                    <input type="text" name="productVariation" id="productVariation" class="form-control" value="<?= $rowProduct['variation']; ?>">
                                </div>
                            </div>
                            <div class="form-group row" id="productCostTHB-group">
                                <label for="productCostTHB" class="col-sm-6 col-form-label">Cost (THB)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="productCostTHB" id="productCostTHB" class="form-control" value="<?= $rowProduct['costTHB']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="productAfterDiscTHB" class="col-sm-6 col-form-label" id="">Disc (THB)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="productAfterDiscTHB" id="productAfterDiscTHB" class="form-control" value="<?= $rowProduct['discTHB']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row" id="productCostMYR-group">
                                <label for="productCostMYR" class="col-sm-6">Cost (MYR)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="productCostMYR" id="productCostMYR" class="form-control" value="<?= $rowProduct['costMYR']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row" id="productSellingMYR-group">
                                <label for="productSellingMYR" class="col-sm-6">Selling Price (MYR)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="productSellingMYR" id="productSellingMYR" class="form-control" value="<?= $rowProduct['sellingMYR']; ?>" required>
                                </div>
                                <!-- <label for="productProfitMYR" class="col-sm-1">Profit (MYR)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="productProfitMYR" id="productProfitMYR" class="form-control" readonly <?= $rowProduct['profitMYR']; ?>>
                                </div> -->
                            </div>
                            <?php if ($rowProduct['img'] == '') : ?>
                                <div class="form-group row" id="productImg-group">
                                    <label for="" class="col-sm-6">Product Image</label>
                                    <div class="col-sm-6">
                                        <input type='file' id="productImg" name="productImg" class="form-control" accept="image/x-png,image/gif,image/jpeg">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <img id="preview" src="#" alt="image will display here" class="img-thumbnail" style="margin-bottom: 10px;">
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="form-group row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <img id="preview" src="/project/upload/img/product/2021/<?= $rowProduct['img']; ?>" alt="image will display here" class="img-thumbnail" style="margin-bottom: 10px;">
                                    </div>
                                </div>
                                <div class="row form-group d-none">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="productImgValue" value="<?= $rowProduct['img']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <input type='file' id="productImgUpdate" name="productImgUpdate" class="form-control" accept="image/jpeg" value="">
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-info float-right shadow-sm shadow">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Update item quantity -->
        <div class="col-xl-6 col-lg-6">
            <form method="POST">
                <input type="text" name="id" id="id" class="form-control d-none" value="<?= $_GET['id']; ?>">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Update Item's Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="row form-group">
                                <label for="productId" class="col-sm-6 col-form-label">Item Last Modified</label>
                                <div class="col-sm-6">
                                    <input type="text" name="modified" class="form-control text-capitalize" id="modified" value="<?= $rowItem['modified']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="itemQuantity" class="col-sm-6 col-form-label">Item Quantity Received</label>
                                <div class="col-sm-6">
                                    <input type="text" name="itemQuantity" id="itemQuantity" class="form-control" value="<?= $rowItem['itemQuantity']; ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="itemAvailable" class="col-sm-6 col-form-label">Item Available</label>
                                <div class="col-sm-6">
                                    <input type="text" name="itemAvailable" id="itemAvailable" class="form-control" value="<?= $rowItem['itemAvailable']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="itemDefect" class="col-sm-6 col-form-label">Item Defect</label>
                                <div class="col-sm-6">
                                    <input type="text" name="itemDefect" id="itemDefect" class="form-control" value="<?= $rowItem['itemDefective']; ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-sm-6 col-form-label">Item Sold</label>
                                <div class="col-sm-6">
                                    <input type="text" name="itemSold" id="itemSold" class="form-control" value="<?= $rowItem['itemSold']; ?>">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <button type="button" id="saveItem" class="btn btn-info float-right shadow-sm shadow">Save</button>
                                </div>
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

<script>
    $(document).ready(function() {
        // Get value from selected option
        $("#category").change(function() {
            var categoryID = $("#category option:selected").val();
            var categoryName = $("#category option:selected").text();
            $("#productCategoryCode").val(categoryID);
            $("#productCategory").val(categoryName);
        });

        // Convert THB to MYR
        $("#productCostTHB").change(function() {
            // Pull the variable from id
            var productCostTHB = $("#productCostTHB").val();

            // Calculate the cost in MYR
            var afterDiscTHB = productCostTHB * 0.8;
            var productCostMYR = ((afterDiscTHB / 100) * 15).toFixed(2);
            var productSellingMYR = ((productCostMYR * 2.5) + 6 + 10).toFixed(0);
            var productProfitMYR = productSellingMYR - productCostMYR;

            // Display the data
            $("#productAfterDiscTHB").val(afterDiscTHB);
            $("#productCostMYR").val(productCostMYR);
            $("#productSellingMYR").val(productSellingMYR);
            $("#productProfitMYR").val(productProfitMYR);
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#productImg").change(function() {
        readURL(this);
    });

    $(document).on("click", "#saveItem", function(event) {
        var itemData = {
            id: $("#id").val(),
            itemQuantity: $("#itemQuantity").val(),
            itemAvailable: $("#itemAvailable").val(),
            itemDefect: $("#itemDefect").val(),
            itemSold: $("#itemSold").val(),
        };

        $.ajax({
            type: "POST",
            url: "updateItem2.php",
            data: itemData,
            dataType: "JSON",
            encode: true,
            success: function(response) {
                var jsonData = response;

                if (jsonData = 1) {
                    alert("Successfully update the item details");
                } else {
                    alert("Error occured");
                }
            }
        });
    })
</script>