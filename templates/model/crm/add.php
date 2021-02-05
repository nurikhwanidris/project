<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Get Package ID -->
<?php
$sql = "SELECT id FROM customers ORDER BY id DESC";
$resultSql = mysqli_query($conn, $sql);
if ($resultSql) {
    $row = mysqli_fetch_assoc($resultSql);
    $customerID = $row['id'] + 1;
} else {
    echo mysqli_error($conn);
}
?>

<!-- Get Package -->
<?php
$package = "SELECT * FROM tours";
$resultPackage = mysqli_query($conn, $package);
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
                                        <input type="text" name="staffName" id="" class="form-control">
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
                                        <input type="text" name="customerName" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="">Client Phone</label>
                                        <input type="text" name="customerPhone" id="customerPhone" class="form-control" tabindex="0" data-toggle="tooltip" title="Start with 1">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="">Client Email</label>
                                        <input type="email" name="customerEmail" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-6">
                                        <label for="address1">Address</label>
                                        <input type="text" name="address1" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="address1">City</label>
                                        <input type="text" name="city" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="address1">Postcode</label>
                                        <input type="text" name="postcode" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-2   ">
                                        <label for="address1">State</label>
                                        <select name="state" id="" class="form-control">
                                            <option value="">Select</option>
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
                                <h6 class="font-weight-bold text-info"><u>Package Details</u></h6>
                                <div class="row my-2">
                                    <div class="col-lg-2">
                                        <label for="">Package Type</label>
                                        <select name="packageType" id="" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="SD">SD</option>
                                            <option value="FIT">FIT</option>
                                            <option value="Private">Private</option>
                                            <option value="Academic">Academic</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Package Name</label>
                                        <input type="text" name="packageName" id="" list="packageName" class="form-control">
                                        <datalist id="packageName">
                                            <?php while ($rowPackage = mysqli_fetch_assoc($resultPackage)) : ?>
                                                <option value="<?= $rowPackage['name']; ?>">
                                                <?php endwhile; ?>
                                        </datalist>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Package Date</label>
                                        <input type="date" name="packageDate" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-2 mt-2">
                                        <label for="">TWN</label>
                                        <input type="number" name="packageTWN" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-2 mt-2">
                                        <label for="">SGL</label>
                                        <input type="number" name="packageSGL" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-2 mt-2">
                                        <label for="">CTW</label>
                                        <input type="number" name="packageCTW" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-2 mt-2">
                                        <label for="">CWB</label>
                                        <input type="number" name="packageCWB" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-2 mt-2">
                                        <label for="">CNB</label>
                                        <input type="number" name="packageCNB" id="" class="form-control">
                                    </div>
                                </div>
                                <hr>
                                <div class="row my-2">
                                    <div class="col">
                                        <h6 class="text-info font-weight-bold"><u>Other Request</u></h6>
                                        <textarea name="request" id="" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
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