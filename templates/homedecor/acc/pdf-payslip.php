<?php

// DB Conn
include($_SERVER['DOCUMENT_ROOT'] . '/project/src/model/dbconn.php');

$id = $_GET['id'];

// Get the data first
$id = $_GET['id'];
$sql = "SELECT * FROM homedecor_payslip WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

//require the main TCPDF library (search for installation path).
require_once($_SERVER['DOCUMENT_ROOT'] . '/project/assets/vendor/pdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Arzu Home & Living');
$pdf->SetTitle($row['period'] . ' - ' . $row['employeeName']);

// Business name
define('BUSINESS', 'Arzu Home & Living Empire');

// Business address
define('ADDRESS', "No. 243B, Tingkat 2, Jalan Bandar 13, \n53100 Taman Melawati, Kuala Lumpur");

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, BUSINESS, ADDRESS);
// $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
$pdf->SetFont('dejavusans', 'B', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

$pdf->MultiCell(90, 10, 'PAYSLIP', 0, 'L', 0, 0);
$pdf->MultiCell(90, 10, $row['period'], 0, 'R', 0, 0);
$pdf->Ln();

// Employee info
$pdf->SetFillColor(123, 172, 212);
$pdf->SetTextColor(0, 0, 0, 0);
$pdf->SetFont('Helvetica', 'B', 11, '', true);
$pdf->MultiCell(70, 5, 'Employee Information', 0, 'L', 1, 0, '', '', true);

// Blank space
$pdf->SetFillColor(0, 0, 0, 0);
$pdf->SetTextColor(0, 0, 0, 100);
$pdf->SetFont('Helvetica', 'B', 11, '', true);
$pdf->MultiCell(30, 5, '', 0, 'L', 1, 0, '', '', true);

// Pay date
$pdf->SetFillColor(123, 172, 212);
$pdf->SetTextColor(0, 0, 0, 0);
$pdf->SetFont('Helvetica', 'B', 11, '', true);
$pdf->MultiCell(30, 5, 'Pay Date', 0, 'C', 1, 0, '', '', true);

// Month
$pdf->SetFillColor(123, 172, 212);
$pdf->SetTextColor(0, 0, 0, 0);
$pdf->SetFont('Helvetica', 'B', 11, '', true);
$pdf->MultiCell(50, 5, 'Period', 0, 'C', 1, 0, '', '', true);

// Next line
$pdf->Ln();

// Employee name
$pdf->SetFillColor(0, 0, 0, 0);
$pdf->SetTextColor(0, 0, 0, 100);
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(70, 5, $row['employeeName'], 0, 'L', 1, 0, '', '', true);

// Blank
$pdf->SetFillColor(0, 0, 0, 0);
$pdf->SetTextColor(0, 0, 0, 100);
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(30, 5, '', 0, 'L', 1, 0, '', '', true);

// Paydate
$pdf->SetFillColor(0, 0, 0, 0);
$pdf->SetTextColor(0, 0, 0, 100);
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$oldDate = $row['paymentDate'];
$newDate = date('d/m/Y', strtotime($oldDate));
$pdf->MultiCell(30, 5, $newDate, 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(50, 5, $row['daterange'], 0, 'C', 1, 0, '', '', true);

// Pay date
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(30, 5, '', 0, 'C', 1, 0, '', '', true);

// Next line
$pdf->Ln();

$pdf->SetFont('Helvetica', '', 10, '', true);
$pdf->MultiCell(70, 5, $row['ic']);
$pdf->SetFont('Helvetica', '', 10, '', true);
$pdf->MultiCell(40, 5, $row['jobTitle'], 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(60, 5, '', 0, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(123, 172, 212);
$pdf->SetTextColor(0, 0, 0, 0);
$pdf->SetFont('Helvetica', 'B', 11, '', true);
$pdf->MultiCell(80, 5, 'Bank Information', 0, 'C', 1, 0, '', '', true);
$pdf->Ln();

// Bank information
$pdf->SetFillColor(0, 0, 0, 0);
$pdf->SetTextColor(0, 0, 0, 0);
$pdf->MultiCell(40, 5, '', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(60, 5, '', 0, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(0, 0, 0, 0);
$pdf->SetTextColor(0, 0, 0, 100);
$pdf->SetFont('Helvetica', '', 10, '', true);
$pdf->MultiCell(80, 5, $row['accBank'] . ' - ' . $row['accNum'], 0, 'C', 1, 0, '', '', true);
$pdf->Ln();

// Next line
$pdf->Ln();
$pdf->Ln();

// Display the salary
$pdf->SetFillColor(123, 172, 212);
$pdf->SetTextColor(0, 0, 0, 0);
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(90, 10, 'Earnings', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->MultiCell(90, 10, 'Deductions', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Ln();
$pdf->SetFillColor(0, 0, 0, 0);
$pdf->SetTextColor(0, 0, 0, 100);
$pdf->SetFont('Helvetica', '', 10, '', true);
$pdf->MultiCell(35, 10, 'Basic Salary', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(55, 10, 'RM' . number_format($row['basicSalary'], 2, '.', ','), 0, 'R', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFont('Helvetica', '', 10, '', true);
$pdf->MultiCell(35, 10, 'EPF', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(55, 10, 'RM' . number_format($row['epf'], 2, '.', ','), 0, 'R', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Ln();
$pdf->SetFont('Helvetica', '', 10, '', true);
$pdf->MultiCell(35, 10, 'Allowance', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(55, 10, 'RM' . number_format($row['salesComm'], 2, '.', ','), 0, 'R', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFont('Helvetica', '', 10, '', true);
$pdf->MultiCell(35, 10, 'SOCSO', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(55, 10, 'RM' . number_format($row['socso'], 2, '.', ','), 0, 'R', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Ln();
$pdf->MultiCell(35, 10, '', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->MultiCell(55, 10, '', 0, 'C', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFont('Helvetica', '', 10, '', true);
$pdf->MultiCell(35, 10, 'SOCSO 2', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(55, 10, 'RM' . number_format($row['socso2'], 2, '.', ','), 0, 'R', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Ln();
$pdf->SetFillColor(0, 0, 0, 11);
$pdf->SetTextColor(0, 0, 0, 100);
$pdf->SetFont('Helvetica', '', 10, '', true);
$pdf->MultiCell(35, 10, 'Total Earnings', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(55, 10, 'RM' . number_format(($row['basicSalary'] + $row['salesComm']), 2, '.', ','), 0, 'R', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFillColor(0, 0, 0, 13);
$pdf->SetTextColor(0, 0, 0, 100);
$pdf->SetFont('Helvetica', '', 10, '', true);
$pdf->MultiCell(35, 10, 'Total Deduction', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(55, 10, 'RM' . number_format(($row['epf'] + $row['socso'] + $row['socso2']), 2, '.', ','), 0, 'R', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Ln();
$pdf->SetFillColor(0, 0, 0, 0);
$pdf->SetTextColor(0, 0, 0, 0);
$pdf->MultiCell(35, 10, '', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->MultiCell(55, 10, '', 0, 'C', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFillColor(0, 0, 0, 31);
$pdf->SetTextColor(0, 0, 0, 0);
$pdf->SetFont('Helvetica', '', 10, '', true);
$pdf->MultiCell(35, 10, 'Net Pay', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFillColor(0, 0, 0, 31);
$pdf->SetTextColor(0, 0, 0, 0);
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(55, 10, 'RM' . number_format($row['totalEarn'], 2, '.', ','), 0, 'R', 1, 0, '', '', true, 0, false, true, 10, 'M');

$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(123, 172, 212);
$pdf->SetTextColor(0, 0, 0, 0);
$pdf->MultiCell(90, 10, 'Company Contribution', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Ln();
$pdf->SetFillColor(0, 0, 0, 0);
$pdf->SetTextColor(0, 0, 0, 100);
$pdf->SetFont('Helvetica', '', 10, '', true);
$pdf->MultiCell(35, 10, 'EPF', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(55, 10, 'RM' . number_format($row['epfEmp'], 2, '.', ','), 0, 'R', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Ln();
$pdf->SetFont('Helvetica', '', 10, '', true);
$pdf->MultiCell(35, 10, 'SOCSO', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(55, 10, 'RM' . number_format($row['socsoEMP'], 2, '.', ','), 0, 'R', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Ln();
$pdf->SetFont('Helvetica', '', 10, '', true);
$pdf->MultiCell(35, 10, 'SOCSO 2', 0, 'L', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->SetFont('Helvetica', 'B', 10, '', true);
$pdf->MultiCell(55, 10, 'RM' . number_format($row['socso2EMP'], 2, '.', ','), 0, 'R', 1, 0, '', '', true, 0, false, true, 10, 'M');

// Break
$pdf->Ln();
$pdf->Ln();

$pdf->SetFillColor(1, 0, 6, 25);
$pdf->SetTextColor(0, 0, 0, 100);
$pdf->MultiCell(90, 10, 'Prepared by', 0, 'C', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->MultiCell(90, 10, 'Approved by', 0, 'C', 1, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Ln();
$pdf->SetFillColor(0, 0, 0, 0);
$pdf->SetTextColor(0, 0, 0, 100);
$pdf->MultiCell(90, 20, 'Arzu Home & Living Empire', 0, 'C', 1, 0, '', '', true, 0, false, true, 20, 'M');
$pdf->MultiCell(90, 40, '', 0, 'C', 1, 0, '', '', true, 0, false, true, 40, 'M');


// Line break
$pdf->Ln();


// Result
$pdf->Output($row['employeeName'] . '.pdf');
