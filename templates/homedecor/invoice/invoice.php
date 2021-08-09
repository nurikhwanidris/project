<?php

// DB Conn
include($_SERVER['DOCUMENT_ROOT'] . '/src/model/dbconn.php');

$id = $_GET['id'];

// Get the data first
$sqlOrder = "SELECT * FROM homedecor_order WHERE id = '$id'";
$resOrder = mysqli_query($conn, $sqlOrder);
$rowOrder = mysqli_fetch_assoc($resOrder);

// Get the invoice data
$sqlInvoice = "SELECT * FROM homedecor_invoice WHERE id ='$id'";
$resInvoice = mysqli_query($conn, $sqlInvoice);
$rowInvoice = mysqli_fetch_assoc($resInvoice);

// Make everything explodeeeeeeeeee
$products = explode(',', $rowOrder['product_id']);
$quantities = explode(',', $rowOrder['quantity']);
$prices = explode(',', $rowOrder['price']);
$discountItems = explode(',', $rowOrder['discount_items']);
$discountAll = explode(',', $rowOrder['discount_all']);

// Get customer info
$customer = "SELECT * FROM homedecor_customer where id = '" . $rowOrder['customer_id'] . "'";
$resultCustomer = mysqli_query($conn, $customer);
$rowCustomer = mysqli_fetch_array($resultCustomer);

// Get receipt info if exist
$selectReceipt = "SELECT * FROM homedecor_receipt WHERE customerID = '" . $rowOrder['customer_id'] . "'";
$resultReceipt = mysqli_query($conn, $selectReceipt);

// Get invoice id if exist
$invoicee = "SELECT * FROM homedecor_invoice where customer_id = '" . $rowOrder['customer_id'] . "'";
$resultInvoicee = mysqli_query($conn, $invoicee);

if (mysqli_num_rows($resultInvoicee) > 0) {
    $rowInvoicee = mysqli_fetch_assoc($resultInvoicee);
    $date =  $rowInvoicee['invoice_date'];
}

// Include the main TCPDF library (search for installation path).
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/vendor/pdf/tcpdf.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'This is a computer generated document. No signature is required', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
// $pdf->SetCreator(PDF_CREATOR);
// $pdf->SetAuthor('Arzu Home & Living');
// $pdf->SetTitle($rowOrder['pvNum']);

// Business name
define('BUSINESS', 'Arzu Home & Living Empire');

// Business address
define('ADDRESS', "No. 243B, Tingkat 2, Jalan Bandar 13, \n53100 Taman Melawati, Kuala Lumpur");

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, BUSINESS, ADDRESS);
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 12, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// Create cells
$pdf->MultiCell(90, 10, 'Invoice For', 0, 'L', 0, 0);
$pdf->MultiCell(90, 5, 'INV-' . $rowInvoice['invoice_num'], 0, 'R', 0, 0);
$pdf->Ln();
$pdf->setFont('Helvetica', 'B', 8);
$pdf->Cell(90, 5, '', 0, 'L', 0, 0);
$pdf->Cell(162, 5, $rowInvoicee['invoice_date'], 0, 'R', 0, 0);
$pdf->Ln();
$pdf->Ln();

// Pay to whom?
$pdf->setFont('Helvetica', 'B', 11);
$pdf->Cell(100, 5, $rowCustomer['customerName']);
$pdf->Ln();

// Address
$pdf->setFont('Helvetica', 0, 8);
$pdf->Cell(100, 5, $rowCustomer['address1'] . ',');
$pdf->Ln();
$pdf->Cell(100, 5, $rowCustomer['city'] . ',');
$pdf->Ln();
$pdf->Cell(160, 5, $rowCustomer['postcode'] . ", " . $rowCustomer['state']);
$pdf->Ln();
// Contact?
$pdf->setFont('Helvetica', 'B', 8);
$pdf->Cell(120, 5, $rowCustomer['customerPhone']);
$pdf->Ln();
$pdf->Ln();

// Table header
$pdf->setFont('Helvetica', 'B', 9);
$pdf->Cell(90, 6, 'Description', 1, false, 'L', 0, '', 0, false, 'T', 'M');
$pdf->Cell(20, 6, 'Price/Unit', 1, 'C', 0, 0);
$pdf->Cell(20, 6, 'Quantity', 1, 'C', 0, 0);
$pdf->Cell(25, 6, 'Amount', 1, 'C', 0, 0);

// Check if there's discount
if ($rowOrder['discount_items'] != '' && $rowOrder['price'] != $rowOrder['discount_items']) {
    $pdf->Cell(25, 6, 'Discount', 1, 'C', 0, 0);
}
$pdf->Ln();

// Then loop that shhit
for ($i = 0; $i < count($products); $i++) :
    $product = $products[$i];
    $quantity = $quantities[$i];
    $price = $prices[$i];
    $discount = $discountItems[$i];
    $selectProduct = "SELECT * FROM homedecor_product WHERE id = '$product'";
    $resultProduct = mysqli_query($conn, $selectProduct);
    $rowProduct = mysqli_fetch_array($resultProduct);

    $pdf->setFont('Helvetica', '', 9);
    $pdf->MultiCell(90, 10, $rowProduct['name'] . ' [' . $rowProduct['orderNo'] . ']', 1, 'L', 0, 0, '', '', true, 0, false, true, 10, 'M');

    // Check for shipping
    if ($rowProduct['name'] == 'Shipping') :
        $pdf->MultiCell(20, 10, 'RM' . number_format($price, 2, '.', ','), 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
    else :
        if (!empty($rowProduct['fixedPrice'])) :
            $pdf->MultiCell(20, 10, 'RM' . number_format($rowProduct['fixedPrice'], 2, '.', ','), 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
        else :
            $pdf->MultiCell(20, 10, 'RM' . number_format(((int)$rowProduct['cost'] * 2.5) + 6, 2, '.', ','), 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
        endif;
    endif;


    $pdf->MultiCell(20, 10, $quantity, 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');

    // Check if there's discount
    if ($rowOrder['discount_items'] != '' && $rowOrder['price'] != $rowOrder['discount_items']) {
        $pdf->MultiCell(25, 10, 'RM' . number_format((int)$price, 2, '.', ','), 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
        $pdf->MultiCell(25, 10, 'RM' . number_format((int)$discount, 2, '.', ','), 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
    } elseif ($rowOrder['discount_items'] == $rowOrder['price']) {
        $pdf->MultiCell(25, 10, 'RM' . number_format((int)$price, 2, '.', ','), 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
    }

    $pdf->Ln();
endfor;

// Table footer
$pdf->setFont('Helvetica', 'B', 9);
$pdf->MultiCell(110, 10, '', 0, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');

// Check if there's discount
if ($rowOrder['discount_items'] != '' && $rowOrder['price'] != $rowOrder['discount_items']) {
    $pdf->MultiCell(45, 10, 'Total', 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
} elseif ($rowOrder['discount_items'] == $rowOrder['price']) {
    $pdf->MultiCell(20, 10, 'Total', 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
}

if ($rowOrder['discount_items'] != 0 && $rowOrder['price'] != $rowOrder['discount_items']) :
    $pdf->MultiCell(25, 10, 'RM' . number_format(array_sum($discountItems), 2, '.', ','), 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
elseif ($rowInvoicee['total_amount'] !== '') :
    $pdf->MultiCell(25, 10, 'RM' .  number_format($rowInvoicee['total_amount'], 2, '.', ','), 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
elseif ($rowOrder['discount_all'] != '') :
    $total = explode(',', $rowOrder['price']);
    $totalSum = array_sum($total);
    $percent = $rowOrder['discount_all'] / 100;
    $discount = $totalSum - ($totalSum * $percent);
    $pdf->MultiCell(25, 10, 'RM' .  number_format($discount, 2, '.', ','), 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
else :
    $pdf->MultiCell(25, 10, 'RM' .  number_format(array_sum($prices), 2, '.', ','), 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
endif;
$pdf->Ln();
$pdf->Ln();

// Receipt
$pdf->setFont('Helvetica', '', 8);
$pdf->Cell(64, 5, 'Receipt(s)', 1, 'C', 0);
$pdf->Ln();
$pdf->Cell(14, 5, 'No.', 1, 'C', 0);
$pdf->Cell(30, 5, 'Date', 1, 'C', 0);
$pdf->Cell(20, 5, 'Amount', 1, 'C', 0);
$pdf->Ln();
while ($rowReceipt = mysqli_fetch_array($resultReceipt)) :
    // No receipt
    $pdf->Cell(14, 5, str_pad($rowReceipt['id'], 4, 0, STR_PAD_LEFT), 1, 'C', 0);

    // Date
    $s = $rowReceipt['invoiceDate'];
    $dt = new DateTime($s);
    $pdf->Cell(30, 5, $date = $dt->format('d/m/Y'), 1, 'C', 0);

    // Amount
    $pdf->Cell(20, 5, 'RM' . $rowReceipt['amountPaid'], 1, 'C', 0);
    $pdf->Ln();
endwhile;
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

// Pay to?
$pdf->setFont('Helvetica', '', 10);
$pdf->Cell(40, 5, 'Pay to');
$pdf->Ln();
$pdf->setFont('Helvetica', 'B', 10);
$pdf->Cell(40, 5, 'Arzu Home Living Empire');
$pdf->Ln();
$pdf->setFont('Helvetica', 'B', 10);
$pdf->Cell(100, 5, 'Maybank - 5622 0966 6454');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

// Terms
$pdf->setFont('Helvetica', '', 10);
$pdf->Cell(100, 5, 'Terms and Conditions');
$pdf->Ln();
$pdf->Cell(100, 5, '1. Price will be rounded up to the nearest point.');
$pdf->Ln();
$pdf->Cell(100, 5, '2. Please include the payment slips after the payment was made.');
$pdf->Ln();
$pdf->Cell(100, 5, '3. Balance payment must be made within 2 days after the invoice billed to you.');
$pdf->Ln();

// Result
$pdf->Output($rowInvoice['invoice_num'] . '.pdf');
