<!-- Title -->
<?php $title = 'View Product | ' . $_GET['id'] ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Get Source -->
<?php
$selectSource = "SELECT * FROM homedecor_category";
$resultSource = mysqli_query($conn, $selectSource);
?>

<!-- Get Product Details -->
<?php
$id = $_GET['id'];
$selectProduct = "SELECT * FROM homedecor_product2 WHERE id = '$id'";
$resultSelectProduct = mysqli_query($conn, $selectProduct);
$rowProduct = mysqli_fetch_assoc($resultSelectProduct);
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
    <form action="updateProduct.php" method="POST" class="was-validated" novalidate enctype="multipart/form-data">
        <div class="row d-none">
            <div class="col-lg-12">
                <input type="text" name="id" id="id" class="form-control" value="<?= $_GET['id']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Update Product</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="row form-group">
                                <label for="productId" class="col-sm-2 col-form-label">Last Modified on</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productId" class="form-control text-capitalize" id="productId" value="<?= $rowProduct['modified']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row" id="productId-group">
                                <label for="productId" class="col-sm-2 col-form-label">Product Id</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productId" class="form-control text-capitalize" id="productId" value="<?= $rowProduct['itemId']; ?>">
                                </div>
                            </div>
                            <div class="form-group row" id="productName-group">
                                <label for="productName" class="col-sm-2 col-form-label">Product Name</label>
                                <div class="col-sm-4">
                                    <input type="text" name="productName" class="form-control text-capitalize" id="productName" value="<?= $rowProduct['name']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row" id="productSupplier-group">
                                <label for="productSupplier" class="col-sm-2 col-form-label">Supplier Name</label>
                                <div class="col-sm-4">
                                    <select name="productSupplier" id="productSupplier" class="form-control">
                                        <option value="">Select</option>
                                        <option value="JPUI" <?= ($rowProduct['supplier'] == 'JPUI') ? 'selected' : ''; ?>>Jpui</option>
                                        <option value="NEE" <?= ($rowProduct['supplier'] == 'NEE') ? 'selected' : ''; ?>>Nee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="productCategory-group">
                                <label for="productCategory" class="col-sm-2 col-form-label">Product Category</label>
                                <div class="col-sm-2">
                                    <select name="category" id="category" class="form-control" required>
                                        <option value="<?= $rowProduct['itemCode']; ?>"><?= $rowProduct['category']; ?></option>
                                        <?php while ($rowSource = mysqli_fetch_assoc($resultSource)) : ?>
                                            <option value="<?= $rowSource['id']; ?>"><?= $rowSource['name']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <label for="productCategoryCode" class="col-sm-1 col-form-label">Category Code</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productCategoryCode" id="productCategoryCode" class="form-control" value="<?= $rowProduct['itemCode']; ?>" readonly>
                                </div>
                                <label for="productCategory" class="col-sm-1 col-form-label d-none">Name</label>
                                <div class="col-sm-2 d-none">
                                    <input type="text" name="productCategory" id="productCategory" class="form-control" value="<?= $rowProduct['category']; ?>">
                                </div>
                            </div>
                            <div class="form-group row" id="productSize-group">
                                <label for="productSize" class="col-sm-2 col-form-label">Size</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productSize" id="productSize" class="form-control" value="<?= $rowProduct['size']; ?>">
                                </div>
                            </div>
                            <div class="form-group row" id="productVariation-group">
                                <label for="productVariation" class="col-sm-2 col-form-label">Variation</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productVariation" id="productVariation" class="form-control" value="<?= $rowProduct['variation']; ?>">
                                </div>
                            </div>
                            <div class="form-group row" id="productCostTHB-group">
                                <label for="productCostTHB" class="col-sm-2 col-form-label">Cost (THB)</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productCostTHB" id="productCostTHB" class="form-control" value="<?= $rowProduct['costTHB']; ?>" required>
                                </div>
                                <label for="productAfterDiscTHB" class="col-sm-1 col-form-label" id="">Disc (THB)</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productAfterDiscTHB" id="productAfterDiscTHB" class="form-control" value="<?= $rowProduct['discTHB']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row" id="productCostMYR-group">
                                <label for="productCostMYR" class="col-sm-2">Cost (MYR)</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productCostMYR" id="productCostMYR" class="form-control" value="<?= $rowProduct['costMYR']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row" id="productSellingMYR-group">
                                <label for="productSellingMYR" class="col-sm-2">Selling Price (MYR)</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productSellingMYR" id="productSellingMYR" class="form-control" value="<?= $rowProduct['sellingMYR']; ?>" required>
                                </div>
                                <!-- <label for="productProfitMYR" class="col-sm-1">Profit (MYR)</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productProfitMYR" id="productProfitMYR" class="form-control" readonly <?= $rowProduct['profitMYR']; ?>>
                                </div> -->
                            </div>
                            <?php if ($rowProduct['img'] == '') : ?>
                                <div class="form-group row" id="productImg-group">
                                    <label for="" class="col-sm-2">Product Image</label>
                                    <div class="col-sm-2">
                                        <input type='file' id="productImg" name="productImg" class="form-control" accept="image/x-png,image/gif,image/jpeg">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-2">
                                        <img id="preview" src="#" alt="image will display here" class="img-thumbnail" style="margin-bottom: 10px;">
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-2">
                                        <img id="preview" src="/project/upload/img/product/2021/<?= $rowProduct['img']; ?>" alt="image will display here" class="img-thumbnail" style="margin-bottom: 10px;">
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                    <button type="submit" class="btn btn-info float-right">Submit</button>
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
</script>