<!-- Title -->
<?php $title = "Add New Customer"; ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Get Package ID -->
<?php
$sql = "SELECT id, customerName FROM homedecor_customer ORDER BY id DESC";
$resultCustomer = mysqli_query($conn, $sql);
if ($resultCustomer) {
    $rowCustomer = mysqli_fetch_assoc($resultCustomer);
    $customerID = $rowCustomer['id'] + 1;
} else {
    echo mysqli_error($conn);
}
?>

<!-- Get Product -->
<?php
$product = "SELECT 
homedecor_product2.id AS productid,
homedecor_product2.name AS productName,
homedecor_product2.variation AS productVariation,
homedecor_product2.supplier AS productSupplier,
homedecor_product2.itemId AS productItemId,
homedecor_item2.productId AS itemId,
homedecor_item2.itemAvailable AS itemAvailable
FROM homedecor_product2
JOIN homedecor_item2
ON homedecor_product2.id = homedecor_item2.productId";
$resultproduct = mysqli_query($conn, $product);

// Select product
$productSelectOptions = array();
while ($rowProduct = $resultproduct->fetch_assoc()) {
    $productSelectOptions[$rowProduct['productid']] = $rowProduct['productSupplier'] . ' | ' . $rowProduct['productItemId'] .  ' - ' .  $rowProduct['productName'] . ' - ' . $rowProduct['productVariation'] . ' [' . $rowProduct['itemAvailable'] . ' left]';
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
        <h1 class="h3 mb-0 text-gray-800">Customers Management</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <form action="saveOrder.php" method="POST">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add Customers - <?= $customerID; ?></h6>
                        <input type="text" name="customerID" id="" class="d-none" value="<?= $customerID; ?>">
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
                                <h6 class="font-weight-bold text-info"><u>Staff Details</u></h6>
                                <div class="row my-2">
                                    <div class="col-lg-4">
                                        <label for="staffName">Staff Name</label>
                                        <input type="text" name="staffName" id="" class="form-control" value="<?= $row['fName']; ?>" readonly>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="tourDate">Insert Date</label>
                                        <input type="text" name="insertDate" id="" class="form-control" value="<?= date("d-m-Y"); ?>" readonly>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="source">Source</label>
                                        <select name="source" id="" class="form-control">
                                            <?php while ($rowSource = mysqli_fetch_assoc($resultSource)) : ?>
                                                <option value="<?= $rowSource['sourceName']; ?>"><?= $rowSource['sourceName']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="font-weight-bold text-info"><u>Customer Details</u></h6>
                                <div class="row my-2">
                                    <div class="col-lg-3 form-group">
                                        <label for="">Client Phone</label>
                                        <input type="text" name="customerPhone" id="customerPhone" class="form-control" tabindex="0" data-toggle="tooltip" title="Start with 1">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="">Client Name</label>
                                        <input type="text" name="customerName" id="customerName" class="form-control" list="nameList">
                                        <datalist id="nameList">
                                            <?php while ($rowName = mysqli_fetch_assoc($resultCustomer)) : ?>
                                                <option value="<?= $rowName['customerName']; ?>"></option>
                                            <?php endwhile; ?>
                                        </datalist>
                                    </div>
                                    <div class="col-lg-2 form-group">
                                        <label for="">Birthday</label>
                                        <input type="date" name="customerBirthday" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-3 form-group">
                                        <label for="">Client Email</label>
                                        <input type="email" name="customerEmail" id="customerEmail" class="form-control">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-6">
                                        <label for="address1">Address</label>
                                        <input type="text" name="address1" id="customerAddress" class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="address1">City</label>
                                        <input type="text" name="city" id="customerCity" class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="address1">Postcode</label>
                                        <input type="text" name="postcode" id="customerPostcode" class="form-control">
                                    </div>
                                    <div class="col-lg-2   ">
                                        <label for="address1">State</label>
                                        <input type="text" name="state" id="customerState" class="form-control" list="stateList">
                                        <datalist id="stateList">
                                            <option value="Johor">Johor</option>
                                            <option value="Kedah">Kedah</option>
                                            <option value="Kelantan">Kelantan</option>
                                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                                            <option value="Labuan">Labuan</option>
                                            <option value="Malacca">Malacca</option>
                                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                                            <option value="Pahang">Pahang</option>
                                            <option value="Perak">Perak</option>
                                            <option value="Perlis">Perlis</option>
                                            <option value="Penang">Penang</option>
                                            <option value="Sabah">Sabah</option>
                                            <option value="Sarawak">Sarawak</option>
                                            <option value="Selangor">Selangor</option>
                                            <option value="Terengganu">Terengganu</option>
                                        </datalist>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h6 class="font-weight-bold text-info"><u>Product Details</u></h6>
                        <div class="row my-4">
                            <div class="col-lg-3">
                                <label for="">Product</label>
                                <select name="product" id="product" class="selectpicker form-control" data-live-search="true">
                                    <option value=""></option>
                                    <?php foreach ($productSelectOptions as $val => $text) : ?>
                                        <option value="<?= $val; ?>"><?= $text; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Sell Defect?</label>
                                <select name="sellDefect" id="sellDefect" class="form-control">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Quantity</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Qty</span>
                                    </div>
                                    <input type="number" name="" id="quantity" class="form-control text-center" min="1" value="1">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Discount RM</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">RM</span>
                                    </div>
                                    <input type="number" name="" id="discountRinggit" class="form-control text-center" placeholder="Discount" value="0">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Discount %</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="" id="discountItem" class="form-control text-center" placeholder="Discount" value="0" step="any" min="0">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="row">
                                    <label for="">&nbsp;</label>
                                </div>
                                <button type="button" class="btn btn-primary float-right add-row"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="row my-2 d-none">
                            <div class="col-lg-12">
                                <label for="">product id</label>
                                <input type="text" id="productId" />
                                <label for="">product name</label>
                                <input type="text" id="productName" />
                                <label for="">product supplier</label>
                                <input type="text" id="productSupplier" />
                                <label for="">product code</label>
                                <input type="text" id="productItemCode" />
                                <label for="">product category</label>
                                <input type="text" id="productCategory" />
                                <label for="">product variation</label>
                                <input type="text" id="productVariation" />
                                <label for="">item id</label>
                                <input type="text" id="itemId" />
                                <label for="">item available</label>
                                <input type="text" id="itemAvailable" />
                                <label for="">item defect</label>
                                <input type="text" id="itemDefect" />
                                item sold
                                <input type="text" id="itemProductId" />
                                <label for="">item sold</label>
                                <input type="text" id="itemSold" />
                                <label for="">selling myr</label>
                                <input type="text" id="productSellingMYR" />
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg-11">
                                <table class="table table-sm table-stripped table-bordered" id="tblProducts">
                                    <thead>
                                        <tr>
                                            <th class="align-middle text-center">/</th>
                                            <th class="align-middle text-center">Code</th>
                                            <th class="align-middle" style="width: 60%;">Product Name</th>
                                            <th class="align-middle text-right">Unit Price</th>
                                            <th class="align-middle text-center">Quantity</th>
                                            <th class="align-middle text-right">Discount</th>
                                            <th class="align-middle text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-1">
                                <button type="button" class="btn btn-danger delete-row float-right"><i class="far fa-trash-alt"></i></button>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-sm-2">
                                <label for="">Shipping</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">RM</span>
                                    </div>
                                    <input type="text" name="shipping" class="form-control" aria-label="Amount (to the nearest ringgit)" value="15">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label for="">Voucher</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">RM</span>
                                    </div>
                                    <input type="text" name="voucher" class="form-control" aria-label="Amount (to the nearest ringgit)" value="" data-toggle="tooltip" data-placement="top" title="Only if voucher redeemed">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <button type="submit" class="btn btn-primary float-right" onclick="return confirm('Are you sure about submitting the data?');">Submit</button>
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

<!-- Insert phone number country code-->
<script>
    $(" #customerPhone").keyup(function() {
        var prefix = "+60"
        if (this.value.indexOf(prefix) !== 0) {
            this.value = prefix + this.value;
        }
    });
</script>

<!-- Get existing customer info -->
<script>
    $customerName = $('#customerName');
    $customerPhone = $('#customerPhone');
    $customerEmail = $('#customerEmail');
    $customerAddress = $('#customerAddress');
    $customerCity = $('#customerCity');
    $customerPostcode = $('#customerPostcode');
    $customerState = $('#customerState');

    // Fetch from the API
    var url = 'getCustomerInfo.php';

    function refreshInputForCustomer(customer) {
        $.post(url, {
            customer: customer
        }, function(r) {
            /**
             * Assuming your PHP API responds with a JSON encoded array, with the ID available.
             */
            $customerName.val(r.customerName);
            $customerPhone.val(r.customerPhone);
            $customerEmail.val(r.customerEmail);
            $customerAddress.val(r.customerAddress);
            $customerCity.val(r.customerCity);
            $customerPostcode.val(r.customerPostcode);
            $customerState.val(r.customerState);
        });
    }

    // Listen for when a customer is selected
    $customerPhone.change(function() {
        var customer = $(this).val();
        refreshInputForCustomer(customer);
    });
</script>

<!-- Get Product Info -->
<script>
    var $productSelect = $("#product");
    var $productId = $("#productId");
    var $productName = $("#productName");
    var $productSupplier = $("#productSupplier");
    var $productItemCode = $("#productItemCode");
    var $productCategory = $("#productCategory");
    var $productVariation = $("#productVariation");
    var $productSellingMYR = $("#productSellingMYR");
    var $itemId = $("#itemId");
    var $itemAvailable = $("#itemAvailable");
    var $itemDefect = $("#itemDefect");
    var $itemProductId = $("#itemProductId");
    var $itemSold = $("#itemSold");

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
            $itemId.val(r.itemId);
            $itemAvailable.val(r.itemAvailable);
            $itemDefect.val(r.itemDefect);
            $itemProductId.val(r.itemProductId);
            $productSellingMYR.val(r.productSellingMYR);
            $itemSold.val(r.itemSold);
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
        $("#discountRinggit").change(function() {
            // Get the discount percentage
            var discountRinggit = parseInt($("#discountRinggit").val());
            var productSellingMYR = parseFloat($("#productSellingMYR").val());

            // Calculate the discount
            var discountedPrice = ((discountRinggit / productSellingMYR) * 100).toFixed(2);

            // Relay the price
            $("#discountItem").val(discountedPrice);
        })

        $(".add-row").click(function() {
            var e = $("#product");
            var itemId = $("#itemId").val();
            var getID = e.val();
            var name = $("#product option:selected").text();
            var itemCode = $("#productSupplier").val() + '-' + $("#productItemCode").val().padStart(3, '0') + '-' + $("#productId").val();
            var productOrderNo = $("#productOrderNo").val();
            var quantity = parseInt($("#quantity").val());
            var discountItem = parseFloat($("#discountItem").val());
            var productSellingMYR = parseFloat($("#productSellingMYR").val());
            var sellDefect = $("#sellDefect").val();

            // Calculate the price
            if (discountItem !== 0) {
                if (sellDefect == 'yes') {
                    var discount = ((discountItem / 100) * productSellingMYR);
                    var amount = Math.round((((productSellingMYR) - discount) - 5) * quantity);
                } else {
                    var discount = (discountItem / 100) * productSellingMYR;
                    var amount = Math.round((productSellingMYR - discount) * quantity);
                }
            } else {
                // If selling defect item, deduct 5 ringgit
                if (sellDefect == 'yes') {
                    var amount = (productSellingMYR - 5) * quantity;
                    var discountItem = ((5 / productSellingMYR) * 100).toFixed(2);
                } else {
                    var amount = productSellingMYR * quantity;
                }
            }

            // Create tabel rows
            var markup = "<tr><td class='align-middle text-center'><input type='checkbox' name='record'></td><td class='text-center align-middle'>" + itemCode + "</td><td class='align-middle'><input type='text' class='border-0 form-control' value='" + name + "'><input type='text' name='productId[]' value='" + getID + "' class='d-none'><input type='text' name='itemIds[]' value='" + itemId + "' class='d-none'><input type='text' name='sellDefect[]' value='" + sellDefect + "' class='d-none'></td><td class='text-center align-middle'><input type='text' name='productPrice[]' class='text-right p-0 m-0 border-0 form-control' value='" + productSellingMYR.toFixed(2) + "'></td><td class='text-center align-middle'><input type='text' name='quantity[]' class='text-center border-0 form-control' value='" + quantity + "'></td><td class='text-center align-middle'><input type='text' name='discount[]' class='d-none' value='" + discountItem + "'>" + discountItem + "%</td><td class='text-center align-middle'><input type='text' name='discountItem[]' class='text-right p-0 m-0 border-0 form-control' value='" + amount.toFixed(2) + "'></td></tr>";
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