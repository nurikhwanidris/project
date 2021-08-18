<!-- Title -->
<?php $title = 'Purchase Order Listing'; ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Get data from table -->
<?php
$selectPO = "SELECT * FROM homedecor_po";
$resultPO = mysqli_query($conn, $selectPO);
?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Datatable CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.3/css/rowGroup.dataTables.min.css">


<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

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
                                    <th class="align-middle text-center">
                                        Supplier
                                    </th>
                                    <th class="align-middle text-center">
                                        Batch
                                    </th>
                                    <th class="align-middle text-center">
                                        Created
                                    </th>
                                    <th class="align-middle text-center">
                                        Delivery Date
                                    </th>
                                    <th class="align-middle text-center">
                                        Arrival Date
                                    </th>
                                    <th class="align-middle text-center">
                                        Total Items
                                    </th>
                                    <th class="align-middle text-center">
                                        Total Amount
                                    </th>
                                    <th class="align-middle text-center">
                                        Status
                                    </th>
                                    <th class="align-middle text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rowPO = mysqli_fetch_assoc($resultPO)) : ?>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <?= $rowPO['supplier']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $rowPO['batch']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $rowPO['created']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $rowPO['expectedDeliveryDate']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $rowPO['expectedArrivalDate']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $rowPO['totalQuantity']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $rowPO['totalAmount']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $rowPO['poStatus']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="viewPO?id=<?= $rowPO['id']; ?>" target="_blank" class="btn btn-sm btn-info mx-2" rel="noopener noreferrer"><i class="far fa-eye"></i></a>
                                            <a href="viewPO?id=<?= $rowPO['id']; ?>" target="_blank" class="btn btn-sm btn-danger mx-2" id="deletePO" rel="noopener noreferrer"><i class="fas fa-minus-circle"></i></a>
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
        var table = $("myTable").DataTable({});
    })
</script>