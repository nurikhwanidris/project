<!-- Title -->
<?php $title = "Invoice List"; ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<?php
// Fetch customer
$invoice = "SELECT 
homedecor_customer.customerName AS customerName,
homedecor_invoice.customer_id AS customerID,
homedecor_invoice.invoice_num AS invoiceNum,
homedecor_invoice.invoice_date AS invoiceDate,
homedecor_invoice.total_amount AS invoiceTotal,
homedecor_invoice.invoice_status AS invoiceStatus,
homedecor_invoice.remaining_amount AS balanceDue,
homedecor_invoice.modified AS modified
FROM homedecor_invoice
JOIN homedecor_customer
ON homedecor_invoice.customer_id = homedecor_customer.id";

$resultinvoice = mysqli_query($conn, $invoice);

// Fetch Package based on customer ID
// $enquiry = "SELECT * FROM homedecor_order_product ORDER BY customer_ID";
// $resultEnquiries = mysqli_query($conn, $enquiry);

// Count rows
// $rowCountEnq = mysqli_num_rows($resultEnquiries);

$fetchEnquiries = "SELECT id FROM homedecor_purchase_order";
$resultEnquiries = mysqli_query($conn, $fetchEnquiries);

$rowCountEnq = mysqli_num_rows($resultEnquiries);


// Special case
$selectCustomer = "SELECT customerName FROM homedecor_customer GROUP BY customerName";
$resultCst = mysqli_query($conn, $selectCustomer);
$rowCountCust = mysqli_num_rows($resultCst);

// Count Pending
$pending = "SELECT status FROM homedecor_purchase_order WHERE status = 'Pending'";
$resultPending = mysqli_query($conn, $pending);
$rowCountPending = mysqli_num_rows($resultPending);
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
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Order Inserted</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $rowCountEnq; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-id-card fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Assigned Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $rowCountPending; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
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
                    <h6 class="m-0 font-weight-bold text-primary">Order Management</h6>
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
                                    <th class="align-middle text-center">Invoice Number</th>
                                    <th class="align-middle">Client</th>
                                    <th class="align-middle text-center">Invoice Date</th>
                                    <th class="align-middle text-center">Invoice Total</th>
                                    <th class="align-middle text-center">Balance Due</th>
                                    <th class="align-middle text-center">Due Date</th>
                                    <th class="align-middle text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rowInvoice = mysqli_fetch_array($resultinvoice)) : ?>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <a href="/project/templates/homedecor/invoice/view?id=<?= $rowInvoice['invoiceNum']; ?>" target="_blank">
                                                INV<?= $rowInvoice['invoiceNum']; ?>
                                            </a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $rowInvoice['customerName']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= date("d/m/Y", strtotime($rowInvoice['invoiceDate'])); ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            RM<?= $rowInvoice['invoiceTotal']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            RM<?= $rowInvoice['balanceDue']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?php
                                            $invoiceDate = $rowInvoice['invoiceDate'];
                                            $newDate = date('d/m/Y', strtotime('+14 days', strtotime($invoiceDate)));
                                            echo $newDate;
                                            ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?php if ($rowInvoice['invoiceStatus'] == 'Deposit') : ?>
                                                <h5><span class="badge badge-info"><?= $rowInvoice['invoiceStatus']; ?></span></h5>
                                            <?php elseif ($rowInvoice['invoiceStatus'] == 'Full' || $rowInvoice['balanceDue'] == 0) : ?>
                                                <h5><span class="badge badge-success"><?= $rowInvoice['invoiceStatus']; ?></span></h5>
                                            <?php endif; ?>
                                        </td>
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