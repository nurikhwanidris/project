<?php

// DB Conn
include($_SERVER['DOCUMENT_ROOT'] . '/project/src/model/dbconn.php');

$id = $_GET['id'];

// Get the order data first
$sqlOrder = "SELECT * FROM homedecor_order2 WHERE id = '$id'";
$resOrder = mysqli_query($conn, $sqlOrder);
$rowOrder = mysqli_fetch_assoc($resOrder);

// Get ordered items data second
$items = "SELECT
homedecor_order2.id,
homedecor_order_item.orderId,
homedecor_order_item.productId,
homedecor_order_item.itemId,
homedecor_order_item.productPrice,
homedecor_order_item.productDiscount,
homedecor_order_item.discount,
homedecor_order_item.quantity,
homedecor_item2.itemAvailable,
homedecor_product2.id,
homedecor_product2.name,
homedecor_product2.supplier,
homedecor_product2.itemId,
homedecor_product2.itemCode
FROM homedecor_order_item
JOIN homedecor_product2
ON homedecor_order_item.productId = homedecor_product2.id
JOIN homedecor_item2
ON homedecor_order_item.productId = homedecor_item2.productId
JOIN homedecor_order2
ON homedecor_order2.id = '$id'
HAVING homedecor_order2.id = homedecor_order_item.orderId";
$resultItems = mysqli_query($conn, $items);

// Get the invoice data
$sqlInvoice = "SELECT * FROM homedecor_invoice2 WHERE orderId ='$id'";
$resInvoice = mysqli_query($conn, $sqlInvoice);
$rowInvoice = mysqli_fetch_assoc($resInvoice);

// Get customer info
$customer = "SELECT * FROM homedecor_customer where id = '" . $rowOrder['customerId'] . "'";
$resultCustomer = mysqli_query($conn, $customer);
$rowCustomer = mysqli_fetch_array($resultCustomer);

// Get receipt info if exist
$selectReceipt = "SELECT * FROM homedecor_receipt2 WHERE orderId = '$id'";
$resultReceipt = mysqli_query($conn, $selectReceipt);

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

// Create cells
$pdf->MultiCell(90, 10, 'Invoice For', 0, 'L', 0, 0);
$pdf->MultiCell(90, 5, 'INV-' . str_pad($id, 6, '0', STR_PAD_LEFT), 0, 'R', 0, 0);
$pdf->Ln();
$pdf->setFont('Helvetica', 'B', 8);
$pdf->Cell(180, 5, $rowInvoice['invoiceDate'], 0, false, 'R', 0, '', 0, false, 'T', 'M');
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
$pdf->Cell(83, 8, 'Description', 1, false, 'L', 0, '', 0, false, 'T', 'M');
$pdf->Cell(25, 8, 'Product ID', 1, false, 'L', 0, '', 0, false, 'T', 'M');
$pdf->Cell(20, 8, 'Price/Unit', 1, false, 'R', 0, '', 0, false, 'T', 'M');
$pdf->Cell(16, 8, 'Quantity', 1, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Cell(16, 8, 'Discount', 1, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Cell(20, 8, 'Amount', 1, false, 'R', 0, '', 0, false, 'T', 'M');
$pdf->Ln();

$pdf->setFont('Helvetica', '', 9);
while ($rowOrderItem = mysqli_fetch_assoc($resultItems)) :
    // $pdf->MultiCell(90, 10, $rowOrderItem['name'], 1, 'L', 0, 0, '', '', true, 0, false, true, 10, 'M');
    if ($rowOrderItem['itemAvailable'] <= 0) :
        $pdf->Cell(83, 6, $rowOrderItem['name'] . ' [Pre-order]', 1, false, 'L', 0, '', 0, false, 'T', 'M');
    else :
        $pdf->Cell(83, 6, $rowOrderItem['name'], 1, false, 'L', 0, '', 0, false, 'T', 'M');
    endif;
    $pdf->Cell(25, 6, $rowOrderItem['supplier'] . '-' . str_pad($rowOrderItem['itemCode'], 4, 0, STR_PAD_LEFT) . '-' . $rowOrderItem['itemId'], 1, false, 'L', 0, '', 0, false, 'T', 'M');
    $pdf->Cell(20, 6, 'RM ' . number_format($rowOrderItem['productPrice'], 2, '.', ','), 1, false, 'R', 0, '', 0, false, 'T', 'M');
    $pdf->Cell(16, 6, $rowOrderItem['quantity'], 1, false, 'C', 0, '', 0, false, 'T', 'M');
    $pdf->Cell(16, 6, $rowOrderItem['discount'] . '%', 1, false, 'C', 0, '', 0, false, 'T', 'M');
    $pdf->Cell(20, 6, 'RM ' . number_format($rowOrderItem['productDiscount'], 2, '.', ','), 1, false, 'R', 0, '', 0, false, 'T', 'M');
    $pdf->Ln();
endwhile;
$pdf->Cell(155, 6, 'Subtotal :', 0, false, 'R', 0, '', 0, false, 'T', 'M');
$pdf->Cell(25, 6, 'RM ' . number_format($rowOrder['itemDiscount'], 2, '.', ','), 0, false, 'R', 0, '', 0, false, 'T', 'M');
$pdf->Ln();

$pdf->Cell(155, 6, 'Shipping :', 0, false, 'R', 0, '', 0, false, 'T', 'M');
$pdf->Cell(25, 6, 'RM ' . number_format($rowOrder['shipping'], 2, '.', ','), 0, false, 'R', 0, '', 0, false, 'T', 'M');
$pdf->Ln();

$pdf->Cell(155, 6, 'Total :', 0, false, 'R', 0, '', 0, false, 'T', 'M');
$pdf->Cell(25, 6, 'RM ' . number_format($rowOrder['total'], 2, '.', ','), 0, false, 'R', 0, '', 0, false, 'T', 'M');
$pdf->Ln();

// Check for voucher
if ($rowOrder['voucher'] != 0) {
    $pdf->Cell(155, 6, 'Voucher :', 0, false, 'R', 0, '', 0, false, 'T', 'M');
    $pdf->Cell(25, 6, '- RM ' . number_format($rowOrder['voucher'], 2, '.', ','), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    $pdf->Ln();

    $pdf->setFont('Helvetica', 'B', 12);
    $pdf->Cell(155, 8, 'Grand Total :', 0, false, 'R', 0, '', 0, false, 'T', 'T');
    $pdf->Cell(25, 8, 'RM ' . number_format($rowOrder['grandTotal'], 2, '.', ','), 0, false, 'R', 0, '', 0, false, 'T', 'T');
    $pdf->Ln();
} else {
    $pdf->setFont('Helvetica', 'B', 12);
    $pdf->Cell(155, 8, 'Grand Total :', 0, false, 'R', 0, '', 0, false, 'T', 'T');
    $pdf->setFont('Helvetica', 'B', 12);
    $pdf->Cell(25, 8, 'RM ' . number_format($rowOrder['grandTotal'], 2, '.', ','), 0, false, 'R', 0, '', 0, false, 'T', 'T');
    $pdf->Ln();
}

$pdf->Ln();
$pdf->Ln();

// Receipt
$pdf->setFont('Helvetica', '', 8);
$pdf->Cell(64, 3, 'Receipt(s)', 0, false, 'L', 0, '', 0, false, 'T', 'M');
$pdf->Ln();
$pdf->setFont('Helvetica', 'B', 8);
$pdf->Cell(14, 5, 'No.', 1, false, 'L', 0, '', 0, false, 'T', 'M');
$pdf->Cell(30, 5, 'Date', 1, false, 'L', 0, '', 0, false, 'T', 'M');
$pdf->Cell(20, 5, 'Amount', 1, false, 'L', 0, '', 0, false, 'T', 'M');
$pdf->Ln();
$pdf->setFont('Helvetica', '', 8);
while ($rowReceipt = mysqli_fetch_array($resultReceipt)) :
    // No receipt
    $pdf->Cell(14, 5, str_pad($rowReceipt['id'], 4, 0, STR_PAD_LEFT), 1, false, 'L', 0, '', 0, false, 'T', 'M');

    // Date
    $s = $rowReceipt['invoiceDate'];
    $dt = new DateTime($s);
    $pdf->Cell(30, 5, $date = $dt->format('d/m/Y'), 1, false, 'L', 0, '', 0, false, 'T', 'M');

    // Amount
    $pdf->Cell(20, 5, 'RM' . number_format($rowReceipt['amountPaid'], 2, '.', ''), 1, false, 'L', 0, '', 0, false, 'T', 'M');
    $pdf->Ln();
endwhile;
$pdf->Ln();
$pdf->Ln();

// Pay to?
$pdf->setFont('Helvetica', '', 10);
$pdf->Cell(40, 5, 'Pay to');
$pdf->Ln();
$pdf->setFont('Helvetica', 'B', 10);
$pdf->Cell(100, 5, 'Arzu Home Living Empire');
$pdf->Ln();
$pdf->setFont('Helvetica', 'B', 10);
$pdf->Cell(100, 5, 'Maybank - 5622 0966 6454');
$pdf->Ln();
$pdf->Ln();

// Terms
$pdf->setFont('Helvetica', '', 10);
$pdf->Cell(100, 5, 'Terms and Conditions');
$pdf->Ln();
$pdf->Cell(100, 5, '1. Price will be rounded up to the nearest ringgit.');
$pdf->Ln();
$pdf->Cell(100, 5, '2. Please include the payment slips after the payment was made.');
$pdf->Ln();
$pdf->Cell(100, 5, '3. Balance payment must be made within 2 days after the invoice billed to you.');
$pdf->Ln();

// Result
$pdf->Output('INV-' . str_pad($id, 6, '0', STR_PAD_LEFT) . '.pdf');
