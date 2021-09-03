<!-- Header -->
<?php require('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php require('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/nav.php') ?>

<?php

// Create membership list
$membership = "SELECT
homedecor_customer.id AS customerId,
homedecor_customer.customerName AS customerName,
homedecor_customer.customerPhone AS customerPhone,
homedecor_customer.customerEmail AS customerEmail,
homedecor_customer.created AS created,
homedecor_customer.staffName AS staffName,
homedecor_invoice.amount_paid AS amountPaid
FROM homedecor_invoice
JOIN homedecor_customer
ON homedecor_invoice.customer_id = homedecor_customer.id
WHERE homedecor_invoice.amount_paid >= 1000";
$resultMembership = mysqli_query($conn, $membership);
$rowCountCust = mysqli_num_rows($resultMembership);
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customer Summary</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Clients</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $rowCountCust; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                    <h6 class="m-0 font-weight-bold text-primary">Customer Summary</h6>
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
                                    <th class="text-center align-middle">#</th>
                                    <th class="align-middle">Client Name</th>
                                    <th class="text-center align-middle">Client Phone</th>
                                    <th class="align-middle">Client Email</th>
                                    <th class="text-center align-middle">Enquiry Time</th>
                                    <th class="text-center align-middle">Insert by</th>
                                    <th class="text-center align-middle">
                                        Staff Assigned
                                    </th>
                                    <th class="text-center align-middle">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($row = mysqli_fetch_assoc($resultMembership)) : ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <a href="view?customerID=<?= $row['id']; ?>" class=" btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> <?= $i++; ?>
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <?= $row['customerName']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $row['customerPhone']; ?>
                                        </td>
                                        <td class="align-middle">
                                            <?= $row['customerEmail']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $row['created']; ?>
                                        </td>
                                        <td class=" text-center align-middle">
                                            <?= $row['staffName']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $row['staffName']; ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-success">Member</span>
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
<?php require('../../elements/admin/dashboard/footer.php') ?>