<!-- Header -->
<?php require('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php require('../../../src/model/dbconn.php') ?>

<?php
// Get supplier
$supply = "SELECT * FROM homedecor_supplier";
$resSupply = mysqli_query($conn, $supply);
?>

<?php
// Get product
$product = "SELECT * FROM homedecor_product WHERE thb != 0";
$resultproduct = mysqli_query($conn, $product);
$productSelectOptions = array();
while ($rowProduct = $resultproduct->fetch_assoc()) {
    $productSelectOptions[$rowProduct['id']] = $rowProduct['name'] . ' - ' . $rowProduct['orderNo'];
}


// Get the product
$id = $_GET['id'];
$po = "SELECT * FROM homedecor_supplier_order WHERE id = '$id'";
$resultPO = mysqli_query($conn, $po);
$rowPO = mysqli_fetch_assoc($resultPO);

// Explode everything
$productIDs = explode(',', $rowPO['productID']);
$productCosts = explode(',', $rowPO['productCost']);
$productQtys = explode(',', $rowPO['productQty']);
$productPrices = explode(',', $rowPO['productPrice']);
?>

<?php
if (isset($_POST['submit'])) {
    // Get everything from the post
    $supplier = $_POST['supplier'];
    $productId = implode(',', $_POST['productId']);
    $productCost = implode(',', $_POST['productCost']);
    $quantity = implode(',', $_POST['quantity']);
    $productPrice = implode(',', $_POST['productPrice']);
    $staffName = $_POST['staffName'];
    $img = implode(',', $_POST['img']);

    // Discount
    $discount = $_POST['discount'];

    // Date created and modified
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $created = date('Y-m-d H:i:s');
    $modified = date('Y-m-d H:i:s');

    // Update the table
    $update = "UPDATE homedecor_supplier_order SET productID = '$productId', productCost ='$productCost', productQty = '$quantity', productPrice = '$productPrice', discount = '$discount' WHERE id = '$id'";

    $resutUpdate = mysqli_query($conn, $update);

    if ($resutUpdate) {
        $msg = "Successfully created a new purchase order.";
        $alert = "success";
        header('Location: /project/templates/homedecor/supplier/polist?msg=success&alert=success');
    } else {
        $msg = "Error " . mysqli_error($conn);
    }
    echo $msg;
}
?>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/nav.php') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Create Purchase Order</h6>
                </div>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" class="form-group" method="POST">
                    <input type="text" name="staffName" id="" class="form-control d-none" value="<?= $staffName; ?>">
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-lg-4">
                                <label for="">Select Supplier</label>
                                <select name="supplier" id="" class="form-control">
                                    <option value="">Select</option>
                                    <?php while ($rowSupply = mysqli_fetch_assoc($resSupply)) : ?>
                                        <option value="<?= $rowSupply['id']; ?>"><?= $rowSupply['businessName']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-lg-1">
                                <label for="">Discount</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="discount" id="quantity" class="form-control text-center">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-2">

                            <div class="col-lg-4">
                                <label for="">Product</label>
                                <select name="product" id="product" class="selectpicker form-control" data-live-search="true">
                                    <option value=""></option>
                                    <?php foreach ($productSelectOptions as $val => $text) : ?>
                                        <option value="<?= $val; ?>"><?= $text; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-lg-1">
                                <label for="">Quantity</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Qty</span>
                                    </div>
                                    <input type="number" name="" id="quantity" class="form-control text-center" min="1" value="1">
                                </div>
                            </div>
                            <div class="d-none">
                                <input type="text" name="id_text" id="productOrderNo" />
                                <input type="text" name="id_text" id="productName" />
                                <input type="text" name="id_text" id="thb" />
                                <input type="text" name="id_text" id="img" />
                            </div>
                            <div class="col-lg-2">
                                <div class="row">
                                    <label for="">&nbsp;</label>
                                </div>
                                <div class="row">
                                    <input type="button" class="btn btn-info add-row" value="Add Item">
                                </div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg-11">
                                <table class="table table-stripped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="align-middle text-center">/</th>
                                            <th class="align-middle text-center">Product ID</th>
                                            <th class="align-middle" style="width: 50%;">Product Name</th>
                                            <th class="align-middle text-center">Cost ฿</th>
                                            <th class="align-middle text-center">Quantity</th>
                                            <th class="align-middle text-center">Price ฿</th>
                                            <th class="align-middle text-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($productIDs); $i++) :
                                            $products = $productIDs[$i];
                                            $quantity = $productQtys[$i];
                                            $cost = $productCosts[$i];
                                            $price = $productPrices[$i];

                                            $resultProductss = mysqli_query($conn, "SELECT* FROM homedecor_product WHERE id = '$products'");
                                            $rowPOs = mysqli_fetch_array($resultProductss);
                                        ?>
                                            <td class='align-middle text-center'><input type='checkbox' name='record'></td>
                                            <td class='text-center align-middle'><?= $rowPOs['orderNo']; ?></td>
                                            <td class='align-middle'><input type='text' class='border-0 form-control' value='<?= $rowPOs['name']; ?>'><input type='text' name='productId[]' value='<?= $rowPOs['id']; ?>' class='d-none'></td>
                                            <td class='text-center align-middle'><input type='text' class='text-center border-0 form-control' name='productCost[]' value='<?= $cost; ?>'></td>
                                            <td class='text-center align-middle'><input type='text' name='quantity[]' class='text-center border-0 form-control' value='<?= $quantity; ?>'></td>
                                            <td class='text-center align-middle'><input type='text' name='productPrice[]' class='text-center border-0 form-control' value='<?= $price; ?>'></td>
                                            <td class='text-center align-middle'><img src='/project/upload/img/product/<?= $rowPOs['img']; ?>' style='width:124px; height: 124px;'><input type='text' name='img[]' class='d-none' value='" + img + "'></td>
                                            </tr>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-1">
                                <button type="button" class="btn btn-danger delete-row float-right"><i class="far fa-trash-alt"></i> Delete</button>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Sidebar -->
<?php require('../../elements/admin/dashboard/footer.php') ?>

<!-- Get Product Info -->
<script>
    var $productSelect = $('#product');
    var $productOrderNo = $('#productOrderNo');
    var $productName = $('#productName');
    var $thb = $('#thb');
    var $img = $('#img');

    // This should be the path to a PHP script set up to receive $_POST['product']
    // and return the product info in a JSON encoded array.
    // You should also set the Content-Type of the response to application/json so as our javascript parses it automatically.
    var apiUrl = '/templates/homedecor/crm/getProductInfo.php';

    function refreshInputsForProduct(product) {
        $.post(apiUrl, {
            product: product
        }, function(r) {
            /**
             * Assuming your PHP API responds with a JSON encoded array, with the ID available.
             */
            $productOrderNo.val(r.orderNo);
            $productName.val(r.name);
            $thb.val(r.thb);
            $img.val(r.img);
        });
    }

    // Listen for when a new product is selected.
    $productSelect.change(function() {
        var product = $(this).val();
        refreshInputsForProduct(product);
    });
</script>

<script>
    $(document).ready(function() {
        $(".add-row").click(function() {
            var e = document.getElementById("product");
            var getID = e.value;
            var name = e.options[e.selectedIndex].text;
            var productOrderNo = parseInt($("#productOrderNo").val());
            var quantity = parseInt($("#quantity").val());
            var thb = parseFloat($("#thb").val());
            var img = $("#img").val();

            // Calculate the prices
            var total = thb * quantity;

            // Create tabel rows
            var markup = "<tr><td class='align-middle text-center'><input type='checkbox' name='record'></td><td class='text-center align-middle'>" + productOrderNo + "</td><td class='align-middle'><input type='text' class='border-0 form-control' value='" + name + "'><input type='text' name='productId[]' value='" + getID + "' class='d-none'></td><td class='text-center align-middle'><input type='text' class='text-center border-0 form-control' name='productCost[]' value='" + thb + "'></td><td class='text-center align-middle'><input type='text' name='quantity[]' class='text-center border-0 form-control' value='" + quantity + "'></td><td class='text-center align-middle'><input type='text' name='productPrice[]' class='text-center border-0 form-control' value='" + total + "'></td><td class='text-center align-middle'><img src='/project/upload/img/product/" + img + "' style='width:124px; height: 124px;'><input type='text' name='img[]' class='d-none' value='" + img + "'></td></tr>";
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
    });
</script>