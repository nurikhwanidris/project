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
homedecor_invoice.id AS id,
homedecor_invoice.customer_id AS customerID,
homedecor_invoice.invoice_num AS invoiceNum,
homedecor_invoice.invoice_date AS invoiceDate,
homedecor_invoice.total_amount AS invoiceTotal,
homedecor_invoice.invoice_status AS invoiceStatus,
homedecor_invoice.remaining_amount AS balanceDue,
homedecor_invoice.amount_paid AS amountPaid,
homedecor_invoice.modified AS modified
FROM homedecor_invoice
JOIN homedecor_customer
ON homedecor_invoice.customer_id = homedecor_customer.id";
$resultinvoice = mysqli_query($conn, $invoice);

// Count invoice created
$fetchInvoice = "SELECT id FROM homedecor_invoice";
$resultInv = mysqli_query($conn, $fetchInvoice);
$countInv = mysqli_num_rows($resultInv);

// Special case
$selectCustomer = "SELECT customerName FROM homedecor_customer GROUP BY customerName";
$resultCst = mysqli_query($conn, $selectCustomer);
$rowCountCust = mysqli_num_rows($resultCst);

// Calculate sales generated monthly
$sales = "SELECT SUM(amount_paid) AS totalSales, SUM(remaining_amount) AS balance FROM homedecor_invoice WHERE MONTH(created) = MONTH(NOW()) AND YEAR(created) = YEAR(NOW())";
$resSales = mysqli_query($conn, $sales);
$rowSales = mysqli_fetch_assoc($resSales);
$sumSales = $rowSales['totalSales'];
$balance = $rowSales['balance'];

// Count Pending
// $pending = "SELECT status FROM homedecor_order WHERE status = 'Pending'";
// $resultPending = mysqli_query($conn, $pending);
// $rowCountPending = mysqli_num_rows($resultPending);
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
                                Invoice Created</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countInv; ?></div>
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
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Earnings (Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">RM <?= number_format($sumSales, 2, '.', ','); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                                Pending Assigned Requests (Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                RM <?= number_format($balance, 2, '.', ','); ?>
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
                        <table class="table table-bordered table-hover" id="myTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col>
                                <col>
                                <col>
                                <col class="bg-info">
                                <col class="bg-success">
                                <col class="bg-warning">
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="align-middle text-center ">Invoice Number</th>
                                    <th class="align-middle">Client</th>
                                    <th class="align-middle text-center">Invoice Date</th>
                                    <th class="align-middle text-center text-white">Invoice Total</th>
                                    <th class="align-middle text-center text-white">Amount Paid</th>
                                    <th class="align-middle text-center text-white">Balance Due</th>
                                    <th class="align-middle text-center">Due Date</th>
                                    <th class="align-middle text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rowInvoice = mysqli_fetch_array($resultinvoice)) : ?>
                                    <tr>
                                        <td class="align-middle text-center ">
                                            <a href="/project/templates/homedecor/invoice/view?id=<?= $rowInvoice['id']; ?>" target="_blank">
                                                INV<?= $rowInvoice['invoiceNum']; ?>
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <?= $rowInvoice['customerName']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= date("d/m/Y", strtotime($rowInvoice['invoiceDate'])); ?>
                                        </td>
                                        <td class="align-middle text-center text-white">
                                            RM <?= $rowInvoice['invoiceTotal']; ?>
                                        </td>
                                        <td class="align-middle text-center text-white">RM <?= $rowInvoice['amountPaid']; ?></td>
                                        <td class="align-middle text-center text-white">
                                            RM <?= number_format($rowInvoice['balanceDue'], 2, '.', ''); ?>
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
                                            <?php elseif ($rowInvoice['balanceDue'] == 0) : ?>
                                                <h5>
                                                    <span class="badge badge-success">
                                                        Paid
                                                    </span>
                                                </h5>
                                            <?php elseif ($rowInvoice['balanceDue'] > 0) : ?>
                                                <h5>
                                                    <span class="badge badge-warning">
                                                        Open
                                                    </span>
                                                </h5>
                                            <?php elseif ($rowInvoice['invoiceStatus'] == 'Refund') : ?>
                                                <h5>
                                                    <span class="badge badge-danger">
                                                        Canceled
                                                    </span>
                                                </h5>
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