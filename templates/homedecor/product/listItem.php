<!-- Title -->
<?php $title = 'Item Listing'; ?>

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
homedecor_product2.id,
homedecor_product2.itemId AS itemId,
homedecor_product2.name AS name,
homedecor_product2.itemCode AS itemCode,
homedecor_product2.supplier AS supplier,
homedecor_product2.category AS category,
homedecor_product2.size AS size,
homedecor_product2.variation AS variation,
homedecor_product2.costTHB AS costTHB,
homedecor_product2.discTHB AS discTHB,
homedecor_product2.costMYR AS costMYR,
homedecor_product2.sellingMYR AS sellingMYR,
homedecor_product2.img AS img,
homedecor_item2.productId AS productId,
homedecor_item2.itemQuantity AS itemQuantity,
homedecor_item2.itemAvailable AS itemAvailable,
homedecor_item2.itemDefective AS itemDefect,
homedecor_item2.itemSold AS itemSold
FROM homedecor_product2
JOIN homedecor_item2
ON homedecor_product2.id = homedecor_item2.productId";
$result = mysqli_query($conn, $sql);
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
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Item List</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm float-right mx-2" id="addDisplay" data-toggle="modal" data-target="#displayModal"><i class="fas fa-plus fa-sm text-white-50"></i> Add Display Item</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Item List</h6>
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
                        <div class="my-2">
                            <a class="group-by btn btn-primary btn-sm mr-2 float-right" id="exportPDF"><i class="fas fa-file-pdf"></i></a>
                            <a class="group-by btn btn-success btn-sm mx-2 float-right" id="exportCSV"><i class="fas fa-file-excel"></i></a>
                            <a class="group-by btn btn-info btn-sm float-right" data-column="4">Supplier</a>
                            <a class="group-by btn btn-info btn-sm mx-2 float-right" data-column="3">Category</a>
                            <input type="text" name="searchCode" id="searchCode" class="float-right" placeholder="Search by item code">
                        </div>
                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-left align-middle">Item Code</th>
                                    <th class="align-middle">Name</th>
                                    <th class="d-none text-center align-middle">Item ID</th>
                                    <th class="text-center align-middle d-none">Category</th>
                                    <th class="text-center align-middle d-none">Supplier</th>
                                    <th class="text-center align-middle">Variation</th>
                                    <th class="text-center align-middle">Cost THB</th>
                                    <th class="text-center align-middle">Cost MYR</th>
                                    <th class="text-center align-middle">Selling MYR</th>
                                    <th class="text-center align-middle">Quantity</th>
                                    <th class="text-center align-middle">Available</th>
                                    <th class="text-center align-middle">Sold</th>
                                    <th class="text-center align-middle">Size</th>
                                    <th class="text-center align-middle">Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rowItem = mysqli_fetch_array($result)) : ?>
                                    <tr>
                                        <td class="text-left align-middle">
                                            <a href="viewItem.php?id=<?= $rowItem['id']; ?>" id="editItem" target="_blank">
                                                <?= $rowItem['supplier'] . '-' . str_pad($rowItem['itemCode'], 4, 0, STR_PAD_LEFT) . '-' . $rowItem['itemId']; ?>
                                            </a>
                                        </td>
                                        <td class="text-left align-middle">
                                            <?= $rowItem['name']; ?>
                                        </td>
                                        <td class="text-center align-middle d-none">
                                            <?= $rowItem['itemId']; ?>
                                        </td>
                                        <td class="text-center align-middle d-none">
                                            <?= $rowItem['category']; ?>
                                        </td>
                                        <td class="text-center align-middle d-none">
                                            <?= $rowItem['supplier']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['variation']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['costTHB']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['costMYR']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['sellingMYR']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['itemQuantity']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['itemAvailable']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['itemSold']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['size']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php if ($rowItem['img'] != '') : ?>
                                                <img src="/project/upload/img/product/2021/<?= $rowItem['img']; ?>" alt="" id="editImg" class="img-thumbnail changeImg" style="width:100px; height:auto;">
                                            <?php endif; ?>
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

<!-- footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>

<script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            dom: 'ltipr',
            buttons: [{
                    extend: 'csv',
                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4',
                }
            ],
            orderFixed: [
                [3, 'asc']
            ],
            rowGroup: {
                dataSrc: 3
            }
        });

        $("#exportPDF").on("click", function() {
            table.button('.buttons-pdf').trigger();
        });

        $("#exportCSV").on("click", function() {
            table.button('.buttons-csv').trigger();
        });

        $('#searchCode').on('keyup', function() {
            table
                .columns(2)
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

    // Enlarge image
    $(document).ready(function() {
        $('.img-thumbnail').click(function() {
            $(this).css('width', function(_, cur) {
                return cur === '100px' ? '100%' : '100px'
            }); // original width is 500px 
        });
    });
</script>