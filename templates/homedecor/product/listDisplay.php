<!-- Title -->
<?php $title = 'Product Listing'; ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Datatable CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.3/css/rowGroup.dataTables.min.css">

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Get item from database -->
<?php
// Fetch number of products
$sql = "SELECT
homedecor_display_product.productId AS productId,
homedecor_display_product.uniqueId AS uniqueId,
homedecor_display_product.productName AS productName,
homedecor_display_product.productQty AS productQty,
homedecor_display_product.productRemarks AS productRemarks,
homedecor_display_product.productSet AS productSet,
homedecor_display_product.created AS created,
-- homedecor_product2.id AS productId,
homedecor_product2.itemId AS itemId,
homedecor_product2.itemCode AS productitemCode,
homedecor_product2.supplier AS productSupplier,
homedecor_product2.category AS productCategory,
homedecor_product2.size AS productSize,
homedecor_product2.variation AS productVariation,
homedecor_product2.img AS img
FROM homedecor_display_product
JOIN homedecor_product2
ON homedecor_display_product.uniqueId = homedecor_product2.id
";
$result = mysqli_query($conn, $sql);
?>

<!-- Get the product from database -->
<?php
$product = "SELECT * FROM homedecor_product2";
$resultproduct = mysqli_query($conn, $product);
$productSelectOptions = array();
while ($rowProduct = $resultproduct->fetch_assoc()) {
    $productSelectOptions[$rowProduct['id']] = $rowProduct['name'] . '- ' . $rowProduct['supplier'] . ' - ' . $rowProduct['itemId'];
}
?>

<!-- Get all the sets -->
<?php
$selectSet = "SELECT productSet FROM homedecor_display_product GROUP BY productSet";
$resultSet = mysqli_query($conn, $selectSet);
?>

<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <h1 class="h3 mb-0 text-gray-800">List of Product for Display Only </h1>
    </div>
    <div class="row my-4">
        <div class="col-lg-12">
            <a href="#" class="btn btn-sm btn-primary shadow-sm float-right mx-2" id="addDisplay" data-toggle="modal" data-target="#displayModal"><i class="fas fa-plus fa-sm text-white-50"></i> Add Display Item</a>
            <a class="group-by btn btn-info shadow-sm btn-sm float-right mx-2" data-column="4">Supplier</a>
            <a class="group-by btn btn-info shadow-sm btn-sm float-right mx-2" data-column="5">Category</a>
            <select name="" id="searchSet" class="shadow-sm btn-sm float-right mx-2">
                <?php while ($set = mysqli_fetch_assoc($resultSet)) : ?>
                    <?php if (empty($set['productSet'])) : ?>
                        <option value="<?= $set['productSet']; ?>">Search set</option>
                    <?php else : ?>
                        <option value="<?= $set['productSet']; ?>"><?= $set['productSet']; ?></option>
                    <?php endif ?>
                <?php endwhile; ?>
            </select>
            <input type="text" name="searchCode" id="searchCode" class="float-right mx-2 searchCode" style="width: 100px;" placeholder="Search code">
            <input type="text" name="searchName" id="searchName" class="float-right mx-2 searchName" style="width: 150px;" placeholder="Search name">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id="message"></div>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-left align-center">ID</th>
                                    <th class="text-center align-center">Image</th>
                                    <th class="text-left align-center">Name</th>
                                    <th class="text-left align-center">Set</th>
                                    <th class="text-center align-center">Supplier</th>
                                    <th class="text-center align-center">Category</th>
                                    <th class="text-center align-center">Size</th>
                                    <th class="text-center align-center">Variation</th>
                                    <th class="text-left align-center">Remarks</th>
                                    <th class="text-center align-center">Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rowItem = mysqli_fetch_array($result)) : ?>
                                    <tr>
                                        <td class="text-left align-middle">
                                            <?= $rowItem['productSupplier'] . '-' . str_pad($rowItem['productitemCode'], 4, 0, STR_PAD_LEFT) . '-' . $rowItem['itemId']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <img src="/project/upload/img/product/2021/<?= $rowItem['img']; ?>" alt="" style="width:100px; height:100px;">
                                        </td>
                                        <td class="text-left align-middle">
                                            <?= $rowItem['productName']; ?>
                                        </td>
                                        <td class="text-left align-middle">
                                            <?= $rowItem['productSet']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['productSupplier']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['productCategory']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['productSize']; ?> Inches
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['productVariation']; ?>
                                        </td>
                                        <td class="text-left align-middle">
                                            <?= $rowItem['productRemarks']; ?>
                                        </td>
                                        <td class="text-created align-middle">
                                            <?= $rowItem['created']; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal begins -->
<form action="" method="POST">
    <!-- Modal -->
    <div class="modal fade" id="displayModal" tabindex="-1" aria-labelledby="displayModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="displayModalLabel">Add Item for Display</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Choose Product</label>
                            <select name="product" id="productDisplay" class="selectpicker form-control" data-live-search="true">
                                <option value=""></option>
                                <?php foreach ($productSelectOptions as $val => $text) : ?>
                                    <option value="<?= $val; ?>"><?= $text; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Product Name</label>
                            <input type="text" name="productName" id="productName" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Unique Id</label>
                            <input type="text" name="uniqueId" id="uniqueId" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Product Code</label>
                            <input type="text" name="productCode" id="productCode" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Product Set</label>
                            <input type="text" name="productSet" id="productSet" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Quantity</label>
                            <input type="text" name="productQty" id="productQty" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Remarks</label>
                            <textarea name="productRemarks" id="productRemarks" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>

<script>
    // Datatables
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            dom: 'ltipr',
            buttons: [{
                extend: 'csv',
            }],
            orderFixed: [
                [4, 'asc']
            ],
            rowGroup: {
                dataSrc: 4
            }
        });

        $("#exportCSV").on("click", function() {
            table.button('.buttons-csv').trigger();
        });

        $('#searchCode').on('keyup', function() {
            table
                .columns(0)
                .search(this.value)
                .draw();
        });

        $('#searchName').on('keyup', function() {
            table
                .columns(2)
                .search(this.value)
                .draw();
        });

        $('#searchSet').on('change', function() {
            table
                .columns(3)
                .search(this.value)
                .draw();
        });

        // Change the fixed ordering when the data source is updated
        table.on('rowgroup-datasrc', function(e, dt, val) {
            table.order.fixed({
                pre: [
                    [val, 'asc']
                ]
            }).draw();
        });

        $('a.group-by').on('click', function(e) {
            e.preventDefault();

            table.rowGroup().dataSrc($(this).data('column'));
        });
    });

    var $productDisplay = $("#productDisplay");
    var $productName = $("#productName");
    var $uniqueId = $("#uniqueId");
    var $productCode = $("#productCode");

    var apiUrl = 'itemInfo.php';

    function refreshInputs(item) {
        $.post(apiUrl, {
            item: item
        }, function(r) {
            // Item Unique ID
            $uniqueId.val(r.id);
            $productCode.val(r.itemId);
            $productName.val(r.name);
        });
    }

    $productDisplay.change(function() {
        var item = $(this).val();
        refreshInputs(item);
    });

    // Submit form
    $(document).ready(function() {
        var uniqueId = $("#uniqueId").val();
        var productId = $("#productDisplay").val();
        var productName = $("#productName").val();
        var productSet = $("#productSet").val();
        var productQty = $("#productQty").val();
        var productRemarks = $("#productRemarks").val();

        $("form").submit(function(event) {
            $(".form-group").removeClass("has-error");
            $(".text-danger").remove();

            var formData = {
                uniqueId: $("#uniqueId").val(),
                productId: $("#productDisplay").val(),
                productName: $("#productName").val(),
                productSet: $("#productSet").val(),
                productQty: $("#productQty").val(),
                productRemarks: $("#productRemarks").val(),
            };

            $.ajax({
                type: "POST",
                url: "insertDisplay.php",
                data: formData,
                encode: true,
            }).done(function(data) {
                if (data.success = true) {
                    // console.log(data);
                    $("#message").html(
                        '<div class="alert alert-success">Item quantity succesfully inserted!</div>'
                    );
                    $("#message").fadeTo(5000, 500).slideUp(500, function() {
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
                $("#message").fadeTo(5000, 500).slideUp(500, function() {
                    $("#message").slideUp(500);
                });
            });
            event.preventDefault();
        });
    });
</script>