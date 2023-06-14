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

// Output the PDF to the browser
$dompdf->stream("slip.pdf", ["Attachment" => false]);


