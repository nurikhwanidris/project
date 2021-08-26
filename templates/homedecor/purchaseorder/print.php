<?php

// DB Conn
include($_SERVER['DOCUMENT_ROOT'] . '/project/src/model/dbconn.php');

// Include the main TCPDF library (search for installation path).
require_once($_SERVER['DOCUMENT_ROOT'] . '/project/assets/vendor/pdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Business name
define('BUSINESS', 'Arzu Home & Living Empire');

// Business address
define('ADDRESS', "No. 243B, Tingkat 2, Jalan Bandar 13, \n53100 Taman Melawati, Kuala Lumpur");

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, BUSINESS, ADDRESS);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// Get the po details
$purchaseOrder = "SELECT * FROM homedecor_po WHERE id = '" . $_GET['id'] . "'";
$resultPO = mysqli_query($conn, $purchaseOrder);
$rowPO = mysqli_fetch_assoc($resultPO);

$poItems = "SELECT * FROM homedecor_po_items WHERE poId = '" . $_GET['id'] . "'";
$resultPOItems = mysqli_query($conn, $poItems);

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
$pdf->SetFont('dejavusans', '', 10, '', true);

// Add a page
$pdf->AddPage();

$pdf->MultiCell(80, 5, 'Batch Number : ' . $rowPO['batch'], 0, 'L', 0, 0);
$pdf->MultiCell(80, 5, 'Created : ' . $rowPO['created'], 0, 'L', 0, 0);
$pdf->Ln();
$pdf->MultiCell(80, 5, 'Revision Number : ' . $rowPO['poRev'], 0, 'L', 0, 0);
$pdf->MultiCell(80, 5, 'Expected Delivery Date : ' . $rowPO['expectedDeliveryDate'], 0, 'L', 0, 0);
$pdf->Ln();
$pdf->MultiCell(80, 5, 'Supplier : ' . $rowPO['supplier'], 0, 'L', 0, 0);
$pdf->MultiCell(80, 5, 'Expected Arrival Date : ' . $rowPO['expectedArrivalDate'], 0, 'L', 0, 0);
$pdf->Ln();
// $html = '<h4>Purchase Order Number : ' . $rowPO['id'] . '</h4>
// <h4>Supplier : ' . $rowPO['supplier'] . '</h4>
// <h4>Batch Number : ' . $rowPO['batch'] . '</h4>
// <h4>Date Created : ' . $rowPO['created'] . '</h4>
// <h4>Expected Delivery Date : ' . $rowPO['expectedDeliveryDate'] . '</h4>
// <h4>Expected Arrival Date : ' . $rowPO['expectedArrivalDate'] . '</h4>';

// Html table starts
$html = '<table cellspacing="0" cellpadding="1" border="1" style="border-color:gray;">
    <tr style="background-color:green;color:white;">
        <th rowspan="2" style="text-align:center; vertical-align: middle;">Picture</th>
        <th rowspan="2" style="text-align:center; vertical-align: middle;">Item Code</th>
        <th rowspan="2" style="width: 250px;"> Product Desc</th>
        <th rowspan="2" style="width: 50px; text-align:center; vertical-align: middle;">Size</th>
        <th rowspan="2" style="text-align:center; vertical-align: middle;">Unit Price</th>
        <th rowspan="2" style="width: 50px; text-align:center; vertical-align: middle;">Qty.</th>
        <th rowspan="2" style="width: 70px; text-align:center; vertical-align: middle;">Amount</th>
        <th colspan="2" style="text-align:center; vertical-align: middle;">Available (Supplier)</th>
    </tr>
    <tr>
        <th style="text-align:center; vertical-align: middle;">Yes</th>
        <th style="text-align:center; vertical-align: middle;">No</th>
    </tr>';
while ($rowItems = mysqli_fetch_array($resultPOItems)) {
    $selectProduct2 = "SELECT * FROM homedecor_product2 WHERE id = '" . $rowItems['productId'] . "'";
    $resultProduct2 = mysqli_query($conn, $selectProduct2);
    $rowProduct2 = mysqli_fetch_assoc($resultProduct2);
    $html .=
        '<tr style="height: 200px;" nobr="true">
        <td height="50" style="text-align:center"><img src="' . $_SERVER['DOCUMENT_ROOT'] . '/project/upload/img/product/2021/' . $rowProduct2['img'] . '" alt="" srcset="" height="200px" width="200px"></td>
        <td height="50" style="text-align:center">' . $rowProduct2['supplier'] . '-' . str_pad($rowProduct2['itemCode'], 4, 0, STR_PAD_LEFT) . '-' . $rowProduct2['itemId'] . '</td>
        <td height="50" style="text-align:left"> ' . $rowProduct2['name'] . '</td>
        <td height="50" style="text-align:center">' . $rowProduct2['size'] . '</td>
        <td height="50" style="text-align:center; vertical-align: middle;">' . $rowItems['costTHB'] . '</td>
        <td height="50" style="text-align:center; vertical-align: middle;">' . $rowItems['quantity'] . '</td>
        <td height="50" style="text-align:center; vertical-align: middle;">' . $rowItems['amount'] . '</td>
        <td height="50"></td>
        <td height="50"></td>
    </tr>';
}
$html .= '<tr>
    <td colspan="8">Total Items Ordered</td>
    <td style="text-align: right;">' . $rowPO['totalQuantity'] . '</td>
</tr>';
$html .= '<tr>
    <td colspan="8">Discount</td>
    <td style="text-align: right;">' . number_format($rowPO['totalAmount'], 2, '.', ',') . '</td>
</tr>';
$html .= '<tr>
    <td colspan="8">Discount</td>
    <td style="text-align: right;">' . number_format(($rowPO['totalAmount']) * 0.22, 2, '.', ',') . '</td>
</tr>';
$discount = $rowPO['totalAmount'] * .22;
$afterDiscount = $rowPO['totalAmount'] - $discount;
$html .= '<tr>
    <td colspan="8">After Discount</td>
    <td style="text-align: right;">' . number_format($afterDiscount, 2, '.', ',') . '</td>
</tr>';
$html .= '</table>';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Signature
$sign = "
<table>
<tr>
<td></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td>Created by : </td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td>Approved by : </td>
</tr>
</table>
";

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $sign, 0, 1, 0, true, '', true);

// Print on last page
$pdf->lastPage();

// Result
$pdf->Output('PO-' . str_pad($_GET['id'], 6, '0', STR_PAD_LEFT) . '.pdf');
