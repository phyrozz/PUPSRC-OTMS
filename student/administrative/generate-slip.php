<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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



$equipmentNameModified = strtolower(str_replace(' ', '', $equipmentName));

// Generate the file name with the current time, unique identifier, and equipment name
$fileName = 'requisition_slip' . '_' . $equipmentNameModified . '_' . uniqid(). '.pdf';

// Save the PDF to a directory in your file system
$directoryPath = $_SERVER['DOCUMENT_ROOT'] . '/student/administrative/requisition-slip/';
$filePath = $directoryPath . $fileName;
file_put_contents($filePath, $dompdf->output());

// Output the PDF to the browser
$dompdf->stream($fileName, ["Attachment" => false]);

try {
  // Prepare the query to retrieve request_id for the user
  $checkQuery = "SELECT request_id FROM request_equipment WHERE user_id = ? ORDER BY request_id DESC LIMIT 1";
  $checkStmt = $connection->prepare($checkQuery);
  $checkStmt->bind_param("i", $_SESSION['user_id']);
  $checkStmt->execute();
  $checkResult = $checkStmt->get_result();

  if ($checkResult->num_rows > 0) {
      while ($row = $checkResult->fetch_assoc()) {
          $requestId = $row['request_id'];

          // Define the path to the log file
$logFilePath = $_SERVER['DOCUMENT_ROOT'] . '/debug.log';

// Debug log function to append messages to the log file
function debugLog($message) {
    global $logFilePath;
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[{$timestamp}] {$message}\n";
    file_put_contents($logFilePath, $logMessage, FILE_APPEND);
}

// Before executing the update query, add debug logging to check the values of variables
debugLog("Request ID: " . $requestId);
debugLog("Equipment ID: " . $equipmentId);

          // Prepare the query to update slip_content for each request
          $pdfUpdateQuery = "UPDATE request_equipment SET slip_content = ? WHERE request_id = ? AND equipment_id = ? ";
          $stmt = $connection->prepare($pdfUpdateQuery);
          $stmt->bind_param("ssi", $fileName,$requestId, $equipmentId);
          $stmt->execute();

          // Additional logic after update if needed
          if ($stmt->affected_rows > 0) {
            echo "<script>alert('Generated PDF uploaded successfully for all requests.'); window.location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
          } else {
              // Handle cases where the update failed
          }
      }
  } else {
      echo "<script>alert('No requests found for the user.'); window.location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
  }

  // Close prepared statements
  $checkStmt->close();
  $stmt->close();
} catch (Exception $e) {
  $errorCode = $e->getCode();
  $errorMessage = $e->getMessage();
  echo "<script>alert('An error occurred: Error code " . $errorCode . ". Error message: " . $errorMessage . "'); window.location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
}





?>
