<!-- Title -->
<?php $title = "Product Details"; ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Get data from URL -->
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM homedecor_product WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>

<?php if (isset($_POST['submit'])) {
    // Post data
    $name = $_POST['name'];
    $supplier = $_POST['supplier'];
    $category = $_POST['category'];
    $size = $_POST['size'];
    $orderNo = $_POST['orderNo'];
    $cost = $_POST['cost'];
    $quantity = $_POST['quantity'];

    // Upload image
    if (empty($row['img'])) {
        $image = $_FILES['imgSave']['name'];
    } else {
        $image = $row['img'];
    }
    $trimmedImage = str_replace(' ', '-', $image);
    $target = "../../../upload/img/product/" . basename($trimmedImage);

    // Create SKU
    $cutName = substr(str_replace(' ', '', strtoupper($name)), 0, 6);
    $sku = $cutName . '-' . $size . '-' . $orderNo;

    // // Date created and modified
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $created = date('Y-m-d H:i:s');
    $modified = date('Y-m-d H:i:s');

    // Insert to database
    $update = "UPDATE homedecor_product SET name  = '$name', category = '$category', supplierCode = '$supplier', orderNo = '$orderNo', cost = '$cost', quantity = '$quantity', sku = '$sku', modified = '$modified', img = '$image' WHERE id = '$id'";

    if ($result = mysqli_query($conn, $update)) {
        move_uploaded_file($_FILES['imgSave']['tmp_name'], $target);
        $msg = "Successfull updated the product";
        $alert = "success";
    } else {
        $msg = "Error occured. " . mysqli_error($conn);
        $alert = "danger";
    }
} ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product Management</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <?php if (isset($_POST['submit'])) : ?>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="alert alert-<?= $alert; ?> alert-dismissible fade show" role="alert">
                    <?= $msg; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
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
                                        <input type="text" name="name" id="" class="form-control" value="<?= $row['name']; ?>">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Category</label>
                                        <input type="text" name="category" id="" class="form-control" value="<?= $row['category']; ?>">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-2">
                                        <label for="">Size</label>
                                        <input type="text" name="size" id="" class="form-control" value="<?= $row['size']; ?>">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Order No</label>
                                        <input type="text" name="orderNo" id="" class="form-control" value="<?= $row['orderNo']; ?>">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Cost</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                            </div>
                                            <input type="text" class="form-control" name="cost" value="<?= $row['cost']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Fixed Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                            </div>
                                            <input type="text" class="form-control" name="price">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Quantity</label>
                                        <input type="text" name="quantity" id="" class="form-control" value="<?= $row['quantity']; ?>">
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
                                    <?php if (empty($row['img'])) : ?>
                                        <img src="/project/upload/img/product/default.jpg" alt="" srcset="" style="width:100%; height: auto;">
                                    <?php else : ?>
                                        <img src="/project/upload/img/product/<?= $row['img']; ?>" alt="" style="width: 100%; height:auto;">
                                    <?php endif; ?>
                                    <input type='file' id="imgInp" name="imgSave" class="form-control" accept="image/x-png,image/gif,image/jpeg" value="<?= $row['img']; ?>">
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
<?php include('../../elements/admin/dashboard/footer.php') ?>

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