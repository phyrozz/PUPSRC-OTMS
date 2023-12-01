<?php
session_start();

// Include the main TCPDF library (search for installation path).
require_once('TCPDF/tcpdf.php');
require_once('TCPDF/config/tcpdf_config.php');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Santa Rosa Branch|Academic Office');
$pdf->SetTitle('Polytechnic University of the Philippines');
$pdf->SetSubject('Academic Office');
$pdf->SetKeywords('TCPDF, PDF, Academic, PUP, Office');


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE4, PDF_HEADER_STRING4, array(0,0,0), array(0,0,0));
$pdf->setFooterData(array(0,64,0), array(0,64,128));


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set time
$currentDate = date('F d, Y');


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

$pdf->SetY(33,true,true);

// Data Retrieval
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $first_name = $_POST ['first_name'];
        $middle_name = $_POST ['middle_name'];
        $last_name = $_POST ['last_name'];
        $extension_name = $_POST ['extension_name'];
        $student_no = $_POST ['student_no'];
        $name = $first_name . " " . $middle_name . " " . $last_name . " " . $extension_name;

        $yrSec = $_POST ['yr&Sec'];
        $acadYear = $_POST ['acadYear'];
        $reasons = $_POST ['reasons'];
        $reports = $_POST['reports'];

        if (isset($_POST['applicationFor'])) {
            $applicationFor = $_POST['applicationFor'];
          }

        if (isset($_POST['semester'])) {
          $semester = $_POST['semester'];
        }                             
    
      }else {
    // Set default values or handle the case when the form is not submitted
        $name = '';
        $student_no = '';
        $yrSec ='';
        $acadYear ='';
        $reasons ='';
        $reports ='';
        $applicationFor ='';
        $semester ='';
      }

// Set some content to print
$html = <<<EOD
<style>

  table {
    max-width: 100%;
    margin: 0 auto;
    background-color: #fff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    line-height: 1;
  }

  th {
    border: .1px solid gray;
    font-size: 9px;
    background-color: #f2f2f2;
    width: 17%;
    text-align: right;
  }

  td {
    border: .1px solid gray;
    width: 83%;
    font-size: 10px;
  }

  .tdname{
    width: 33%
    font-size: 10px;
  }

  .tdname2{
    width: 33%
    font-size: 10px;
  }

  .tdname3{
    width: 33%
    font-size: 10px;
  }

  .tdname4{
    width: 29%
    font-family: "Arial Unicode MS", "Segoe UI Symbol", Arial, sans-serif;
    font-size: 10px;
  }

  .thname2{
    width: 21%
    font-size: 10px;
    background-color: white;
  }
</style>

<p style="font-size: 12px; text-align: right">Date:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$currentDate&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>

<table>
  <tr>
    <th><div style="font-size:5px">&nbsp;</div>BRANCH/CAMPUS:</th>
    <td><div style="font-size:5px">&nbsp;</div>PUP Santa Rosa Campus</td>
  <tr>
    <th><div style="font-size:5px">&nbsp;</div>STUDENT NUMBER:</th>
    <td class="tdname"><div style="font-size:5px">&nbsp;</div>$student_no</td>
    <th><div style="font-size:5px">&nbsp;</div>APPLICATION FOR:</th>
    <td class="tdname2"><div style="font-size:5px">&nbsp;</div>$applicationFor</td>
  </tr>
  <tr>
    <th><div style="font-size:5px">&nbsp;</div>NAME OF STUDENT:</th>
    <td><div style="font-size:5px">&nbsp;</div>$name</td>
  </tr>
  <tr>
    <th><div style="font-size:5px">&nbsp;</div>COURSE/YR/SECT:</th>
    <td class="tdname3"><div style="font-size:5px">&nbsp;</div>$yrSec</td>
    <th class="thname2"; style="text-align: left;"><div style="font-size:5px">&nbsp;</div>ACADEMIC YEAR: $acadYear</th>
    <td class="tdname4"><div style="font-size:5px">&nbsp;</div>SEMESTER: $semester</td>
  </tr>
  <tr>
    <th><div style="font-size:5px">&nbsp;</div>STUDENT WAS REPORTED AS:</th>
    <td><div style="font-size:5px">&nbsp;</div>$reports</td>
  </tr>
  <tr>
  <th><div style="font-size:5px">&nbsp;</div>DUE TO THE FF. REASON/S:</th>
  <td><div style="font-size:5px">&nbsp;</div>$reasons</td>
</tr>
</table>

<div></div><div></div>

<p style="text-align: right; font-size: 10px; line-height: .1">____________________________________________________</p>
<p style="text-align: right; font-size: 10px; line-height: .5">PROFESSOR/INSTRUCTOR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p style="text-align: right; font-size: 8px; line-height: .5">(SIGNATURE OVER PRINTED NAME)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
  
<div></div><div></div>

<p style="font-size: 12px; line-height: 1">APPROVED BY <b>CAMPUS DIRECTOR</b></p>
<p style="font-size: 12px; line-height: 1">Name: ________________________________________ Signature: _____________________________ Date: ______________ </p>

<div></div>

<p style="font-size: 12px; line-height: 1">Received by Office of the Campus Registrar</p>
<p style="font-size: 12px; line-height: 1">Name: ________________________________________ Signature: _____________________________ Date: ______________ </p>

</body>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/generated_pdf/";

include "../../conn.php";
$query = "SELECT student_no, last_name, first_name FROM users WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$uniqueFileName = 'AO_GA_' . $student_no . '_' . $last_name . '_' . $first_name . '_CFORM.pdf';
$_SESSION['fileName'] = $uniqueFileName;

// Create the path where the file will be stored
$filePath = $uploadDirectory . $uniqueFileName;

// Output the PDF file
$pdf->Output($filePath, 'F');

include "../../conn.php";
// Insert to Database
// Get the file size

$setStatus = 2;

try {
  // Prepare the query to check if the file already exists in the database
$checkQuery = "SELECT COUNT(*) as count FROM acad_grade_accreditation WHERE user_id = ?";
$checkStmt = $connection->prepare($checkQuery);
$checkStmt->bind_param("s", $_SESSION['user_id']);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();
$fileExists = $checkResult->fetch_assoc()['count'];
$checkStmt->close();

// Prepare the query to insert or update the file details in the database
$query = "UPDATE acad_grade_accreditation SET completion_form = ?, completion_form_status = ? WHERE user_id = ?";


$stmt = $connection->prepare($query);
$stmt->bind_param("sii", $uniqueFileName, $setStatus, $_SESSION['user_id']);
$stmt->execute();

if ($stmt->affected_rows > 0) {
  echo "<script>alert('Generated PDF uploaded successfully.'); window.location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
} else {
  echo "<script>alert('Failed to upload generated PDF.'); window.location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
}

$stmt->close();

  
} catch (Exception $e) {
    $errorCode = $e->getCode();
    $errorMessage = $e->getMessage();
    echo "<script>alert('An error occurred: Error code " . $errorCode . ". Error message: " . $errorMessage . "'); window.location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
}



?>