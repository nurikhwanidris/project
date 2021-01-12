<!-- Header -->
<?php include('../../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../../elements/admin/dashboard/nav.php') ?>

<!-- Get Package ID -->
<?php
$sql = "SELECT id FROM tours ORDER BY id DESC";
$resultSql = mysqli_query($conn, $sql);
if ($resultSql) {
    $row = mysqli_fetch_assoc($resultSql);
    $packageID = $row['id'] + 1;
} else {
    echo mysqli_error($conn);
}
?>

<!-- Get Package -->
<?php
$package = "SELECT * FROM tours";
$resultPackage = mysqli_query($conn, $package);
?>


<!-- Get the inclusion -->
<?php
$included = "SELECT * FROM included";
$resultIncluded = mysqli_query($conn, $included);
$rowIncluded = mysqli_fetch_assoc($resultIncluded);
?>

<!-- Get the exclusion -->
<?php
$excluded = "SELECT * FROM excluded";
$resultExcluded = mysqli_query($conn, $excluded);
$rowExcluded = mysqli_fetch_assoc($resultExcluded);
?>

<!-- Get the airlines -->
<?php
$query = "SELECT * FROM airlines";
$result = mysqli_query($conn, $query);
?>

<!-- Get the Source -->
<?php
$source = "SELECT * FROM source";
$resultSource = mysqli_query($conn, $source);
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customers Management</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <form action="save-package.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add Customers - <?= $packageID; ?></h6>
                        <input type="text" name="tourID" id="" class="d-none" value="<?= $packageID; ?>">
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="General-tab" data-toggle="tab" href="#General" role="tab" aria-controls="General" aria-selected="true">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="package-tab" data-toggle="tab" href="#package" role="tab" aria-controls="package" aria-selected="false">Package</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Price-tab" data-toggle="tab" href="#Price" role="tab" aria-controls="Price" aria-selected="false">Price</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Include-tab" data-toggle="tab" href="#Include" role="tab" aria-controls="Include" aria-selected="false">Include</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Exclude-tab" data-toggle="tab" href="#Exclude" role="tab" aria-controls="Exclude" aria-selected="false">Exclude</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
                                <div class="row my-2">
                                    <div class="col-4 my-2">
                                        <label for="staffName">Staff Name</label>
                                        <input type="text" name="staffName" id="" class="form-control">
                                    </div>
                                    <div class="col-4 my-2">
                                        <label for="tourDate">Package Date</label>
                                        <input type="text" name="insertDate" id="" class="form-control">
                                    </div>
                                    <div class="col-4 my-2">
                                        <label for="source">Source</label>
                                        <select name="source" id="" class="form-control">
                                            <?php while ($rowSource = mysqli_fetch_assoc($resultSource)) : ?>
                                                <option value="<?= $rowSource['sourceName']; ?>"><?= $rowSource['sourceName']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-4 form-group">
                                        <label for="">Client Name</label>
                                        <input type="text" name="customerName" id="" class="form-control">
                                    </div>
                                    <div class="col-4 form-group">
                                        <label for="">Client Phone</label>
                                        <input type="text" name="customerPhone" id="" class="form-control">
                                    </div>
                                    <div class="col-4 form-group">
                                        <label for="">Client Email</label>
                                        <input type="email" name="customerEmail" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-6">
                                        <label for="address1">Address</label>
                                        <input type="text" name="address1" id="" class="form-control">
                                    </div>
                                    <div class="col-2">
                                        <label for="address1">City</label>
                                        <input type="text" name="City" id="" class="form-control">
                                    </div>
                                    <div class="col-2">
                                        <label for="address1">Postcode</label>
                                        <input type="text" name="address2" id="" class="form-control">
                                    </div>
                                    <div class="col-2   ">
                                        <label for="address1">State</label>
                                        <select name="state" id="" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Johor">Johor</option>
                                            <option value="Kedah">Kedah</option>
                                            <option value="Kelantan">Kelantan</option>
                                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                                            <option value="Labuan">Labuan</option>
                                            <option value="Malacca">Malacca</option>
                                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                                            <option value="Pahang">Pahang</option>
                                            <option value="Perak">Perak</option>
                                            <option value="Perlis">Perlis</option>
                                            <option value="Penang">Penang</option>
                                            <option value="Sabah">Sabah</option>
                                            <option value="Sarawak">Sarawak</option>
                                            <option value="Selangor">Selangor</option>
                                            <option value="Terengganu">Terengganu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Include" role="tabpanel" aria-labelledby="Include-tab">
                                <div class="row my-2">
                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="include[]" class="custom-control-input" id="airlineTicket" value="1" checked>
                                            <label class="custom-control-label" for="airlineTicket">Tiket penerbangan pergi-balik kelas ekonomi termasuk surcaj minyak dan segala cukai penerbangan.</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="include[]" class="custom-control-input" id="hotel" value="2" checked>
                                            <label class="custom-control-label" for="hotel">Hotel penginapan yang selesa sepanjang lawatan (rujuk senarai hotel ditawarkan).</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="include[]" class="custom-control-input" id="cityTax" value="3" checked>
                                            <label class="custom-control-label" for="cityTax">Cukai bandar (city tax).</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="include[]" class="custom-control-input" id="meals" value="4" checked>
                                            <label class="custom-control-label" for="meals">Sarapan pagi di hotel, makan tengahari dan makan malam sesuai Muslim sepanjang lawatan.</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="include[]" class="custom-control-input" id="entranceTicket" value="5" checked>
                                            <label class="custom-control-label" for="entranceTicket">Ticket masuk ke tempat-tempat menarik sepanjang lawatan.</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="include[]" class="custom-control-input" id="transport" value="6" checked>
                                            <label class="custom-control-label" for="transport">Pengangkutan bas persiaran yang berhawa dan selesa.</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="include[]" class="custom-control-input" id="guide" value="7" checked>
                                            <label class="custom-control-label" for="guide">Perkhidmatan pemandu pelancong berbahasa Inggeris yang berpengalaman sepanjang lawatan.</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="include[]" class="custom-control-input" id="tipping" value="8" checked>
                                            <label class="custom-control-label" for="tipping">Tip kepada pemandu pelancong dan pemandu bas semasa lawatan.</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="include[]" class="custom-control-input" id="tourLeader" value="9" checked>
                                            <label class="custom-control-label" for="tourLeader">Ketua rombongan yang terlatih dan berpengalaman dari Enrich Travelogue Sdn Bhd.</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="include[]" class="custom-control-input" id="beg" value="10" checked>
                                            <label class="custom-control-label" for="beg">Percuma edisi beg pengembaraan khas Enrich Travelogue Sdn Bhd.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Exclude" role="tabpanel" aria-labelledby="Exclude-tab">
                                <div class="row my-2">
                                    <div class="col">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="exclude[]" class="custom-control-input" id="insurance" value="1" checked>
                                            <label class="custom-control-label" for="insurance">Insurans kembara - sila hubungi kami bagi khidmat nasihat dan pembelian premium insurans kembara yang sesuai.</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="exclude[]" class="custom-control-input" id="surcaj" value="2" checked>
                                            <label class="custom-control-label" for="surcaj">Surcaj tambahan kepada harga yang ditawarkan ketika waktu perayaan, puncak dan cuti sekolah (sekiranya dinyatakan di dalam tarikh perlepasan).</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="exclude[]" class="custom-control-input" id="additionalService" value="3" checked>
                                            <label class="custom-control-label" for="additionalService">Servis tambahan di hotel seperti dobi, snek, minibar dan perkhidmatan porter sekiranya tidak dinyatakan.</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="exclude[]" class="custom-control-input" id="extraLuggage" value="4" checked>
                                            <label class="custom-control-label" for="extraLuggage">Bayaran tambahan bagi lebihan had bagasi yang dibawa.</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="exclude[]" class="custom-control-input" id="extraMeals" value="5" checked>
                                            <label class="custom-control-label" for="extraMeals">Makan minum, tiket lawatan dan lawatan lain yang tidak dinyatakan di dalam aturcara</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="exclude[]" class="custom-control-input" id="others" value="6" checked>
                                            <label class="custom-control-label" for="others">Perkara lain selain yang dinyatakan di dalam aturcara dan pakej termasuk kami.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="package" role="tabpanel" aria-labelledby="package-tab">
                                <div class="row my-3">
                                    <div class="col-4">
                                        <label for="">Package Type</label>
                                        <select name="" id="packageType" class="form-control">
                                            <option value="SD">SD</option>
                                            <option value="FIT">FIT</option>
                                            <option value="Academic">Academic</option>
                                            <option value="Private">Private</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-2" id="SD" class="packageHide" style="display:none;">
                                    <div class="col-4" id="">
                                        <label for="">Package Name</label>
                                        <select name="packageName" id="" class="form-control">
                                            <option value="">Select</option>
                                            <?php while ($rowPackage = mysqli_fetch_assoc($resultPackage)) : ?>
                                                <option value="<?= $rowPackage['id']; ?>"><?= $rowPackage['name']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="">Package Date</label>
                                        <input type="date" name="packageDate" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row my-2" id="FIT" class="packageHide" style="display:none;">
                                    <div class="col-4">
                                        <label for="">Package Name</label>
                                        <input type="text" name="packageNameFIT" id="" class="form-control">
                                    </div>
                                    <div class="col-4">
                                        <label for="">Package Date</label>
                                        <input type="date" name="packageDateFIT" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row my-2" id="Academic" class="packageHide" style="display:none;">
                                    <div class="col-4">
                                        <label for="">Package Name</label>
                                        <input type="text" name="packageNameAcademic" id="" class="form-control">
                                    </div>
                                    <div class="col-4">
                                        <label for="">Package Date</label>
                                        <input type="date" name="packageDateAcademic" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row my-2" id="Private" class="packageHide" style="display:none;">
                                    <div class="col-4">
                                        <label for="">Package Name</label>
                                        <input type="text" name="packageNamePrivate" id="" class="form-control">
                                    </div>
                                    <div class="col-4">
                                        <label for="">Package Date</label>
                                        <input type="date" name="packageDatePrivate" id="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Price" role="tabpanel" aria-labelledby="Price-tab">
                                <div class="row my-2">
                                    <div class="col">
                                        <label for="tourName">Tour Price</label>
                                        <table class="table table-bordered mb-0">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th class="text-center align-middle"></th>
                                                    <th class="text-center align-middle">TWN</th>
                                                    <th class="text-center align-middle">SGL</th>
                                                    <th class="text-center align-middle">CTW</th>
                                                    <th class="text-center align-middle">CWB</th>
                                                    <th class="text-center align-middle">CNB</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th class="text-center align-middle">
                                                        Normal Person
                                                    </th>
                                                    <td class="text-center align-middle">
                                                        <input type="number" name="twn" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="number" name="sgl" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="number" name="ctw" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="number" name="cwb" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="number" name="cnb" id="" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center align-middle">
                                                        Senior Citizen
                                                    </th>
                                                    <td class="text-center align-middle">
                                                        <input type="number" name="snr_twn" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="number" name="snr_sgl" id="" class="form-control">
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
        </div>
        <div class="row">
            <div class="col mb-3">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<!-- Footer -->
<?php include('../../elements/admin/dashboard/footer.php') ?>

<!-- Script for livesearch -->
<script>
    $(document).ready(function() {
        $('#selectSearch').select2();
    });
</script>

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

<script>
    $(function() {
        $('#packageType').change(function() {
            $('.packageHide').hide();
            $('#' + $(this).val()).show();
        });
    });
</script>