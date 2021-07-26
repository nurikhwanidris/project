<!-- Title -->
<?php $title = "Add New Order"; ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Get Customer Info -->
<?php
$customer = "SELECT * FROM homedecor_customer";
$resultCustomer = mysqli_query($conn, $customer);
$customerSelectOptions = array();
while ($rowCustomer = $resultCustomer->fetch_assoc()) {
    $customerSelectOptions[$rowCustomer['id']] = $rowCustomer['customerName'];
}
?>

<!-- Get Product -->
<?php
$product = "SELECT * FROM homedecor_product";
$resultproduct = mysqli_query($conn, $product);
$productSelectOptions = array();
while ($rowProduct = $resultproduct->fetch_assoc()) {
    $productSelectOptions[$rowProduct['id']] = $rowProduct['name'] . ' - ' . $rowProduct['orderNo'];
}
?>

<!-- Get the Source -->
<?php
$source = "SELECT * FROM source";
$resultSource = mysqli_query($conn, $source);
date_default_timezone_set("Asia/Kuala_Lumpur");
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Order Management</h1>
    </div>
    <form action="#" method="POST">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add New Order</h6>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
                                <div class="row my-4">
                                    <div class="col-lg-4">
                                        <label for="">Select Customer</label>
                                        <select name="customer" id="customer" class="selectpicker form-control" data-live-search="true">
                                            <option value=""></option>
                                            <?php foreach ($customerSelectOptions as $value => $ayat) : ?>
                                                <option value="<?= $value; ?>"><?= $ayat; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-md-4">
                                        <label for="">Add Shipping Cost?</label>
                                        <select name="" id="addShipping" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row my-4">
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
                                    <div class="col-lg-1">
                                        <label for="">Discount</label>
                                        <div class="input-group mb-3">
                                            <input type="number" name="" id="discountItem" class="form-control text-center" value="0" min="0">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="row">
                                            <label for="">&nbsp;</label>
                                        </div>
                                        <div class="row">
                                            <button type="button" class="btn btn-info add-row"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-12">
                                        <input type="text" name="id_text" id="productOrderNo" />
                                        <input type="text" name="id_text" id="productName" />
                                        <input type="text" name="id_text" id="productCost" />
                                        <input type="text" class="total" name="id_text" id="productFixedPrice" />
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-10">
                                        <table class="table table-sm table-stripped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle text-center">/</th>
                                                    <th class="align-middle text-center">ID</th>
                                                    <th class="align-middle pl-3" style="width: 60%;">Product Name</th>
                                                    <th class="align-middle text-center">Quantity</th>
                                                    <th class="align-middle text-center">Price</th>
                                                    <th class="align-middle text-center">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="align-middle text-right" colspan="5">Subtotal</td>
                                                    <td class="align-middle text-center"><input type="text" class="form-control border-0" readonly name="final_total_amount" id="final_total_amt"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-danger delete-row"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-12">
                                        <input type="text" name="subTotal" id="final_total_amt">
                                    </div>
                                </div>
                                <div style="display: none;" id="ship">
                                    <hr>
                                    <div class="row my-2">
                                        <div class="col-lg-2 col-md-3">
                                            <label for="">Shipping</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">RM</span>
                                                </div>
                                                <input type="text" name="shipping" id="shipping" class="form-control" placeholder="00.00">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure about submitting the data?');">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>

<!-- Get Product Info -->
<script>
    var $productSelect = $('#product');
    var $productOrderNo = $('#productOrderNo');
    var $productName = $('#productName');
    var $productCost = $('#productCost');
    var $productFixedPrice = $('#productFixedPrice');

    // This should be the path to a PHP script set up to receive $_POST['product']
    // and return the product info in a JSON encoded array.
    // You should also set the Content-Type of the response to application/json so as our javascript parses it automatically.
    var apiUrl = 'getProductInfo.php';

    function refreshInputsForProduct(product) {
        $.post(apiUrl, {
            product: product
        }, function(r) {
            /**
             * Assuming your PHP API responds with a JSON encoded array, with the ID available.
             */
            $productOrderNo.val(r.orderNo);
            $productName.val(r.name);
            $productCost.val(r.cost);
            $productFixedPrice.val(r.price);
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
        var final_total_amt = $('#final_total_amt').val();
        var count = 1;
        $(".add-row").click(function() {
            var e = document.getElementById("product");
            var getID = e.value;
            var name = e.options[e.selectedIndex].text;
            var productOrderNo = $("#productOrderNo").val();
            var quantity = parseInt($("#quantity").val());
            var discountInput = 0;
            var discountItem = parseInt($("#discountItem").val()) || discountInput;

            // Calculate price based on cost
            var productCost = parseFloat($("#productCost").val());
            var productFixedPrice = parseFloat($("#productFixedPrice").val());
            if (productFixedPrice === 0) {
                var productPrice = Math.round((productCost * 2.5) + 6) * quantity;
            } else {
                var productPrice = parseFloat($("#productFixedPrice").val()) * quantity
            }

            // Check for discount
            if (discountItem !== '') {
                // Calculate discount
                var percentToDecimal = discountItem / 100;
                var percent = percentToDecimal * productPrice;
                var discount = productPrice - percent;
                var productPrice = Math.round(discount);
            }

            // Create tabel rows
            var markup = "<tr><td class='align-middle text-center'><input type='checkbox' name='record'></td><td class='text-center align-middle'>" + productOrderNo + "</td><td class='align-middle'><input type='text' class='border-0 form-control' value='" + name + "'><input type='text' name='productId[]' value='" + getID + "' class='d-none'></td><td class='text-center align-middle'><input type='text' name='quantity[]' class='text-center border-0 form-control' id='itemQuantity' value='" + quantity + "'></td><td class='text-center align-middle'><input type='text' name='productPrice[]' class='text-center border-0 form-control total' id='itemPrice' value='" + productPrice + "'></td><td class='text-center align-middle'><input type='text' class='border-0' id='actualAmount' readonly></td></tr>";
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

        function cal_final_total(count) {
            var final_item_total = 0;
            for (j = 1; j <= count; j++) {
                var quantity = 0;
                var price = 0;
                var item_total = 0;
                quantity = parseInt($("#quantity" + j).val());
                // quantity = $("#quantity" + j).val();
                if (quantity > 0) {
                    price = parseFloat($("#productFixedPrice" + j).val());
                    // price = $("#itemPrice" + j).val();
                    if (price > 0) {
                        actualAmount = parseFloat(quantity) * parseFloat(price);
                        $("#actualAmount" + j).val(actualAmount);
                        final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
                        $("#order_item_final_amount" + j).val(item_total);
                    }
                }
            }
            $('#final_total_amt').val('asd');
        }

    });
</script>

<script>
    document.getElementById('addShipping').addEventListener('change', function() {
        var style = this.value == 1 ? 'block' : 'none';
        document.getElementById('ship').style.display = style;
    });
</script>