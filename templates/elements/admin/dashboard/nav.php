<!-- Check for session -->
<?php
if (!isset($_SESSION['id'])) {
    header('Location:/project/user/login?msg=Please login first.&alert=info');
}
?>

<!-- Get user data -->
<?php
// Data from employee information table
$id = $_SESSION['id'];
$user = "SELECT * FROM employee_information WHERE id = '$id'";
$result = mysqli_query($conn, $user);
$row = mysqli_fetch_array($result);

// Data from employee office table
$office = "SELECT * FROM employee_office WHERE emp_id = '$id'";
$resultOffice = mysqli_query($conn, $office);
$rowOffice = mysqli_fetch_array($resultOffice);

// Data from employee leave allotment table
$leave = "SELECT * FROM leave_allotment WHERE emp_id = '$id'";
$resultLeave = mysqli_query($conn, $leave);
$rowLeave = mysqli_fetch_array($resultLeave);
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion d-print-none" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/project/templates/homedecor/dashboard">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Neurali</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/project/templates/homedecor/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Arzu Home
            </div>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCRMdecor" aria-expanded="true" aria-controls="collapseCRMdecor">
                    <i class="fas fa-meteor"></i>
                    <span>CRM</span>
                </a>
                <div id="collapseCRMdecor" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customer Management</h6>
                        <a class="collapse-item" href="/project/templates/homedecor/crm/addCustomer">Add Customer</a>
                        <a class="collapse-item" href="/project/templates/homedecor/crm/list">List</a>
                        <a class="collapse-item" href="/project/templates/homedecor/crm/category">Category</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
                    <i class="fas fa-meteor"></i>
                    <span>Customer Order</span>
                </a>
                <div id="collapseOrder" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Order Management</h6>
                        <a class="collapse-item" href="/project/templates/homedecor/order/orderList">List</a>
                        <!-- <a class="collapse-item" href="/project/templates/homedecor/order2/list">Old List</a> -->
                        <a class="collapse-item" href="/project/templates/homedecor/order/report">Report</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
                    <i class="fas fa-meteor"></i>
                    <span>Products</span>
                </a>
                <div id="collapseProduct" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Product Management</h6>
                        <!-- <a class="collapse-item" href="/project/templates/homedecor/product/add-new">Create New</a> -->
                        <a class="collapse-item" href="/project/templates/homedecor/product/addProduct">Add Product</a>
                        <!-- <a class="collapse-item" href="/project/templates/homedecor/product/add">Add</a> -->
                        <a class="collapse-item" href="/project/templates/homedecor/product/listProduct">Product List</a>
                        <!-- <a class="collapse-item" href="/project/templates/homedecor/product/list">List</a> -->
                        <a class="collapse-item" href="/project/templates/homedecor/product/categoryProduct">Product Category</a>
                        <!-- Divider -->
                        <hr class="sidebar-divider my-0">
                        <h6 class="collapse-header">Display Item Management</h6>
                        <a class="collapse-item" href="/project/templates/homedecor/product/listDisplay">Display List</a>
                        <!-- Divider -->
                        <hr class="sidebar-divider my-0">
                        <h6 class="collapse-header">Item Management</h6>
                        <a class="collapse-item" href="/project/templates/homedecor/product/addItem">Add Item</a>
                        <a class="collapse-item" href="/project/templates/homedecor/product/listItem">Item List</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInvoice" aria-expanded="true" aria-controls="collapseInvoice">
                    <i class="fas fa-meteor"></i>
                    <span>Invoice</span>
                </a>
                <div id="collapseInvoice" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Invoice Management</h6>
                        <a class="collapse-item" href="/project/templates/homedecor/invoice/newList">New List</a>
                        <a class="collapse-item" href="/project/templates/homedecor/invoice/oldList">Old List</a>
                        <a class="collapse-item" href="/project/templates/homedecor/invoice/report">Report</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePO" aria-expanded="true" aria-controls="collapsePO">
                    <i class="fas fa-meteor"></i>
                    <span>Purchase Order</span>
                </a>
                <div id="collapsePO" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">PO Management</h6>
                        <a class="collapse-item" href="/project/templates/homedecor/purchaseorder/addPo">Add PO</a>
                        <a class="collapse-item" href="/project/templates/homedecor/purchaseorder/listPo">List</a>
                        <a class="collapse-item" href="/project/templates/homedecor/purchaseorder/report">Report</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSupplier" aria-expanded="true" aria-controls="collapseSupplier">
                    <i class="fas fa-meteor"></i>
                    <span>Supplier</span>
                </a>
                <div id="collapseSupplier" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Supplier Management</h6>
                        <a class="collapse-item" href="/project/templates/homedecor/supplier/add">Add Supplier</a>
                        <a class="collapse-item" href="/project/templates/homedecor/supplier/list">Supplier List</a>
                        <a class="collapse-item" href="/project/templates/homedecor/supplier/order">New Order</a>
                        <a class="collapse-item" href="#">Supplier Report</a>
                        <!-- Divider -->
                        <hr class="sidebar-divider">
                        <!-- Heading -->
                        <h6 class="collapse-header">Purchase Management</h6>
                        <a class="collapse-item" href="/project/templates/homedecor/supplier/polist">Purchase Order List</a>
                        <a class="collapse-item" href="#">Purchase Order Report</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventory" aria-expanded="true" aria-controls="collapseInventory">
                    <i class="fas fa-boxes"></i>
                    <span>Inventory</span>
                </a>
                <div id="collapseInventory" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Inventory Management</h6>
                        <a class="collapse-item" href="/project/templates/homedecor/inventory/add">Add Item</a>
                        <a class="collapse-item" href="/project/templates/homedecor/inventory/list">Item List</a>
                        <a class="collapse-item" href="#">Item Report</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">
                Accounting
            </div>

            <?php if ($row['username'] = 'faridah' || $row['username'] = 'arzu.abdullah' || $row['username'] = 'nurikhwanidris') : ?>
                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccount" aria-expanded="true" aria-controls="collapseAccount">
                        <i class="fas fa-calculator"></i>
                        <span>Accounting</span>
                    </a>
                    <div id="collapseAccount" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Payment Voucher</h6>
                            <a class="collapse-item" href="/project/templates/homedecor/acc/add-pv">Add</a>
                            <a class="collapse-item" href="/project/templates/homedecor/acc/list-pv">List</a>
                            <!-- Divider -->
                            <hr class="sidebar-divider">
                            <!-- Heading -->
                            <h6 class="collapse-header">Cash In</h6>
                            <a class="collapse-item" href="/project/templates/homedecor/acc/add-cash">Add</a>
                            <a class="collapse-item" href="/project/templates/homedecor/acc/list-cash">List</a>
                            <!-- Heading -->
                            <h6 class="collapse-header">Payslip</h6>
                            <a class="collapse-item" href="/project/templates/homedecor/acc/add-payslip">Add</a>
                            <a class="collapse-item" href="/project/templates/homedecor/acc/list-payslip">List</a>
                            <!-- Heading -->
                            <h6 class="collapse-header">Settings</h6>
                            <a class="collapse-item" href="/project/templates/homedecor/acc/settings">Settings</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseReport">
                    <i class="fas fa-table"></i>
                    <span>Report</span>
                </a>
                <div id="collapseReport" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Report</h6>
                        <a class="collapse-item" href="/project/templates/homedecor/report/generate">Generate</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="/project/assets/img/undraw_profile_1.svg" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="/project/assets/img/undraw_profile_2.svg" alt="">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="/project/assets/img/undraw_profile_3.svg" alt="">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?= $row['fName']; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="/project/assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/project/templates/users/profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="/project/templates/users/settings">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="/project/templates/users/activity">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->