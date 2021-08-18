<?php

// DB Conn
include($_SERVER['DOCUMENT_ROOT'] . '/project/src/model/dbconn.php');

// Include the main TCPDF library (search for installation path).
require_once($_SERVER['DOCUMENT_ROOT'] . '/project/assets/vendor/pdf/tcpdf.php');

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
// set JPEG quality
$pdf->setJPEGQuality(75);

// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// // Example of Image from data stream ('PHP rules')
// $imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');

// // The '@' character is used to indicate that follows an image data stream and not an image file name
// $pdf->Image('@' . $imgdata);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Image example with resizing
$pdf->Image('/project/upload/img/product/2021/10-20210805.JPG', 15, 140, 75, 113, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// test fitbox with all alignment combinations

$horizontal_alignments = array('L', 'C', 'R');
$vertical_alignments = array('T', 'M', 'B');

$x = 15;
$y = 35;
$w = 30;
$h = 30;
// test all combinations of alignments
for ($i = 0; $i < 3; ++$i) {
    $fitbox = $horizontal_alignments[$i] . ' ';
    $x = 15;
    for ($j = 0; $j < 3; ++$j) {
        $fitbox[1] = $vertical_alignments[$j];
        $pdf->Rect($x, $y, $w, $h, 'F', array(), array(128, 255, 128));
        $pdf->Image('/project/upload/img/product/2021/10-20210805.JPG', $x, $y, $w, $h, 'JPG', '', '', false, 300, '', false, false, 0, $fitbox, false, false);
        $x += 32; // new column
    }
    $y += 32; // new row
}

$x = 115;
$y = 35;
$w = 25;
$h = 50;
for ($i = 0; $i < 3; ++$i) {
    $fitbox = $horizontal_alignments[$i] . ' ';
    $x = 115;
    for ($j = 0; $j < 3; ++$j) {
        $fitbox[1] = $vertical_alignments[$j];
        $pdf->Rect($x, $y, $w, $h, 'F', array(), array(128, 255, 255));
        $pdf->Image('/project/upload/img/product/2021/10-20210805.JPG', $x, $y, $w, $h, 'JPG', '', '', false, 300, '', false, false, 0, $fitbox, false, false);
        $x += 27; // new column
    }
    $y += 52; // new row
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Stretching, position and alignment example

$pdf->SetXY(110, 200);
$pdf->Image('/project/upload/img/product/2021/10-20210805.JPG', '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
$pdf->Image('/project/upload/img/product/2021/10-20210805.JPG', '', '', 40, 40, '', '', '', false, 300, '', false, false, 1, false, false, false);

// -------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_009.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+