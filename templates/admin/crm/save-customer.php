<?php

include('../../../src/model/dbconn.php');

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

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

// Insert into customer table
$customer = "INSERT INTO customers (staffName, source, customerName, customerEmail, customerPhone, address1, city, postcode, state, created, modified) VALUE ('$staffName', '$source', '$customerName', '$customerEmail', '$strippedSpace', '$address1', '$city', '$postcode', '$state', '$created', '$modified')";
if ($resultCustomer = mysqli_query($conn, $customer)) {
    echo "Berjaya insert dalam customer's table<br>";
} else {
    echo mysqli_error($conn) . "<br>";
}

// Insert into enquiry table
$enquiry = "INSERT INTO enquiries (customerID, packageType, packageName, packageDate, packageTWN, packageSGL, packageCTW, packageCWB, packageCNB, request, created, modified) VALUE ('$customerID', '$packageType', '$packageName', '$packageDate', '$packageTWN', '$packageSGL', '$packageCTW', '$packageCWB', '$packageCNB', '$request', '$created', '$modified')";
if ($resultEnquiry = mysqli_query($conn, $enquiry)) {
    echo "Berjaya insert dalam enquiry table";
} else {
    echo mysqli_error($conn) . "<br>";
}
