<!-- Title -->
<?php $title = 'Product Listing'; ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Get item from database -->
<?php
// Fetch number of products
$sql = "SELECT * FROM homedecor_product";
$result = mysqli_query($conn, $sql);
$numOfProd = mysqli_num_rows($result);
$product = mysqli_fetch_assoc($result);

// Fetch number of active items
$active = "SELECT id FROM homedecor_product";
$resultActive = mysqli_query($conn, $active);
$numOfActive = mysqli_num_rows($resultActive);
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product List</h1>
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
                                Product Inserted</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $numOfProd; ?>
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
                                Active Products</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $numOfActive; ?>
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
                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">Order No</th>
                                    <th class="align-middle">Name</th>
                                    <th class="text-center align-middle">Category</th>
                                    <th class="text-center align-middle">Supplier Code</th>
                                    <th class="text-center align-middle">Size</th>
                                    <th class="text-center align-middle">SKU</th>
                                    <th class="text-center align-middle">Cost</th>
                                    <th class="text-center align-middle">Price</th>
                                    <th class="text-center align-middle">Quantity</th>
                                    <th class="text-center align-middle">Purchased</th>
                                    <th class="text-center align-middle">Balance</th>
                                    <th class="text-center align-middle">Reorder?</th>
                                    <!-- <th class="text-center align-middle">Created</th> -->
                                    <!-- <th class="text-center align-middle">Modified</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($result)) :
                                    $quantity = (int)$row['quantity'];
                                    $purchased = (int)$row['purchased'];
                                ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <?= $row['orderNo']; ?>
                                        </td>
                                        <td class="align-middle">
                                            <a href="/project/templates/homedecor/product/view?id=<?= $row['id']; ?>" target="_blank" rel="noopener noreferrer">
                                                <?= $row['name']; ?>
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $row['category']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $row['supplierCode']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $row['size']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $row['sku']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $row['cost']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php
                                            if (empty($row['supplierCode'])) {
                                                echo 0;
                                            } elseif ($row['fixedPrice'] != 0) {
                                                echo $row['fixedPrice'];
                                            } else {
                                                $stripped = (int)preg_replace("/[^0-9]/", "", $row['supplierCode']);
                                                $thbDiscount = $row['thb'] * (1 - ($stripped / 100));
                                                $costMYR = ($thbDiscount / 100) * 15;
                                                echo $price = ($costMYR * 2.5) + 6;
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $quantity; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php if ($row['purchased'] == 0) : ?>
                                                0
                                            <?php else : ?>
                                                <?= $row['purchased']; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php if ($quantity != 0) : $balance = $quantity - $purchased; ?>
                                                <?= $balance; ?>
                                            <?php else : ?>
                                                0
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php if ($row['quantity'] == 0) : ?>
                                                <span class="badge badge-danger">
                                                    Yes
                                                </span>
                                            <?php elseif ((($quantity - $purchased) / $quantity) < 0.5) : ?>
                                                <span class="badge badge-warning">
                                                    Yes
                                                </span>
                                            <?php else : ?>
                                                <span class="badge badge-success">
                                                    No
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- <td class="text-center align-middle">
                                            <?= $row['created']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $row['modified']; ?>
                                        </td> -->
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
        $('#myTable').DataTable({
            "order": [
                [0, "asc"]
            ]
        });
    });
</script>