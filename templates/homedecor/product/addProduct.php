<!-- Title -->
<?php $title = 'New Item' ?>

<!-- Header -->
<?php require('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php require('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/nav.php') ?>

<!-- Source -->
<?php
$selectSource = "SELECT * FROM homedecor_category";
$resultSource = mysqli_query($conn, $selectSource);
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
    <form action="insertProduct.php" method="POST" class="was-validated" novalidate enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">New Product</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="form-group row" id="productName-group">
                                <label for="productName" class="col-sm-2 col-form-label">Product Name</label>
                                <div class="col-sm-4">
                                    <input type="text" name="productName" class="form-control text-capitalize" id="productName" value="" required>
                                </div>
                            </div>
                            <div class="form-group row" id="productSupplier-group">
                                <label for="productSupplier" class="col-sm-2 col-form-label">Supplier Name</label>
                                <div class="col-sm-4">
                                    <select name="productSupplier" id="productSupplier" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="NEE">Nee</option>
                                        <option value="JPUI">Jpui</option>
                                        <option value="BLU">Bluwitte</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="productCategory-group">
                                <label for="productCategory" class="col-sm-2 col-form-label">Product Category</label>
                                <div class="col-sm-2">
                                    <select name="category" id="category" class="form-control" required>
                                        <option value="">Select</option>
                                        <?php while ($rowSource = mysqli_fetch_assoc($resultSource)) : ?>
                                            <option value="<?= $rowSource['id']; ?>"><?= $rowSource['name']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <label for="productCategoryCode" class="col-sm-1 col-form-label">Category Code</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productCategoryCode" id="productCategoryCode" class="form-control" readonly>
                                </div>
                                <label for="productCategory" class="col-sm-1 col-form-label d-none">Name</label>
                                <div class="col-sm-2 d-none">
                                    <input type="text" name="productCategory" id="productCategory" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row" id="productSize-group">
                                <label for="productSize" class="col-sm-2 col-form-label">Size</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productSize" id="productSize" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="form-group row" id="productVariation-group">
                                <label for="productVariation" class="col-sm-2 col-form-label">Variation</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productVariation" id="productVariation" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row" id="productCostTHB-group">
                                <label for="productCostTHB" class="col-sm-2 col-form-label">Cost (THB)</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productCostTHB" id="productCostTHB" class="form-control" value="" required="true">
                                </div>
                                <label for="productAfterDiscTHB" class="col-sm-1 col-form-label" id="">Disc (THB)</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productAfterDiscTHB" id="productAfterDiscTHB" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row" id="productCostMYR-group">
                                <label for="productCostMYR" class="col-sm-2">Cost (MYR)</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productCostMYR" id="productCostMYR" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row" id="productSellingMYR-group">
                                <label for="productSellingMYR" class="col-sm-2">Selling Price (MYR)</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productSellingMYR" id="productSellingMYR" class="form-control" required>
                                </div>
                                <label for="productProfitMYR" class="col-sm-1">Profit (MYR)</label>
                                <div class="col-sm-2">
                                    <input type="text" name="productProfitMYR" id="productProfitMYR" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row" id="productImg-group">
                                <label for="" class="col-sm-2">Product Image</label>
                                <div class="col-sm-2">
                                    <input type='file' id="productImg" name="productImg" class="form-control" accept="image/jpeg">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-2">
                                    <img id="preview" src="#" alt="image will display here" class="img-thumbnail" style="margin-bottom: 10px;">
                                </div>
                            </div>
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

        $('#productSupplier').change(function() {
            //var optionValue = $(this).val();
            //var optionText = $('#dropdownList option[value="'+optionValue+'"]').text();
            // var optionText = $("#productSupplier option:selected").text();
            // alert("Selected Option Text: " + optionText);

            var supplier = $(this).val();

            if (supplier === 'BLU') {
                // Change to readonly
                $("#productCostTHB").attr("readonly", true);
                $("#productCostTHB").attr("required", false);
                $("#productCostMYR").attr("readonly", false);
                $("#productCostMYR").attr("required", true);
            }

            // Convert THB to MYR
            $("#productCostMYR").change(function() {
                // Pull the variable from id
                var productCostMYR = $("#productCostMYR").val();

                // Calculate the everything in MYR
                var productSellingMYR = ((productCostMYR * 2.5) + 6 + 10).toFixed(0);
                var productProfitMYR = productSellingMYR - productCostMYR;

                // Display the data
                $("#productCostMYR").val(productCostMYR);
                $("#productSellingMYR").val(productSellingMYR);
                $("#productProfitMYR").val(productProfitMYR);
            });
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

    // Used pure php instead ajax because of image being uploaded too.

    // $(document).ready(function() {
    //     // Submit form backend
    //     $("form").submit(function(event) {
    //         $(".form-group").removeClass("has-error");
    //         $(".text-danger").remove();
    //         var formData = {
    //             productName: $("#productName").val(),
    //             productSupplier: $("#productSupplier").val(),
    //             productCategory: $("#productCategory").val(),
    //             productCategoryCode: $("#productCategoryCode").val(),
    //             productSize: $("#productSize").val(),
    //             productVariation: $("#productVariation").val(),
    //             productCostTHB: $("#productCostTHB").val(),
    //             productAfterDiscTHB: $("#productAfterDiscTHB").val(),
    //             productCostMYR: $("#productCostMYR").val(),
    //             productSellingMYR: $("#productSellingMYR").val(),
    //         };
    //         $.ajax({
    //             type: "POST",
    //             url: "insertProduct.php",
    //             data: formData,
    //             dataType: "json",
    //             encode: true,
    //         }).done(function(data) {
    //             $("form").trigger("reset");
    //             console.log(data);
    //             if (!data.success) {
    //                 if (data.errors.productName) {
    //                     $("#productName-group").append(
    //                         '<div class="text-danger">' + data.errors.productName + "</div>"
    //                     );
    //                 }
    //                 if (data.errors.productSupplier) {
    //                     $("#productSupplier-group").append(
    //                         '<div class="text-danger">' + data.errors.productSupplier + "</div>"
    //                     );
    //                 }
    //                 if (data.errors.productCategory) {
    //                     $("#productCategory-group").append(
    //                         '<div class="text-danger">' + data.errors.productCategory + "</div>"
    //                     );
    //                 }
    //                 if (data.errors.productCategoryCode) {
    //                     $("#productCategoryCode-group").append(
    //                         '<div class="text-danger">' + data.errors.productCategoryCode + "</div>"
    //                     );
    //                 }
    //                 if (data.errors.productSize) {
    //                     $("#productSize-group").append(
    //                         '<div class="text-danger">' + data.errors.productSize + "</div>"
    //                     );
    //                 }
    //                 if (data.errors.productVariation) {
    //                     $("#productVariation-group").append(
    //                         '<div class="text-danger">' + data.errors.productVariation + "</div>"
    //                     );
    //                 }
    //                 if (data.errors.productCostTHB) {
    //                     $("#productCostTHB-group").append(
    //                         '<div class="text-danger">' + data.errors.productCostTHB + "</div>"
    //                     );
    //                 }
    //                 if (data.errors.productAfterDiscountTHB) {
    //                     $("#productAfterDiscountTHB-group").append(
    //                         '<div class="text-danger">' + data.errors.productAfterDiscountTHB + "</div>"
    //                     );
    //                 }
    //                 if (data.errors.productCostMYR) {
    //                     $("#productCostMYR-group").append(
    //                         '<div class="text-danger">' + data.errors.productCostMYR + "</div>"
    //                     );
    //                 }
    //                 if (data.errors.productSellingMYR) {
    //                     $("#productSellingMYR-group").append(
    //                         '<div class="text-danger">' + data.errors.productSellingMYR + "</div>"
    //                     );
    //                 } else {
    //                     $("#message").html(
    //                         '<div class="alert alert-success">' + data.message + "</div>"
    //                     );
    //                     $("#message").fadeTo(3000, 500).slideUp(500, function() {
    //                         $("#message").slideUp(500);
    //                     });
    //                 }
    //             }
    //         }).fail(function(data) {
    //             $("#message").html(
    //                 '<div class="alert alert-danger">Could not reach server, please try again later.</div>'
    //             );
    //             $("#message").fadeTo(3000, 500).slideUp(500, function() {
    //                 $("#message").slideUp(500);
    //             });
    //         });
    //         event.preventDefault();
    //     });
    // })
</script>