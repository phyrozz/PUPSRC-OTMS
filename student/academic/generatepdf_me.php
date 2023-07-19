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
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE3, PDF_HEADER_STRING3, array(0,0,0), array(0,0,0));
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

$pdf->SetY(20,true,true);


// Data Retrieval
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      // Add session variables to store post variables in it
      $_SESSION['academic_first_name'] = $_POST['first_name'];
      $_SESSION['academic_last_name'] = $_POST['last_name'];
      $_SESSION['academic_middle_name'] = $_POST['middle_name'];
      $_SESSION['academic_extension_name'] = $_POST['extension_name'];
      $_SESSION['academic_student_no'] = $_POST['student_no'];
        
      $first_name = $_SESSION['academic_first_name'];
      $middle_name = $_SESSION['academic_middle_name'];
      $last_name = $_SESSION['academic_last_name'];
      $extension_name = $_SESSION['academic_extension_name'];
      $student_no = $_SESSION['academic_student_no'];
      $name = $first_name . " " . $middle_name . " " . $last_name . " " . $extension_name;

      $_SESSION['yr&Sec'] = $_POST ['yr&Sec'];
      $_SESSION['acadYear'] = $_POST ['acadYear'];
      $_SESSION['reason'] = $_POST ['reason'];

      $yrSec = $_SESSION['yr&Sec'];
      $acadYear = $_SESSION['acadYear'];
      $reason = $_SESSION['reason'];

      $_SESSION['semester'] = $_POST['semester'];
      if (isset($_SESSION['semester'])) {
        $semester = $_SESSION['semester'];
      }

      $_SESSION['code1'] = $_POST['code1'];
      $_SESSION['code2'] = $_POST['code2'];
      $_SESSION['code3'] = $_POST['code3'];
      $code1 = $_SESSION['code1'];
      $code2 = $_SESSION['code2'];
      $code3 = $_SESSION['code3'];

      $_SESSION['desc1'] = $_POST['desc1'];
      $_SESSION['desc2'] = $_POST['desc2'];
      $_SESSION['desc3'] = $_POST['desc3'];
      $desc1 = $_SESSION['desc1'];
      $desc2 = $_SESSION['desc2'];
      $desc3 = $_SESSION['desc3'];

      $_SESSION['courseYrSec1'] = $_POST['courseYrSec1'];
      $_SESSION['courseYrSec2'] = $_POST['courseYrSec2'];
      $_SESSION['courseYrSec3'] = $_POST['courseYrSec3'];
      $courseYrSec1 = $_SESSION['courseYrSec1'];
      $courseYrSec2 = $_SESSION['courseYrSec2'];
      $courseYrSec3 = $_SESSION['courseYrSec3'];

      $_SESSION['units1'] = $_POST['units1'];
      $_SESSION['units2'] = $_POST['units2'];
      $_SESSION['units3'] = $_POST['units3'];
      $units1 = $_SESSION['units1'];
      $units2 = $_SESSION['units2'];
      $units3 = $_SESSION['units3'];
                                                  }
    
    else {
    // Set default values or handle the case when the form is not submitted
    $name = '';
    $studentNumber = '';
    $yrSec ='';
    $acadYear ='';
    $reason ='';
    $semester ='';

    $code1 ='';
    $code2 ='';
    $code3 ='';

    $desc1 ='';
    $desc2 ='';
    $desc3 ='';

    $courseYrSec1 ='';
    $courseYrSec2 ='';
    $courseYrSec3 ='';

    $units1 ='';
    $units2 ='';
    $units3 ='';
      }

// Set some content to print
$html = <<<EOD

<style>
  body {
    font-family: Arial, sans-serif;
  }

  .steps{
    font-size: 10px;
    line-height: .8;
    
  }

  .instructions{
    font-size: 10px;
    line-height: .8;
  }

  .indented {
    text-indent: 35px; /* Adjust the value as per your desired indentation */
  }
</style>

<body>
  <div class="steps">
  <p class="instructions"><b>INSTRUCTIONS: READ AND FOLLOW THE STEPS CAREFULLY</b> </p>
  <p>Step 1. Fill-out all blank spaces provided in this form with appropriate information; Write N/A if not applicable </p>
  <p>Step 2. Write the details of subject to add in the ADD section </p>
  <p>Step 3. Place your signature above your printed name (located at the lower-right portion of this form) </p>
  <p>Step 4. Every filled-up row must be signed by the Academic Head </p>
  <p>Step 5. This form must be signed with date by the Academic Head </p>
  <p>Step 6. Proceed to your Department for TAGGING of the necessary changes. (After tagging, open your SIS Account to check if the necessary changes </p>
  <p class="indented">were done and correct)</p>
  <p>Step 7. Go to the Branch/Campus Accounting Student Services for the assessment and tagging of necessary fee/s </p>
  <p>Step 8. For students not covered by R.A. 10931: Pay the assessed fee at the Branch/Campus Cashier’s Office </p>
  <p>Step 9. Photocopy this form and official receipt (for students not covered by R.A. 10931), and submit the Original Copy to the Branch/Campus </p>
  <p class="indented">Registrar’s Office, one (1) photocopy to the Academic Head, and ALWAYS keep a personal copy </p> 
  <p style="color:red; font-size:10px; font-weight:bold; line-height: .8;">   [1]</p>
  </div>
</body>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$pdf->SetY(86, true, true);
$pdf->setCellMargins(0, 0, 0, 0); // Set cell margins to 0

$html2 = <<<EOD

<style>

  table {
    max-width: 100%;
    margin: 0 auto;
    background-color: #fff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    line-height: .7;
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

<table>
  <tr>
    <th><div style="font-size:5px">&nbsp;</div>BRANCH/CAMPUS:</th>
    <td><div style="font-size:5px">&nbsp;</div>PUP Sta. Rosa Campus</td>
  </tr>
  <tr>
    <th><div style="font-size:5px">&nbsp;</div>STUDENT NUMBER:</th>
    <td class="tdname"><div style="font-size:5px">&nbsp;</div>$student_no</td>
    <th><div style="font-size:5px">&nbsp;</div>APPLICATION DATE:</th>
    <td class="tdname2"><div style="font-size:5px">&nbsp;</div>$currentDate</td>
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
    <th><div style="font-size:5px">&nbsp;</div>REASON/S:</th>
    <td><div style="font-size:5px">&nbsp;</div>$reason</td>
  </tr>
</table>

<p style="color:red; font-size:10px; font-weight:bold; line-height: .8;">   [2]</p>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html2, 0, 1, 0, true, '', true);

$pdf->SetY(131, true, true);

$html3 = <<<EOD

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
    font-size: 9px;
    line-height: 3;
  }

  .tablehead{
    padding: 1px;
  }

  .thclass{
    font-size:9px;
    text-align: center;
  }

  .thclass1{
    width: 78%;
    text-align: left;
    background-color: light gray;
    font-weight: bold;
    line-height: .1;
  }

  .thclass2{
    width: 22%;
    text-align: left;
    background-color: light gray;
    font-weight: bold;
    line-height: .1;
  }

  .tdclass{
    width:11.7%
    font-size:2px;
    text-align: center;
  }
</style>

<table>
<tr>
  <th class="thclass1">ADD:</th>
  <th class="thclass2">ACCEPTED BY:</th>
</tr>
<tr>
  <th class="thclass"; style="width:10%";><div style="font-size:18px">&nbsp;</div><b>Code</b> </th>
  <th class="thclass"; style="width:25%";><div style="font-size:18px">&nbsp;</div><b>Description</b> </th>
  <th class="thclass"; style="width:10%";><div style="font-size:9px">&nbsp;</div><b>Course, Year, & Section</b> </th>
  <th class="thclass"; style="width:7%";><div style="font-size:18px">&nbsp;</div><b>Day</b> </th>
  <th class="thclass"; style="width:12%";><div style="font-size:18px">&nbsp;</div><b>Time</b> </th>
  <th class="thclass"; style="width:7%";><div style="font-size:18px">&nbsp;</div><b>Room</b> </th>
  <th class="thclass"; style="width:7%";><div style="font-size:18px">&nbsp;</div><b>Units</b> </th>
  <th class="thclass"; style="width:11%";><b>Acad. Head Signature Over Printed Name and Date</b> </th>
  <th class="thclass"; style="width:11%";><b>Tagged by Signature Over Printed Name and Date</b> </th>
</tr>

<tr>
  <td class="tdclass" style="width:10%";>$code1</td>
  <td class="tdclass" style="width:25%";>$desc1</td>
  <td class="tdclass" style="width:10%";>$courseYrSec1</td>
  <td class="tdclass" style="width:7%";></td>
  <td class="tdclass" style="width:12%";></td>
  <td class="tdclass" style="width:7%";></td>
  <td class="tdclass" style="width:7%";>$units1</td>
  <td class="tdclass" style="width:11%";></td>
  <td class="tdclass" style="width:11%";></td>
</tr>

<tr>
  <td class="tdclass" style="width:10%";>$code2</td>
  <td class="tdclass" style="width:25%";>$desc2</td>
  <td class="tdclass" style="width:10%";>$courseYrSec2</td>
  <td class="tdclass" style="width:7%";></td>
  <td class="tdclass" style="width:12%";></td>
  <td class="tdclass" style="width:7%";></td>
  <td class="tdclass" style="width:7%";>$units2</td>
  <td class="tdclass" style="width:11%";></td>
  <td class="tdclass" style="width:11%";></td>
</tr>

<tr>
  <td class="tdclass" style="width:10%";>$code3</td>
  <td class="tdclass" style="width:25%";>$desc3</td>
  <td class="tdclass" style="width:10%";>$courseYrSec3</td>
  <td class="tdclass" style="width:7%";></td>
  <td class="tdclass" style="width:12%";></td>
  <td class="tdclass" style="width:7%";></td>
  <td class="tdclass" style="width:7%";>$units3</td>
  <td class="tdclass" style="width:11%";></td>
  <td class="tdclass" style="width:11%";></td>
</tr>

</table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html3, 0, 1, 0, true, '', true);


$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/generated_pdf/";

include "../../conn.php";
$query = "SELECT student_no, last_name, first_name FROM users WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$uniqueFileName = 'ME_R0FORM_' . $student_no . '_' . $last_name . '_' . $first_name . '.pdf';
$_SESSION['fileName'] = $uniqueFileName;

// Create the path where the file will be stored
$filePath = $uploadDirectory . $uniqueFileName;

// Output the PDF file
$pdf->Output($filePath, 'F');

include "../../conn.php";
// Insert to Database
// Get the file size
// $fileSize = filesize($filePath);
// $attachmentStatus = 2;
$type = "Generated PDF";
$setStatus = 1;

try {
  // Prepare the query to check if the file already exists in the database
$checkQuery = "SELECT COUNT(*) as count FROM manual_enrollment WHERE user_id = ?";
$checkStmt = $connection->prepare($checkQuery);
$checkStmt->bind_param("i", $_SESSION['user_id']);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();
$fileExists = $checkResult->fetch_assoc()['count'];
$checkStmt->close();

// Prepare the query to insert or update the file details in the database
$query = "UPDATE manual_enrollment SET r_zero_form = ?, r_zero_form_status = ? WHERE user_id = ?";

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