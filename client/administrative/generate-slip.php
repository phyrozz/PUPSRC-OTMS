<?php
require "../../vendor/autoload.php";
use Dompdf\Dompdf;
use Dompdf\Options;

include "conn.php";

session_start();

if (isset($_SESSION['request_details'])) {
    $requestDetails = $_SESSION['request_details'];

    $date = $requestDetails['date'];
    $quantityEquip = $requestDetails['quantity_equip'];
    $time = $requestDetails['time'];
    $equipmentId = $requestDetails['equipment_id'];

    // Convert the time to standard time format
    $formattedTime = date("h:i A", strtotime($time));
    // Format the date (assuming the $date variable is in "Y-m-d" format)
    $formattedDate = date("F j, Y", strtotime($date));

    // Retrieve the equipment name from the database based on the equipment ID
    $equipmentStmt = $connection->prepare("SELECT equipment_name FROM equipment WHERE equipment_id = ?");
    $equipmentStmt->bind_param("i", $equipmentId);
    $equipmentStmt->execute();
    $equipmentResult = $equipmentStmt->get_result();
    $equipmentRow = $equipmentResult->fetch_assoc();
    $equipmentName = $equipmentRow['equipment_name'];

    // Close the prepared statement
    $equipmentStmt->close();
  } else {
    // Set default values if request details are not available
    $date = '';
    $quantityEquip = '';
    $time = '';
    $formattedTime = '';
    $equipmentName = '';
    $formattedDate = '';
}

$html = <<<EOD
<!DOCTYPE html>
<html>
<head>
  <title>Requisition Slip</title>
  <link rel="icon" href="/assets/icon/pup-logo.png" type="image/x-icon">
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="stylesheets/slip.css">
  <style>
    .table td {
      font-size: 14px; /* Adjust the font size as per your requirement */
    }
    * {
      font-family: "Fira Sans";
      src: url("/assets/fonts/FiraSans/FiraSans-Regular.ttf") format("truetype");
    }
  
  
    body {
      font-family: "Fira Sans";
    }
  
    .header {
      /* margin-top: px; */
      text-align: center;
    }
  
    .requisition-slip {
      background-color: #98BCDE; /* Customize the background color */
      color: #333; /* Customize the text color */
      font-weight: bold;
      text-align: center;
      padding: 10px;
    }
  
    .logo {
      width: 150px;
      height: auto;
    }
  
    .address {
      text-align: center;
    }
  
    .table {
      margin-top: 40px;
      margin-bottom: 100px;
      border: 2px solid #000;
      width: 100%;
    }
  
    .table  thead  th,
    .table  tbody td {
      text-align: center;
      border: 2px solid grey;
      width: 33.33%; /* Set equal width for each cell */
    }
  
    .signature {
      margin-top: 20px;
      text-align: center;
    }
  
    .bold-text {
      font-weight: bold;
    }
  
    .line {
      border-top: 1px solid black;
      width: 40%;
      margin: 0 auto;
    }
  </style>
</head>
<body>
  <div class="header">
    <h5>Polytechnic University of the Philippines</h5>
    <p>Sta. Rosa Campus</p>
  </div>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th colspan="4" class="requisition-slip">REQUISITION SLIP</th>
      </tr>
      <tr>
        <th>EQUIPMENT</th>
        <th>QUANTITY</th>
        <th>DATE</th>
        <th>TIME</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>$equipmentName</td>
        <td>$quantityEquip</td>
        <td>$formattedDate</td>
        <td>$formattedTime</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>

  <div class="line signature">
    <p class="bold-text">Signature Over Printed Name</p>
  </div>
</body>
</html>
EOD;

$options = new Options;
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

$dompdf->setPaper(array(0, 0, 500.64, 450.53), 'portrait');
$dompdf->loadHtml($html);

$dompdf->render();





$equipmentNameModified = strtolower(str_replace(' ', '', $equipmentName));

// Generate the file name with the current time, unique identifier, and equipment name
$fileName = 'requisition_slip' . '_' . $equipmentNameModified . '_' . uniqid(). '.pdf';

// Save the PDF to a directory in your file system
$directoryPath = 'C:/xampp/htdocs/client/administrative/requisition-slip/';
$filePath = $directoryPath . $fileName;
file_put_contents($filePath, $dompdf->output());

// Store the PDF file path in the database
$pdfFilePath = 'requisition-slip/' . $fileName;

// Update the request_equipment table with the PDF file path
$pdfUpdateQuery = "UPDATE request_equipment SET slip_content = ? WHERE request_id = ?";
$pdfUpdateStmt = $connection->prepare($pdfUpdateQuery);
$pdfUpdateStmt->bind_param("bi", $pdfFilePath, $requestId);
$pdfUpdateStmt->execute();
$pdfUpdateStmt->close();

// Output the PDF to the browser
$dompdf->stream($fileName, ["Attachment" => false]);
