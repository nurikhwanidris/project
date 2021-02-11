<!-- Header -->
<?php include('../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../elements/admin/dashboard/nav.php') ?>

<!-- Get emergency contact -->
<?php
$nokk = "SELECT * FROM employee_nok WHERE emp_id = '" . $row['id'] . "'";
$resultNokk = mysqli_query($conn, $nokk);
?>

<?php
if (isset($_POST['submit'])) {
    // Post data
    $empID = $_POST['empID'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $img = $_FILES['img-save'];

    // Post data for next of kins / emergency contact
    $nokName = $_POST['nokName'];
    $nokPhone = $_POST['nokPhone'];
    $nokRelation = $_POST['nokRelation'];

    // Date created and modified
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $created = date('Y-m-d H:i:s');
    $modified = date('Y-m-d H:i:s');


    // Insert Next of Kins  for emergency contacts
    $nok = "INSERT INTO employee_nok (emp_id, nokName, nokPhone, nokRelation, created, modified) VALUES ('$empID', '$nokName', '$nokPhone', '$nokRelation', '$created', '$modified')";
    $resultNok = mysqli_query($conn, $nok);
    if ($resultNok) {
        $msg = "Successfully inserted the emergency contacts.";
        $alert = "success";
    } else {
        $msg = "Failed to insert " . mysqli_error($conn);
        $alert = "danger";
    }

    // Update existing information
    // $existing = "UPDATE employee_information SET fName = '$fName', lName = '$lName', gender = '$gender', dob = '$dob', phone = '$phone', email = '$email', address = '$address', postcode = '$postcode', city = '$city', state = '$state', img = '$img' WHERE emp_id = '$empID'";
    // $resultExisting = mysqli_query($conn, $existing);
    // if ($resultExisting) {
    //     $msg = "Successfully updated the information.";
    //     $alert = "success";
    // } else {
    //     $msg = "Failed to update " . mysqli_error($conn);
    //     $alert = "danger";
    // }
}
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employee Profile</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <?php if (isset($_POST['submit'])) : ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-<?= $alert; ?> alert-dismissible fade show" role="alert">
                    <?= $msg; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <input type="number" name="empID" id="" class="form-control d-none" value="<?= $row['id']; ?>">
        <div class="row">
            <div class="col-xl-9 col-lg-9">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="font-weight-bold text-primary mb-0"><?= str_pad($row['id'], 4, '0', STR_PAD_LEFT); ?> - <?= $row['fName']; ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active">
                                <h6 class="font-weight-bold text-info">Basic Information</h6>
                                <div class="row my-2">
                                    <div class="col-lg-3">
                                        <label for="">IC Number <small class="text-danger">Mandatory</small></label>
                                        <input type="text" name="ic" id="ssn" class="form-control" value="<?= $row['ic']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-4">
                                        <label for="">First Name <small class="text-danger">Mandatory</small></label>
                                        <input type="text" name="fName" id="" class="form-control" value="<?= $row['fName']; ?>">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Last Name <small class="text-danger">Mandatory</small></label>
                                        <input type="text" name="lName" id="" class="form-control" value="<?= $row['lName']; ?>">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Date of Birth</label>
                                        <input type="date" name="dob" id="" class="form-control" value="<?= date('Y-m-d', strtotime($row['dob'])); ?>">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Gender</label>
                                        <input type="text" name="gender" id="" class="form-control" list="gender" value="<?= $row['gender']; ?>">
                                        <datalist id="gender">
                                            <option value="Male">
                                            <option value="Female">
                                        </datalist>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="font-weight-bold text-info">Contact Info</h6>
                                <div class="row my-2">
                                    <div class="col-lg-4">
                                        <label for="">Personal Phone Number <small class="text-danger">Mandatory</small></label>
                                        <input type="text" name="phone" id="" class="form-control" value="<?= $row['phone']; ?>">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Personal Email <small class="text-danger">Mandatory</small></label>
                                        <input type="email" name="email" id="" class="form-control" value="<?= $row['email']; ?>">
                                    </div>
                                </div>
                                <hr>
                                <h6 class="font-weight-bold text-info">Residence</h6>
                                <div class="row my-2">
                                    <div class="col-lg-6">
                                        <label for="">Address</label>
                                        <input type="text" name="address" id="" class="form-control" value="<?= $row['address']; ?>">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Postcode</label>
                                        <input type="text" name="postcode" id="" class="form-control" value="<?= $row['postcode']; ?>">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">City</label>
                                        <input type="text" name="city" id="" class="form-control" value="<?= $row['city']; ?>">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">State</label>
                                        <input list="state" type="text" name="state" id="" class="form-control" value="<?= $row['state']; ?>">
                                        <datalist id="state">
                                            <option value="Johor">
                                            <option value="Kedah">
                                            <option value="Kelantan">
                                            <option value="Melaka">
                                            <option value="Negeri Sembilan">
                                            <option value="Pahang">
                                            <option value="Perak">
                                            <option value="Perlis">
                                            <option value="Pulau Pinang">
                                            <option value="Sabah">
                                            <option value="Sarawak">
                                            <option value="Selangor">
                                            <option value="Terengganu">
                                            <option value="WP Kuala Lumpur">
                                            <option value="WP Labuan">
                                            <option value="WP Putrajaya">
                                        </datalist>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="font-weight-bold text-info">Next of Kin / Emergency Contact</h6>
                                <div class="row my-2">
                                    <div class="col-lg-12">
                                        <table class="table table responsive table-stripped">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle">Name</th>
                                                    <th class="align-middle text-center">Phone</th>
                                                    <th class="align-middle text-center">Relation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($rowNok = mysqli_fetch_assoc($resultNokk)) : ?>
                                                    <tr>
                                                        <td class="align-middle">
                                                            <?= $rowNok['nokName']; ?>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <?= $rowNok['nokPhone']; ?>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <?= $rowNok['nokRelation']; ?>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                                <tr>
                                                    <td class="align-middle">
                                                        <input type="text" name="nokName" id="" class="form-control border-0" placeholder="Name">
                                                    </td>
                                                    <td class="align-middle" style="width:30%">
                                                        <input type="text" name="nokPhone" id="" class="form-control border-0" placeholder="Phone number">
                                                    </td>
                                                    <td class="align-middle">
                                                        <input type="text" name="nokRelation" id="" class="form-control border-0" list="relation" placeholder="Relationship">
                                                        <datalist id="relation">
                                                            <option value="Father"></option>
                                                            <option value="Husband"></option>
                                                            <option value="Mother"></option>
                                                            <option value="Wife"></option>
                                                            <option value="Partner"></option>
                                                            <option value="Brother"></option>
                                                            <option value="Sister"></option>
                                                            <option value="Grandparent"></option>
                                                            <option value="Uncle"></option>
                                                            <option value="Aunt"></option>
                                                            <option value="Cousin"></option>
                                                            <option value="Nephew"></option>
                                                            <option value="Niece"></option>
                                                        </datalist>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="mb-0 font-weight-bold text-primary">Picture</h6>
                            </div>
                            <div class="card-body">
                                <div class="row my-3">
                                    <div class="col-md-9">
                                        <label for="">Profile Picture</label><br>
                                        <img id="preview" src="/project/upload/img/emp-picture/<?= $row['img']; ?>" alt="image will display here" class="img-thumbnail" style="margin-bottom: 10px; height: 100px;">
                                        <input type='file' id="imgInp" name="img-save" class="form-control" accept="image/x-png,image/gif,image/jpeg" value="<?= $row['img']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="mb-0 font-weight-bold text-primary">Leave Allotment</h6>
                            </div>
                            <div class="card-body">
                                <div class="row my-3">
                                    <div class="col">
                                        <label for="">Annual Leave</label>
                                        <input type="number" name="al" id="" class="form-control" value="<?= $rowLeave['al']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col">
                                        <label for="">Sick</label>
                                        <input type="number" name="mc" id="" class="form-control" value="<?= $rowLeave['mc']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col">
                                        <label for="">Maternity/Paternity</label>
                                        <input type="number" name="mt" id="" class="form-control" value="<?= $rowLeave['mt']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <button class="btn btn-primary float-right" name="submit" type="submit">Submit</button>
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
<?php include('../elements/admin/dashboard/footer.php') ?>