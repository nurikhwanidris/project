<!-- Header -->
<?php include('../elements/admin/dashboard/header.php') ?>

<!-- Get DB conn -->
<?php include('../../src/model/dbconn.php') ?>

<!-- Sidebar -->
<?php include('../elements/admin/dashboard/nav.php') ?>

<?php
// Fetch number of enquiry
$enq = "SELECT id FROM homedecor_customer GROUP BY id";
$resEnq = mysqli_query($conn, $enq);
$numOfEnq = mysqli_num_rows($resEnq);

// Fetch number of customers
$cust = "SELECT id FROM homedecor_customer GROUP BY customerName";
$resCust = mysqli_query($conn, $cust);
$numOfCust = mysqli_num_rows($resCust);

// Fetch amount of sales made in a month
$sales = "SELECT SUM(homedecor_invoice.total_amount) AS salesMade, SUM(amount_paid) AS amountPaid, SUM(remaining_amount) AS balance FROM (SELECT total_amount, amount_paid, remaining_amount FROM homedecor_invoice WHERE invoice_status != 'Cancelled' UNION ALL SELECT grandTotal, amountPaid, remainingAmount FROM homedecor_invoice2) homedecor_invoice WHERE YEAR(NOW()) ";
$resSales = mysqli_query($conn, $sales);
$rowSales = mysqli_fetch_assoc($resSales);

// Bar Chart
$chartRevenue = "SELECT SUM(homedecor_invoice.amount_paid) AS totalAmount, created FROM (SELECT amount_paid, created FROM homedecor_invoice WHERE invoice_status != 'Cancelled' UNION ALL SELECT amountPaid, created FROM homedecor_invoice2) homedecor_invoice GROUP BY MONTH(created)";
$resultRevenue = mysqli_query($conn, $chartRevenue);

// Bar Chart
// $chartBalance = "SELECT SUM(remaining_amount) AS sumBalance FROM homedecor_invoice GROUP BY MONTH(created)";
$chartBalance = "SELECT SUM(homedecor_invoice.remaining_amount) AS sumBalance, created FROM (SELECT remaining_amount, created FROM homedecor_invoice WHERE invoice_status != 'Cancelled' UNION ALL SELECT remainingAmount, created FROM homedecor_invoice2) homedecor_invoice GROUP BY MONTH(created)";
$resultBalance = mysqli_query($conn, $chartBalance);

// Pie Chart
$pieChart = "SELECT COUNT(source) AS countSource, source FROM homedecor_customer GROUP BY source";
$resultPie = mysqli_query($conn, $pieChart);

// Create the loop
$dataRow = array();
while ($rowPie = mysqli_fetch_assoc($resultPie)) {
    $dataRow = $rowPie;
}

?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Arzu Home Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Enquiries Inserted</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $numOfEnq; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-id-card fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Customers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $numOfCust; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Sales</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                RM <?= number_format($rowSales['salesMade'], 2, '.', ','); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Earnings (Cumulative)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">RM <?= number_format($rowSales['amountPaid'], 2, '.', ','); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Balance (Cumulative)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                RM <?= number_format($rowSales['balance'], 2, '.', ','); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Report</h6>
                </div>
                <div class="card-body">
                    <h4 class="font-weight-bold">Welcome to Neurali!</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yearly Revenue</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <hr>
                    <!-- Styling for the bar chart can be found in the
                    <code>/js/demo/chart-bar-demo.js</code> file. -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<?php include('../elements/admin/dashboard/footer.php') ?>

<!-- Bar Chart -->
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Bar Chart Example
    var ctx = document.getElementById("myBarChart");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                    label: "Revenue",
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data: [
                        <?php
                        while ($rowData1 = mysqli_fetch_array($resultRevenue)) :
                            echo $rowData1['totalAmount'] . ",";
                        endwhile;
                        ?>
                    ],
                },
                {
                    label: "Balance",
                    backgroundColor: "#df534e",
                    hoverBackgroundColor: "#d9392e",
                    borderColor: "#df534e",
                    data: [
                        <?php
                        while ($rowData2 = mysqli_fetch_array($resultBalance)) :
                            echo $rowData2['sumBalance'] . ",";
                        endwhile;
                        ?>
                    ],
                }
            ],
            maxBarThickness: 25
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    },
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        // max: 15000,
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return 'RM' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': RM' + number_format(tooltipItem.yLabel);
                    }
                }
            },
        }
    });
</script>