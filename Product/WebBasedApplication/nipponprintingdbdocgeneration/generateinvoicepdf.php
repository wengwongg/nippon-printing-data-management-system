<?php
    // Include the main TCPDF library (search for installation path).
require 'config.php'; 
require_once('TCPDF-main/tcpdf.php');

if (isset($_GET['pdf_invoice_generate'])) {
    $Invoice_ID = $_GET['Invoice_ID'];

    $select = "SELECT * FROM db_nippon_printing.complete_invoice WHERE
    db_nippon_printing.complete_invoice.Invoice_ID = '$Invoice_ID'";

    $query = mysqli_query($mysqli, $select);

    while ($row = mysqli_fetch_array($query)) {
        $Invoice_ID = $row['Invoice_ID']; // DONE
        $DO_ID = $row['DO_ID']; // DONE
        $Delivery_Address = $row['Delivery_Address']; // DONE
        $Invoice_Creation_Date = $row['Invoice_Creation_Date']; // DONE
        $Term_Days = $row['Term_Days']; // DONE
        $Salesman_Name = $row['Salesman_Name']; // DONE
        $Tariff_Code = $row['Tariff_Code']; // DONE
        $Client_Name = $row['Client_Name']; // DONE
        $Office_Address = $row['Office_Address']; // DONE
        $Office_Number = $row['Office_Number']; // DONE
        $Email_Address = $row['Email_Address']; // DONE
        $Item_One_Name = $row['Item_One_Name']; // DONE
        $Item_One_Units = $row['Item_One_Units']; // DONE
        $Item_One_Unit_Cost = $row['Item_One_Unit_Cost']; // DONE
        $Item_One_Total_Cost = $row['Item_One_Total_Cost']; // DONE
        $Item_Two_Name = $row['Item_Two_Name']; // DONE
        $Item_Two_Units = $row['Item_Two_Units']; // DONE
        $Item_Two_Unit_Cost = $row['Item_Two_Unit_Cost']; // DONE
        $Item_Two_Total_Cost = $row['Item_Two_Total_Cost']; // DONE
        $Item_Three_Name = $row['Item_Three_Name']; // DONE
        $Item_Three_Units = $row['Item_Three_Units']; // DONE
        $Item_Three_Unit_Cost = $row['Item_Three_Unit_Cost']; // DONE
        $Item_Three_Total_Cost = $row['Item_Three_Total_Cost']; // DONE
        $Sales_Tax_Amount = $row['Sales_Tax_Amount']; // DONE
        $Total_Price = $row['Total_Price']; // DONE

        // may not use everything here.
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
        $this->Cell(189, 3, 'Invoice', 0, 1, 'C');
    }

    public function Footer() {
        $this->SetY(-97);
        $this->Ln(5);
        $this->SetFont('Times', 'B', 10);
        $this->Cell(189, 3, 'Reminder', 0, 1, 'L');
        $this->SetFont('Times', '', 10);
        $html = '<p style="text-align: justify">All cheques should be crossed and made payable to <b>"NIPPON PRINTING"</b></p>
        <p>All claims must be made in writing within 7 days from date hereof. A receipt must be obtained after payment.</p>
        <p>Interest at a rate of 18% per annum will be charged on overdue invoices.</p>';
        $this->writeHTML($html, true, false, true, false, '');

        $this->Ln(8);
        $this->SetFont('Times', '', 10);
        $this->Cell(189, 3, 'If you need further information, please do not hesitate to contact the following numbers:', 0, 1, 'L');
        $this->SetFont('Times', 'B', 10);
        $this->Cell(189, 3, '012-473 1188 / 012-487 8826', 0, 1, 'L');
        $this->Ln(8);
        $this->SetFont('Times', '', 10);

        $this->Cell(189, 3, 'Nippon Printing', 0, 1);

        $this->Ln(8);

        $this->Cell(189, 3, '_________________________', 0, 1);

        $this->Ln(2);

        $this->Cell(189, 3, 'Authorised Signature', 0, 1);


    }
}

// create new PDF document
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Weng Wong (George) Hum');
$Invoice_ID = $_GET['Invoice_ID'];
$pdf->SetTitle('Invoice: '.$Invoice_ID);
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
$pdf->Cell(153, 5, 'Invoice ID : '.$Invoice_ID.'',0,0);
$pdf->Cell(36, 5, 'Date : '.$Invoice_Creation_Date.'',0, 1);

$pdf->Ln(6);

$pdf->SetFont('Times', 'U, B', 11);
$pdf->Cell(189, 5, 'SOLD TO', 0, 1);
$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(189, 5, $Client_Name, 0, 1);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(189, 5, $Office_Address, 0, 1);
$pdf->Cell(189, 5, 'TEL: '.$Office_Number.' / EMAIL: '.$Email_Address, 0, 1);

$pdf->Ln(6);

$pdf->SetFont('Times', 'U, B', 11);
$pdf->Cell(189, 5, 'DELIVERY ADDRESS', 0, 1);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(189, 5, $Delivery_Address, 0, 1);

$pdf->Ln(5);

$pdf->SetFont('Times', 'B', 11);
$pdf->SetFillColor(220, 220, 220);

$pdf->Cell(45, 7, 'D/O NO', 1, 0, 'C', 1);
$pdf->Cell(45, 7, 'Term Days', 1, 0, 'C', 1);
$pdf->Cell(45, 7, 'Salesman', 1, 0, 'C', 1);
$pdf->Cell(45, 7, 'Tariff Code', 1, 1, 'C', 1);
$pdf->SetFont('Times', '', 11);

$pdf->Cell(45, 7, $DO_ID, 1, 0, 'C', 0);
$pdf->Cell(45, 7, $Term_Days, 1, 0, 'C', 0);
$pdf->Cell(45, 7, $Salesman_Name, 1, 0, 'C', 0);
$pdf->Cell(45, 7, $Tariff_Code, 1, 1, 'C', 0);

$pdf->Ln(14);

$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(15, 7, 'Item', 1, 0, 'C', 1);
$pdf->Cell(81, 7, 'Description', 1, 0, 'C', 1);
$pdf->Cell(28, 7, 'Quantity', 1, 0, 'C', 1);
$pdf->Cell(28, 7, 'Unit Price', 1, 0, 'C', 1);
$pdf->Cell(28, 7, 'Amount', 1, 1, 'C', 1);
$pdf->SetFont('Times', '', 11);

$pdf->Cell(15, 9, '1', 1, 0, 'C', 0);
$pdf->Cell(81, 9, $Item_One_Name, 1, 0, 'C', 0);
$pdf->Cell(28, 9, $Item_One_Units.' PCS', 1, 0, 'C', 0);
$pdf->Cell(28, 9, 'RM '.$Item_One_Unit_Cost, 1, 0, 'C', 0);
$pdf->Cell(28, 9, 'RM '.$Item_One_Total_Cost, 1, 1, 'C', 0);

$pdf->Cell(15, 9, '2', 1, 0, 'C', 0);
$pdf->Cell(81, 9, $Item_Two_Name, 1, 0, 'C', 0);
$pdf->Cell(28, 9, $Item_Two_Units.' PCS', 1, 0, 'C', 0);
$pdf->Cell(28, 9, 'RM '.$Item_Two_Unit_Cost, 1, 0, 'C', 0);
$pdf->Cell(28, 9, 'RM '.$Item_Two_Total_Cost, 1, 1, 'C', 0);

$pdf->Cell(15, 9, '3', 1, 0, 'C', 0);
$pdf->Cell(81, 9, $Item_Three_Name, 1, 0, 'C', 0);
$pdf->Cell(28, 9, $Item_Three_Units.' PCS', 1, 0, 'C', 0);
$pdf->Cell(28, 9, 'RM '.$Item_Three_Unit_Cost, 1, 0, 'C', 0);
$pdf->Cell(28, 9, 'RM '.$Item_Three_Total_Cost, 1, 1, 'C', 0);

$pdf->Cell(15, 9, '', 0, 0, 'C', 0);
$pdf->Cell(81, 9, '', 0, 0, 'C', 0);
$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(56, 9, 'ADD SALES TAX 10%', 1, 0, 'C', 1);
$pdf->SetFont('Times', '', 11);
$pdf->Cell(28, 9, 'RM '.$Sales_Tax_Amount, 1, 1, 'C', 0);

$pdf->Cell(15, 9, '', 0, 0, 'C', 0);
$pdf->Cell(81, 9, '', 0, 0, 'C', 0);
$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(56, 9, 'TOTAL (INC. SALES TAX)', 1, 0, 'C', 1);
$pdf->SetFont('Times', '', 11);
$pdf->Cell(28, 9, 'RM '.$Total_Price, 1, 1, 'C', 0);

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

?>

