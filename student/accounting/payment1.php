<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payment_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['submit'])) {
    // Retrieve form data
    $course = ($_POST['course']);
    $documentType = ($_POST['documentType']);
    $firstname = ($_POST['firstname']);
    $middlename = ($_POST['middlename']);
    $surname = ($_POST['surname']);
    $studentNumber = ($_POST['studentNumber']);
    $amount = ($_POST['amount']);
    $referenceNumber = ($_POST['referenceNumber']);


    $sql = "INSERT INTO student_info (course, documentType, firstname, middlename, surname, studentNumber, amount, referenceNumber) 
            VALUES ('$course', '$documentType', '$firstname', '$middlename', '$surname', '$studentNumber', '$amount', '$referenceNumber')";

    if ($conn->query($sql) === TRUE) {
        header("location: payment2.php");
        exit(); // Add an exit after the header redirect to stop executing the remaining code
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
    <link rel="stylesheet" href="css/payment1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <?php
    include '../navbar.php';
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
<h1>STUDENT PAYMENT INFORMATION</h1>
<br>


<div class="qr-container">
  <form action="" id="" method="post" class="row g-3 needs-validation" autocomplete="off">
    <div class="col-12 col-md-6">
      <h2>1. Scan QR Code</h2>
      <h2>2. Upload Screenshot of Payment</h2>
      <p style="color: red;">Note: CASH PAYMENT receipts must also be uploaded.</p>
      <div class="upload-container">
        <label for="receiptImage" class="form-label">Upload Receipt</label>
        <input type="file" class="form-control upload-button" id="receiptImage" name="receiptImage" accept="image/*">
        <div class="invalid-feedback">
          Please upload a valid image file.
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 qr-text">
      <div class="qr-details">
        <p>GCash_Receiver_Name</p>
        <p>012-345-6789</p>
      </div>
      <img src="images/qr.png" alt="QR Code" class="qr-image">
    </div>
  </form>
</div>





<br><br>

<div class="container-fluid-form">
<form action="" id="" method="post" class="row g-3 needs-validation" autocomplete="off">
<br>
<br>
<div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="course" class="form-label">Course</label>
          <select class="form-select" id="" name="course" required>
            <option value="">Select Course</option>
            <option value="Course 1" >Course 1</option>
            <option value="Course 2" >Course 2</option>
            <option value="Course 3" >Course 3</option>
            <!-- Add more options as needed -->
          </select>
          <div class="invalid-feedback">
            Please select a course.
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="documentType" class="form-label">Document Type</label>
          <select class="form-select" id="" name="documentType" required>
            <option value="">Select Document Type</option>
            <option value="Document 1">Document 1</option>
            <option value="Document 2">Document 2</option>
            <option value="Document 3">Document 3</option>
            <!-- Add more options as needed -->
          </select>
          <div class="invalid-feedback">
            Please select a document type.
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="" name="firstname" value="" pattern="^[A-Za-z\s]+$" oninput="this.value = this.value.slice(0, 50)" required>
      <div class="invalid-feedback">
        Please provide your name.
      </div>
    </div>


    <div class="col-md-6">
      <label for="middlename" class="form-label">Middle Name</label>
      <input type="text" class="form-control" id="" name="middlename" value="" pattern="^[A-Za-z\s]+$" oninput="this.value = this.value.slice(0, 50)" required>
      <div class="invalid-feedback">
        Please provide your middle name.
      </div>
    </div>

    <div class="col-md-6">
      <label for="surname" class="form-label">Surname</label>
      <input type="text" class="form-control" id="" name="surname" value="" pattern="^[A-Za-z\s]+$" oninput="this.value = this.value.slice(0, 50)" required> 
      <div class="invalid-feedback">
        Please provide your surname.
      </div>
    </div>

    <div class="col-md-6">
      <label for="studentNumber" class="form-label">Student Number</label>
      <input type="text" class="form-control" id="studentNumber" name="studentNumber" value="" required oninput="validateStudentNumber(this)" maxlength="15">
      <div class="invalid-feedback">
        Please provide a valid student number with exactly 15 characters.
      </div>
    </div>

    <div class="col-md-6">
      <label for="amount" class="form-label">Amount</label>
      <input type="text" class="form-control" id="amount" name="amount" value="" required oninput="validateAmount(this)">
      <div class="invalid-feedback">
        Please provide a valid amount.
      </div>
    </div>
    <div class="col-md-6">
      <label for="referenceNumber" class="form-label">Reference Number</label>
      <input type="text" class="form-control" id="" name="referenceNumber" value="" required oninput="validateReferenceNumber(this)">
      <div class="invalid-feedback">
        Please provide the reference number.
      </div>
    </div>

    <br>
    <div class="d-flex justify-content-between">
        <a class="btn btn-primary back-button" href="../accounting.php">Back</a>
        <input style="margin-top: 0px; height: 35px; font-size: 15px" class="btn btn-primary" type="submit" name="submit"/>

      </div>


  </form>
</div>







<script>
function validateStudentNumber(input) {
  var value = input.value.toUpperCase().replace(/[^A-Z0-9-]/g, '');
  input.value = value.slice(0, 15);
  input.setCustomValidity(value.length === 15 ? '' : 'Please provide a valid student number in this format: XXXX-XXXXX-SR-X.');
}

function validateAmount(input) {
  var value = input.value;
  value = value.replace(/[^0-9.]/g, ''); // Remove any non-digit and non-decimal point characters
  value = value.slice(0, 9); // Limit the input to a maximum of 7 characters (6 digits + 1 decimal point)
  input.value = value;

  var regex = /^\d{0,6}(\.\d{0,2})?$/; // Regex pattern to validate input with up to 6 digits and 2 decimal places
  if (!regex.test(input.value)) {
    input.setCustomValidity('Please provide a valid amount with up to 6 digits and 2 decimal places.');
  } else {
    input.setCustomValidity('');
  }
}

function validateReferenceNumber(input) {
  var value = input.value;
  var maxLength = 20; // Maximum allowed characters

  if (value.length > maxLength) {
    input.value = value.slice(0, maxLength); // Truncate the input value to the maximum length
  }

  var regex = /^[0-9]+$/; // Regex pattern to validate numeric input

  if (!regex.test(input.value)) {
    input.setCustomValidity('Please provide a valid reference number containing only numbers.');
  } else if (input.value.length !== maxLength) {
    input.setCustomValidity('Please provide a reference number with exactly 20 characters.');
  } else {
    input.setCustomValidity('');
  }
}







</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/paymentscript.js"></script>


</body>
</html>