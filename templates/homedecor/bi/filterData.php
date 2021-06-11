<?php
include('../../../src/model/dbconn.php');
if (isset($_POST['startDate'], $_POST['endDate'])) {
    $output = '';
    $sql = "SELECT invoice_num, invoice_date, total_amount FROM homedecor_invoice WHERE invoice_date BETWEEN '" . $_POST['startDate'] . "' AND '" . $_POST['endDate'] . "' ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered table-hover table-sm">  
                <tr>  
                     <th width="" class="text-center align-middle">#</th>  
                     <th width="" class="text-center align-middle">Invoice #</th>
                     <th width="" class="text-center align-middle">Invoice Date</th>  
                     <th width="" class="text-center align-middle">Item Bought</th>  
                     <th width="" class="text-center align-middle">Total</th>  
                </tr>
                ';
    if (mysqli_num_rows($result) > 0) {
        $i = 1;
        while ($row = mysqli_fetch_array($result)) {
            $output .= '  
                <tr>  
                     <td class="text-center align-middle">' . $i++ . '</td>  
                     <td class="text-center align-middle">' . $row["invoice_num"] . '</td>
                     <td class="text-center align-middle">' . $row["invoice_date"] . '</td>
                     <td class="text-center align-middle">' . 'asd' . '</td>
                     <td class="text-center align-middle">RM' . $row["total_amount"] . '</td>
                </tr>  
           ';
        }
    } else {
        $output .= '  
                <tr>  
                     <td colspan="5">No Order Found</td>  
                </tr>  
           ';
    }
    $output .= '</table>';
    echo $output;
} elseif (isset($_POST['month'])) {
    $output = '';
    $sql = "SELECT invoice_num, invoice_date, total_amount FROM homedecor_invoice WHERE MONTH(invoice_date) = '" . $_POST['month'] . "' ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered table-hover table-sm">  
                <tr>  
                     <th width="" class="text-center align-middle">#</th>  
                     <th width="" class="text-center align-middle">Invoice #</th>
                     <th width="" class="text-center align-middle">Invoice Date</th>  
                     <th width="" class="text-center align-middle">Item Bought</th>  
                     <th width="" class="text-center align-middle">Total</th>  
                </tr>
                ';
    if (mysqli_num_rows($result) > 0) {
        $i = 1;
        while ($row = mysqli_fetch_array($result)) {
            $output .= '  
                <tr>  
                     <td class="text-center align-middle">' . $i++ . '</td>  
                     <td class="text-center align-middle">' . $row["invoice_num"] . '</td>
                     <td class="text-center align-middle">' . $row["invoice_date"] . '</td>
                     <td class="text-center align-middle">' . 'asd' . '</td>
                     <td class="text-center align-middle">RM' . $row["total_amount"] . '</td>
                </tr>  
           ';
        }
    } else {
        $output .= '  
                <tr>  
                     <td colspan="5">No Order Found</td>  
                </tr>  
           ';
    }
    $output .= '</table>';
    echo $output;
} else {
    $output = '';
    $sql = "SELECT invoice_num, invoice_date, total_amount FROM homedecor_invoice ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered table-hover table-sm">  
                <tr>  
                     <th width="" class="text-center align-middle">#</th>  
                     <th width="" class="text-center align-middle">Invoice #</th>
                     <th width="" class="text-center align-middle">Invoice Date</th>  
                     <th width="" class="text-center align-middle">Item Bought</th>  
                     <th width="" class="text-center align-middle">Total</th>  
                </tr>
                ';
    $i = 1;
    while ($row = mysqli_fetch_array($result)) {
        $output .= '  
                <tr>  
                     <td class="text-center align-middle">' . $i++ . '</td>  
                     <td class="text-center align-middle">' . $row["invoice_num"] . '</td>
                     <td class="text-center align-middle">' . $row["invoice_date"] . '</td>
                     <td class="text-center align-middle">' . 'asd' . '</td>
                     <td class="text-center align-middle">RM' . $row["total_amount"] . '</td>
                </tr> 
           ';
    }
    $output .= '</table>  
      </div>';
    echo $output;
}
