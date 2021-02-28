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
$product = "SELECT * FROM homedecor_product WHERE quantity != 0 ";
$resultproduct = mysqli_query($conn, $product);
$productSelectOptions = array();
while ($rowProduct = $resultproduct->fetch_assoc()) {
    $productSelectOptions[$rowProduct['id']] = $rowProduct['name'];
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
    <form action="save-customer.php" method="POST">
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
                                        <input type="date" name="dob" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-3 form-group">
                                        <label for="">Client Phone</label>
                                        <input type="text" name="customerPhone" id="customerPhone" class="form-control" tabindex="0" data-toggle="tooltip" title="Start with 1">
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
                                <hr>
                                <h6 class="font-weight-bold text-info"><u>Product Details</u></h6>
                                <div class="row my-4">
                                    <div class="col-lg-4">
                                        <label for="">Product</label>
                                        <select name="product" id="product" class="selectpicker form-control" data-live-search="true">
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
                                            <input type="number" name="" id="discountItem" class="form-control text-center" placeholder="Discount" value="0">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-none">
                                        <input type="text" name="id_text" id="productOrderNo" />
                                        <input type="text" name="id_text" id="productName" />
                                        <input type="text" name="id_text" id="productCost" />
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
                                    <div class="col-lg-10">
                                        <table class="table table-stripped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle text-center">/</th>
                                                    <th class="align-middle text-center">Product ID</th>
                                                    <th class="align-middle" style="width: 60%;">Product Name</th>
                                                    <th class="align-middle text-center">Quantity</th>
                                                    <th class="align-middle text-center">Price</th>
                                                    <th class="align-middle text-center">Discount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-danger delete-row float-right"><i class="far fa-trash-alt"></i> Delete Item</button>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-2">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Disc for All</span>
                                            </div>
                                            <input type="number" name="discountAll" id="discountAll" class="form-control text-center" placeholder="Discount" value="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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

<!-- Insert phone number country code-->
<script>
    $("#customerPhone").keyup(function() {
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
    $customerName.change(function() {
        var customer = $(this).val();
        refreshInputForCustomer(customer);
    });
</script>

<!-- Get Product Info -->
<script>
    var $productSelect = $('#product');
    var $productOrderNo = $('#productOrderNo');
    var $productName = $('#productName');
    var $productCost = $('#productCost');

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
            var discountItem = parseInt($("#discountItem").val());

            // Calculate price based on cost
            var productCost = parseFloat($("#productCost").val());
            var productPrice = Math.round((productCost * 2.5) + 6) * quantity;

            // Calculate discount
            var percentToDecimal = discountItem / 100;
            var percent = percentToDecimal * productPrice;
            var discount = productPrice - percent;

            // Create tabel rows
            var markup = "<tr><td class='align-middle text-center'><input type='checkbox' name='record'></td><td class='text-center align-middle'>" + productOrderNo + "</td><td class='align-middle'><input type='text' class='border-0 form-control' value='" + name + "'><input type='text' name='productId[]' value='" + getID + "' class='d-none'></td><td class='text-center align-middle'><input type='text' name='quantity[]' class='text-center border-0 form-control' value='" + quantity + "'></td><td class='text-center align-middle'><input type='text' name='productPrice[]' class='text-center border-0 form-control' value='" + productPrice + "'></td><td class='text-center align-middle'><input type='text' name='discountItem[]' class='text-center border-0 form-control' value='" + discount + "'></td></tr>";
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