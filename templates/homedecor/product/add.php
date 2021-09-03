<!-- Header -->
<?php require('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php require('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/nav.php') ?>

<!-- Get Category -->
<?php
$category = "SELECT * FROM homedecor_category";
$resultCategory = mysqli_query($conn, $category);
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product Management</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <form action="save-product.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-10 col-lg-10">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
                                <h6 class="font-weight-bold text-info"><u>Product Details</u></h6>
                                <div class="row my-2">
                                    <div class="col-lg-3">
                                        <label for="">Supplier</label>
                                        <input type="text" name="supplier" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-4">
                                        <label for="">Name</label>
                                        <input type="text" name="name" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Category</label>
                                        <input type="text" name="category" id="" class="form-control" list="category">
                                        <datalist id="category">
                                            <?php while ($rowCategory = mysqli_fetch_array($resultCategory)) : ?>
                                                <option value="<?= $rowCategory['name']; ?>"></option>
                                            <?php endwhile; ?>
                                        </datalist>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Supplier Discount</label>
                                        <select name="supplierCode" id="" class="form-control">
                                            <option value="">Select</option>
                                            <option value="KL3">3</option>
                                            <option value="KL5">5</option>
                                            <option value="KL10">10</option>
                                            <option value="KL15">15</option>
                                            <option value="KL20">20</option>
                                            <option value="KL22">22</option>
                                            <option value="KL25">25</option>
                                            <option value="KL30">30</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-2">
                                        <label for="">Size</label>
                                        <input type="text" name="size" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Order No</label>
                                        <input type="text" name="orderNo" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Quantity</label>
                                        <input type="text" name="quantity" id="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-2">
                                        <label for="">Cost in THB</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">thb</span>
                                            </div>
                                            <input type="text" class="form-control" name="thb">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Cost in RM</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                            </div>
                                            <input type="text" class="form-control" name="cost">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Selling Price in THB</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">THB</span>
                                            </div>
                                            <input type="text" class="form-control" name="sellingPriceTHB">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Selling Price in RM</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                            </div>
                                            <input type="text" class="form-control" name="sellingPriceRM">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add Image</h6>
                    </div>
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="row">
                                <div class="col">
                                    <img id="preview" src="#" alt="image will display here" class="img-thumbnail" style="margin-bottom: 10px;">
                                    <input type='file' id="imgInp" name="imgSave" class="form-control" accept="image/x-png,image/gif,image/jpeg">
                                </div>
                            </div>
                            <div class="row form-group my-2">
                                <div class="col float-right">
                                    <button type="submit" name="submit" class="btn btn-info float-right">Submit</button>
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

<!-- Image Preview -->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });
</script>