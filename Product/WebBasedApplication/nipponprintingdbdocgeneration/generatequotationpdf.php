<?php
require 'config.php';
require_once('TCPDF-main/tcpdf.php');

if (isset($_GET['pdf_quotation_generate'])) {
    $Quotation_ID = $_GET['Quotation_ID'];

    $select = "SELECT * FROM db_nippon_printing.complete_quotation WHERE
    db_nippon_printing.complete_quotation.Quotation_ID = '$Quotation_ID'";

    $query = mysqli_query($mysqli, $select);

    while ($row = mysqli_fetch_array($query)) {
        $Quotation_ID = $row['Quotation_ID'];
        $Quotation_Creation_Date = $row['Quotation_Creation_Date'];
        $Lead_Time = $row['Lead_Time'];
        $Tolerance_Of_Quantity = $row['Tolerance_Of_Quantity'];
        $Terms_Of_Payment = $row['Terms_Of_Payment'];
        $Quotation_Validity_Period = $row['Quotation_Validity_Period'];
        $Client_Name = $row['Client_Name'];
        $Office_Address = $row['Office_Address'];
        $First_Manager_Name = $row['First_Manager_Name'];
        $First_Manager_Number = $row['First_Manager_Number'];
        $Second_Manager_Name = $row['Second_Manager_Name'];
        $Second_Manager_Number = $row['Second_Manager_Number'];
        $Product_Name = $row['Product_Name'];
        $CO1_Units = $row['CO1_Units'];
        $CO1_Unit_Cost = $row['CO1_Unit_Cost'];
        $CO2_Units = $row['CO2_Units'];
        $CO2_Unit_Cost = $row['CO2_Unit_Cost'];
        $CO3_Units = $row['CO3_Units'];
        $CO3_Unit_Cost = $row['CO3_Unit_Cost'];
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
        $this->Cell(189, 3, 'Quotation', 0, 1, 'C');
    }

    public function Footer() {
        $this->SetY(-97);
        $this->Ln(5);
        $this->SetFont('Times', 'B', 10);
        $this->Cell(189, 3, 'Declaration', 0, 1, 'L');
        $this->SetFont('Times', '', 10);
        $html = '<p style="text-align: justify">All the copyright of packaging artworks created by our company shall belong to our company. We do not normally provide original copies of our artwork to our customers. Furthermore, it is important to note that we do not allow our artwork or design to be used by other third parties and we reserve the right to file for infringement of copyright.</p>';
        $this->writeHTML($html, true, false, true, false, '');

        $this->Ln(8);
        $this->SetFont('Times', '', 10);
        $this->Cell(189, 3, 'If you need further information, please do not hesitate to contact the following numbers:', 0, 1, 'L');
        $this->SetFont('Times', 'B', 10);
        $this->Cell(189, 3, '012-473 1188 / 012-487 8826', 0, 1, 'L');
        $this->Ln(8);
        $this->SetFont('Times', '', 10);
        $this->Cell(189, 3, 'Looking forward to your valuable order.', 0, 1, 'L');
        $this->Ln(8);
        $this->Cell(189, 3, 'Yours faithfully,', 0, 1, 'L');

        $this->Cell(20, 3, 'Nippon Printing', 0, 0);
        $this->Cell(118, 3, '', 0, 0);
        $this->Cell(51, 3, 'Agreed and confirmed by:', 0, 1);

        $this->Ln(8);

        $this->Cell(20, 3, '_________________________', 0, 0);
        $this->Cell(118, 3, '', 0, 0);
        $this->Cell(51, 3, '________________________', 0, 1);

    }
}

// create new PDF document
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Weng Wong (George) Hum');
$Quotation_ID = $_GET['Quotation_ID'];
$pdf->SetTitle('Quotation: '.$Quotation_ID);
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
$pdf->Cell(153, 5, 'Quotation ID : '.$Quotation_ID.'',0,0);
$pdf->Cell(36, 5, 'Date : '.$Quotation_Creation_Date.'',0, 1);

$pdf->Ln(10);

$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(189, 5, $Client_Name, 0, 1);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(189, 5, $Office_Address, 0, 1);
$pdf->Cell(189, 5, 'ATTN: '.$First_Manager_Name.' ('.
    $First_Manager_Number.')', 0, 1);
if (!empty($Second_Manager_Name)) {
    $pdf->Cell(189, 5, $Second_Manager_Name.' ('.
    $Second_Manager_Number.')', 0, 1);
}

$pdf->Ln(7);
$pdf->Cell(189, 5, 'Thank you for your enquiry. We hereby append below our best quotation for your kind consideration and confirmation.', 0, 1);

$pdf->Ln(17);

$pdf->SetFont('Times', 'B', 11);
$pdf->SetFillColor(220, 220, 220);

$pdf->Cell(60, 7, 'Product Name', 1, 0, 'C', 1);
$pdf->Cell(60, 7, 'Units', 1, 0, 'C', 1);
$pdf->Cell(60, 7, 'Unit Cost', 1, 1, 'C', 1);
$pdf->SetFont('Times', '', 11);

$pdf->Multicell(60, 21, $Product_Name, 1, 'C', false, 0);
$pdf->Multicell(60, 7, $CO1_Units, 1, 'C', false, 0);
$pdf->Multicell(60, 7, 'RM '.$CO1_Unit_Cost, 1, 'C', false, 1);

$pdf->Multicell(60, 7, '', 0, 'C', false, 0);
$pdf->Multicell(60, 7, $CO2_Units, 1, 'C', false, 0);
$pdf->Multicell(60, 7, 'RM '.$CO2_Unit_Cost, 1, 'C', false, 1);

$pdf->Multicell(60, 7, '', 0, 'C', false, 0);
$pdf->Multicell(60, 7, $CO3_Units, 1, 'C', false, 0);
$pdf->Multicell(60, 7, 'RM '.$CO3_Unit_Cost, 1, 'C', false, 1);

$pdf->Ln(1);

$pdf->SetFont('Times', 'I', 10);
$pdf->Cell(189, 5, 'Please note that 10% SST will be charged.', 0, 1);

$pdf->Ln(7);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(19, 5, 'Lead Time: ', 0, 0);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(50, 5, $Lead_Time.' working days upon artwork confirmation.', 0, 1);

$pdf->Ln(2);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(37, 5, 'Tolerance Of Quantity: ', 0, 0);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(50, 5, '+-'.$Tolerance_Of_Quantity.'%.', 0, 1);

$pdf->Ln(2);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 5, 'Terms of Payment: ', 0, 0);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(50, 5, $Terms_Of_Payment.'.', 0, 1);

$pdf->Ln(2);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(14, 5, 'Validity: ', 0, 0);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(50, 5, $Quotation_Validity_Period.' working days.', 0, 1);


// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

?>

