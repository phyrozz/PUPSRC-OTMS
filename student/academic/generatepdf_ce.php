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
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE2 , PDF_HEADER_STRING2, array(0,0,0), array(0,0,0));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(25, PDF_MARGIN_TOP, 15);
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
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(255,255,255), 'opacity'=>1, 'blend_mode'=>'Normal'));

// set time
$currentDate = date('F d, Y');

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
        $branch = $_POST ['branch'];


        if (isset($_POST['semester'])) {
            $semester = $_POST['semester'];
          }
  
          $code1 = $_POST['code1'];
          $code2 = $_POST['code2'];
          $code3 = $_POST['code3'];
  
          $desc1 = $_POST['desc1'];
          $desc2 = $_POST['desc2'];
          $desc3 = $_POST['desc3'];
  
          $units1 = $_POST['units1'];
          $units2 = $_POST['units2'];
          $units3 = $_POST['units3'];
    }else{
    // Set default values or handle the case when the form is not submitted
        $name = '';
        $studentNumber = '';
        $yrSec ='';
        $acadYear ='';
        $reason ='';
        $semester ='';
        $course ='';
        $branch ='';

        $code1 ='';
        $code2 ='';
        $code3 ='';

        $desc1 ='';
        $desc2 ='';
        $desc3 ='';

        $units1 ='';
        $units2 ='';
        $units3 ='';
      }             

// Set some content to print
    $html = <<<EOD

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 14px;
        }

        .letter {
            max-width: 800px;
            margin: 0 auto;
        }

        p {
            margin: 5px 0;
            font-size: 14px;
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 14px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            font-size: 14px;
        }

        .footer {
            margin-top: 20px;
        }
    </style>

    <div class="letter">
        <p style="line-height: 1.2;">$currentDate</p>
        
        <br>
        <p style="line-height: .3;"><b>--------------</b></p>
        <p style="line-height: .3;">--------------</p>
        <p style="line-height: .3;">PUP Santa Rosa Branch</p>
        <p style="line-height: .3;">Brgy. Tagapo, Santa Rosa, Laguna</p>

        <p style="line-height: 1.8;">Dear Ma'am/Sir,</p>

        <p style="text-indent: 35px;">I am $name, a $yrSec student from PUP Santa Rosa, would like to ask your permission to cross-enroll the following subject/s for $semester of $acadYear at PUP $branch Branch.</p>

        <div class="table-container" style="line-height: 2;">
            <table>
                <thead>
                    <tr>
                        <th><b>Course Code</b></th>
                        <th><b>Course Description</b></th>
                        <th><b>Units</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>$code1</td>
                        <td>$desc1</td>
                        <td>$units1</td>
                    </tr>
                </tbody>
                <tbody>
                <tr>
                        <td>$code2</td>
                        <td>$desc2</td>
                        <td>$units2</td>
                </tr>
                </tbody>
                <tbody>
                <tr>
                        <td>$code3</td>
                        <td>$desc3</td>
                        <td>$units3</td>
                </tr>
                </tbody>
            </table>
        </div>

        <p style="line-height: .5;">I am seeking after your most great response about this issue. Thank you and God bless.</p>
        
        <div></div>
        
        <div class="footer">
            <p style="line-height: .3;">Sincerely yours,</p>
            <br>
            <p style="line-height: .3;">$name</p>
            <p style="line-height: .3;">$student_no</p>

            <div></div><div></div>

            <p style="line-height: .3;">Noted by:</p>
            <br>
            <p style="line-height: .3;">---------------</p>
            <p style="line-height: .3;">---------------</p>
        </div>
    </div>
        
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

$uniqueFileName = 'AO_CE_' . $student_no . '_' . $last_name . '_' . $first_name . '_APPLETTER.pdf';
$_SESSION['fileName'] = $uniqueFileName;

// Create the path where the file will be stored
$filePath = $uploadDirectory . $uniqueFileName;

// Output the PDF file
$pdf->Output($filePath, 'F');

include "../../conn.php";
// Insert to Database

$setStatus = 2;

try {
  // Prepare the query to check if the file already exists in the database
$checkQuery = "SELECT COUNT(*) as count FROM acad_cross_enrollment WHERE user_id = ?";
$checkStmt = $connection->prepare($checkQuery);
$checkStmt->bind_param("s", $_SESSION['user_id']);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();
$fileExists = $checkResult->fetch_assoc()['count'];
$checkStmt->close();

// Prepare the query to insert or update the file details in the database
$query = "UPDATE acad_cross_enrollment SET application_letter = ?, application_letter_status = ? WHERE user_id = ?";


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