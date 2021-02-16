<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Get Package ID -->
<?php
$customerID = $_GET['customerID'];
$sql = "SELECT * FROM homedecor_customer WHERE id = '$customerID'";
$resultSql = mysqli_query($conn, $sql);
$rowCustomer = mysqli_fetch_assoc($resultSql);
?>

<!-- Get Package -->
<?php
$product = "SELECT * FROM homedecor_product WHERE quantity != 0 ";
$resultproduct = mysqli_query($conn, $product);
?>

<!-- Get enquiries data -->
<?php
$enquiry = "SELECT * FROM homedecor_enquiries WHERE customer_id = '$customerID'";
$resultEnquiry = mysqli_query($conn, $enquiry);
$rowEnquiry = mysqli_fetch_array($resultEnquiry);
?>

<!-- Get the Source -->
<?php
$source = "SELECT * FROM source";
$resultSource = mysqli_query($conn, $source);
date_default_timezone_set("Asia/Kuala_Lumpur");
?>

<!-- Explode everything -->
<?php
$explodeProduct = explode(',', $rowEnquiry['product_id']);
$explodeQuantity = explode(',', $rowEnquiry['quantity']);
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customers Management</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <form action="save-po.php" method="POST">
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
                                        <input type="text" name="staffName" id="" class="form-control" value="<?= $rowCustomer['staffName']; ?>" readonly>

                                    </div>
                                    <div class="col-lg-4">
                                        <label for="tourDate">Insert Date</label>
                                        <input type="text" name="insertDate" id="" class="form-control" value="<?= $rowCustomer['created'] ?>" readonly>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="source">Source</label>
                                        <select name="source" id="" class="form-control" disabled>
                                            <option value="<?= $rowCustomer['source']; ?>"><?= $rowCustomer['source']; ?></option>
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
                                        <input type="text" name="customerName" id="" class="form-control" value="<?= $rowCustomer['customerName']; ?>">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="">Client Phone</label>
                                        <input type="text" name="customerPhone" id="customerPhone" class="form-control" tabindex="0" data-toggle="tooltip" title="Start with 1" value="<?= $rowCustomer['customerPhone']; ?>">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="">Client Email</label>
                                        <input type="email" name="customerEmail" id="" class="form-control" value="<?= $rowCustomer['customerEmail']; ?>">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-6">
                                        <label for="address1">Address</label>
                                        <input type="text" name="address1" id="" class="form-control" value="<?= $rowCustomer['address1']; ?>">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="address1">City</label>
                                        <input type="text" name="city" id="" class="form-control" value="<?= $rowCustomer['city']; ?>">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="address1">Postcode</label>
                                        <input type="text" name="postcode" id="" class="form-control" value="<?= $rowCustomer['postcode']; ?>">
                                    </div>
                                    <div class="col-lg-2   ">
                                        <label for="address1">State</label>
                                        <select name="state" id="" class="form-control">
                                            <option value="<?= $rowCustomer['state']; ?>"><?= $rowCustomer['state']; ?></option>
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
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="font-weight-bold text-info"><u>Product Details</u></h6>
                                <div class="row my-2">
                                    <div class="col-lg-9">
                                        <table class="table table-stripped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle text-center" style="width: 5%;">Select</th>
                                                    <th class="align-middle" style="width: 60%;">Product Name</th>
                                                    <th class="align-middle text-center">Quantity</th>
                                                    <th class="text-center align-middle">Price/Unit</th>
                                                    <th class="text-center align-middle">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach (array_combine($explodeProduct, $explodeQuantity) as $explodeProduct => $explodeQuantity) :
                                                    $display = "SELECT * FROM homedecor_product WHERE id = '$explodeProduct'";
                                                    $res = mysqli_query($conn, $display);
                                                    while ($rowDisplay = mysqli_fetch_array($res)) : $ppu = round(($rowDisplay['cost'] * 2.5) + 6, 3); ?>
                                                        <tr>
                                                            <td class="text-center align-middle">
                                                                <input type='checkbox' name='record'>
                                                            </td>
                                                            <td class="align-middle">
                                                                <input type="text" name="productName[]" id="" class="border-0 form-control" value="<?= $rowDisplay['name']; ?>">
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <input type="text" name="productQuantity[]" id="" class="text-center form-control border-0" value="<?= $explodeQuantity; ?>">
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <input type="text" name="productCost[]" id="" class="text-center form-control border-0" value="<?= $ppu; ?>">
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <input type="text" name="productTotal[]" id="" class="text-center form-control border-0" value="<?= round($ppu * $explodeQuantity, 2); ?>">
                                                            </td>
                                                        </tr>
                                                <?php endwhile;
                                                endforeach; ?>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-danger delete-row">Delete Row</button>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col">
                                        <button class="btn btn-primary float-right">Submit</button>
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

<script>
    $("#customerPhone").keyup(function() {
        var prefix = "+60"

        if (this.value.indexOf(prefix) !== 0) {
            this.value = prefix + this.value;
        }
    });
</script>
<script>
    $(document).ready(function() {
        $(".add-row").click(function() {
            // var e = document.getElementById("ddlViewBy");
            // var name = e.value;
            var e = document.getElementById("name");
            var getID = e.value;
            var name = e.options[e.selectedIndex].text;
            var quantity = parseInt($("#quantity").val());
            var markup = "<tr><td class='align-middle text-center'><input type='checkbox' name='record'></td><td class='align-middle'><input type='text' class='border-0 form-control' value='" + name + "'><input type='text' name='product[]' value='" + getID + "' class='d-none'></td><td class='text-center align-middle'><input type='text' name='quantity[]' class='text-center border-0 form-control' value='" + quantity + "'></td></tr>";
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