<!-- Get DB conn -->
<?php include('../../../../src/model/dbconn.php') ?>

<!-- Header -->
<?php include('../../../elements/admin/dashboard/header.php') ?>

<!-- Title -->
<?php $title = "Leave Application" ?>

<!-- Sidebar -->
<?php include('../../../elements/admin/dashboard/nav.php') ?>

<!-- Insert the data into leave_application table -->
<?php

if (isset($_POST['submit'])) {
    $empID = $_POST['emp_id'];
    $type = $_POST['type'];
    $leaveFrom = $_POST['leave_from'];
    $leaveTo = $_POST['leave_to'];
    $reasonLeave = $_POST['reason_leave'];
    $status = 'Pending';

    // Date created and modified
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $created = date('Y-m-d H:i:s');
    $modified = date('Y-m-d H:i:s');

    $leave = "INSERT INTO leave_application (emp_id, type, leave_from, leave_to, reason_leave, status, created, modified) values ('$empID','$type','$leaveFrom','$leaveTo','$reasonLeave','$status','$created','$modified')";
    $resultLeave = mysqli_query($conn, $leave);

    // Deduct the leave
    $datetime1 = date_create('2009-10-11');
    $datetime2 = date_create('2009-10-13');
    $countDays = date_diff($datetime1, $datetime2);
    $days = $countDays->format();

    // Display message after submit
    if ($resultLeave) {
        $msg = "Your application has been submitted. You've taken " . $days . "day(s).";
        $alert = "-success";
    } else {
        $msg = mysqli_error($conn);
        $alert = "-danger";
    }
}

?>

<div class="container-fluid">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="text" name="emp_id" id="" value="<?= $row['id']; ?>" class="form-control d-none">
        <?php if (isset($_POST['submit'])) : ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert<?= $alert; ?> alert-dismissible fade show" role="alert">
                        <?= $leaveFrom; ?>
                        <?= $msg; ?> <p>You've applied leave from <strong><?= $leaveFrom; ?></strong> to <strong><?= $leaveTo; ?></strong></p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Apply Leave</h6>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="">Employee Name</label>
                                        <input type="text" name="" id="" class="form-control" value="<?= $row['fName'] . ' ' . $row['lName']; ?>" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="">Employee IC</label>
                                        <input type="text" name="" id="" class="form-control" value="<?= $row['ic']; ?>" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="">Department</label>
                                        <input type="text" name="" id="" class="form-control" list="dept" value="<?= $rowOffice['dept']; ?>" readonly>
                                        <datalist id="dept">
                                            <option value="">Select</option>
                                            <option value="Insurance">Insurance</option>
                                            <option value="Tour">Tour</option>
                                            <option value="IT">IT</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Finance">Finance</option>
                                        </datalist>
                                    </div>
                                    <div class="col-3">
                                        <label for="">Position</label>
                                        <input type="text" name="" id="" class="form-control" list="position" value="<?= $rowOffice['position']; ?>" readonly>
                                        <datalist id="position">
                                            <option value="Telemarketer">Telemarketer</option>
                                            <option value="Tour Executive">Tour Executive</option>
                                            <option value="System Administrator">System Administrator</option>
                                            <option value="Graphic Designer">Graphic Designer</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Accountant">Accountant</option>
                                        </datalist>
                                    </div>
                                </div>
                                <hr class="my-3">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="">Type of Leave</label>
                                        <select name="type" id="" class="form-control">
                                            <option value="">Select</option>
                                            <option value="AL">Annual Leave</option>
                                            <option value="BR">Bereavement</option>
                                            <option value="EL">Emergency Leave</option>
                                            <option value="MT">Maternity/Paternity Leave</option>
                                            <option value="MC">Sick Leave</option>
                                            <option value="UL">Unpaid Leave</option>
                                            <option value="OT">Other Leave</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="">From</label>
                                        <input type="date" name="leave_from" id="" class="form-control">
                                    </div>
                                    <div class="col-2">
                                        <label for="">To</label>
                                        <input type="date" name="leave_to" id="" class="form-control">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Reason of Leave</label>
                                        <textarea name="reason_leave" id="" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-4">
                                        <button class="btn btn-sm btn-primary" type="submit" name="submit">Submit</button>
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
<?php include('../../../elements/admin/dashboard/footer.php') ?>

<script>
    document.getElementById('status').addEventListener('change', function() {
        var style = this.value == 'Rejected' ? 'block' : 'none';
        document.getElementById('hidden').style.display = style;
    });
</script>