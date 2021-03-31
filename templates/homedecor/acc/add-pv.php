<!-- Title -->
<?php $title = "Add Payment Voucher" ?>

<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Payment Voucher</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <form action="save-pv.php" method="post">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add PV</h6>
                    </div>
                    <div class="card-body">
                        <div class="row my-2 clearfix">
                            <div class="col-lg-6">
                                <label for="">Payable to</label>
                                <input type="text" name="payTo" id="" class="form-control">
                            </div>
                            <div class="col-lg-3">
                                <label for="">Account Number</label>
                                <input type="text" name="numAcc" id="" class="form-control">
                            </div>
                            <div class="col-lg-3">
                                <label for="">Bank</label>
                                <select name="bankAcc" id="" class="form-control">
                                    <option value="">Select</option>
                                    <option value="ABB">Affin Bank Berhad</option>
                                    <option value="AGRO">Agro Bank</option>
                                    <option value="ABMB">Alliance Bank Malaysia Berhad</option>
                                    <option value="BIMB">Bank Islam Malaysia Berhad</option>
                                    <option value="BKRM">Bank Kerjasama Rakyat Malaysia</option>
                                    <option value="CIMB">CIMB Malaysia Berhad</option>
                                    <option value="CITI">Citibank Berhad</option>
                                    <option value="HSBC">HSBC Bank Berhad</option>
                                    <option value="MBB">Malayan Banking Berhad</option>
                                    <option value="OCBC">OCBC Bank Malaysia Berhad</option>
                                    <option value="PBB">Public Bank Berhad</option>
                                    <option value="RHB">RHB Bank Berhad</option>
                                    <option value="SCB">Standard Chartered Bank Malaysia Berhad</option>
                                    <option value="UOB">United Overseas Bank</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-2 clearfix">
                            <div class="col-lg-8">
                                <label for="">Payment Description</label>
                                <input type="text" id="description" class="form-control clear" placeholder="Write something here">
                            </div>
                            <div class="col-lg-2">
                                <label for="">Amount</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                    </div>
                                    <input type="text" id="amount" class="form-control clear" placeholder="00.00" aria-label="Amount" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-lg-2 ">
                                <label for="">&nbsp;</label>
                                <div class="form-group col-md-12 align-self-end">
                                    <button class="btn btn-info float-right add-row" id="btn" name="btn" type="button"><i class="far fa-plus-square"></i></button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row my-2 clearfix">
                            <div class="col-lg-12">
                                <div class="row my-2">
                                    <div class="col-lg-10">
                                        <label for="">Output</label>
                                        <table class="table table-stripped table-bordered table-md">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle text-center" style="width: 5%;">/</th>
                                                    <th class="align-middle" style="width: 70%;">Decription</th>
                                                    <th class="align-middle text-center">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">&nbsp;</label>
                                        <div class="form-group col-md-12 align-self-end">
                                            <button type="button" class="btn btn-danger delete-row float-right mx-0"><i class="far fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clear-fix">
                            <div class="col-lg-10">
                                <div class="row my-2">
                                    <div class="col-lg-12">
                                        <button class="btn btn-success float-right align-self-end" name="submit" type="submit">Submit</button>
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
    // Give it a meaning
    $(document).ready(function() {
        $(".add-row").click(function() {

            // Declare that shit
            var description = $('#description').val();
            var amount = parseInt($('#amount').val());
            // Create tabel rows
            var markup = "<tr><td class='align-middle text-center'><input type='checkbox' name='record'><td class='align-middle text-left'><input type='text' name='description[]' value='" + description + "' class='border-0 text-left form-control'/></td><td><input name='amount[]' class='text-center align-middle form-control border-0' value='" + amount.toFixed(2) + "' /></td></tr>";
            $("table tbody").append(markup);

            // Clear the value after insert
            var clear = $('.clear').val('');
        });

        // Find and remove selected table rows
        $(".delete-row").click(function() {
            $("table tbody").find('input[name="record"]').each(function() {
                if ($(this).is(":checked")) {
                    $(this).parents("tr").remove();
                }
            });
        });
    });
</script>