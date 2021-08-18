<!-- Title -->
<?php $title = 'Purchase Order' ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- DB Conn -->
<?php include('../../../src/model/dbconn.php'); ?>

<?php
// Get PO details
$viewPO =  "SELECT * FROM homedecor_po WHERE id = '" . $_GET['id'] . "'";
$resultViewPO = mysqli_query($conn, $viewPO);
$rowPO = mysqli_fetch_assoc($resultViewPO);

// Get PO items details
$viewItems = "SELECT * FROM homedecor_po_items WHERE poId = '" . $_GET['id'] . "'";
$resultViewItems = mysqli_query($conn, $viewItems);
?>

<?php
// Get product details
$product = "SELECT * FROM homedecor_product2";
$resultproduct = mysqli_query($conn, $product);
$productSelectOptions = array();
while ($rowProduct = $resultproduct->fetch_assoc()) {
    $productSelectOptions[$rowProduct['id']] = $rowProduct['name'] . ' | ' . $rowProduct['itemId'];
}

?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Purchase Order Management</h1>
    </div>
    <div class="row" id="print">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">New Purchase Order</h6>
                </div>
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-lg-12">
                            <div class="row form-group">
                                <label for="poNumber" class="col-sm-2 col-form-label">Purchase Order Number</label>
                                <div class="col-sm-3">
                                    <input type="text" name="poNumber" id="poNumber" class="form-control" value="<?= $rowPO['id']; ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="poSupplier" class=" col-sm-2 col-form-label">Supplier</label>
                                <div class="col-sm-3">
                                    <input type="text" name="poSupplier" id="poSupplier" class="form-control" value="<?= $rowPO['supplier']; ?>" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-sm-2 col-form-label">Batch Number</label>
                                <div class="col-sm-3">
                                    <input type="text" name="poBatch" id="poBatch" class="form-control" value="<?= $rowPO['batch']; ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="poCreated" class="col-sm-2 col-form-label">Date Created</label>
                                <div class="col-sm-2">
                                    <input type="datetime" name="poCreated" id="poCreated" class="form-control" value="<?= $rowPO['created']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="poExpectedDelivery" class="col-sm-2 col-form-label">Expected Delivery Date</label>
                                <div class="col-sm-2">
                                    <input type="date" name="poExpectedDelivery" id="poExpectedDelivery" class="form-control" value="<?= $rowPO['expectedDeliveryDate']; ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="poExpectedArrival" class="col-sm-2 col-form-label">Expected Arrival Date</label>
                                <div class="col-sm-2">
                                    <input type="date" name="poExpectedArrival" id="poExpectedArrival" class="form-control" value="<?= $rowPO['expectedArrivalDate']; ?>">
                                </div>
                            </div>
                            <div class="row form-group d-print-none" id="exclude">
                                <label for="poProduct" class="col-sm-2 col-form-label">Select Product</label>
                                <div class="col-sm-3">
                                    <select name="poProduct" id="poProduct" class="selectpicker form-control" data-live-search="true">
                                        <option value=""></option>
                                        <?php foreach ($productSelectOptions as $val => $text) : ?>
                                            <option value="<?= $val; ?>"><?= $text; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-sm-7">
                                    <button type="button" class="btn btn-primary float-left add-row"><i class="fas fa-plus"></i></button>
                                    <button type="button" class="btn btn-danger float-right delete-row"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            <div class="row form-group d-none">
                                <div class="col-sm-12">
                                    <label for="">product id</label>
                                    <input type="text" id="productId" /><br>
                                    <label for="">product name</label>
                                    <input type="text" id="productName" /><br>
                                    <label for="">product supplier</label>
                                    <input type="text" id="productSupplier" /><br>
                                    <label for="">product code</label>
                                    <input type="text" id="productItemCode" /><br>
                                    <label for="">product size</label>
                                    <input type="text" id="productSize" /><br>
                                    <label for="">product category</label>
                                    <input type="text" id="productCategory" /><br>
                                    <label for="">product cost thb</label>
                                    <input type="text" id="productTHB" /><br>
                                    <label for="">img file name</label>
                                    <input type="text" id="productImg" /><br>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-sm" id="purchaseOrder">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="align-middle text-center" rowspan="2" style="width: 20px;">/</th>
                                                <th class="align-middle text-center" rowspan="2">Picture</th>
                                                <th class="align-middle" rowspan="2">Item Code</th>
                                                <th class="align-middle" rowspan="2">Product Desc.</th>
                                                <th class="align-middle text-center" rowspan="2">Size (Inch)</th>
                                                <th class="align-middle text-center" rowspan="2" style="width: 100px;">Unit Price ฿</th>
                                                <th class="align-middle text-center" rowspan="2" style="width: 100px;">Qty</th>
                                                <th class="align-middle text-center" rowspan="2" style="width: 100px;">Amount ฿</th>
                                                <th class="align-middle text-center text-wrap" colspan="2">Available (Supplier)</th>
                                                <th class="align-middle text-center text-wrap" colspan="3">Received (Arzu Home)</th>
                                            </tr>
                                            <tr>
                                                <th class="align-middle text-center" style="width: 70px;">Yes</th>
                                                <th class="align-middle text-center" style="width: 70px;">No</th>
                                                <th class="align-middle text-center" style="width: 100px;">Qty</th>
                                                <th class="align-middle text-center" style="width: 100px;">Extra</th>
                                                <th class="align-middle text-center" style="width: 100px;">Broken</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($rowOrderItems = mysqli_fetch_assoc($resultViewItems)) :
                                                $selectProduct2 = "SELECT * FROM homedecor_product2 WHERE id = '" . $rowOrderItems['productId'] . "'";
                                                $resultProduct2 = mysqli_query($conn, $selectProduct2);
                                                $rowProduct2 = mysqli_fetch_assoc($resultProduct2);
                                            ?>
                                                <tr>
                                                    <td class="align-middle text-center" style="width: 20px;"><input type="checkbox" class="form-control" name="record" style="width: 20px;"></td>
                                                    <td class="align-middle text-center" style="width: 200px;">
                                                        <img src="/project/upload/img/product/2021/<?= $rowProduct2['img']; ?>" alt="" srcset="" height="200px" width="200px">
                                                        <input type="text" name="productId[]" class="d-none" id="" value="<?= $rowItem['productId']; ?>">
                                                    </td>
                                                    <td class="align-middle">
                                                        <?= $rowProduct2['supplier'] . '-' . str_pad($rowProduct2['itemCode'], 4, 0, STR_PAD_LEFT) . '-' . $rowProduct2['itemId']; ?>
                                                    </td>
                                                    <td class="align-middle">
                                                        <?= $rowProduct2['name']; ?>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <?= $rowProduct2['size']; ?>
                                                    </td>
                                                    <td class="align-middle text-center" style="width: 100px;">
                                                        <input type="text" name="poCostTHB[]" id="poCostTHB" class="border-0 text-center" style="width: 100px;" value="<?= $rowOrderItems['costTHB']; ?>" readonly>
                                                    </td>
                                                    <td class="align-middle text-center" style="width: 100px;">
                                                        <input type="number" name="poQuantity[]" id="poQuantity" class="border-0 text-center" style="width: 100px;" value="<?= $rowOrderItems['quantity']; ?>">
                                                    </td>
                                                    <td class="align-middle text-center" style="width: 100px;">
                                                        <input type="text" name="poAmount[]" id="poAmount" class="border-0 text-center" style="width: 100px;" value="<?= $rowOrderItems['amount']; ?>">
                                                    </td>
                                                    <td class="align-middle text-center">

                                                    </td>
                                                    <td class="align-middle text-center">

                                                    </td>
                                                    <td class="align-middle text-center">

                                                    </td>
                                                    <td class="align-middle text-center">

                                                    </td>
                                                    <td class="align-middle text-center">

                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                        <tfoot style="border:none;" class="border-0">
                                            <tr style="border:none;" class="border-0">
                                                <td class="text-right" colspan="11">Total Items Ordered</td>
                                                <td class="border-0 font-weight-bold text-right text-primary h5" colspan="2"><?= $rowPO['totalQuantity']; ?></td>
                                            </tr>
                                            <tr style="border:none;">
                                                <td class="text-right" colspan="11">Total Amount</td>
                                                <td class="font-weight-bold text-right text-white bg-secondary h5" colspan="2">฿ <?= number_format($rowPO['totalAmount'], 2, '.', ','); ?></td>
                                            </tr>
                                            <tr style="border:none;">
                                                <td class="text-right" colspan="11">Discount</td>
                                                <td class="font-weight-bold text-right text-white bg-info h5" colspan="2">- ฿ <?= number_format(($rowPO['totalAmount']) * 0.22, 2, '.', ','); ?></td>
                                            </tr>
                                            <tr style="border:none;">
                                                <td class="text-right" colspan="11">After Discount</td>
                                                <td class="font-weight-bold text-right text-white bg-success h5" colspan="2">฿
                                                    <?php
                                                    $discount = $rowPO['totalAmount'] * .22;
                                                    $afterDiscount = $rowPO['totalAmount'] - $discount;
                                                    echo number_format($afterDiscount, 2, '.', ',');
                                                    ?>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-lg-12">
            <button href="#" class="btn btn-primary float-right" id="printPO"><i class="fas fa-print"></i> Print</button>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>

<script>
    var $productSelect = $("#poProduct");
    var $productId = $("#productId");
    var $productName = $("#productName");
    var $productSupplier = $("#productSupplier");
    var $productItemCode = $("#productItemCode");
    var $productCategory = $("#productCategory");
    var $productVariation = $("#productVariation");
    var $productSize = $("#productSize");
    var $productTHB = $("#productTHB");
    var $productImg = $("#productImg");

    var apiUrl = "getItemInfo.php";

    function refreshInputsForProduct(product) {
        $.post(apiUrl, {
            product: product
        }, function(r) {
            $productId.val(r.productId);
            $productName.val(r.productName);
            $productSupplier.val(r.productSupplier);
            $productItemCode.val(r.productItemCode);
            $productCategory.val(r.productCategory);
            $productVariation.val(r.productVariation);
            $productSize.val(r.productSize);
            $productTHB.val(r.productCostTHB);
            $productImg.val(r.productImg);
        });
    }

    // Listen for when a new product is selected.
    $productSelect.change(function() {
        var product = $(this).val();
        refreshInputsForProduct(product);
    });

    $(document).ready(function() {

        $(".add-row").click(function() {
            var i = 0;
            var e = $("#product");
            var productId = $("#productId").val();
            var getID = e.val();
            var productName = $("#productName").val();
            var productImg = $("#productImg").val();
            var productSize = $("#productSize").val();
            var itemCode = $("#productSupplier").val() + '-' + $("#productItemCode").val().padStart(4, '0') + '-' + $("#productId").val();
            var productTHB = parseFloat($("#productTHB").val());

            // Create table rows
            var markup = '<tr><td class="align-middle text-center" style="width: 20px;"><input type="checkbox" class="form-control" name="record" style="width: 20px;"></td><td class="align-middle text-center" ><img src="/project/upload/img/product/2021/' + productImg + '" alt="" srcset="" height="200px" width="200px"><input type="text" name="productId[]" class="d-none" value="' + productId + '"></td><td class="align-middle">' + itemCode + '</td><td class="align-middle text-left">' + productName + '</td> <td class="align-middle text-center">' + productSize + '</td><td class="align-middle text-center"><input type="text" name="poCostTHB[]" id="poCostTHB" class="border-0 text-center" style="width: 100px;" value="' + productTHB + '"></td> <td class="align-middle text-center"><input type="number" name="poQuantity[]" id="poQuantity" class="border-0 text-center" style="width: 100px;" value="0"></td> <td class="align-middle text-center" ><input type="text" name="poAmount[]" id="poAmount" class="border-0 text-center" style="width: 100px;" value="0"></td></tr>';
            $("table tbody").append(markup);
        });

        // Find and remove selected table rows
        $(".delete-row").click(function() {
            $("table tbody").find('input[name="record"]').each(function() {
                if ($(this).is(":checked")) {
                    $(this).parents("tr").remove();
                }
            });
        });

        $("table").on("change", "#poQuantity", function() {
            var row = $(this).closest("tr");
            var poQuantity = parseInt(row.find("#poQuantity").val());
            var poCostTHB = parseInt(row.find("#poCostTHB").val());
            var poAmount = poQuantity * poCostTHB;
            var getTotal = row.find("#poAmount").val(poAmount);
        });
    });

    $(document).ready(function() {
        $("#printPO").click(function() {
            var element = document.getElementById('print');
            var opt = {
                margin: 1,
                filename: 'PO-<?= str_pad($rowPO['id'], 6, 0, STR_PAD_LEFT); ?>.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A3',
                    orientation: 'landscape'
                }
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();

            // Old monolithic-style usage:
            html2pdf(element, opt);
        });
    });
</script>