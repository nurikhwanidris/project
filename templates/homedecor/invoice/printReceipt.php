<?php

// DB Conn
include($_SERVER['DOCUMENT_ROOT'] . '/project/src/model/dbconn.php');

// Include the main TCPDF library (search for installation path).
require_once($_SERVER['DOCUMENT_ROOT'] . '/project/assets/vendor/pdf/tcpdf.php');

// Get id from url
$id = $_GET['id'];

// Select receipt
$selectReceipt = "SELECT * FROM homedecor_receipt2 WHERE id = '$id'";
$resultReceipt = mysqli_query($conn, $selectReceipt);
$rowReceipt = mysqli_fetch_assoc($resultReceipt);

// Select order
$selectOrder = "SELECT * FROM homedecor_order2 WHERE id = '" . $rowReceipt['orderId'] . "'";
$resultOrder = mysqli_query($conn, $selectOrder);
$rowOrder = mysqli_fetch_assoc($resultOrder);

// Select customer
$selectCustomer = "SELECT * FROM homedecor_customer WHERE id = '" . $rowOrder['customerId'] . "'";
$resultCustomer = mysqli_query($conn, $selectCustomer);
$customer = mysqli_fetch_array($resultCustomer);

// Return receipt data
$invoice = "SELECT * FROM homedecor_invoice2 WHERE orderId = '" . $rowReceipt['orderId'] . "'";
$resultInvoice = mysqli_query($conn, $invoice);
$rowInvoice = mysqli_fetch_assoc($resultInvoice);

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

// Paper orientation
define('PAPER_ORIENTATION', 'L');

// Paper size
define('PAPER_SIZE', 'A5');

// Create new PDF document
$pdf = new MYPDF(PAPER_ORIENTATION, PDF_UNIT, PAPER_SIZE, true, 'UTF-8', false);

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

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
// $pdf->SetFont('dejavusans', '', 12, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// Create cells for payment details
$pdf->SetFont('courierB', '', 12, '', true);
$pdf->MultiCell(90, 5, 'Payment Receipt', 0, 'L', 0, 0);

$pdf->SetFont('courier', '', 12, '', true);

$pdf->MultiCell(50, 5, 'Num :', 0, 'R', 0, 0);
$pdf->SetFont('courierB', '', 12, '', true);
$pdf->MultiCell(40, 5, str_pad($id, 6, '0', STR_PAD_LEFT), 0, 'R', 0, 0);
$pdf->Ln();

$pdf->SetFont('courier', '', 12, '', true);
$pdf->MultiCell(90, 5, '', 0, 'L', 0, 0);
$pdf->MultiCell(50, 5, 'Date :', 0, 'R', 0, 0);
$pdf->SetFont('courierB', '', 12, '', true);
$pdf->MultiCell(40, 5, $rowInvoice['invoiceDate'], 0, 'R', 0, 0);
$pdf->Ln();

$pdf->SetFont('courier', '', 12, '', true);
$pdf->MultiCell(90, 5, '', 0, 'L', 0, 0);
$pdf->MultiCell(50, 5, 'Payment Type :', 0, 'R', 0, 0);
$pdf->SetFont('courierB', '', 12, '', true);
$pdf->MultiCell(40, 5, $rowInvoice['paymentType'], 0, 'R', 0, 0);
$pdf->Ln();

$pdf->SetFont('courier', '', 12, '', true);
$pdf->MultiCell(90, 5, '', 0, 'L', 0, 0);
$pdf->MultiCell(50, 5, 'Amount :', 0, 'R', 0, 0);
$pdf->SetFont('courierB', '', 12, '', true);
$pdf->MultiCell(40, 5, 'RM ' . number_format($rowInvoice['amountPaid'], 2, '.', ''), 0, 'R', 0, 0);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

// Create something for recipient
$pdf->SetFont('courier', '', 12, '', true);
$pdf->MultiCell(45, 5, 'Received From', 0, 'L', 0, 0);
$pdf->SetFont('courierB', '', 12, '', true);
$pdf->MultiCell(15, 5, ':', 0, 'C', 0, 0);
$pdf->MultiCell(120, 5, $customer['customerName'], 0, 'L', 0, 0);
$pdf->Ln();

$pdf->SetFont('courier', '', 12, '', true);
$pdf->MultiCell(45, 5, 'Address', 0, 'L', 0, 0);
$pdf->MultiCell(15, 5, ':', 0, 'C', 0, 0);
$pdf->SetFont('courierB', '', 12, '', true);
$pdf->MultiCell(120, 5, $customer['address1'], 0, 'L', 0, 0);
$pdf->Ln();

$pdf->SetFont('courier', '', 12, '', true);
$pdf->MultiCell(45, 5, '', 0, 'L', 0, 0);
$pdf->MultiCell(15, 5, '', 0, 'C', 0, 0);
$pdf->SetFont('courierB', '', 12, '', true);
$pdf->MultiCell(140, 5, $customer['city'] . ', ' . $customer['postcode'] . ', ' . $customer['state'], 0, 'L', 0, 0);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('courier', '', 12, '', true);
$pdf->MultiCell(45, 5, 'Details', 0, 'L', 0, 0);
$pdf->MultiCell(15, 5, ':', 0, 'C', 0, 0);
$pdf->SetFont('courierB', '', 12, '', true);
$pdf->MultiCell(140, 5, 'Being payment for invoice number - INV' . date("Ym", strtotime($rowInvoice['invoiceDate'])) . str_pad($rowReceipt['orderId'], 4, 0, STR_PAD_LEFT), 0, 'L', 0, 0);
$pdf->Ln();

$pdf->SetFont('courier', '', 12, '', true);
$pdf->MultiCell(45, 5, 'Received by', 0, 'L', 0, 0);
$pdf->MultiCell(15, 5, ':', 0, 'C', 0, 0);
$pdf->SetFont('courierB', '', 12, '', true);
$pdf->MultiCell(140, 5, 'Arzu Home and Living Empire', 0, 'L', 0, 0);
$pdf->Ln();

// Result
$pdf->Output(str_pad($id, 6, '0', STR_PAD_LEFT) . '.pdf');
