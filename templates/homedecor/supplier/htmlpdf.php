<?php

// DB Conn
include($_SERVER['DOCUMENT_ROOT'] . '/project/src/model/dbconn.php');

$id = $_GET['id'];

$title = str_pad($id, 4, 0, STR_PAD_LEFT);


// Include the main TCPDF library (search for installation path).
require_once($_SERVER['DOCUMENT_ROOT'] . '/project/assets/vendor/pdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

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
$pdf->SetFont('Times', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// Get the data first
$id = $_GET['id'];
$sqlOrder = "SELECT * FROM homedecor_supplier_order WHERE id = '$id'";
$resOrder = mysqli_query($conn, $sqlOrder);
$rowOrder = mysqli_fetch_assoc($resOrder);

// Make everything explodeeeeeeeeee
$productID = explode(',', $rowOrder['productID']);
$productQty = explode(',', $rowOrder['productQty']);
$productCost = explode(',', $rowOrder['productCost']);
$productPrice = explode(',', $rowOrder['productPrice']);
$productStatus = explode(',', $rowOrder['status']);
$staffName = explode(',', $rowOrder['staffName']);

$pdf->Cell(180, 10, 'Purchase Order');
$pdf->Ln();

$pdf->setFont('Times', '', 11);
$pdf->Cell(12, 6, 'No', 1);
$pdf->Cell(36, 6, 'Picture', 1);
$pdf->Cell(80, 6, 'Description', 1);
$pdf->Cell(20, 6, 'Unit Price', 1);
$pdf->Cell(12, 6, 'Qty', 1);
$pdf->Cell(20, 6, 'Amount', 1);
$pdf->Ln();

$imgPath = $_SERVER['DOCUMENT_ROOT'] . '/project/upload/img/product/';

$x = 1;
// Html
$html = '
<table class="table table-bordered" id="table">
    <thead>
        <tr>
            th class="align-middle text-center">No</th>
            <th class="align-middle text-center">Picture</th>
            <th class="align-middle" style="width: 40%;">Description</th>
            <th class="align-middle text-right" style="width: 15%;">Unit Price <span class="d-none">THB</span></th>
            <th class="align-middle text-center">Qty</th>
            <th class="align-middle text-right" style="width: 10%;">Amount <span class="d-none">THB</span></th>
            <th class="align-middle text-center d-print-none">Code</th>
        </tr>
    </thead>
    <tbody>';

for ($i = 0; $i < count($productID); $i++) :
    $product = $productID[$i];
    $quantity = $productQty[$i];
    $price = $productPrice[$i];
    $cost = $productCost[$i];
    $selProduct = "SELECT * FROM homedecor_product WHERE id = '$product'";
    $resProduct = mysqli_query($conn, $selProduct);
    $rowProduct = mysqli_fetch_array($resProduct);

    $discount = $rowOrder['discount'];
    $total = array_sum($productPrice);
    $discLvl = $discount / 100;
    $totalAmount = number_format(
        $total - ($total * $discLvl),
        2,
        '.',
        ','
    );

    // Try writeHTMLcell method
    $html .= '
    <tr>
        <td class="align-middle text-center">
            ' . $x++ . '
        </td>
        <td class="align-middle text-center">
            <img src="/project/upload/img/product/' . $rowProduct['img'] . '" alt="" srcset="" class="rounded"
                style="width:124px; height:124px;">
        </td>
        <td class="align-middle">
            ' . $rowProduct['name'] . '
        </td>
        <td class="align-middle text-right">
            ' . number_format($cost, 2, '.', ',') . '
        </td>
        <td class="align-middle text-center">
            $quantity
        </td>
        <td class="align-middle text-right">
            ' . number_format($price, 2, '.', ',') . '
        </td>
        <td class="align-middle text-center d-print-none">
            ' . $rowProduct['orderNo'] . '
        </td>
    </tr>
    <tr>
        <td class="text-right align-middle" colspan="6">
            Total
        </td>
        <td class="text-center align-middle">
            THB ' . $amount = number_format(array_sum($productPrice), 2, '.', ',') .
        '
        </td>
    </tr>
    <tr>
        <td class="text-right align-middle" colspan="6">
            Discount
        </td>
        <td class="text-center align-middle">
            ' . $discount . '
        </td>
    </tr>
    <tr class="font-weight-bold">
        <td class="text-right align-middle" colspan="6">
            <h5 class="font-weight-bold ">
                Grand Total
            </h5>
        </td>
        <td style="background-color: yellow;" class="text-center align-middle">
            <h5 class="font-weight-bold doubleUnderline">THB ' . $totalAmount . '
            </h5>
        </td>
    </tr>
    </tbody>
    </table>
    ';
endfor;

$pdf->writeHTMLCell(80, 0, 0, 0, $html,);

// Result
$pdf->Output('PO-' . $title . '.pdf');
