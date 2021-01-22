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

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tours Management</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <form action="save-package.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col xl-8 col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add Tours - <?= $packageID; ?></h6>
                        <input type="text" name="tourID" id="" class="d-none" value="<?= $packageID; ?>">
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="General-tab" data-toggle="tab" href="#General" role="tab" aria-controls="General" aria-selected="true">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="flight-tab" data-toggle="tab" href="#flight" role="tab" aria-controls="flight" aria-selected="false">Flight</a>
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
                                <div class="row">
                                    <div class="col my-2">
                                        <label for="tourName">Package Name</label>
                                        <input type="text" name="tourName" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <label for="tourDate">Package Date</label>
                                        <textarea name="tourDate" id="" cols="30" rows="3" class="form-control">Put the dates here. Eg: 12/12/2020,13/12/2020</textarea>
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col form-group">
                                        <label for="">Package Itinerary</label>
                                        <textarea name="tourItinerary" id="editor1" class="editor border rounded mb-0 ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline ck-blurred form-control" cols="30" rows="10">Replace this with the itinerary.</textarea>
                                    </div>
                                    <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor 4
                                        // instance, using default configuration.
                                        CKEDITOR.replace('editor1');
                                    </script>
                                </div>
                                <div class="row my-2">
                                    <div class="col">
                                        <label for="tourCities">Package Cities</label>
                                        <textarea name="tourCities" id="" cols="30" rows="4" class="form-control"></textarea>
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
                            <div class="tab-pane fade" id="flight" role="tabpanel" aria-labelledby="flight-tab">
                                <div class="row my-2">
                                    <div class="col">
                                        <label for="tourAirlines">Airlines</label>
                                        <div class="">
                                            <select class="form-control mx-0" id="selectSearch" name="airlines" style="width: 50%;">
                                                <?php while ($row = mysqli_fetch_array($result)) : ?>
                                                    <option value="<?= $row['iata']; ?>"><?= $row['airline']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col">
                                        <label for="flightSchedule">Flight Schedule</label>
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-middle">Flights</th>
                                                    <th class="text-center align-middle">Airlines</th>
                                                    <th class="text-center align-middle">Sectors</th>
                                                    <th class="text-center align-middle">ETD</th>
                                                    <th class="text-center align-middle">ETA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="flight1" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="airline1" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="sector1" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="etd1" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="eta1" id="" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="flight2" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="airline2" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="sector2" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="etd2" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="eta2" id="" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="flight3" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="airline3" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="sector3" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="etd3" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="eta3" id="" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="flight4" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="airline4" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="sector4" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="etd4" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="eta4" id="" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="flight5" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="airline5" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="sector5" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="etd5" id="" class="form-control">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" name="eta5" id="" class="form-control">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
            <div class="col-xl-4 col-lg-4 position-sticky">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Main Settings</h6>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <label class="col-md-3 my-auto control-label text-left">Image</label>
                            <div class="col-md-9">
                                <img id="preview" src="#" alt="image will display here" class="img-thumbnail" style="margin-bottom: 10px;">
                                <input type='file' id="imgInp" name="img-save" class="form-control" accept="image/x-png,image/gif,image/jpeg">
                            </div>
                        </div>
                        <div class=" row form-group">
                            <label for="tourPDF" class="col-md-3 my-auto control-label text-left">PDF Itinerary</label>
                            <div class="col-md-9">
                                <input type="file" name="doc-save" id="" class="form-control" accept="application/pdf">
                            </div>
                        </div>
                        <div class=" row form-group">
                            <label class="col-md-3 my-auto control-label text-left">Status</label>
                            <div class="col-md-9">
                                <select name="status" id="" class="form-control">
                                    <option value="enabled" selected>Enabled</option>
                                    <option value="disable">Disable</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 my-auto control-label text-left">Meals</label>
                            <div class="col-md-9">
                                <select name="meals" id="" class="form-control">
                                    <option value="halfboard">Half-board</option>
                                    <option value="fullboard">Full-board</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 my-auto control-label text-left">Hotel Rating</label>
                            <div class="col-md-9">
                                <select name="hotel" id="" class="form-control">
                                    <option value="⭐">⭐</option>
                                    <option value="⭐⭐">⭐⭐</option>
                                    <option value="⭐⭐⭐">⭐⭐⭐</option>
                                    <option value="⭐⭐⭐⭐">⭐⭐⭐⭐</option>
                                    <option value="⭐⭐⭐⭐⭐">⭐⭐⭐⭐⭐</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 my-auto control-label text-left">Season</label>
                            <div class="col-md-9">
                                <select name="season" id="" class="form-control">
                                    <option value="Spring">Spring</option>
                                    <option value="Summer">Summer</option>
                                    <option value="Falls">Falls</option>
                                    <option value="Winter">Winter</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 my-auto control-label text-left">Tour Type</label>
                            <div class="col-md-9">
                                <select name="type" id="" class="form-control">
                                    <option value="SD">SD</option>
                                    <option value="FIT">FIT</option>
                                    <option value="Private">Private</option>
                                    <option value="Academic">Academic</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="Feature" class="col-md-3 my-auto control-label text-left">Feature</label>
                            <div class="col-md-3">
                                <select name="feature" id="" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="promoStart" id="" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="promoEnd" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="deposit" class="col-md-3 my-auto control-label text-left text-success">Deposit</label>
                            <div class="col-md-5">
                                <select name="deposit" id="" class="form-control">
                                    <option value="Fixed">Fixed</option>
                                    <option value="Percentage">Percentage</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="depositAmount" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="deposit" class="col-md-3 my-auto control-label text-left text-warning">Discount</label>
                            <div class="col-md-5">
                                <select name="discount" id="" class="form-control">
                                    <option value="Fixed">Fixed</option>
                                    <option value="Percentage">Percentage</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="discountAmount" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <button type="submit" name="submit" class="btn btn-info">Submit</button>
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