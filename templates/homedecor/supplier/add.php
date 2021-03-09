<!-- Title -->
<?php $title = "Add New Supplier"; ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<?php
// Save supplier
if (isset($_POST['submit'])) {
    $businessName = $_POST['businessName'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $supplierPhone = $_POST['supplierPhone'];
    $supplierEmail = $_POST['supplierEmail'];
    $supplierAddress1 = $_POST['supplierAddress1'];
    $supplierAddress2 = $_POST['supplierAddress2'];
    $supplierCity = $_POST['supplierCity'];
    $supplierPostcode = $_POST['supplierPostcode'];
    $supplierState = $_POST['supplierState'];
    $supplierBank = $_POST['supplierBank'];
    $supplierAccountNumber = $_POST['supplierAccountNumber'];
    $supplierCurrency = $_POST['supplierCurrency'];

    // Date created and modified
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $created = date('Y-m-d H:i:s');
    $modified = date('Y-m-d H:i:s');

    $insert = "INSERT INTO homedecor_supplier (businessName, firstName, lastName, supplierPhone, supplierEmail, supplierAddress1, supplierAddress2, supplierCity, supplierPostcode, supplierState, supplierBank, supplierAccountNumber, supplierCurrency, created, modified) VALUES ('$businessName', '$firstName', '$lastName', '$supplierPhone', '$supplierEmail', '$supplierAddress1', '$supplierAddress2', '$supplierCity', '$supplierPostcode', '$supplierState', '$supplierBank', '$supplierAccountNumber', '$supplierCurrency', '$created', '$modified')";
    $resInsert = mysqli_query($conn, $insert);

    if ($resInsert) {
        $msg = "Successfully inserted the supplier";
        $alert = "success";
    } else {
        $msg = "Error " . mysqli_error($conn);
    }
    echo $msg;
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Supplier</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="form-group">
        <div class="row">
            <div class="col-lg-8 col-xl-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Supplier Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-lg-12">
                                <label for="">Business name</label>
                                <input type="text" name="businessName" id="" class="form-control">
                            </div>
                        </div>
                        <h6 class="font-weight-bold">Contact Person</h6>
                        <div class="row my-2">
                            <div class="col-lg-6">
                                <label for="">First Name</label>
                                <input type="text" name="firstName" id="" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Last Name</label>
                                <input type="text" name="lastName" id="" class="form-control">
                            </div>
                        </div>
                        <h6 class="font-weight-bold">Phone & Email</h6>
                        <div class="row my-2">
                            <div class="col-lg-6">
                                <label for="">Phone</label>
                                <input type="text" name="supplierPhone" id="" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Email</label>
                                <input type="email" name="supplierEmail" id="" class="form-control">
                            </div>
                        </div>
                        <h6 class="font-weight-bold">Address</h6>
                        <div class="row my-2">
                            <div class="col-lg-6">
                                <label for="">Street Address 1</label>
                                <input type="text" name="supplierAddress1" id="" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Street Address 2</label>
                                <input type="text" name="supplierAddress2" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg-4">
                                <label for="">City</label>
                                <input type="text" name="supplierCity" id="" class="form-control">
                            </div>
                            <div class="col-lg-4">
                                <label for="">Postcode</label>
                                <input type="text" name="supplierPostcode" id="" class="form-control">
                            </div>
                            <div class="col-lg-4">
                                <label for="">State</label>
                                <input type="text" name="supplierState" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Supplier Account Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-lg-12">
                                <label for="">Account Number</label>
                                <input type="text" name="supplierAccountNumber" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg-12">
                                <label for="">Bank Name</label>
                                <input type="text" name="supplierBank" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg-12">
                                <label for="">Currency</label>
                                <input type="text" name="supplierCurrency" id="" class="form-control" list="currency">
                                <datalist id="currency">
                                    <option value="USD">United States Dollars</option>
                                    <option value="EUR">Euro</option>
                                    <option value="GBP">United Kingdom Pounds</option>
                                    <option value="DZD">Algeria Dinars</option>
                                    <option value="ARP">Argentina Pesos</option>
                                    <option value="AUD">Australia Dollars</option>
                                    <option value="ATS">Austria Schillings</option>
                                    <option value="BSD">Bahamas Dollars</option>
                                    <option value="BBD">Barbados Dollars</option>
                                    <option value="BEF">Belgium Francs</option>
                                    <option value="BMD">Bermuda Dollars</option>
                                    <option value="BRR">Brazil Real</option>
                                    <option value="BGL">Bulgaria Lev</option>
                                    <option value="CAD">Canada Dollars</option>
                                    <option value="CLP">Chile Pesos</option>
                                    <option value="CNY">China Yuan Renmimbi</option>
                                    <option value="CYP">Cyprus Pounds</option>
                                    <option value="CSK">Czech Republic Koruna</option>
                                    <option value="DKK">Denmark Kroner</option>
                                    <option value="NLG">Dutch Guilders</option>
                                    <option value="XCD">Eastern Caribbean Dollars</option>
                                    <option value="EGP">Egypt Pounds</option>
                                    <option value="FJD">Fiji Dollars</option>
                                    <option value="FIM">Finland Markka</option>
                                    <option value="FRF">France Francs</option>
                                    <option value="DEM">Germany Deutsche Marks</option>
                                    <option value="XAU">Gold Ounces</option>
                                    <option value="GRD">Greece Drachmas</option>
                                    <option value="HKD">Hong Kong Dollars</option>
                                    <option value="HUF">Hungary Forint</option>
                                    <option value="ISK">Iceland Krona</option>
                                    <option value="INR">India Rupees</option>
                                    <option value="IDR">Indonesia Rupiah</option>
                                    <option value="IEP">Ireland Punt</option>
                                    <option value="ILS">Israel New Shekels</option>
                                    <option value="ITL">Italy Lira</option>
                                    <option value="JMD">Jamaica Dollars</option>
                                    <option value="JPY">Japan Yen</option>
                                    <option value="JOD">Jordan Dinar</option>
                                    <option value="KRW">Korea (South) Won</option>
                                    <option value="LBP">Lebanon Pounds</option>
                                    <option value="LUF">Luxembourg Francs</option>
                                    <option value="MYR">Malaysia Ringgit</option>
                                    <option value="MXP">Mexico Pesos</option>
                                    <option value="NLG">Netherlands Guilders</option>
                                    <option value="NZD">New Zealand Dollars</option>
                                    <option value="NOK">Norway Kroner</option>
                                    <option value="PKR">Pakistan Rupees</option>
                                    <option value="XPD">Palladium Ounces</option>
                                    <option value="PHP">Philippines Pesos</option>
                                    <option value="XPT">Platinum Ounces</option>
                                    <option value="PLZ">Poland Zloty</option>
                                    <option value="PTE">Portugal Escudo</option>
                                    <option value="ROL">Romania Leu</option>
                                    <option value="RUR">Russia Rubles</option>
                                    <option value="SAR">Saudi Arabia Riyal</option>
                                    <option value="XAG">Silver Ounces</option>
                                    <option value="SGD">Singapore Dollars</option>
                                    <option value="SKK">Slovakia Koruna</option>
                                    <option value="ZAR">South Africa Rand</option>
                                    <option value="KRW">South Korea Won</option>
                                    <option value="ESP">Spain Pesetas</option>
                                    <option value="XDR">Special Drawing Right (IMF)</option>
                                    <option value="SDD">Sudan Dinar</option>
                                    <option value="SEK">Sweden Krona</option>
                                    <option value="CHF">Switzerland Francs</option>
                                    <option value="TWD">Taiwan Dollars</option>
                                    <option value="THB">Thailand Baht</option>
                                    <option value="TTD">Trinidad and Tobago Dollars</option>
                                    <option value="TRL">Turkey Lira</option>
                                    <option value="VEB">Venezuela Bolivar</option>
                                    <option value="ZMK">Zambia Kwacha</option>
                                    <option value="EUR">Euro</option>
                                    <option value="XCD">Eastern Caribbean Dollars</option>
                                    <option value="XDR">Special Drawing Right (IMF)</option>
                                    <option value="XAG">Silver Ounces</option>
                                    <option value="XAU">Gold Ounces</option>
                                    <option value="XPD">Palladium Ounces</option>
                                    <option value="XPT">Platinum Ounces</option>
                                </datalist>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg-12">
                                <button class="btn btn-info float-right" name="submit" type="submit">Submit</button>
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