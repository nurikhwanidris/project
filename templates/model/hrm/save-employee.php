<?php

include('../../../src/model/dbconn.php');

$empID = $_POST['empID'];
$ic = $_POST['ic'];
$fName = ucwords($_POST['fName']);
$lName = ucwords($_POST['lName']);
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$postcode = $_POST['postcode'];
$city = $_POST['city'];
$state = $_POST['state'];
$username = $_POST['username'];
$passwordHash = password_hash($_POST['password2'], PASSWORD_DEFAULT);
$dept = $_POST['dept'];
$position = $_POST['position'];
$doh = $_POST['doh'];
$status = $_POST['status'];
$al = $_POST['al'];
$mc = $_POST['mc'];
$mt = $_POST['mt'];

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

// Upload image
$image = $_FILES['img-save']['name'];
$target = "../../../upload/img/emp-picture/" . basename($image);

// Check if employee already existed
$empCheck = "SELECT * FROM employee_information WHERE id = '$empID'";
$resultCheck = mysqli_query($conn, $empCheck);

if (mysqli_num_rows($resultCheck) > 0) {
    echo "Sorry, the employee already existed in the database";
} else {
    // insert into employee_information table
    $employee = "INSERT INTO employee_information (ic, fName, lName, dob, gender, phone, email, address, postcode, city, state, img, created, modified) VALUE ('$ic','$fName','$lName','$dob','$gender','$phone','$email','$address','$postcode','$city','$state','$image','$created','$modified')";
    if ($resultEmployee = mysqli_query($conn, $employee)) {
        // Move picture to folder
        move_uploaded_file($_FILES['img-save']['tmp_name'], $target);
        echo "Berjaya insert dalam table employee information <br>";
    } else {
        echo mysqli_error($conn) . "<br>";
    }

    // insert into employee_office
    $office = "INSERT INTO employee_office (emp_id, doh, dept, position, status, created, modified) VALUE ('$empID','$doh','$dept','$position','$status','$created','$modified')";
    if ($resultOffice = mysqli_query($conn, $office)) {
        echo "Berjaya insert dalam table employee_office <br>";
    } else {
        echo mysqli_error($conn) . "<br>";
    }

    // Insert into leave allotment table
    $leave = "INSERT INTO leave_allotment (emp_id, al, mc, mt, created, modified) VALUE ('$empID','$al','$mc','$mt','$created','$modified')";
    if ($resultLeave = mysqli_query($conn, $leave)) {
        echo "Berjaya insert dalam table leave allotment <br>";
    } else {
        echo mysqli_error($conn) . "<br>";
    }

    // Insert into the user table
    $user = "INSERT INTO users (emp_id, username, password, created, modified) VALUE ('$empID','$username','$passwordHash','$created','$modified')";
    if ($resultUser = mysqli_query($conn, $user)) {
        echo "Berjaya insert dalam user table";
        header('Location:/project/templates/model/hrm/summary?success=yes&user=' . $fName . ' ' . $lName);
    } else {
        echo mysqli_error($conn);
    }
}
