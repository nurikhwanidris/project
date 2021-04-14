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

<!-- Link -->
<link rel="stylesheet" type="text/css" href="/project/assets/css/print.min.css">

<!-- jsPDF -->
<script src="/project/assets/js/jspdf.umd.js"></script>
<script src="/project/assets/js/jspdf.plugin.autotable.js"></script>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<style>
    .doubleUnderline {
        text-decoration-line: underline;
        text-decoration-style: double;
    }

    @media print {
        @page {
            size: A4;
            /* DIN A4 standard, Europe */
            margin: 0;
        }

        html,
        body {
            width: 210mm;
            /* height: 297mm; */
            height: 282mm;
            font-size: 11px;
            background: #FFF;
            overflow: visible;
        }

        body {
            padding-top: 15mm;
        }

        table,
        tr {
            border: 2px solid black;
            border-collapse: collapse;
        }
    }
</style>

<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-lg-12 col-xl-12 p-0 m-0">
            <div class="card mb-4">
                <div class="card-body" id="">
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
                                <img src="/project/upload/img/invoice-logo-1.png" alt="" srcset="" style="height: auto; width: 70%;" id="imgNjir">
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
                                    Purchase Order # : <span class="font-weight-bold"><?= str_pad($_GET['id'], 4, 0, STR_PAD_LEFT); ?></span>
                                    <input type="text" name="invoiceNum" id="" class="form-control d-none" value="<?= str_pad($_GET['id'], 4, 0, STR_PAD_LEFT); ?>"><br>
                                    Date : <span class="font-weight-bold">
                                        <?php $created = $rowOrder['created'];
                                        $dt = new DateTime($created);
                                        $date = $dt->format('d/m/Y');
                                        echo $date; ?>
                                        <input type="text" name="invoiceDate" id="" class="form-control d-none" value="
                                        <?php $created = $rowOrder['created'];
                                        $dt = new DateTime($created);
                                        $date = $dt->format('d/m/Y');
                                        echo $date; ?>"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12 col-xl-12 table-reponsive">
                            <table class="table table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">No</th>
                                        <th class="align-middle text-center">Picture</th>
                                        <th class="align-middle" style="width: 40%;">Description</th>
                                        <th class="align-middle text-right" style="width: 15%;">Unit Price <span class="d-none">THB</span></th>
                                        <th class="align-middle text-center">Qty</th>
                                        <th class="align-middle text-right" style="width: 10%;">Amount <span class="d-none">THB</span></th>
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
                                                <?= number_format($cost, 2, '.', ','); ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?= $quantity; ?>
                                            </td>
                                            <td class="align-middle text-right">
                                                <?= number_format($price, 2, '.', ','); ?>
                                            </td>
                                            <td class="align-middle text-center d-print-none">
                                                <?= $rowProduct['orderNo']; ?>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                    <tr>
                                        <td class="text-right align-middle" colspan="6">
                                            Total
                                        </td>
                                        <td class="text-center align-middle">
                                            THB <?= $amount = number_format(array_sum($productPrice), 2, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right align-middle" colspan="6">
                                            Discount
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $discount = $rowOrder['discount']; ?>%
                                        </td>
                                    </tr>
                                    <tr class="font-weight-bold">
                                        <td class="text-right align-middle" colspan="6">
                                            <h5 class="font-weight-bold ">
                                                Grand Total
                                            </h5>
                                        </td>
                                        <td style="background-color: yellow;" class="text-center align-middle">
                                            <?php
                                            $total = array_sum($productPrice);
                                            $discLvl = $discount / 100;
                                            $totalAmount = number_format($total - ($total * $discLvl), 2, '.', ',');
                                            ?>
                                            <h5 class="font-weight-bold doubleUnderline">THB <?= $totalAmount; ?></h5>
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
                            <div class="col-lg-4 float-left text-left">
                                <!-- <button type="button" class="btn btn-primary" onclick="generate()"><i class="fas fa-file-pdf"></i> PDF</button> -->
                                <a href="pdf.php?id=<?= $_GET['id']; ?>" class="btn btn-warning border"><i class="fas fa-file-pdf"></i> PDF</a>
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

<!-- HTMl to PDF -->
<script>
    function generate() {
        var doc = new jspdf.jsPDF()
        var imgData = 'data:image/png;base'
        // Simple html example
        doc.autoTable({
            html: '#table',
            theme: 'grid',
            body: [
                [{
                    content: 'Text',
                    styles: {
                        halign: 'center'
                    }
                }],
            ],
        })

        doc.save('<?= "PO-" . str_pad($_GET['id'], 4, 0, STR_PAD_LEFT); ?>.pdf');
    }
</script>