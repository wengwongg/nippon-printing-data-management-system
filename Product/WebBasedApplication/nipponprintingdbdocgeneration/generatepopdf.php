<?php
    // Include the main TCPDF library (search for installation path).
require 'config.php';
require_once('TCPDF-main/tcpdf.php');

if (isset($_GET['pdf_po_generate'])) {
    $PO_ID = $_GET['PO_ID'];

    $select = "SELECT * FROM db_nippon_printing.complete_purchase_order WHERE
    db_nippon_printing.complete_purchase_order.PO_ID = '$PO_ID'";

    $query = mysqli_query($mysqli, $select);

    while ($row = mysqli_fetch_array($query)) {
        $PO_ID = $row['PO_ID']; // DONE
        $PO_Creation_Date = $row['PO_Creation_Date']; // DONE
        $Delivery_Address = $row['Delivery_Address']; // DONE
        $Description = $row['Description']; // DONE
        $Quantity = $row['Quantity']; // DONE
        $Unit_Price = $row['Unit_Price']; // DONE
        $Total_Price = $row['Total_Price']; // DONE
        $Supplier_Name = $row['Supplier_Name']; // DONE
        $Office_Address = $row['Office_Address']; // DONE
        $Office_Number = $row['Office_Number']; // DONE
        $Manager_Name = $row['Manager_Name']; // DONE
        $Manager_Number = $row['Manager_Number']; // DONE
    }
}

class PDF extends TCPDF
{
    public function Header() {
        $this->SetFont('Times', 'B', 15);
        $this->Ln(8);
        $this->Cell(189, 3, 'Nippon Printing Sdn. Bhd.', 0, 1, 'C');
        $this->SetFont('Times', '', 10);
        $this->Cell(189, 3, 'No. 22, Jalan Loh Boon Siew', 0, 1, 'C');
        $this->Cell(189, 3, '10400, Pulau Pinang, Malaysia', 0, 1, 'C');
        $this->Cell(189, 3, 'TEL: 04-2281849, FAX: 04-2281323', 0, 1, 'C');
        $this->Cell(189, 3, 'EMAIL: goh88888@gmail.com', 0, 1, 'C');
        
        $this->Ln(7);
        $this->SetFont('Times', 'B', '12');
        $this->Cell(189, 3, 'Purchase Order', 0, 1, 'C');
    }

    public function Footer() {
        $this->SetY(-105);
        $this->Ln(5);
        $this->SetFont('Times', 'B', 10);
        
        $this->Cell(189, 3, 'Nippon Printing (Authorised Signature)', 0, 1, 'L');
        $this->Ln(13);
        $this->Cell(189, 3, '__________________________________', 0, 1, 'L');

        $this->Ln(7);
        $this->Cell(189, 3, 'Please kindly accept the above by', 0, 1, 'L');
        $this->Cell(189, 3, 'chopping, signing and returning the fax to us ASAP', 0, 1, 'L');
        $this->Ln(5);
        $this->Cell(189, 3, 'Name: ', 0, 1, 'L');
        $this->Ln(13);
        $this->Cell(189, 3, 'Date: ', 0, 1, 'L');
        $this->Ln(13);
        $this->Cell(189, 3, 'Chop & Sign: ', 0, 1, 'L');
    }
}

// create new PDF document
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Weng Wong (George) Hum');
$PO_ID = $_GET['PO_ID'];
$pdf->SetTitle('Purchase Order: '.$PO_ID);
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

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
 
$pdf->Ln(30);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(153, 5, 'Purchase Order ID : '.$PO_ID.'',0,0);
$pdf->Cell(36, 5, 'Date : '.$PO_Creation_Date.'',0, 1);

$pdf->Ln(10);

$pdf->Cell(189, 5, $Supplier_Name, 0, 1);

$pdf->SetFont('Times', '', 10);
$pdf->Cell(189, 5, $Office_Address, 0, 1);
$pdf->Cell(189, 5, $Office_Number, 0, 1);

$pdf->Cell(189, 5, $Manager_Name.' / '.$Manager_Number, 0, 1);

$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 10);

$pdf->Cell(29, 5, 'Delivery Address: ', 0, 0);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(151, 5, $Delivery_Address, 0, 1);

$pdf->Ln(10);

$pdf->SetFont('Times', 'B', 11);
$pdf->SetFillColor(220, 220, 220);

$pdf->Multicell(90, 7, 'Description', 1, 'C', true, 0);
$pdf->Multicell(30, 7, 'Quantity', 1, 'C', true, 0);
$pdf->Multicell(30, 7, 'Unit Price', 1, 'C', true, 0);
$pdf->Multicell(30, 7, 'Amount', 1, 'C', true, 1);
$pdf->SetFont('Times', '', 11);

$pdf->Multicell(90, 60, $Description, 1, 'C', false, 0);
$pdf->Multicell(30, 60, $Quantity, 1, 'C', false, 0);
$pdf->Multicell(30, 60, 'RM '.$Unit_Price, 1, 'C', false, 0);
$pdf->Multicell(30, 60, 'RM '.$Total_Price, 1, 'C', false, 1);

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

?>

