<?php

require "../../vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

// Set the paper size to A4 and orientation to portrait
$dompdf->setPaper('A4', 'portrait');

$html = <<<HTML
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
        <h4><span id="current-date">April 27, 2023</span></h4>
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
            We are <span id="year-level">3rd Year</span> from <span id="course">BSIT</span> and we would like to ask permission to use the <span id="facility">Audio Visual Room</span> for <span id="reason">a seminar</span>. We will utilize it from <span id="start-date">July 27, 2023</span> at <span id="start-time">1:00 PM</span> up to <span id="end-date">July 24, 2023</span> at <span id="end-time">10:00 PM</span>
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

            <span id="representative-name" style="text-decoration: none;">Juan Dela Cruz</span><br>
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
HTML;

$dompdf->loadHtml($html);

$dompdf->render();

// Output the PDF to the browser
$dompdf->stream("letter.pdf", ["Attachment" => false]);
?>

