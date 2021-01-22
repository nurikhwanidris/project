<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<div>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tour Summary</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tour Assigned</h6>
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
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">Enquiry #</th>
                                    <th class="text-center align-middle">Enquiry Date</th>
                                    <th class="align-middle">Program</th>
                                    <th class="text-center align-middle">Travelling Date</th>
                                    <th class="text-center align-middle">Type</th>
                                    <th class="align-middle">Client</th>
                                    <th class="text-center align-middle">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center align-middle">
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> 1401
                                        </a>
                                    </td>
                                    <td class="text-center align-middle">
                                        2020/03/20
                                    </td>
                                    <td class="align-middle">
                                        3D2N Bangkok Lopburi
                                    </td>
                                    <td class="text-center align-middle">
                                        2021/03/01
                                    </td>
                                    <td class="align-middle text-center">
                                        FIT
                                    </td>
                                    <td class="align-middle">
                                        Mammon
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-warning">Pending</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> 1401
                                        </a>
                                    </td>
                                    <td class="text-center align-middle">
                                        2020/03/20
                                    </td>
                                    <td class="align-middle">
                                        3D2N Bangkok Lopburi
                                    </td>
                                    <td class="text-center align-middle">
                                        2021/03/01
                                    </td>
                                    <td class="align-middle text-center">
                                        FIT
                                    </td>
                                    <td class="align-middle">
                                        Lucifer
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success">Confirmed</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> 1401
                                        </a>
                                    </td>
                                    <td class="text-center align-middle">
                                        2020/03/20
                                    </td>
                                    <td class="align-middle">
                                        3D2N Bangkok Lopburi
                                    </td>
                                    <td class="text-center align-middle">
                                        2021/03/01
                                    </td>
                                    <td class="align-middle text-center">
                                        FIT
                                    </td>
                                    <td class="align-middle">
                                        Mammon
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-warning">Pending</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> 1401
                                        </a>
                                    </td>
                                    <td class="text-center align-middle">
                                        2020/03/20
                                    </td>
                                    <td class="align-middle">
                                        3D2N Bangkok Lopburi
                                    </td>
                                    <td class="text-center align-middle">
                                        2021/03/01
                                    </td>
                                    <td class="align-middle text-center">
                                        FIT
                                    </td>
                                    <td class="align-middle">
                                        Asmodeus
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-danger">Cancelled</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> 1401
                                        </a>
                                    </td>
                                    <td class="text-center align-middle">
                                        2020/03/20
                                    </td>
                                    <td class="align-middle">
                                        3D2N Bangkok Lopburi
                                    </td>
                                    <td class="text-center align-middle">
                                        2021/03/01
                                    </td>
                                    <td class="align-middle text-center">
                                        FIT
                                    </td>
                                    <td class="align-middle">
                                        Leviathan
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-danger">Cancelled</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> 1401
                                        </a>
                                    </td>
                                    <td class="text-center align-middle">
                                        2020/03/20
                                    </td>
                                    <td class="align-middle">
                                        3D2N Bangkok Lopburi
                                    </td>
                                    <td class="text-center align-middle">
                                        2021/03/01
                                    </td>
                                    <td class="align-middle text-center">
                                        FIT
                                    </td>
                                    <td class="align-middle">
                                        Beelzebub
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-warning">Pending</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> 1401
                                        </a>
                                    </td>
                                    <td class="text-center align-middle">
                                        2020/03/20
                                    </td>
                                    <td class="align-middle">
                                        3D2N Bangkok Lopburi
                                    </td>
                                    <td class="text-center align-middle">
                                        2021/03/01
                                    </td>
                                    <td class="align-middle text-center">
                                        FIT
                                    </td>
                                    <td class="align-middle">
                                        Satan
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success">Confirmed</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> 1401
                                        </a>
                                    </td>
                                    <td class="text-center align-middle">
                                        2020/03/20
                                    </td>
                                    <td class="align-middle">
                                        3D2N Bangkok Lopburi
                                    </td>
                                    <td class="text-center align-middle">
                                        2021/03/01
                                    </td>
                                    <td class="align-middle text-center">
                                        FIT
                                    </td>
                                    <td class="align-middle">
                                        Belphegor
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success">Confirmed</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> 1401
                                        </a>
                                    </td>
                                    <td class="text-center align-middle">
                                        2020/03/20
                                    </td>
                                    <td class="align-middle">
                                        3D2N Bangkok Lopburi
                                    </td>
                                    <td class="text-center align-middle">
                                        2021/03/01
                                    </td>
                                    <td class="align-middle text-center">
                                        FIT
                                    </td>
                                    <td class="align-middle">
                                        Belphegor
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success">Confirmed</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> 1401
                                        </a>
                                    </td>
                                    <td class="text-center align-middle">
                                        2020/03/20
                                    </td>
                                    <td class="align-middle">
                                        3D2N Bangkok Lopburi
                                    </td>
                                    <td class="text-center align-middle">
                                        2021/03/01
                                    </td>
                                    <td class="align-middle text-center">
                                        FIT
                                    </td>
                                    <td class="align-middle">
                                        Belphegor
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success">Confirmed</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> 1401
                                        </a>
                                    </td>
                                    <td class="text-center align-middle">
                                        2020/03/20
                                    </td>
                                    <td class="align-middle">
                                        3D2N Bangkok Lopburi
                                    </td>
                                    <td class="text-center align-middle">
                                        2021/03/01
                                    </td>
                                    <td class="align-middle text-center">
                                        FIT
                                    </td>
                                    <td class="align-middle">
                                        Belphegor
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success">Confirmed</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('../../elements/admin/dashboard/footer.php') ?>