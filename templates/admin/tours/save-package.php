<?php
include('../../../src/model/dbconn.php');
$tourID = $_POST['tourID'];
$tourName = $_POST['tourName'];
$tourDate = $_POST['tourDate'];
$tourItinerary = $_POST['tourItinerary'];
$tourCities = $_POST['tourCities'];
$include = implode(',', $_POST['include']);
$exclude = implode(',', $_POST['exclude']);
$airlines = $_POST['airlines'];
$flight1 = $_POST['flight1'];
$airline1 = $_POST['airline1'];
$sector1 = $_POST['sector1'];
$etd1 = $_POST['etd1'];
$eta1 = $_POST['eta1'];
$flight2 = $_POST['flight2'];
$airline2 = $_POST['airline2'];
$sector2 = $_POST['sector2'];
$etd2 = $_POST['etd2'];
$eta2 = $_POST['eta2'];
$flight3 = $_POST['flight3'];
$airline3 = $_POST['airline3'];
$sector3 = $_POST['sector3'];
$etd3 = $_POST['etd3'];
$eta3 = $_POST['eta3'];
$flight4 = $_POST['flight4'];
$sector4 = $_POST['sector4'];
$airline4 = $_POST['airline4'];
$etd4 = $_POST['etd4'];
$eta4 = $_POST['eta4'];
$flight5 = $_POST['flight5'];
$airline5 = $_POST['airline5'];
$sector5 = $_POST['sector5'];
$etd5 = $_POST['etd5'];
$eta5 = $_POST['eta5'];
$twn = $_POST['twn'];
$sgl = $_POST['sgl'];
$ctw = $_POST['ctw'];
$cwb = $_POST['cwb'];
$cnb = $_POST['cnb'];
$snr_twn = $_POST['snr_twn'];
$snr_sgl = $_POST['snr_sgl'];
$status = $_POST['status'];
$meals = $_POST['meals'];
$hotel = $_POST['hotel'];
$season = $_POST['season'];
$type = $_POST['type'];
$promo = $_POST['feature'];
$promoStart = $_POST['promoStart'];
$promoEnd = $_POST['promoEnd'];
$deposit = $_POST['deposit'];
$depositAmount = $_POST['depositAmount'];
$discount = $_POST['discount'];
$discountAmount = $_POST['discountAmount'];

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

// Upload image
$image = $_FILES['img-save']['name'];
$target = "../../../upload/img/" . basename($image);

// Upload PDF doc
$pdf = $_FILES['doc-save']['name'];
$targetDoc = "../../../upload/doc/" . basename($pdf);

// Insert into tours table
$tours = "INSERT INTO tours (name, date, description, cities, include, exclude, img, doc, created, modified) VALUE ('$tourName', '$tourDate', '$tourItinerary', '$tourCities', '$include', '$exclude', '$image', '$pdf', '$created', '$modified')";
if ($resultTours = mysqli_query($conn, $tours)) {
    move_uploaded_file($_FILES['img-save']['tmp_name'], $target);
    move_uploaded_file($_FILES['doc-save']['tmp_name'], $targetDoc);
    echo "Berjaya insert dalam tours<br>";
    echo "Berjaya simpan image dlm folder img dan doc<br>";
} else {
    echo mysqli_error($conn) . "<br>";
}

// Insert into tours_flight table
$tourFlight = "INSERT INTO tours_flight (tour_id, airlines, flight1, sector1, etd1, eta1, flight2, sector2, etd2, eta2, flight3, sector3, etd3, eta3, flight4, sector4, etd4, eta4) VALUES ('$tourID','$airlines', '$flight1', '$sector1', '$etd1', '$eta1', '$flight2', '$sector2', '$etd2', '$eta2', '$flight3', '$sector3', '$etd3', '$eta3', '$flight4', '$sector4', '$etd4', '$eta4')";
if ($resultFlight = mysqli_query($conn, $tourFlight)) {
    echo "Berjaya insert dalam tours_flight<br>";
} else {
    echo mysqli_error($conn) . "<br>";
}

// Insert into tours_price table
$toursPrice = "INSERT INTO tours_price (tour_id, twn, sgl, ctw, cwb, cnb, snr_twn, snr_sgl) VALUE ('$tourID','$twn', '$sgl', '$ctw', '$cwb', '$cnb', '$snr_twn', '$snr_sgl')";
if ($resultPrice = mysqli_query($conn, $toursPrice)) {
    echo "Berjaya insert dalam tours_price<br>";
} else {
    echo  mysqli_error($conn) . "<br>";
}

// Insert into tours_settings
$toursSetting =  "INSERT INTO tours_settings (tour_id, status, meals, hotel, season, type, promo, promoStart, promoEnd, deposit, deposit_amount, discount, discount_amount) VALUES ('$tourID','$status', '$meals', '$hotel', '$season', '$type', '$promo', '$promoStart', '$promoEnd', '$deposit', '$depositAmount', '$discount', '$discountAmount')";
if ($resultSetting = mysqli_query($conn, $toursSetting)) {
    echo "Berjaya insert dalam tours_setting<br>";
} else {
    echo mysqli_error($conn) . "<br>";
}
