<?php
$office_name = "Accounting Office";

$servername = "localhost";
$username =  "root";
$password = "";
$dbname =  "payment_db";

$conn = new mysqli ($servername,$username,$password,$dbname);
if ($conn->connect_error){
    die("connection failed".$conn->connect_error);
}
if (isset($_POST['submit'])) {
  // Retrieve form datah
  $referenceNumber = ($_POST['referenceNumber']);


  $sql = "INSERT INTO reference (referenceNumber) VALUES ('$referenceNumber')";

  if ($conn->query($sql) == TRUE) {

      header("location: payment3.php");
  } else {
      echo "Error inserting data: " . $conn->error;
  }

  $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accounting Office - Payments</title>
  <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/payment1.css">
  <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
  <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/style.css">
  <script src="/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script> 
</head>
<body>
    <?php
    include "../navbar.php"; 
    include '../../breadcrumb.php';
    ?>
    <div class="container-fluid p-4">
      <?php
      $breadcrumbItems = [
          ['text' => 'Accounting Office', 'url' => '../accounting.php', 'active' => false],
          ['text' => 'Payments', 'active' => true],
      ];

      echo generateBreadcrumb($breadcrumbItems, true);
      ?>
    </div>
    <div class="container-fluid text-center p-4">




    
<!--Start of content-->
<div class="container-fluid-form">
<form action="" id="" method="post" class="row g-3 needs-validation" autocomplete="off">
<div class="col-12">
      <h2>1. Scan QR Code</h2>
      <h2>2. Upload Screenshot of Payment</h2>
      <br>
      <p style="color: red;">Note: CASH PAYMENT receipts must also be uploaded.</p>
     
      <div class="upload-container">
      <label for="receiptImage" class="form-label">Upload Receipt</label>
      <input type="file" class="form-control upload-button" id="receiptImage" name="receiptImage" accept="image/*">
      <div class="invalid-feedback">
        Please upload a valid image file.
      </div>
      <div class="form-group">
        <label for="referenceNumber">Reference Number</label>
        <input type="text" class="form-control" id="" name="referenceNumber" required>
        <div class="invalid-feedback">
          Please enter a valid reference number.
        </div>
</div>


       
        <div class="row g-3">
           
            
        <div class="col-12">
          <br> <br>
      <a style="margin-right:50px;" class="btn btn-primary back-button" href="payment1.php">Back</a>
      <!--<button class="btn btn-primary next-button" type="submit">Next</button>-->
      <input style="margin-top: 0px; height: 35px; font-size: 15px;" class="btn btn-primary" type="submit" name="submit"/>
    </div>
        </div>
    </div>
    </form>
</div>

<div class="notification-popup" id="popup" style="display: none;">
  <h3>Image Uploaded!</h3>
  <p>Your image has been successfully uploaded.</p>
  <span class="close-button" onclick="hidePopup();">&times;</span>
</div>


<script src="js/script.js"></script>





</body>
</html>