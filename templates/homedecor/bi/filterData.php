<?php
include('../../../src/model/dbconn.php');
if (isset($_POST['startDate'], $_POST['endDate'])) {
     $output = '';
     $sql = "SELECT * FROM homedecor_invoice WHERE invoice_date BETWEEN '" . $_POST['startDate'] . "' AND '" . $_POST['endDate'] . "' ORDER BY id DESC";
     $sql2 = "SELECT SUM(total_amount) AS total FROM homedecor_invoice WHERE invoice_date BETWEEN '" . $_POST['startDate'] . "' AND '" . $_POST['endDate'] . "'";
     $result = mysqli_query($conn, $sql);
     $result2 = mysqli_query($conn, $sql2);
     $rowTotal = mysqli_fetch_assoc($result2);

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
          $output .= '<tr>
                    <td class="text-center align-middle" colspan="4">Total</td>
                    <td class="text-center align-middle bg-info text-white font-weight-bold">RM' . number_format($rowTotal['total'], 2, '.', ',') . '</td>
                </tr> ';
          $output .= '</table>  
    </div>';
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
     $sql2 = "SELECT SUM(total_amount) AS total FROM homedecor_invoice WHERE MONTH(invoice_date) = '" . $_POST['month'] . "'";
     $result = mysqli_query($conn, $sql);
     $result2 = mysqli_query($conn, $sql2);
     $rowTotal = mysqli_fetch_array($result2);

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
          $output .= '<tr>
                    <td class="text-center align-middle" colspan="4">Total</td>
                    <td class="text-center align-middle bg-info text-white font-weight-bold">RM' . number_format($rowTotal['total'], 2, '.', ',') . '</td>
                </tr> ';
          $output .= '</table>  
    </div>';
     } else {
          $output .= '  
                <tr>  
                     <td class="text-center align-middle text-danger font-weight-bold" colspan="5">No Order Found</td>  
                </tr>  
           ';
     }
     $output .= '</table>';
     echo $output;
} else {
     $output = '';
     $sql = "SELECT invoice_num, invoice_date, total_amount FROM homedecor_invoice ORDER BY id DESC";
     $sql2 = "SELECT SUM(total_amount) AS total FROM homedecor_invoice";
     $result = mysqli_query($conn, $sql);
     $result2 = mysqli_query($conn, $sql2);
     $rowTotal = mysqli_fetch_array($result2);
     $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered table-hover table-sm">  
                <tr>  
                     <th width="" class="text-center align-middle">#</th>  
                     <th width="" class="text-center align-middle">Invoice #</th>
                     <th width="" class="text-center align-middle">Invoice Date</th>  
                     <th width="" class="text-center align-middle">Item Bought</th>  
                     <th width="" class="text-center align-middle">Subtotal</th>  
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
     $output .= '<tr>
                    <td class="text-center align-middle" colspan="4">Total</td>
                    <td class="text-center align-middle bg-info text-white font-weight-bold">RM' . number_format($rowTotal['total'], 2, '.', ',') . '</td>
                </tr> ';
     $output .= '</table>  
    </div>';
     echo $output;
}
