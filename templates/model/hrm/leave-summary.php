<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Summary</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">#</th>
                                    <th class="align-middle">Employee Name</th>
                                    <th class="text-center align-middle">Employee IC</th>
                                    <th class="text-center align-middle">Created on</th>
                                    Type of Leave
                                    </th>
                                    <th class="text-center align-middle">Leave From</th>
                                    <th class="text-center align-middle">Leave To</th>
                                    <th class="text-center align-middle">Verified by</th>
                                    <th class="text-center align-middle">Approved by</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Balance Left</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center align-middle">
                                        <a href="#" class="btn btn-sm btn-info">1</a>
                                    </td>
                                    <td class="align-middle">
                                        Nur Ikhwan Idris Abdul Rahman
                                    </td>
                                    <td class="text-center align-middle">
                                        920516-02-5367
                                    </td>
                                    <td class="text-center align-middle">
                                        2021-01-13
                                    </td>
                                    <td class="text-center align-middle">
                                        2021-01-14
                                    </td>
                                    <td class="text-center align-middle">
                                        2021-01-14
                                    </td>
                                    <td class="text-center align-middle">
                                        Suhana
                                    </td>
                                    <td class="text-center align-middle">
                                        Arzu Abdullah
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="badge badge-success">Approved</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <strong style="background-color:green;">
                                            <u style="color: white;">
                                                13
                                            </u>
                                        </strong>
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

<!-- Footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>