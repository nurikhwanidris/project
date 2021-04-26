<!-- Title -->
<?php $title = "Update Inventory"; ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Database -->
<?php
// Id
$id = $_GET['id'];

// homedecor_item
$item = "SELECT * FROM homedecor_item WHERE id = '$id'";
$resultItem = mysqli_query($conn, $item);
$rowItem = mysqli_fetch_assoc($resultItem);

// homedecor_item_summary
$summary = "SELECT * FROM homedecor_item_summary WHERE itemID = '$id' ORDER BY id DESC";
$resultSummary = mysqli_query($conn, $summary);

// only for emergency
$lastRow = "SELECT * FROM homedecor_item_summary ORDER BY id DESC LIMIT 1";
$resultAsd = mysqli_query($conn, $lastRow);
$rowSummary = mysqli_fetch_assoc($resultAsd);
$existingBalance = $rowSummary['itemBalance'];

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

if (isset($_POST['submit'])) {
    // POST items
    $itemCost = $_POST['itemCost'];
    $itemQtyIn = $_POST['itemQtyIn'];
    $itemInDate = $_POST['itemInDate'];
    $itemQtyOut = $_POST['itemQtyOut'];
    $itemOutDate = $_POST['itemOutDate'];

    if ($itemQtyIn != '' && $itemInDate != '') {
        // Insert dulu
        $insert  = "INSERT INTO homedecor_item_summary (itemID, itemCost, itemQtyIn, itemInDate, created, modified) VALUES ('$id', '$itemCost', '$itemQtyIn', '$itemInDate', '$created', '$modified')";
        $resultInsert = mysqli_query($conn, $insert);

        // Cari last inserted id dia apa
        // $lastID = mysqli_insert_id($conn);

        // Cari last row
        $selectRow = "SELECT * FROM homedecor_item_summary ORDER BY id DESC LIMIT 1";
        $resultRow = mysqli_query($conn, $selectRow);
        $lastRow = mysqli_fetch_assoc($resultRow);
        $rowLast = $lastRow['id'];

        // Update lepas tu
        $update = "UPDATE homedecor_item_summary SET itemBalance = ItemQtyIn + '$existingBalance' WHERE id = '$rowLast'";
        $resultUpdate = mysqli_query($conn, $update);

        if ($resultUpdate) {
            $msg = "Succesfully updated the item information for " . $lastID;
            $alert = "success";
        } else {
            $msg = "An error occured. " . mysqli_error($conn);
            $alert = "danger";
        }
    } elseif ($itemOutDate != '' && $itemQtyOut != '') {
        // Insert dulu boi
        $insert = "INSERT INTO homedecor_item_summary (itemID, itemQtyOut, itemOutDate, created, modified) VALUES ('$id', '$itemQtyOut', '$itemOutDate', '$created', '$modified')";
        $resultInsert = mysqli_query($conn, $insert);

        // cari last insert id dia boi
        // $lastID = mysqli_insert_id($conn);

        // Cari last row
        $selectRow = "SELECT * FROM homedecor_item_summary ORDER BY id DESC LIMIT 1";
        $resultRow = mysqli_query($conn, $selectRow);
        $lastRow = mysqli_fetch_assoc($resultRow);
        $rowLast = $lastRow['id'];

        $update = "UPDATE homedecor_item_summary SET itemBalance = '$existingBalance' - '$itemQtyOut' WHERE id = '$rowLast'";
        $resultUpdate = mysqli_query($conn, $update);

        // check for result
        if ($resultUpdate) {
            $msg = "Successfully update the item information.";
            $alert = "success";
        } else {
            $msg = "Error occured. " . mysqli_error($conn);
            $alert = "danger";
        }
    }
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Item</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <?php if (isset($msg)) : ?>
        <div class="row mt-3 d-print-none">
            <div class="col-lg-4 col-xl-4">
                <div class="alert alert-<?= $alert; ?> alert-dismissible fade show" role="alert">
                    <?= $msg; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" class="form-group" method="POST">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Item Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-lg-12">
                                <label for="">Name</label>
                                <input type="text" name="itemName" id="" class="form-control" value="<?= $rowItem['itemName']; ?>" readonly>
                            </div>
                        </div>
                        <hr>
                        <h6 class="text-info">In</h6>
                        <div class="row my-2">
                            <div class="col-lg-6">
                                <label for="">Cost</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">RM</span>
                                    </div>
                                    <input type="text" name="itemCost" id="" class="form-control" data-toggle="tooltip" data-placement="top" title="Cost must include shipping">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row my-2">
                            <div class="col-lg-6">
                                <label for="">Quantity</label>
                                <input type="number" name="itemQtyIn" id="" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="">In (Date)</label>
                                <input type="date" name="itemInDate" id="" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <h6 class="text-info">Out</h6>
                        <div class="row my-2">
                            <div class="col-lg-6">
                                <label for="">Quantity</label>
                                <input type="number" name="itemQtyOut" id="" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Out (Date)</label>
                                <input type="date" name="itemOutDate" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <button class="btn btn-success float-right" name="submit" onclick="return confirm('Click Ok if everything is right');">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-8 col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Item Summary</h6>
                </div>
                <div class="card-body">
                    <div class="col-lg-12" style="height: 500px; overflow-y: scroll;">
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center align-middle">#</th>
                                    <th class="text-center align-middle">In (Date)</th>
                                    <th class="text-center align-middle">Qty (In)</th>
                                    <th class="text-center align-middle">Out (Date)</th>
                                    <th class="text-center align-middle">Qty (Out)</th>
                                    <th class="text-center align-middle">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($itemSummary = mysqli_fetch_assoc($resultSummary)) :
                                    // Date in
                                    $dateIn = $itemSummary['itemInDate'];
                                    if ($dateIn == '0000-00-00') {
                                        $newDateIn = '';
                                    } else {
                                        $newDateIn = date('d/m/Y', strtotime($dateIn));
                                        $masuk = "text-success font-weight-bold";
                                    }
                                    // Date out
                                    $dateOut = $itemSummary['itemOutDate'];
                                    if ($dateOut == '0000-00-00') {
                                        $newDateOut = '';
                                    } else {
                                        $newDateOut = date('d/m/y', strtotime($dateOut));
                                        $keluar = "text-danger font-weight-bold";
                                    }
                                    // itemQtyIn
                                    $itemIn = $itemSummary['itemQtyIn'];
                                    if ($itemIn == '0') {
                                        $itemIn = '';
                                    } else {
                                        $itemIn = $itemSummary['itemQtyIn'];
                                    }
                                    // itemQtyOut
                                    $itemOut = $itemSummary['itemQtyOut'];
                                    if ($itemOut == '0') {
                                        $itemOut = '';
                                    } else {
                                        $itemOut = $itemSummary['itemQtyOut'];
                                    }
                                ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $i++; ?></td>
                                        <td class="text-center align-middle <?= $masuk; ?>"><?= $newDateIn; ?></td>
                                        <td class="text-center align-middle <?= $masuk; ?>"><?= $itemIn; ?></td>
                                        <td class="text-center align-middle <?= $keluar; ?>"><?= $newDateOut; ?></td>
                                        <td class="text-center align-middle <?= $keluar; ?>"><?= $itemOut; ?></td>
                                        <td class="text-center align-middle"><?= $itemSummary['itemBalance'] ?></td>
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