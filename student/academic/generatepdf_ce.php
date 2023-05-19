<?php
// Include the main TCPDF library (search for installation path).
require_once('TCPDF/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Santa Rosa Branch|Academic Office');
$pdf->SetTitle('Polytechnic University of the Philippines');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
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

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('helvetica', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


// Data Retrieval
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        $lastName = $_POST['lastName'];
        $nameSuffix = $_POST['nameSuffix'];
        $studentNumber = $_POST['studentNumber'];
        $courseYrSec = $_POST ['courseYrSec'];
        $acadyear = $_POST ['acadyear'];  
        $courseCode = $_POST ['courseCode'];
        $description = $_POST ['description'];
        $units = $_POST ['units'];
        $acadyear = $_POST ['acadyear'];
        $pupBranch = $_POST ['pupBranch'];
    }else
    // Set default values or handle the case when the form is not submitted
        $firstName = '';
        $middleName ='';
        $lastName = '';
        $nameSuffix ='';
        $studentNumber = '';
        $courseYrSec ='';
        $acadyear ='';
        $courseCode ='';
        $description ='';
        $units ='';
        $acadyear ='';
        $pupBranch ='';                         

// Concentrate first name, middle name, and last name to form the recipient's full name
$recipientName = $firstName . ' ' . $middleName . ' ' . $lastName;

// Define the pre-generated letter in HTML format
$preGeneratedLetter = <<<EOD
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pre-generated Letter</title>
</head>
<body>
    <h1>Dear $recipientName,</h1>
    
    <p>We are pleased to inform you that you have been accepted into the PUP Academic Office program for the upcoming academic year.</p>
    
    <p>As a participant in this program, you will have the opportunity to engage in a wide range of educational activities, including lectures, workshops, and hands-on projects.</p>
    
    <p>Please find attached the necessary documents and information for your enrollment. If you have any questions or require further assistance, don't hesitate to contact our office.</p>
    
    <p>Thank you for your interest in the PUP Academic Office program. We look forward to welcoming you and supporting your educational journey.</p>
    
    <p>Best regards,</p>
    <p>The PUP Academic Office Team</p>
</body>
</html>
EOD;
// Set some content to print
    $html = <<<EOD
    <h2>Personal Information</h2>
        <p style="text-indent: 5em;">First Name: $firstName</p>
        <p style="text-indent: 5em;">Middle Name: $middleName</p>
        <p style="text-indent: 5em;">Last Name: $lastName</p>
        <p style="text-indent: 5em;">Name Suffix: $nameSuffix</p>
        <p style="text-indent: 5em;">Student Number: $studentNumber</p>
        <p style="text-indent: 5em;">Course/Year/Section: $courseYrSec</p>
        <p style="text-indent: 5em;">Academic Year: $acadyear</p>
        <p style="text-indent: 5em;">Course Code: $courseCode</p>
        <p style="text-indent: 5em;">Course Description: $description</p>
        <p style="text-indent: 5em;">Units: $units</p>
        <p style="text-indent: 5em;">Cross Enroll Term: $enrollment</p>
        <p style="text-indent: 5em;">Academic Year: $acadyear</p>
        <p style="text-indent: 5em;">PUP Branch: $pupBranch</p>

    $preGeneratedLetter
    EOD;
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('pupsrc-generated-file-student.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>

///
// Adjust the position and size of the text box accordingly
        doc.textbox('First sem', 20, 20, { width: 100 });
        doc.textbox('Second sem', 20, 40, { width: 100 });
        doc.textbox('Summer', 20, 60, { width: 100 });