<!-- Title -->
<?php $title = "List of Payment Vouchers" ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Get the data from PV table -->
<?php
$sql = "SELECT * FROM homedecor_cashin";
$result = mysqli_query($conn, $sql);
$pvs = mysqli_num_rows($result);
?>


<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List of Cash Vouchers</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Vouchers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pvs; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List of Vouchers</h6>
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
                                    <th class="text-center align-middle">PV Number</th>
                                    <th class="align-middle">Payable to</th>
                                    <th class="text-center align-middle">Account Number</th>
                                    <th class="text-center align-middle">Bank Name</th>
                                    <th class="align-middle">Insert by</th>
                                    <th class="text-center align-middle">Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rowPV = mysqli_fetch_array($result)) : ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <a href="view-cash?cashNum=<?= $rowPV['cashNum']; ?>" class="text-decoration-none"><?= $rowPV['cashNum']; ?></a>
                                        </td>
                                        <td class="align-middle"><?= $rowPV['payFrom']; ?></td>
                                        <td class="text-center align-middle"><?= $rowPV['accNum']; ?></td>
                                        <td class="text-center align-middle"><?= $rowPV['accBank']; ?></td>
                                        <td class="align-middle"><?= $rowPV['staffName']; ?></td>
                                        <td class="text-center align-middle"><?= $rowPV['created']; ?></td>
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

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "order": [
                [0, "desc"]
            ]
        });
    });
</script>


<!-- Footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>