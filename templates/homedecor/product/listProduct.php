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
$sql = "SELECT * FROM homedecor_product2";
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
        <h1 class="h3 mb-0 text-gray-800">Product List</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
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
                        <div class="my-2">
                            <a class="group-by btn btn-success btn-sm mx-2 float-right" id="exportCSV"><i class="fas fa-file-excel"></i></a>
                            <a class="group-by btn btn-info btn-sm float-right" data-column="3">Supplier</a>
                            <a class="group-by btn btn-info btn-sm mx-2 float-right" data-column="4">Category</a>
                            <input type="text" name="searchCode" id="searchCode" class="float-right" placeholder="Search by item code">
                        </div>
                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-left align-middle">Item Code</th>
                                    <th class="align-middle">Name</th>
                                    <th class="d-none text-center align-middle">Item Code</th>
                                    <th class="text-center align-middle">Supplier</th>
                                    <th class="text-center align-middle">Category</th>
                                    <th class="text-center align-middle">SKU</th>
                                    <th class="text-center align-middle">Size</th>
                                    <th class="text-center align-middle">Cost THB</th>
                                    <th class="text-center align-middle">Discount THB</th>
                                    <th class="text-center align-middle">Cost MYR</th>
                                    <th class="text-center align-middle">Selling Price</th>
                                    <th class="text-center align-middle">Profit MYR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rowItem = mysqli_fetch_array($result)) : ?>
                                    <tr>
                                        <td class="text-left align-middle">
                                            <a href="viewProduct?id=<?= $rowItem['id']; ?>"><?= $rowItem['supplier'] . '-' . str_pad($rowItem['itemCode'], 4, 0, STR_PAD_LEFT) . '-' . $rowItem['itemId']; ?></a>
                                        </td>
                                        <td class="text-left align-middle">
                                            <?= $rowItem['name']; ?>
                                        </td>
                                        <td class="text-center align-middle d-none">
                                            <?= $rowItem['itemId']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['supplier']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['category']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['itemCode'] . '-' . $rowItem['itemId'] . '-' . strtoupper(substr(trim(preg_replace('/\s+/', ' ', $rowItem['name'])), 0, 3)) . '-' . strtoupper(substr(trim(preg_replace('/\s+/', ' ', $rowItem['variation'])), 0, 3)) . '-' . $rowItem['size']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['size']; ?> Inches
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['costTHB']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['discTHB']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['costMYR']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['sellingMYR']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowItem['sellingMYR'] - $rowItem['costMYR']; ?>
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
            }],
            orderFixed: [
                [3, 'asc']
            ],
            rowGroup: {
                dataSrc: 3
            }
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
</script>