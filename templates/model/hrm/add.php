<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Get latest userID -->
<?php
$sql = "SELECT id FROM employee_information ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$empId = $row['id'] + 1;
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employee Management</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <form action="save-employee.php" method="POST" enctype="multipart/form-data">
        <input type="number" name="empID" id="" class="form-control d-none" value="<?= $empId; ?>">
        <div class="row">
            <div class="col xl-9 col-lg-9">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="font-weight-bold text-primary mb-0">Add Employee - <?= $empId; ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active">
                                <h6 class="font-weight-bold text-info">Basic Information</h6>
                                <div class="row my-2">
                                    <div class="col-lg-3">
                                        <label for="">IC Number <small class="text-danger">Mandatory</small></label>
                                        <input type="text" name="ic" id="ssn" class="form-control" maxlength="14" required>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-4">
                                        <label for="">First Name <small class="text-danger">Mandatory</small></label>
                                        <input type="text" name="fName" id="" class="form-control" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Last Name <small class="text-danger">Mandatory</small></label>
                                        <input type="text" name="lName" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Date of Birth</label>
                                        <input type="date" name="dob" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Gender</label>
                                        <input type="text" name="gender" id="" class="form-control" list="gender">
                                        <datalist id="gender">
                                            <option value="Male">
                                            <option value="Female">
                                        </datalist>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="font-weight-bold text-info">Login Information</h6>
                                <div class="row my-2">
                                    <div class="col-lg-4">
                                        <label for="">Username <small class="text-danger">Mandatory</small></label>
                                        <input type="text" name="username" id="" class="form-control" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Password <small class="text-danger">Mandatory</small></label>
                                        <input type="password" name="password1" id="password1" class="form-control" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Confirm Password <small class="text-danger">Mandatory</small></label>
                                        <input type="password" name="password2" id="password2" class="form-control" required>
                                        <span id="message"></span>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="font-weight-bold text-info">Contact Info</h6>
                                <div class="row my-2">
                                    <div class="col-lg-4">
                                        <label for="">Personal Phone Number <small class="text-danger">Mandatory</small></label>
                                        <input type="text" name="phone" id="" class="form-control" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Personal Email <small class="text-danger">Mandatory</small></label>
                                        <input type="email" name="email" id="" class="form-control" required>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="font-weight-bold text-info">Residence</h6>
                                <div class="row my-2">
                                    <div class="col-lg-6">
                                        <label for="">Address</label>
                                        <input type="text" name="address" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Postcode</label>
                                        <input type="text" name="postcode" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">City</label>
                                        <input type="text" name="city" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">State</label>
                                        <input list="state" type="text" name="state" id="" class="form-control">
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
                                <h6 class="font-weight-bold text-info">Work</h6>
                                <div class="row my-2">
                                    <div class="col-lg-3">
                                        <label for="">Department</label>
                                        <select name="dept" id="" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="Insurance">Insurance</option>
                                            <option value="Tour">Tour</option>
                                            <option value="IT">IT</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Finance">Finance</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Position</label>
                                        <select name="position" id="" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="Telemarketer">Telemarketer</option>
                                            <option value="Tour Executive">Tour Executive</option>
                                            <option value="System Administrator">System Administrator</option>
                                            <option value="Graphic Designer">Graphic Designer</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Accountant">Accountant</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Date of Hire</label>
                                        <input type="date" name="doh" id="" class="form-control" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Status</label>
                                        <select name="status" id="" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="Active">Active</option>
                                            <option value="Resigned">Resigned</option>
                                            <option value="Terminated">Terminated</option>
                                            <option value="Deceased">Deceased</option>
                                            <option value="Freeze">Freeze</option>
                                        </select>
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
                                        <img id="preview" src="#" alt="image will display here" class="img-thumbnail" style="margin-bottom: 10px; height: 100px;">
                                        <input type='file' id="imgInp" name="img-save" class="form-control" accept="image/x-png,image/gif,image/jpeg">
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
                                        <input type="number" name="al" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col">
                                        <label for="">Sick</label>
                                        <input type="number" name="mc" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col">
                                        <label for="">Maternity/Paternity</label>
                                        <input type="number" name="mt" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <button class="btn btn-primary float-right" type="submit">Submit</button>
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

<!-- Image Preview -->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });
</script>

<!-- SSN Script -->
<script type="text/javascript">
    $('#ssn').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{6})/, '$1-');
        val = val.replace(/-(\d{2})/, '-$1-');
        val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
        this.value = val;
    });
</script>

<!-- Password check -->
<script>
    $('#password1, #password2').on('keyup', function() {
        if ($('#password1').val() == $('#password2').val()) {
            $('#message').html('Both passwords are matching').css('color', 'green');
        } else
            $('#message').html('One of the password does not match').css('color', 'red');
    });
</script>