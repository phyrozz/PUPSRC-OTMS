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
    $course =  $appointmentDetails['course'];
    $section = $appointmentDetails['section'];


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
            margin: 10px 10px 10px 10px; /* Set the margin as per letter size */
            
        }

        .image-container img {
            height: 60;
            width: 60;
        }

        .header .text {
            text-align: center;
        }

        /* margin between image and text */
        .image-container {
            display: inline-block;
            margin-right: 75px;

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
            text-align: right;
        }
        .letter-body p {
            text-align: justify;
          
        }

        .indent {
            text-indent: 2em;
        }

    
        

        #current-date {
            font-weight: bold;
        }

        #year-level,
        #course,
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

    </style>
</head>
<body>

<div class="header">
    <div class="image-container">
        <img src="pup-logo.png" alt="pup-logo">
    </div>
    <div class="text">
        <p>Republic of the Philippines</p>
        <p>POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</p>
        <p>SANTA ROSA CAMPUS</p>
        
    </div>
  
    <div class="clearfix"></div>
    <hr>
</div>
        
    
    <div class="title">
        <h3>LETTER FOR SCHOOL FACILITY APPOINTMENT</h3>
    </div>
    
    <div class="date">
        <h4><span id="current-date">$currentTime</span></h4>
    </div>
    
    <div class="reciever">
        <p>
            <strong>Dr. Leny V. Salmingo</strong><br>
            Directress<br>
            PUP Santa Rosa Campus
        </p>
    </div>
    

    <br>
    <p>
        <strong>Dear Ma'am</strong>
    </p>

    <br>

    <div class="letter-body">

    <p>Greetings!</p>

        <p class="indent">
            We are <span id="year-level">$section</span> from <span id="course">$course</span> and we would like to ask permission to use the <span id="facility">$facilityName</span> to conduct <span id="reason">$purpose</span>. We will utilize it from <span id="start-date">$startDate</span> at <span id="start-time">$startTime</span> up to <span id="end-date">$endDate</span> at <span id="end-time">$endTime</span>
        </p>
        <p class="indent">
            Safety and health protocols will be practiced and observed within the premises such as wearing facemasks, social distancing, providing alcohol, and maintaining cleanliness according to our campus policies. Any damages that might happen will be accounted for.<br>
        </p>
        <p class="indent">
            Thank you and we look forward to your favorable response.
        </p>
    </div>

    <div class="sender">
        <p>
            Respectfully,<br><br><br>

            <span id="representative-name" style="text-decoration: none;">$firstName $lastName</span><br>
            <span id="representative-year-section"></span> Representative
        </p>
    </div>

    <br><br><br><br>
    
    <div class="footer">
        <p>

        <strong>Dr. Leny V. Salmingo</strong><br>
            Campus Director<br>
            HAP
        </p>
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
$directoryPath = 'C:/xampp/htdocs/student/administrative/appointment-letter/';
$filePath = $directoryPath . $fileName;
file_put_contents($filePath, $dompdf->output());

// Output the PDF to the browser
$dompdf->stream("letter.pdf", ["Attachment" => false]);
?>

