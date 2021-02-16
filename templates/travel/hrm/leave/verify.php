<!-- Header -->
<?php include('../../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../../elements/admin/dashboard/nav.php') ?>

<!-- Get the info from DB -->
<?php
// $getInfo = "SELECT * FROM"

?>

<div class="container-fluid">
    <form action="">
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
                                    <div class="col-lg-3">
                                        <label for="">Employee Name</label>
                                        <input type="text" name="" id="" class="form-control" value="" readonly>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Employee IC</label>
                                        <input type="text" name="" id="" class="form-control" value="" readonly>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Department</label>
                                        <input type="text" name="" id="" class="form-control" list="dept" value="" readonly>
                                        <datalist id="dept">
                                            <option value="">Select</option>
                                            <option value="Insurance">Insurance</option>
                                            <option value="Tour">Tour</option>
                                            <option value="IT">IT</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Finance">Finance</option>
                                        </datalist>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Position</label>
                                        <input type="text" name="" id="" class="form-control" list="position" value="" readonly>
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
                                    <div class="col-lg-3">
                                        <label for="">Type of Leave</label>
                                        <select name="type" id="" class="form-control" readonly>
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
                                    <div class="col-lg-2">
                                        <label for="">From</label>
                                        <input type="date" name="leave_from" id="" class="form-control" readonly>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">To</label>
                                        <input type="date" name="leave_to" id="" class="form-control" value="" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="">Reason of Leave</label>
                                        <textarea name="reason_leave" id="" cols="30" rows="5" class="form-control" readonly></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row my-3">
                                    <div class="col-lg-2">
                                        <label for="">Verified by</label>
                                        <input type="text" name="verify" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-lg-4">
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