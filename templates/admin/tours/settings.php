<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Query the DB -->
<?php
// General
$general = "SELECT * FROM general_settings ORDER BY id DESC";
$resultGeneral = mysqli_query($conn, $general);
$rowGeneral = mysqli_fetch_assoc($resultGeneral);

// Type
$type = "SELECT * FROM type";
$resultType = mysqli_query($conn, $type);

// Included
$included = "SELECT * FROM included";
$resultIncluded = mysqli_query($conn, $included);

// Excluded
$excluded = "SELECT * FROM excluded";
$resultExcluded = mysqli_query($conn, $excluded);

// Airlines
$airline = "SELECT * FROM airlines";
$resultAirline = mysqli_query($conn, $airline);
?>

<!-- Save everything inside the database -->
<?php
// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

// Submit 
if (isset($_POST['submitGeneral'])) {
    $target = $_POST['target'];
    $headerTitle = $_POST['headerTitle'];
    $featuredTours = $_POST['featuredTours'];
    $listingTours = $_POST['listingTours'];
    $searchTours = $_POST['searchTours'];
    $relatedTours = $_POST['relatedTours'];
    $homeOrder = $_POST['homeOrder'];
    $listingOrder = $_POST['listingOrder'];
    $searchOrder = $_POST['searchOrder'];
    $minPrice = $_POST['minPrice'];
    $maxPrice = $_POST['maxPrice'];

    // Query the into the database
    $general = "INSERT INTO general_settings (target, header_title, feature, featureOrder, listing, listingOrder, searchResult, searchOrder, relatedTours, minPrice, maxPrice, created, modified) VALUE ('$target', '$headerTitle', '$featuredTours', '$homeOrder', '$listingTours', '$listingOrder','$searchTours', '$searchOrder', '$relatedTours', '$minPrice', '$maxPrice','$created', '$modified')";

    if ($query = mysqli_query($conn, $general)) {
        $alert = "success";
        $message =  "General settings has been updated";
    } else {
        $alert = "danger";
        $message = mysqli_error($conn);
    }
}
if (isset($_POST['submitType'])) {
    $addType = $_POST['addType'];

    $type = "INSERT INTO type (description, created, modified) VALUES ('$addType', '$created', '$modified')";

    if ($query = mysqli_query($conn, $type)) {
        $message = "Packcage type has been added";
        $alert = "success";
    } else {
        $alert = "danger";
        $message = mysqli_error($conn);
    }
}
if (isset($_POST['submitIncluded'])) {
    $addInclusion = $_POST['addInclusion'];

    $include = "INSERT INTO included (description, created, modified) VALUES ('$addInclusion', '$created', '$modified')";

    if ($query = mysqli_query($conn, $include)) {
        $message = "Package inclusion has been added";
        $alert = "success";
    } else {
        $alert = "danger";
        $message = mysqli_error($conn);
    }
}
if (isset($_POST['submitExcluded'])) {
    $addExclusion = $_POST['addExclusion'];

    $exclude = "INSERT INTO excluded (description, created, modified) VALUES ('$addExclusion', '$created', '$modified')";

    if ($query = mysqli_query($conn, $exclude)) {
        $message = "Package exclusion has been added";
        $alert = "success";
    } else {
        $alert = "danger";
        $message = mysqli_error($conn);
    }
}

?>

<!-- Delete from database -->
<?php
if (isset($_GET['dltType'])) {

    $dltType = $_GET['dltType'];

    $deleteType = "DELETE FROM type WHERE id = '$dltType'";
    $deletedType = mysqli_query($conn, $deleteType);

    if ($deletedType) {
        $message = "A package type has been deleted";
        $alert = "warning";
    } else {
        $alert = "danger";
        $message = mysqli_error($conn);
    }
}
if (isset($_GET['dltInclude'])) {

    $dltInclude = $_GET['dltInclude'];

    $deleteInclude = "DELETE FROM included WHERE id = '$dltInclude'";
    $deletedIncluded = mysqli_query($conn, $deleteInclude);

    if ($deletedIncluded) {
        $message = "A package inclusion has been deleted";
        $alert = "warning";
    } else {
        $alert = "danger";
        $message = mysqli_error($conn);
    }
}
if (isset($_GET['dltExclude'])) {

    $dltExclude = $_GET['dltExclude'];

    $deleteExclude = "DELETE FROM excluded WHERE id = '$dltExclude'";
    $deletedExclude = mysqli_query($conn, $deleteExclude);

    if ($deletedExclude) {
        $message = "A package exclusion has been deleted";
        $alert = "warning";
    } else {
        $alert = "danger";
        $message = mysqli_error($conn);
    }
}
if (isset($_GET['dltAirline'])) {

    $dltAirline = $_GET['dltAirline'];

    $deleteAirline = "DELETE FROM included WHERE id = '$dltAirline'";
    $deletedAirline = mysqli_query($conn, $deleteAirline);

    if ($deletedAirline) {
        $message = "An airline has been deleted";
        $alert = "warning";
    } else {
        $alert = "danger";
        $message = mysqli_error($conn);
    }
}
?>


<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tour Settings</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->

    <div class="row">
        <div class="col">
            <?php
            if (isset($_POST['submitGeneral']) || isset($_POST['submitType']) || isset($_POST['submitIncluded']) || isset($_POST['submitExcluded']) || isset($_GET['dltType']) || isset($_GET['dltInclude']) || isset($_GET['dltExclude']) || isset($_GET['dltAirline'])) : ?>
                <div class="alert alert-<?= $alert ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?= $message; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tour Settings</h6>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a href="#General" class="nav-link active" id="General-tab" data-toggle="tab" href="#General" role="tab" aria-controls="General" aria-selected="true">General</a></a>
                        </li>
                        <li class="nav-item">
                            <a href="#type" class="nav-link" id="type-tab" data-toggle="tab" href="#type" role="tab" aria-controls="type" aria-selected="true">Type</a></a>
                        </li>
                        <li class="nav-item">
                            <a href="#included" class="nav-link" id="included-tab" data-toggle="tab" href="#included" role="tab" aria-controls="included" aria-selected="true">Inclusion</a></a>
                        </li>
                        <li class="nav-item">
                            <a href="#excluded" class="nav-link" id="excluded-tab" data-toggle="tab" href="#excluded" role="tab" aria-controls="excluded" aria-selected="true">Exclusion</a></a>
                        </li>
                        <li class="nav-item">
                            <a href="#airlines" class="nav-link" id="airlines-tab" data-toggle="tab" href="#airlines" role="tab" aria-controls="airlines" aria-selected="true">Airlines</a></a>
                        </li>
                    </ul>
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
                                <div class="col-6">
                                    <div class="row form-group mt-3">
                                        <label for="Target" class="col-md-3 my-auto control-label text-left">Target</label>
                                        <div class="col-md-6">
                                            <select name="target" id="Target" class="form-control custom-select">
                                                <option <?php if ($rowGeneral['target'] == '_self') {
                                                            echo "selected";
                                                        } ?> value="_self">Self</option>
                                                <option <?php if ($rowGeneral['target'] == '_blank') {
                                                            echo "selected";
                                                        } ?> value="_blank">Blank</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label for="Header" class="col-md-3 my-auto control-label text-left">Header Title</label>
                                        <div class="col-md-6">
                                            <input type="text" name="headerTitle" id="" class="form-control" value="<?= $rowGeneral['header_title']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row m-auto">
                                    <div class="col-6">
                                        <div class="row form-group">
                                            <label for="deposit" class="col-md-3 my-auto control-label text-left ">Featured Tours</label>
                                            <div class="col-md-6">
                                                <input type="text" name="featuredTours" id="" class="form-control" value="<?= $rowGeneral['feature']; ?>">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label for="deposit" class="col-md-3 my-auto control-label text-left ">Listings Tours</label>
                                            <div class="col-md-6">
                                                <input type="text" name="listingTours" id="" class="form-control" value="<?= $rowGeneral['listing']; ?>">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label for="deposit" class="col-md-3 my-auto control-label text-left ">Search Result Tours</label>
                                            <div class="col-md-6">
                                                <input type="text" name="searchTours" id="" class="form-control" value="<?= $rowGeneral['searchResult']; ?>">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label for="deposit" class="col-md-3 my-auto control-label text-left ">Related Tours</label>
                                            <div class="col-md-6">
                                                <input type="text" name="relatedTours" id="" class="form-control" value="<?= $rowGeneral['relatedTours']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <label for="deposit" class="col-md-3 my-auto control-label text-left ">Display Order</label>
                                            <div class="col-md-6">
                                                <select class="form-control custom-select" name="homeOrder">
                                                    <option value="ol" <?php if ($rowGeneral['featureOrder'] == "ol") {
                                                                            echo "selected";
                                                                        } ?> label="By Order Given">By Order Given</option>
                                                    <option value="newf" <?php if ($rowGeneral['featureOrder'] == "newf") {
                                                                                echo "selected";
                                                                            } ?> label="By Latest First">By Latest First</option>
                                                    <option value="oldf" <?php if ($rowGeneral['featureOrder'] == "oldf") {
                                                                                echo "selected";
                                                                            } ?> label="By Oldest First">By Oldest First</option>
                                                    <option value="az" <?php if ($rowGeneral['featureOrder'] == "az") {
                                                                            echo "selected";
                                                                        } ?> label="Ascending Order (A-Z)">Ascending Order (A-Z)</option>
                                                    <option value="za" <?php if ($rowGeneral['featureOrder'] == "za") {
                                                                            echo "selected";
                                                                        } ?> label="Descending  Order (Z-A)">Descending Order (Z-A)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label for="deposit" class="col-md-3 my-auto control-label text-left ">Display Order</label>
                                            <div class="col-md-6">
                                                <select class="form-control custom-select" name="listingOrder">
                                                    <option value="ol" <?php if ($rowGeneral['listingOrder'] == "ol") {
                                                                            echo "selected";
                                                                        } ?> label="By Order Given">By Order Given</option>
                                                    <option value="newf" <?php if ($rowGeneral['listingOrder'] == "newf") {
                                                                                echo "selected";
                                                                            } ?> label="By Latest First">By Latest First</option>
                                                    <option value="oldf" <?php if ($rowGeneral['listingOrder'] == "oldf") {
                                                                                echo "selected";
                                                                            } ?> label="By Oldest First">By Oldest First</option>
                                                    <option value="az" <?php if ($rowGeneral['listingOrder'] == "az") {
                                                                            echo "selected";
                                                                        } ?> label="Ascending Order (A-Z)">Ascending Order (A-Z)</option>
                                                    <option value="za" <?php if ($rowGeneral['listingOrder'] == "za") {
                                                                            echo "selected";
                                                                        } ?> label="Descending  Order (Z-A)">Descending Order (Z-A)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label for="deposit" class="col-md-3 my-auto control-label text-left ">Display Order</label>
                                            <div class="col-md-6">
                                                <select class="form-control custom-select" name="searchOrder">
                                                    <option value="ol" <?php if ($rowGeneral['searchOrder'] == "ol") {
                                                                            echo "selected";
                                                                        } ?> label="By Order Given">By Order Given</option>
                                                    <option value="newf" <?php if ($rowGeneral['searchOrder'] == "newf") {
                                                                                echo "selected";
                                                                            } ?> label="By Latest First">By Latest First</option>
                                                    <option value="oldf" <?php if ($rowGeneral['searchOrder'] == "oldf") {
                                                                                echo "selected";
                                                                            } ?> label="By Oldest First">By Oldest First</option>
                                                    <option value="az" <?php if ($rowGeneral['searchOrder'] == "az") {
                                                                            echo "selected";
                                                                        } ?> label="Ascending Order (A-Z)">Ascending Order (A-Z)</option>
                                                    <option value="za" <?php if ($rowGeneral['searchOrder'] == "za") {
                                                                            echo "selected";
                                                                        } ?> label="Descending  Order (Z-A)">Descending Order (Z-A)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row m-auto">
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <label for="Target" class="col-md-3 my-auto control-label text-left">Minimum Price</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="minPrice" value="<?= $rowGeneral['minPrice']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <label for="Header" class="col-md-3 my-auto control-label text-left">Maximum Price</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="maxPrice" value="<?= $rowGeneral['maxPrice']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button name="submitGeneral" type="submit" class="mx-2 btn btn-success btn-sm">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="type" role="tabpanel" aria-labelledby="type-tab">
                                <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#typeModal">
                                    Add More Type
                                </button>
                                <table class="table table-bordered table-stripped">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">#</th>
                                            <th class="text-center align-middle">Descriptions</th>
                                            <th class="text-center align-middle">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        while ($rowType = mysqli_fetch_assoc($resultType)) : ?>
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <?= $i++; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?= $rowType['description']; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a href="" class="btn btn-sm btn-info"><i class="far fa-edit"></i> Edit</a> &nbsp; <a href="settings.php?dltType=<?= $rowType['id']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="included" role="tabpanel">
                                <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#includedModal">
                                    Add More Inclusion
                                </button>
                                <table class="table table-bordered table-stripped">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">#</th>
                                            <th>Description</th>
                                            <th class="text-center align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $e = 1;
                                        while ($rowInclusion = mysqli_fetch_assoc($resultIncluded)) : ?>
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <?= $e++; ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?= $rowInclusion['description']; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a href="" class="btn btn-sm btn-info"><i class="far fa-edit"></i> Edit</a> &nbsp; <a href="settings.php?dltInclude=<?= $rowInclusion['id']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="excluded" role="tabpanel">
                                <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#excludedModal">
                                    Add More Exclusion
                                </button>
                                <table class="table table-bordered table-stripped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Description</th>
                                            <th class="text-center align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $x = 1;
                                        while ($rowExclusion = mysqli_fetch_assoc($resultExcluded)) : ?>
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <?= $x++; ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?= $rowExclusion['description']; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a href="" class="btn btn-sm btn-info"><i class="far fa-edit"></i> Edit</a> &nbsp; <a href="settings.php?dltExclude=<?= $rowExclusion['id']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="airlines" role="tabpanel">
                                <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#airlinesModal">
                                    Add Airlines
                                </button>
                                <table class="table table-bordered table-stripped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">#</th>
                                            <th class="text-center align-middle">IATA Code</th>
                                            <th class="text-center align-middle">Airline</th>
                                            <th class="text-center align-middle">Country</th>
                                            <th class="text-center align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $x = 1;
                                        while ($rowAirline = mysqli_fetch_assoc($resultAirline)) : ?>
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <?= $x++; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?= $rowAirline['iata']; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?= $rowAirline['airline']; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?= $rowAirline['country']; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a href="" class="btn btn-sm btn-info"><i class="far fa-edit"></i> Edit</a> &nbsp; <a href="settings.php?dltAirline=<?= $rowAirline['id']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->

<!-- Modal Type -->
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="modal fade" id="typeModal" tabindex="-1" role="dialog" aria-labelledby="typeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="typeModalLabel">Add Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="">Type</label>
                        <input type="text" name="addType" id="" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submitType" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Inclusion -->
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="modal fade" id="includedModal" tabindex="-1" role="dialog" aria-labelledby="includedModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="includedModalLabel">Add Inclusion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="">Inclusion</label>
                        <textarea name="addInclusion" id="" cols="10" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submitIncluded" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Excluded -->
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="modal fade" id="excludedModal" tabindex="-1" role="dialog" aria-labelledby="excludedModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="excludedModalLabel">Add Exclusion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="">Exclusion</label>
                        <textarea name="addExclusion" id="" cols="10" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submitExcluded" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</form>


<?php include('../../elements/admin/dashboard/footer.php') ?>

<script>
    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    })
</script>