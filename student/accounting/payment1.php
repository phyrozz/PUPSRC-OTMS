<?php
session_start();
$servername = "localhost";
$username =  "root";
$password = "";
$dbname =  "payment_db";

$conn = new mysqli ($servername,$username,$password,$dbname);
if ($conn->connect_error){
    die("connection failed".$conn->connect_error);
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


  $sql = "INSERT INTO student_info (course, documentType, firstname, middlename, surname, studentNumber, amount) VALUES ('$course', '$documentType', '$firstname', '$middlename', '$surname', '$studentNumber', '$amount')";

  if ($conn->query($sql) == TRUE) {
      header("location: payment2.php");
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
    <title>Accounting Office - Landing Page</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/payment1.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>    
</head>
<body>
  <?php include "../navbar.php"; ?>
    <div class="container-fluid p-4">
        <nav class="breadcrumb-nav" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php">Accounting Services Office</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payments</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid text-center p-4">






<!--Start of content-->
<h1>PAYMENT INFORMATION</h1>
<br> <br> <br>
<div class="container-fluid-form">
<form action="" id="" method="post" class="row g-3 needs-validation" autocomplete="off">
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
        Please provide your surname.
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
      <input type="text" class="form-control" id="studentNumber" name="studentNumber" value="" required oninput="this.value = this.value.slice(0, 15).toUpperCase().replace(/[^A-Z0-9-]/g, '')">
      <div class="invalid-feedback">
        Please provide a student number.
      </div>
    </div>

    <div class="col-md-6">
      <label for="amount" class="form-label">Amount</label>
      <input type="number" class="form-control" id="amount" name="amount" value="" required oninput="this.value = this.value.slice(0, 6)">
      <div class="invalid-feedback">
        Please provide the amount.
      </div>
    </div>

  

    <div class="col-12">
      <a class="btn btn-primary back-button" href="index.php">Back</a>
      <!--<button class="btn btn-primary next-button" type="submit">Next</button>-->
      <input style="margin-top: 0px; height: 35px; font-size: 15px" class="btn btn-primary" type="submit" name="submit"/>
    </div>

  </form>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/script.js"></script>


</body>
</html>