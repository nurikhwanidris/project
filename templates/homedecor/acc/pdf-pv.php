<?php

// DB Conn
include($_SERVER['DOCUMENT_ROOT'] . '/project/src/model/dbconn.php');

$id = $_GET['id'];

// Get the data first
$id = $_GET['id'];
$sqlPV = "SELECT * FROM homedecor_pv WHERE id = '$id'";
$resPV = mysqli_query($conn, $sqlPV);
$rowPV = mysqli_fetch_assoc($resPV);

// Make everything explodeeeeeeeeee
$descriptions = explode(',', $rowPV['description']);
$amounts = explode(',', $rowPV['amount']);
$categories = explode(',', $rowPV['category']);

//require the main TCPDF library (search for installation path).
require_once($_SERVER['DOCUMENT_ROOT'] . '/project/assets/vendor/pdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Arzu Home & Living');
$pdf->SetTitle($rowPV['pvNum']);

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
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();


$pdf->MultiCell(90, 10, 'Payment Voucher', 0, 'L', 0, 0);
$pdf->MultiCell(90, 10, $rowPV['pvNum'], 0, 'R', 0, 0);
$pdf->Ln();

// Pay to whom?
$pdf->setFont('Helvetica', '', 11);
$pdf->Cell(40, 10, 'Payable To');
$pdf->Cell(10, 10, ':');
$pdf->setFont('Helvetica', 'B', 11);
$pdf->Cell(100, 10, $rowPV['payTo']);
$pdf->Ln();

// Bank account
$pdf->SetFont('Helvetica', '', 11);
$pdf->Cell(40, 10, 'Bank Account');
$pdf->Cell(10, 10, ':');
$pdf->setFont('Helvetica', 'B', 11);
$pdf->Cell(100, 10, $rowPV['accNum']);
$pdf->Ln();

// Bank name
$pdf->SetFont('Helvetica', '', 11);
$pdf->Cell(40, 10, 'Bank Name');
$pdf->Cell(10, 10, ':');
$pdf->setFont('Helvetica', 'B', 11);
$pdf->Cell(100, 10, $rowPV['accBank']);
$pdf->Ln();
$pdf->Ln();

// Table header
$pdf->setFont('Helvetica', '', 11);
$pdf->MultiCell(12, 6, 'Item', 1, 'C', 0, 0);
$pdf->Cell(90, 6, 'Description', 1);
$pdf->Cell(48, 6, 'Category', 1, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->MultiCell(30, 6, 'Amount', 1, 'C', 0, 0);
$pdf->Ln();

// Then loop that shhit
$x = 1;
for ($i = 0; $i < count($descriptions); $i++) :
    $description = $descriptions[$i];
    $category = $categories[$i];
    $amount = $amounts[$i];

    $pdf->setFont('Helvetica', '', 10);
    // $pdf->MultiCell(12, 10, $x++, 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
    // $pdf->MultiCell(90, 10, $description, 1, 'L', 0, 0, '', '', true, 0, false, true, 10, 'M');
    // $pdf->MultiCell(48, 10, $category, 1, 'L', 0, 0, '', '', true, 0, false, true, 10, 'M');
    // $pdf->MultiCell(30, 10, 'RM' . number_format($amount, 2, '.', ','), 1, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
    $pdf->Cell(12, 10, $x++, 1, false, 'C', 0, '', 0, false, 'T', 'M');
    $pdf->Cell(90, 10, $description, 1,);
    $pdf->Cell(48, 10, $category, 1, false, 'C', 0, '', 0, false, 'T', 'M');
    $pdf->Cell(30, 10, 'RM' . number_format($amount, 2, '.', ','), 1, false, 'C', 0, '', 0, false, 'T', 'M');
    $pdf->Ln();
endfor;

// Table footer
$pdf->setFont('Helvetica', '', 11);
$pdf->MultiCell(150, 15, 'Total', 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
$pdf->setFont('Helvetica', 'B', 11);
$pdf->MultiCell(30, 15, 'RM' . number_format(round(array_sum($amounts), 2), 2, '.', ','), 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
$pdf->Ln();
$pdf->Ln();

// Created on?
$pdf->setFont('Helvetica', '', 11);
$pdf->Cell(40, 10, 'Created on');
$pdf->Cell(10, 10, ':');
$pdf->setFont('Helvetica', 'B', 11);
$pdf->Cell(100, 10, $rowPV['created']);
$pdf->Ln();

// Created by?
$pdf->setFont('Helvetica', '', 11);
$pdf->Cell(40, 10, 'Created by');
$pdf->Cell(10, 10, ':');
$pdf->setFont('Helvetica', 'B', 11);
$pdf->Cell(100, 10, $rowPV['staffName']);
$pdf->Ln();

// Approved by?
$pdf->setFont('Helvetica', '', 11);
$pdf->Cell(40, 10, 'Approved by');
$pdf->Cell(10, 10, ':');
$pdf->setFont('Helvetica', 'B', 11);
$pdf->Cell(100, 10, 'Arzu Abdullah');
$pdf->Ln();
$pdf->Ln();

// Footer
$pdf->setFont('Helvetica', '', 10);
$pdf->MultiCell(180, 10, 'This is a computer generated document. No signature is required', 0, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
$pdf->Ln();

// Result
$pdf->Output($rowPV['pvNum'] . '.pdf');
