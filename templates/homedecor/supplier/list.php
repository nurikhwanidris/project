<!-- Header -->
<?php require('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php require('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/nav.php') ?>

<?php
// Fetch supplier
$supply = "SELECT * FROM homedecor_supplier";
$resSupply = mysqli_query($conn, $supply);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List of Suppliers</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th class="align-middle">Business Name</th>
                                    <th class="align-middle text-center">Category</th>
                                    <th class="align-middle text-center">Status</th>
                                    <th class="align-middle">PIC Name</th>
                                    <th class="align-middle text-center">PIC Phone</th>
                                    <th class="align-middle text-center">PIC Email</th>
                                    <th class="align-middle text-center" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rowSupply = mysqli_fetch_assoc($resSupply)) : ?>
                                    <tr>
                                        <td class="align-middle">
                                            <?= $rowSupply['businessName']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $rowSupply['supplierCategory']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $rowSupply['supplierStatus']; ?>
                                        </td>
                                        <td class="align-middle">
                                            <?= $rowSupply['firstName'] . ' ' . $rowSupply['lastName']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $rowSupply['supplierPhone']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $rowSupply['supplierEmmail']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="#" class="btn btn-info">Edit</a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="#" class="btn btn-danger">Delete</a>
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
<?php require('../../elements/admin/dashboard/footer.php') ?>