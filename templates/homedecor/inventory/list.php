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
// fetch the items
$select = "SELECT * FROM homedecor_item";

$result = mysqli_query($conn, $select);

?>

<!-- Cincau ais-->
<?php
// Delete
if (isset($_GET['dlt'])) {
    $id = $_GET['dlt'];
    $delete = "DELETE FROM homedecor_item WHERE id = '$id'";
    $resDlt = mysqli_query($conn, $delete);

    if ($resDlt) {
        $msg = "Succesfully deleted the voucher";
        $alert = "success";
        header('Location:/project/templates/homedecor/inventory/list');
    } else {
        $msg = "Error occured " . mysqli_error($conn);
        $alert = "danger";
    }
}

?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List of Payment Vouchers</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <?php if (isset($msg)) : ?>
        <div class="row mt-3 d-print-none">
            <div class="col-lg-12 col-xl-12">
                <div class="alert alert-<?= $alert; ?> alert-dismissible fade show" role="alert">
                    <?= $msg; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

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
                    <div class="table-responsive col-lg-6 mx-auto">
                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">#</th>
                                    <th class="align-middle">Item Name</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($rowItem = mysqli_fetch_array($result)) :
                                ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <?= $i++; ?>
                                        </td>
                                        <td class="text-left align-middle">
                                            <a href="view?id=<?= $rowItem['id']; ?>"><?= $rowItem['itemName']; ?></a>
                                        </td>

                                        <td class="text-center align-middle">
                                            <a href="list?dlt=<?= $rowItem['id']; ?>" class="btn btn-danger" onclick="return confirm('Sure ke nak delete?');"><i class=" far fa-trash-alt"></i></a>
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
    // $(document).ready(function() {
    //     $('#myTable').DataTable({});
    // });
</script>

<!-- Footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>