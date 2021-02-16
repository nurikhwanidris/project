<!-- Header -->
<?php include('../../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../../elements/admin/dashboard/nav.php') ?>

<!-- Get from database -->
<?php
$leave = "SELECT 
employee_information.fName AS name,
employee_information.ic AS ic,
leave_application.id AS id,
leave_application.created AS created,
leave_application.leave_from AS leaveFrom,
leave_application.type AS type,
leave_application.leave_to AS leaveTo,
leave_application.verify AS verify,
leave_application.approve AS approve,
leave_application.status AS status,
leave_allotment.balance_al AS balanceAL,
leave_allotment.balance_mc AS balanceMC,
leave_allotment.balance_mc AS balanceMT
FROM
leave_application
JOIN employee_information
ON leave_application.emp_id = employee_information.id
JOIN leave_allotment
ON leave_allotment.emp_id = employee_information.id";

$result = mysqli_query($conn, $leave)
?>


<div class="container-fluid">
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
                                    <th class="align-middle">Employee Name</th>
                                    <th class="text-center align-middle">Employee IC</th>
                                    <th class="text-center align-middle">Created on</th>
                                    <th class="text-center align-middle">Type</th>
                                    <th class="text-center align-middle">Leave From</th>
                                    <th class="text-center align-middle">Leave To</th>
                                    <th class="text-center align-middle">Verified by</th>
                                    <th class="text-center align-middle">Approved by</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Balance Left</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rowLeave = mysqli_fetch_array($result)) : ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <h5>
                                                <a href="#" class="badge badge-info"><?= $rowLeave['id']; ?></a>
                                            </h5>
                                        </td>
                                        <td class="align-middle">
                                            <?= $rowLeave['name'] ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowLeave['ic'] ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowLeave['created'] ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowLeave['type'] ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowLeave['leaveFrom'] ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowLeave['leaveTo'] ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowLeave['verify'] ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $rowLeave['approve'] ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <h5>
                                                <?php if ($rowLeave['status'] == 'Pending') : ?>
                                                    <span class="badge badge-warning"><?= $rowLeave['status'] ?></span>
                                                <?php endif; ?>
                                            </h5>
                                        </td>
                                        <td class="text-center align-middle">
                                            <h5>
                                                <?php if ($rowLeave['type'] == 'AL') : ?>
                                                    <span class="badge badge-success"><?= $rowLeave['balanceAL'] ?></span>
                                                <?php elseif ($rowLeave['type' == 'MC']) : ?>
                                                    <span class="badge badge-success"><?= $rowLeave['balanceMC'] ?></span>
                                                <?php elseif ($rowLeave['type' == 'MT']) : ?>
                                                    <span class="badge badge-success"><?= $rowLeave['balanceMT'] ?></span>
                                                <?php endif; ?>
                                            </h5>
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

<!-- Footer -->
<?php include('../../../elements/admin/dashboard/footer.php') ?>