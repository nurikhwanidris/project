<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<?php
// Get data from employee infomation table
$getEmp = "SELECT * FROM employee_information ORDER BY id";
$resultEmp = mysqli_query($conn, $getEmp);

// Get data from employee office table
$getOffice = "SELECT * FROM employee_office ORDER BY emp_id";
$resultOffice = mysqli_query($conn, $getOffice);
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tour Dashboard</h1>
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
                                Package Created</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">000</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">15,000</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($_GET['success']) == 'yes') : ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> User account for <strong><?= $_GET['user']; ?></strong> is created.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
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
                        <a href="/project/templates/model/hrm/add" class="btn btn-success btn-sm mb-3">Add Employee</a>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">Employee ID</th>
                                        <th class="align-middle">Name</th>
                                        <th class="text-center align-middle">Employee IC</th>
                                        <th class="text-center align-middle">Department</th>
                                        <th class="text-center align-middle">Phone</th>
                                        <th class="text-center align-middle">Date Joined</th>
                                        <th class="text-center align-middle">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($rowEmp = mysqli_fetch_assoc($resultEmp) and $rowOff = mysqli_fetch_assoc($resultOffice)) : ?>
                                        <tr>
                                            <td class="text-center align-middle">
                                                <a href="#" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> <?= $rowEmp['id']; ?>
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <?= $rowEmp['fName'] . ' ' . $rowEmp['lName'] ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span id="ic">
                                                    <?= $rowEmp['ic']; ?>
                                                </span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <?= $rowOff['dept']; ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?= $rowEmp['phone']; ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <?= $rowOff['doh']; ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <?php if ($rowOff['status'] == 'Active') : ?>
                                                    <span class="badge badge-success">Active</span>
                                                <?php elseif ($rowOff['status'] == 'Resigned') : ?>
                                                    <span class="badge badge-secondary">Resigned</span>
                                                <?php elseif ($rowOff['status'] == 'Terminated') : ?>
                                                    <span class="badge badge-danger">Terminated</span>
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
</div>

<!-- Footer -->
<?php include('../../elements/admin/dashboard/footer.php'); ?>