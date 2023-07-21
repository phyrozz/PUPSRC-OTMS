<?php

require "../../vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

include "../../conn.php";

session_start();

$requestId = $_SESSION['request_id'];

$currentDate = new DateTime("now", new DateTimeZone("Asia/Manila"));
$currentTime = $currentDate->format("F j, Y ");

// Query to retrieve user data
$userQuery = "SELECT last_name, first_name, middle_name, extension_name FROM users WHERE user_id = ?";
$userStmt = $connection->prepare($userQuery);
$userStmt->bind_param("i", $_SESSION['user_id']);
$userStmt->execute();
$result = $userStmt->get_result();
$userResult = $result->fetch_assoc();
$firstName = $userResult['first_name'];
$lastName = $userResult['last_name'];
$middleName = $userResult['middle_name'];
$extensionName = $userResult['extension_name'];


    // Close the prepared statement
$userStmt->close();


// Retrieve the facility name and facility number from the database based on the facility ID
$requestStmt = $connection->prepare("SELECT purpose FROM doc_requests WHERE request_id = ?");
$requestStmt->bind_param("s", $requestId);
$requestStmt->execute();
$requestResult = $requestStmt->get_result();
$requestRow = $requestResult->fetch_assoc();
$purpose = $requestRow['purpose'];

// Close the prepared statement
$requestStmt->close();

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
        

        .image-container img {
            height: 70;
            width: 70;
        }



        /* margin between image and text */
        .image-container {
            display: inline-block;
            margin-right: 14px;
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
            text-align: left;
        }

        .letter-body p {
            text-align: justify;
            margin
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

        .container-margin {
            margin-left: 46px;
            margin-right: 46px;
        }

        .footer-content {
            position: relative;
            
            
        }
        
          .footer-image {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
          }
        
          .footer-image img {
            margin-top: 15px;
            height: 140px;
            width: auto;

          }
        
          .footer-text {
            padding-right: 20px; /* Adjust the padding as needed */
          }
        
          .footer-text p {
            font-size: 12px;
            margin-bottom: 10px; /* Adjust the margin as needed */
          }
        
          .footer-text p:last-child {
            margin-bottom: 0;
          }
        
          .footer-text p.footer-title {
            font-size: 18px;
          }
        
    </style>
</head>
<body>
    <div class="header">
        <div class="image-container">
            <img src="pup-logo.png" alt="pup-logo">
        </div>
        <div class="text">
            <p style="font-size: 13px; margin-bottom: 0;">Republic of the Philippines</p>
            <strong>POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</strong><br>
            OFFICE OF THE VICE PRESIDENT FOR BRANCHES AND CAMPUSES<br>
            <strong>SANTA ROSA CAMPUS</strong>
        </div>
        <div class="clearfix"></div>
        <hr>
    </div>

<div class="container-margin">


    <div class="date">
        <h4><span id="current-date">$currentTime</span></h4>
    </div>

    <div class="reciever">
        <p>
            <strong>DR. GILFRED A. ACIERTO</strong><br>
            <em>Head, Guidance Office</em>
            <br>
            This Campus
        </p>
    </div>

    <br>
    <p>
        <strong>Dear Sir:</strong>
    </p>


    <div class="letter-body">
        <p>Greetings in pursuit of wisdom!</p>

        <p class="indent">
            I hope this letter finds you in good health and high spirits. I am writing to request a copy of my Good Moral Certificate for $purpose. I kindly request you to issue the certificate at your earliest convenience. If there are any fees or formalities associated with this request, please inform me, and I will gladly comply.
        </p>

        <p>Please find attached a copy of my identification and any other required documents to facilitate the process. Hoping for your kind consideration.</p>

        <br>

        <p>Respectfully Yours,</p>

        <br>

        <div class="sender">
            <p>
                <strong>$lastName, $firstName $middleName $extensionName</strong><br>
                <span id="representative-year-section"></span> Representative
            </p>
        </div>
    </div>

    <div class="footer">
        <p>
            Noted by:<br><br><br>
            <strong>Asst. Prof. Leny V. Salmingo Ph.D</strong><br>
            Subject Facilitator<br>
            This Campus
        </p>
    </div>

    <br><br>

    <footer>
        <div class="footer-content">
            <div class="footer-text">   
            <p style="font-size: 12px;">PUP LCA Boulevard, Brgy. Tagapo, City of Santa Rosa, Laguna<br>
                Direct Line: 0961-8023780<br>
                Website: <a href="https://pupsrc101.school.blog/">https://pupsrc101.school.blog/</a> | Email: starosa@pup.edu<br>
            </p>
            </div>
            <div class="footer-image">
                <img src="iso-cert.png" alt="iso-img">
            </div>
        </div>
        <p style="font-size: 18px;">THE COUNTRY’S 1st POLYTECHNICU</p>
    </footer>
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

// Output the PDF to the browser
$dompdf->stream("request_letter-good_moral.pdf", ["Attachment" => false]);
?>

