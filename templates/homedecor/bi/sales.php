<!-- Title -->
<?php $title = "Sales Reports" ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sales Reports</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Page body -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row">
                    <h6 class="m-0 font-weight-bold text-primary">Sales Reports</h6>
                </div>
                <div class="card-body">
                    <form class="row my-2">
                        <fieldset class="form-group col-lg-2">
                            <legend>Month</legend>
                            <div class="col p-0">
                                <select name="month" id="month" class="form-control">
                                    <option value="">Select</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                        </fieldset>
                        <fieldset class="form-group col-lg-4">
                            <legend>Date Range</legend>
                            <div class="row">
                                <div class="col-4">
                                    <input type="date" name="startDate" id="startDate" class="form-control">
                                </div>
                                <div class="col-4">
                                    <input type="date" name="endDate" id="endDate" class="form-control">
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-primary" id="filter">Filter</button>
                                    <button type="reset" class="btn btn-danger">Clear</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <hr class="mb-4">
                    <div class="row my-2">
                        <div id="live_data" class="col-lg-12"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {

        // Datatable
        $('#myTable').DataTable();

        function fetch_data() {
            $.ajax({
                url: "filterData.php",
                method: "POST",
                success: function(data) {
                    $('#live_data').html(data);
                }
            });
        }
        fetch_data();

        $("#filter").click(function() {
            var startDate = $("#startDate").val();
            var endDate = $("#endDate").val();
            var month = $("#month").val();

            // Check if either date is empty
            if (startDate != '' && endDate != '') {
                $.ajax({
                    url: "filterData.php",
                    method: "POST",
                    data: {
                        startDate: startDate,
                        endDate: endDate
                    },
                    success: function(data) {
                        $('#live_data').html(data);
                    }
                });
            } else if (month != '') {
                $.ajax({
                    url: "filterData.php",
                    method: "POST",
                    data: {
                        month: month
                    },
                    success: function(data) {
                        $('#live_data').html(data);
                    }
                });
            } else {
                alert("Please select one of the filters");
            }
        });
    });
</script>

<!-- Footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>