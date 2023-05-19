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

/*
// Data Retrieval
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $name = $_POST['name'];
        $studentNumber = $_POST['studentNumber'];
        $courseYrSec = $_POST ['courseYrSec'];
        $date = $_POST ['date'];
        $pupBranch = $_POST ['pupBranch'];
        $reason = $_POST ['reason'];


        //$courseCode = $_POST ['courseCode'];
        //$description = $_POST ['description'];
        //$units = $_POST ['units'];
        //$enrollment = isset($_POST['enrollment']) ? $_POST['enrollment'] : array();
        // $enrollment will be an array containing the selected enrollment options  
        //$acadyear = $_POST ['acadyear'];
    } else {
*/
    // Set default values or handle the case when the form is not submitted
        $name = '';
        $studentNumber = '';
        $courseYrSec ='';
        $date ='';
        $pupBranch ='';
        $reason ='';
                                                


// Set some content to print
$html = <<<EOD
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
  }


  h1 {
    color: #333;
    text-align: center;
  }


  table {
    max-width: 100%;
    margin: 0 auto;
    background-color: #fff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }


  th {
    padding: 10px;
    border: 1px solid black;
    text-align: center;
    font-size: 10px;
    background-color: #f2f2f2;
    width: 20%;
  }


  td {
    padding: 10px;
    border: 1px solid black;
    text-align: left;
    width: 85%;
  }


  .tdname{
    width: 32%
  }


  .tdname2{
    width: 33%
  }


  .tdname3{
    width: 32%
  }


  .tdname4{
    width: 33%
    font-family: "Arial Unicode MS", "Segoe UI Symbol", Arial, sans-serif;
    font-size: 10px;
  }


  .thname2{
    background-color: #ffffff;
    font-size: 10px;
  }


  .tablehead{
    padding: 1px;
  }


  .steps{
    font-size: 11px;
  }


  .instructions{
    font-size: 15px;
    line-height: -5%;
  }


  .thclass{
    font-size:9px;
    width: 11.7%;
  }


  .thclass1{
    width: 81.9%;
    text-align: left;
  }


  .thclass2{
    width: 23.4%;
    text-align: left;
  }


  .tdclass{
    width:11.7%
    font-size:9px;
  }


  .p11{
    color: red;
    font-size: 10px;
  }


  .p3{
    font-size: 12px;
    text-align: center;
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
  <p>Step 6. Proceed to your Department for TAGGING of the necessary changes. (After tagging, open your SIS Account to check if the necessary changes were done and correct) </p>
  <p>Step 7. Go to the Branch/Campus Accounting Student Services for the assessment and tagging of necessary fee/s </p>
  <p>Step 8. For students not covered by R.A. 10931: Pay the assessed fee at the Branch/Campus Cashier’s Office </p>
  <p>Step 9. Photocopy this form and official receipt (for students not covered by R.A. 10931), and submit the Original Copy to the Branch/Campus </p>
  <p>Registrar’s Office, one (1) photocopy to the Academic Head, and ALWAYS keep a personal copy </p> </div> </p>


  <p class="p11">[1]</p>
  <table style="margin: 0 auto;">
    <tr>
      <th>BRANCH/CAMPUS:</th>
      <td>$pupBranch</td>
    </tr>
    <tr>
      <th>STUDENT NUMBER:</th>
      <td class="tdname">$studentNumber</td>
      <th>APPLICATION DATE:</th>
      <td class="tdname2">$date</td>
    </tr>
    <tr>
      <th>NAME OF STUDENT:</th>
      <td>$name</td>
    </tr>
    <tr>
      <th>COURSE/YR/SECT:</th>
      <td class="tdname3">$courseYrSec</td>
      <th class="thname2">ACADEMIC YEAR: 20____ to 20____ </th>
      <td class="tdname4">__ First Semester __ Second Semester __ Summer</td>
    </tr>
    <tr>
      <th>REASON/S:</th>
      <td>$reason</td>
    </tr>
  </table>


  <p class="p11">[2]</p>
  <table>
  <tr>
    <th class="thclass1">ADD:</th>
    <th class="thclass2">ACCEPTED BY:</th>
  </tr>
  <tr>
    <th class="thclass">Code</th>
    <th class="thclass">Description</th>
    <th class="thclass">CourseYearSection</th>
    <th class="thclass">Day</th>
    <th class="thclass">Time</th>
    <th class="thclass">Room</th>
    <th class="thclass">Units</th>
    <th class="thclass">Acad. Head</th>
    <th class="thclass">Tagged by</th>
  </tr>
  <tr>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
  </tr>
  <tr>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
    <td class="tdclass"></td>
  </tr>
  <tr>
  <td class="tdclass"></td>
  <td class="tdclass"></td>
  <td class="tdclass"></td>
  <td class="tdclass"></td>
  <td class="tdclass"></td>
  <td class="tdclass"></td>
  <td class="tdclass"></td>
  <td class="tdclass"></td>
  <td class="tdclass"></td>
</tr>
<tr>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
</tr>
<tr>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
</tr>
<tr>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
</tr>
<tr>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
<td class="tdclass"></td>
</tr>
</table>


<p class="p3">This form will only be processed if filled-up properly and completely during the adjustment period.</p>




</body>




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

