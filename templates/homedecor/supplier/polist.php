<!-- Title -->
<?php $title = "Purchase Order List"; ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Get PO Lists -->
<?php
$fetch = "SELECT * FROM homedecor_supplier_order";
$resFetch = mysqli_query($conn, $fetch);
?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<div class="container-fluid">
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
                                Earnings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">RM<?= round($sumSales, 2); ?></div>
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
    <div class="row mt-4">
        <div class="col-lg-12 col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="font-weight-bold text-primary">Purchase Order List</h6>
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">#</th>
                                    <th class="align-middle text-center">PO ID</th>
                                    <th class="align-middle text-center">Supplier</th>
                                    <th class="align-middle text-center">Total Items</th>
                                    <th class="align-middle text-center">Total Price</th>
                                    <th class="align-middle text-center">Status</th>
                                    <th class="align-middle text-center">Created by</th>
                                    <th class="align-middle text-center">Created</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($rowList = mysqli_fetch_array($resFetch)) :
                                    $productPrice = explode(',', $rowList['productPrice']);
                                    $productQty = explode(',', $rowList['productQty']);
                                ?>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <?= $i++; ?>
                                        </td>
                                        <td class="align-middle text-center"><a href="poview?id=<?= $rowList['id']; ?>" target="blank"><?= str_pad($rowList['id'], 4, 0, STR_PAD_LEFT); ?></a></td>
                                        <td class="align-middle text-center">
                                            <?php $supplier = mysqli_query($conn, "SELECT * FROM homedecor_supplier WHERE " . $rowList['id'] . "");
                                            $rowSupplier = mysqli_fetch_assoc($supplier);
                                            echo $rowSupplier['businessName']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= array_sum($productQty); ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            ฿&nbsp;<?= number_format(array_sum($productPrice), 2, '.', ','); ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= ($rowList['status'] = 'Pending' ? '<span class="badge badge-warning">Pending</span>' : ''); ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $rowList['staffName']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $rowList['created']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="editpo.php?id=<?= $rowList['id']; ?>" class="btn btn-info"><i class="far fa-edit"></i></a>
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
<?php include('../../elements/admin/dashboard/footer.php') ?>