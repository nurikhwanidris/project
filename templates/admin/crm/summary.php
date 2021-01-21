<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<?php
// Fetch customer
$customer = "SELECT * FROM customers ORDER BY id";
$resultCustomer = mysqli_query($conn, $customer);

// Fetch Package based on customer ID
$enquiry = "SELECT * FROM enquiries ORDER BY customerID";
$resultEnquiries = mysqli_query($conn, $enquiry);
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customer Summary</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

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
                                <th class="text-center align-middle">Enquiry #</th>
                                <th class="text-center align-middle">Enquiry Time</th>
                                <th class="text-center align-middle">Insert by</th>
                                <th class="align-middle">Program</th>
                                <th class="text-center align-middle">Travelling Date</th>
                                <th class="text-center align-middle">Type</th>
                                <th class="align-middle">Client Name</th>
                                <th class="text-center align-middle">Client Phone</th>
                                <th class="align-middle">Client Email</th>
                                <th class="text-center align-middle">
                                    Staff Assigned
                                </th>
                                <th class="text-center align-middle">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($resultCustomer) and $rowPackage = mysqli_fetch_assoc($resultEnquiries)) : ?>
                                <tr>
                                    <td class="text-center align-middle">
                                        <a href="view-customer?customerID=<?= $row['id']; ?>" class=" btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> <?= $row['id']; ?>
                                        </a>
                                    </td>
                                    <td class="text-center align-middle">
                                        <?= $row['created']; ?>
                                    </td>
                                    <td class="text-center align-middle">
                                        <?= $row['staffName']; ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $rowPackage['packageName']; ?>
                                    </td>
                                    <td class="text-center align-middle">
                                        <?= $rowPackage['packageDate']; ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <?= $rowPackage['packageType']; ?>
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
                                    <td class=" text-center align-middle">
                                        <?= $rowPackage['assigned']; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($rowPackage['status'] == 'Confirmed') : ?>
                                            <span class="badge badge-success"><?= $rowPackage['status']; ?></span>
                                        <?php elseif ($rowPackage['status'] == 'Pending') : ?>
                                            <span class="badge badge-warning"><?= $rowPackage['status']; ?></span>
                                        <?php elseif ($rowPackage['status'] == "Cancelled") : ?> <span class="badge badge-danger"><?= $rowPackage['status']; ?></span>
                                        <?php elseif (empty($rowPackage['assigned'])) : ?>
                                            <span class="badge badge-dark">Unassigned</span>
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