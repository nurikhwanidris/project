<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Get Customer Details -->
<?php
$customerID = $_GET['customerID'];
$sql = "SELECT * FROM customers WHERE id = '$customerID'";
$resultSql = mysqli_query($conn, $sql);
$rowCustomer = mysqli_fetch_assoc($resultSql)
?>

<!-- Get Package Details -->
<?php
$package = "SELECT * FROM enquiries WHERE customerID = '$customerID'";
$resultPackage = mysqli_query($conn, $package);
$packageDetails = mysqli_fetch_assoc($resultPackage);
?>

<!-- Get the Source -->
<?php
$source = "SELECT * FROM source";
$resultSource = mysqli_query($conn, $source);
date_default_timezone_set("Asia/Kuala_Lumpur");
?>

<?php
// Update into database
if (isset($_POST['submit'])) {
    $customerID = $_POST['customerID'];
    $staffName = $_POST['staffName'];
    $source = $_POST['source'];
    $customerName = $_POST['customerName'];
    $customerEmail = $_POST['customerEmail'];
    $customerPhone = $_POST['customerPhone'];
    $strippedSpace = str_replace(' ', '', $customerPhone);
    $address1 = $_POST['address1'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $state = $_POST['state'];
    $packageType = $_POST['packageType'];
    $packageName = $_POST['packageName'];
    $packageDate = $_POST['packageDate'];
    $packageTWN = $_POST['packageTWN'];
    $packageSGL = $_POST['packageSGL'];
    $packageCTW = $_POST['packageCTW'];
    $packageCWB = $_POST['packageCWB'];
    $packageCNB = $_POST['packageCNB'];
    $request = $_POST['request'];
    $assignStaff = $_POST['assignStaff'];
    $status = $_POST['status'];

    // Date created and modified
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $created = date('Y-m-d H:i:s');
    $modified = date('Y-m-d H:i:s');

    // Update the customer information
    $updateCustomer = "UPDATE customers SET staffName = '$staffName', source = '$source', customerName = '$customerName', customerEmail = '$customerEmail', customerPhone = '$strippedSpace', address1 = '$address1', city = '$city', postcode = '$postcode', state = '$state', modified ='$modified' WHERE id = '$customerID'";
    if ($resultCustomer = mysqli_query($conn, $updateCustomer)) {
        $msg = 'The customer information has been sucessfully updated';
        $alert = '-success';
    } else {
        $msg = 'Error on ' . mysqli_error($conn);
        $alert = '-danger';
    }

    // Update the package information
    $updatePackage = "UPDATE enquiries SET packageType = '$packageType', packageName = '$packageName', packageDate = '$packageDate', packageTWN = '$packageTWN', packageSGL = '$packageSGL', packageCTW = '$packageCTW', packageCWB = '$packageCWB', packageCNB = '$packageCNB', modified = '$modified', assigned = '$assignStaff', status = '$status'  WHERE customerID = '$customerID'";
    if ($resultUpdatePackage = mysqli_query($conn, $updatePackage)) {
        $msg  = '<strong>Success!</strong> All the updated information will appeared after the page refreshed in <strong><u><span class="c" id="5"></span></u></strong>.';
        $alert = '-success';
        echo "<meta http-equiv='refresh' content='4.5'>";
    } else {
        $msg = 'Error on ' . mysqli_error($conn);
        $alert = '-danger';
    }
}


?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customers Management</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="row">
        <div class="col">
            <?php if (isset($_POST['submit'])) : ?>
                <div class="alert alert<?= $alert; ?> alert-dismissible fade show" role="alert">
                    <?= $msg; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="row">
            <div class="col xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add Customers - <?= $rowCustomer['id']; ?></h6>
                        <input type="text" name="customerID" id="" class="d-none" value="<?= $rowCustomer['id']; ?>">
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
                                        <input type="text" name="insertDate" id="" class="form-control" value="<?= $rowCustomer['created']; ?>" readonly>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="source">Source</label>
                                        <select name="source" id="" class="form-control" <?php if ($packageDetails['status'] == 'Confirmed' || $packageDetails['status'] == 'Cancelled') : echo "readonly";
                                                                                            endif; ?>>
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
                                <h6 class="font-weight-bold text-info"><u>Package Details</u></h6>
                                <div class="row my-2">
                                    <div class="col-lg-2">
                                        <label for="">Package Type</label>
                                        <select name="packageType" id="" class="form-control" required>
                                            <option value="<?= $packageDetails['packageType']; ?>"><?= $packageDetails['packageType']; ?></option>
                                            <option value="SD">SD</option>
                                            <option value="FIT">FIT</option>
                                            <option value="Private">Private</option>
                                            <option value="Academic">Academic</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Package Name</label>
                                        <input type="text" name="packageName" id="" list="packageName" class="form-control" value="<?= $packageDetails['packageName']; ?>">
                                        <datalist id="packageName">
                                            <?php while ($rowPackage = mysqli_fetch_assoc($resultPackage)) : ?>
                                                <option value="<?= $rowPackage['name']; ?>">
                                                <?php endwhile; ?>
                                        </datalist>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Package Date</label>
                                        <input type="text" name="packageDate" id="" class="form-control" value="<?= $packageDetails['packageDate']; ?>">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-2 mt-2">
                                        <label for="">TWN</label>
                                        <input type="number" name="packageTWN" id="" class="form-control" value="<?= $packageDetails['packageTWN']; ?>">
                                    </div>
                                    <div class="col-lg-2 mt-2">
                                        <label for="">SGL</label>
                                        <input type="number" name="packageSGL" id="" class="form-control" value="<?= $packageDetails['packageSGL']; ?>">
                                    </div>
                                    <div class="col-lg-2 mt-2">
                                        <label for="">CTW</label>
                                        <input type="number" name="packageCTW" id="" class="form-control" value="<?= $packageDetails['packageCTW']; ?>">
                                    </div>
                                    <div class="col-lg-2 mt-2">
                                        <label for="">CWB</label>
                                        <input type="number" name="packageCWB" id="" class="form-control" value="<?= $packageDetails['packageCWB']; ?>">
                                    </div>
                                    <div class="col-lg-2 mt-2">
                                        <label for="">CNB</label>
                                        <input type="number" name="packageCNB" id="" class="form-control" value="<?= $packageDetails['packageCNB']; ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="row my-2">
                                    <div class="col">
                                        <h6 class="text-info font-weight-bold"><u>Other Request</u></h6>
                                        <textarea name="request" id="" cols="30" rows="5" class="form-control"><?= $packageDetails['request']; ?></textarea>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="text-info font-weight-bold"><u>Assignment</u></h6>
                                <div class="row my-2">
                                    <div class="col-lg-4">
                                        <label for="">Assign Staff</label>
                                        <input type="text" name="assignStaff" id="" list="assignStaff" class="form-control" value="<?= $packageDetails['assigned']; ?>">
                                        <datalist id="assignStaff">
                                            <option value="Danial">Danial</option>
                                            <option value="Nadia">Nadia</option>
                                            <option value="Apocalyspe">Apocalyspe</option>
                                            <option value="Kacang">Kacang</option>
                                        </datalist>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Status</label>
                                        <input type="text" name="status" id="" class="form-control" list="statusList" value="<?= $packageDetails['status']; ?>">
                                        <datalist id="statusList">
                                            <option value="Confirmed">Confirmed</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Unassigned">Unassigned</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
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
    function c() {
        var n = $('.c').attr('id');
        var c = n;
        $('.c').text(c);
        setInterval(function() {
            c--;
            if (c >= 0) {
                $('.c').text(c);
            }
            if (c == 0) {
                $('.c').text(n);
            }
        }, 1000);
    }

    // Start
    c();

    // Loop
    setInterval(function() {
        c();
    }, 5000);
</script>