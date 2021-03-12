<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<?php
// Get supplier data
$selectSupplier = "SELECT * FROM homedecor_supplier WHERE id = '1'";
$resSupplier = mysqli_query($conn, $selectSupplier);
$rowSupplier = mysqli_fetch_assoc($resSupplier);
?>

<!-- Title -->
<?php $title = "PO-" . str_pad($_GET['id'], 4, 0, STR_PAD_LEFT); ?>

<!-- Get the order details -->
<?php
$id = $_GET['id'];
$sqlOrder = "SELECT * FROM homedecor_supplier_order WHERE id = '$id'";
$resOrder = mysqli_query($conn, $sqlOrder);
$rowOrder = mysqli_fetch_assoc($resOrder);

// Make everything explodeeeeeeeeee
$productID = explode(',', $rowOrder['productID']);
$productQty = explode(',', $rowOrder['productQty']);
$productCost = explode(',', $rowOrder['productCost']);
$productPrice = explode(',', $rowOrder['productPrice']);
$productStatus = explode(',', $rowOrder['status']);
$staffName = explode(',', $rowOrder['staffName']);
?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-lg-12 col-xl-12 p-0 m-0">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-xl-12">
                            <div class="col-4 float-left text-left">
                                <h4 class="font-weight-bold">Arzu Home & Living</h4>
                                <p>
                                    243B, Jalan Bandar 13 <br>
                                    Taman Melawati <br>
                                    53100, Kuala Lumpur<br>
                                    Office : <b>03-4162 8179</b> <br>
                                    Mobile : <b>011-1675 8179</b>
                                </p>
                            </div>
                            <div class="col-4 float-right text-right">
                                <img src="/project/upload/img/invoice-logo-1.png" alt="" srcset="" style="height: auto; width: 70%;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-12">
                        <h4 class="font-weight-bold">Purchase Order</h4>
                        <div class="row">
                            <div class="col-4 float-left text-left">
                                <p><u>Vendor :</u></p>
                                <p>
                                    <input type="text" name="customerID" id="" class="form-control d-none" value="<?= $rowSupplier['id']; ?>">
                                    <span class="font-weight-bold"><?= $rowSupplier['businessName']; ?></span> <br>
                                    <?= $rowSupplier['supplierAddress1'] . ' ' . $rowSupplier['supplierAddress2']; ?> <br>
                                    <?= $rowSupplier['supplierCity'] . ", " . $rowSupplier['supplierPostcode'] . ",<br> " . $rowSupplier['supplierState'] ?>
                            </div>
                            <div class="col-4">
                                <p><u>Person in Charge :</u></p>
                                <span class="font-weight-bold">
                                    <?= $rowSupplier['firstName'] . ' ' . $rowSupplier['lastName']; ?>
                                </span><br>
                                <span>
                                    <?= $rowSupplier['supplierPhone']; ?> <br>
                                    <?= $rowSupplier['supplierEmail']; ?> <br>
                                </span>
                            </div>
                            <div class="col-4 float-right text-right">
                                <p>
                                    Purchase Order # : <span class="font-weight-bold"><?= date("Ym") . str_pad($id, 4, 0, STR_PAD_LEFT); ?></span>
                                    <input type="text" name="invoiceNum" id="" class="form-control d-none" value="<?= date("Ym") . str_pad($id, 4, 0, STR_PAD_LEFT); ?>"><br>
                                    Date : <span class="font-weight-bold"><?= date("d/m/Y"); ?><input type="text" name="invoiceDate" id="" class="form-control d-none" value="<?= date("Y-m-d"); ?>"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12 col-xl-12 table-reponsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">No</th>
                                        <th class="align-middle text-center">Picture</th>
                                        <th class="align-middle" style="width: 40%;">Description</th>
                                        <th class="align-middle text-right" style="width: 15%;">Unit Price ฿</th>
                                        <th class="align-middle text-center">Qty</th>
                                        <th class="align-middle text-right" style="width: 10%;">Amount ฿</th>
                                        <th class="align-middle text-center d-print-none">Code</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $x = 1;
                                    for ($i = 0; $i < count($productID); $i++) :
                                        $product = $productID[$i];
                                        $quantity = $productQty[$i];
                                        $price = $productPrice[$i];
                                        $cost = $productCost[$i];
                                        $status = $productStatus[$i];
                                        $staff = $staffName[$i];
                                        $selProduct = "SELECT * FROM homedecor_product WHERE id = '$product'";
                                        $resProduct = mysqli_query($conn, $selProduct);
                                        $rowProduct = mysqli_fetch_array($resProduct);

                                    ?>
                                        <tr>
                                            <td class="align-middle text-center">
                                                <?= $x++; ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <img src="/project/upload/img/product/<?= $rowProduct['img']; ?>" alt="" srcset="" class="rounded" style="width:124px; height:124px;">
                                            </td>
                                            <td class="align-middle">
                                                <?= $rowProduct['name']; ?>
                                            </td>
                                            <td class="align-middle text-right">
                                                <?= $cost; ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?= $quantity; ?>
                                            </td>
                                            <td class="align-middle text-right">
                                                <?= $price; ?>
                                            </td>
                                            <td class="align-middle text-center d-print-none">
                                                <?= $rowProduct['orderNo']; ?>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                    <tr>
                                        <td class="text-right align-middle" colspan="6">
                                            ฿<?= array_sum($productPrice); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4 d-print-none">
                        <div class="col-lg-12 col-xl-12">
                            <div class="col-lg-4 float-right text-right">
                                <a class="btn btn-info" onclick="window.print();"><i class="fas fa-print"></i> Print</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>