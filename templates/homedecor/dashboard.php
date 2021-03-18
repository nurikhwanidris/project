<!-- Header -->
<?php include('../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../elements/admin/dashboard/nav.php') ?>

<?php
// Fetch number of enquiry
$enq = "SELECT id FROM homedecor_order GROUP BY id";
$resEnq = mysqli_query($conn, $enq);
$numOfEnq = mysqli_num_rows($resEnq);

// Fetch number of customers
$cust = "SELECT id FROM homedecor_customer";
$resCust = mysqli_query($conn, $cust);
$numOfCust = mysqli_num_rows($resCust);

// Fetch amount of sales made in a month
$sales = "SELECT SUM(total_amount) AS salesMade FROM homedecor_invoice WHERE remaining_amount = 0";
$resSales = mysqli_query($conn, $sales);
$rowSales = mysqli_fetch_assoc($resSales);
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Arzu Home Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Enquiries Inserted</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $numOfEnq; ?>
                            </div>
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
                                Total Customer</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $numOfCust; ?>
                            </div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">RM <?= number_format($rowSales['salesMade'], 2, '.', ','); ?></div>
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
                                Pending Assigned Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?//= $rowCountPending; ?>
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
</div>

<!-- Footer -->
<?php include('../elements/admin/dashboard/footer.php') ?>