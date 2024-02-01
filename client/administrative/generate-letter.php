<?php

require "../../vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

include "conn.php";

session_start();

if(isset($_SESSION['appointment_details'])) {

    $appointmentDetails = $_SESSION['appointment_details'];

    $startDate = date("F j, Y", strtotime($appointmentDetails['startDate']));
    $endDate = date("F j, Y", strtotime($appointmentDetails['endDate']));
    $startTime = date("h:i A", strtotime($appointmentDetails['startTime']));
    $endTime = date("h:i A", strtotime($appointmentDetails['endTime']));
    $facilityId = $appointmentDetails['facility_id'];
    $purpose = $appointmentDetails['purposeReq'];
    $client =  $appointmentDetails['client'];
    $nameOfOrgs = $appointmentDetails['orgs'];



        $currentDate = new DateTime("now", new DateTimeZone("Asia/Manila"));
        $currentTime = $currentDate->format("F j, Y ");

        // Query to retrieve user data
        $userQuery = "SELECT last_name, first_name FROM users WHERE user_id = ?";
        $userStmt = $connection->prepare($userQuery);
        $userStmt->bind_param("i", $_SESSION['user_id']);
        $userStmt->execute();
        $result = $userStmt->get_result();
        $userResult = $result->fetch_assoc();
        $firstName = $userResult['first_name'];
        $lastName = $userResult['last_name'];


         // Close the prepared statement
        $userStmt->close();


        // Retrieve the facility name and facility number from the database based on the facility ID
        $facilityStmt = $connection->prepare("SELECT facility_name FROM facility WHERE facility_id = ?");
        $facilityStmt->bind_param("i", $facilityId);
        $facilityStmt->execute();
        $facilityResult = $facilityStmt->get_result();
        $facilityRow = $facilityResult->fetch_assoc();
        $facilityName = $facilityRow['facility_name'];
        // $facilityNumber = $facilityRow['facility_number'];

        // Close the prepared statement
        $facilityStmt->close();

} else {
        $startDate = '';
        $endDate = '';
        $startTime = '';
        $endTime = '';
        $facilityName = '';

        $purpose = '';
        $nameOfOrgs = '';
        $firstName = '';
        $lastName = '';



}



$html = <<<EOD
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Request Letter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Times New Roman', Times, serif, sans-serif;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif, sans-serif;

        }

        

        .text {
            display: inline-block;
            vertical-align: middle;
            margin: 0;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
        
        h4 {
            margin-bottom: 15px;
        }

        p {
            line-height: 1.3;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .title { 
            text-align: center;
        }

        .date {
            margin-bottom: 50px;
            text-align: left;
        }

        .letter-body p {
            text-align: justify;
            margin
        }


        #current-date {
            font-weight: bold;
        }
        .receiver {

            margin-bottom: 40px;

        }
        .sender {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        #year-level,
        #client,
        #orgs,
        #facility,
        #reason,
        #start-date,
        #start-time,
        #end-date,
        #end-time,
        #representative-name,
        #representative-year-section {
            font-weight: bold;
        }

        #representative-name {
            text-decoration: underline;
        }

        #representative-year-section {
            font-style: italic;
        }

        .container-margin {
            margin-left: 46px;
            margin-right: 46px;
        }

        
        
          
        
    </style>
</head>
<body>


<div class="container-margin">


    <div class="date">
        <h4><span id="current-date">$currentTime</span></h4>
    </div>

    <div class="receiver">
        <p>
            <strong>ASST. PROF DIOMEDES E. RODRIGUEZ</strong><br>
            <em>Head, Administrative Services</em>
            <br>
            This Branch
        </p>
    </div>

    <br>
    <p>
        <strong>Dear Sir,</strong>
    </p>


    <div class="letter-body">
        <p>Warm greetings in pursuit of wisdom!</p>


        <p class="indent">
            We, the <span id="client">$client</span> from <span id="orgs">$nameOfOrgs</span>, kindly request your approval to utilize the <span id="facility">$facilityName</span> at PUP Sta. Rosa Campus.
            The facility will be used as the venue for <span id="reason">"$purpose"</span>.
            The intended schedule for our activity is from <span id="start-date">$startDate</span>, <span id="start-time">$startTime</span> to <span id="end-date">$endDate</span>, <span id="end-time">$endTime</span>.
            This reservation is part of our requirements for the scheduled activity.
        </p>



        <p>
        Your kind consideration of this request is highly appreciated. We assure you that our use of the facility will be in accordance with all guidelines and regulations.</p>


        <br>


        <p>Respectfully Yours,</p>


        <br>


        <div class="sender">
            <p>
                <strong>$lastName, $firstName</strong><br>
                <span id="representative-year-section"></span> Representative
            </p>
        </div>
    </div>



    <div class="footer">
        <p>
            Noted by:<br><br><br>
            <strong>Asst. Prof. Leny V. Salmingo</strong><br>
            Campus Directress<br>
            PUP Sta. Rosa
        </p>
    </div>

    <br><br>


</div>
</body>
</html>

EOD;

$options = new Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

// Set the paper size to A4 and orientation to portrait
$dompdf->setPaper('A4', 'portrait');
$dompdf->loadHtml($html);

$dompdf->render();


$facilityNameModified = strtolower(str_replace(' ', '', $facilityName));

// Generate the file name with the current time, unique identifier, and equipment name
$fileName = 'appointment_letter'. '_'.  $facilityNameModified . '_' . uniqid(). '.pdf';


// Save the PDF to a directory in your file system
$directoryPath = $_SERVER['DOCUMENT_ROOT'] . '/client/administrative/appointment-letter/';
$filePath = $directoryPath . $fileName;
file_put_contents($filePath, $dompdf->output());

// Output the PDF to the browser
$dompdf->stream("letter.pdf", ["Attachment" => false]);


try {
    // Prepare the query to retrieve appointment_id for the user
    $checkQuery = "SELECT appointment_id FROM appointment_facility WHERE user_id = ? ORDER BY appointment_id DESC LIMIT 1";
    $checkStmt = $connection->prepare($checkQuery);
    $checkStmt->bind_param("i", $_SESSION['user_id']);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
  
    if ($checkResult->num_rows > 0) {
        while ($row = $checkResult->fetch_assoc()) {
            $requestId = $row['appointment_id'];
  
            // Prepare the query to update slip_content for each request
            $pdfUpdateQuery = "UPDATE appointment_facility SET letter_content = ? WHERE appointment_id = ? AND facility_id = ? ";
            $stmt = $connection->prepare($pdfUpdateQuery);
            $stmt->bind_param("ssi", $fileName,$requestId, $facilityId);
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
