


<!-- INSERT PHP SECTION -->
<?php
session_start();
include 'admin/db_connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the input values from the form
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $studentNumber = $_POST['studentNumber'];
  $amount = $_POST['amount'];
  $course = $_POST['course'];
  $documentType = $_POST['documentType'];
  
  // Store the input values in session storage
  $_SESSION['name'] = $name;
  $_SESSION['surname'] = $surname;
  $_SESSION['studentNumber'] = $studentNumber;
  $_SESSION['amount'] = $amount;
  $_SESSION['course'] = $course;
  $_SESSION['documentType'] = $documentType;
  
  // Redirect to payment2.php
  header('Location: payment2.php');
  exit;
}

// Retrieve the input values from session storage if available
$name = $_SESSION['name'] ?? '';
$surname = $_SESSION['surname'] ?? '';
$studentNumber = $_SESSION['studentNumber'] ?? '';
$amount = $_SESSION['amount'] ?? '';
$course = $_SESSION['course'] ?? '';
$documentType = $_SESSION['documentType'] ?? '';
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
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>    
</head>
<body>
    <!-- Start of navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-maroon p-3">
        <div class="container-fluid">
            <img class="p-2" src="images/puplogo.png" alt="PUP Logo" width="40">
            <a class="navbar-brand" href="#"><strong>PUPSRC-OTMS</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto order-2 order-lg-1">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="officeServicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Accounting Services Office
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="officeServicesDropdown">
                            <li><a class="dropdown-item" href="#">Registration</a></li>
                            <li><a class="dropdown-item" href="../guidance.php">Guidance</a></li>
                            <li><a class="dropdown-item" href="#">Academic</a></li>
                            <li><a class="dropdown-item" href="index.php">Accounting</a></li>
                            <li><a class="dropdown-item" href="#">Administration</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="officeServicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Payments
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="officeServicesDropdown">
                            <li><a class="dropdown-item" href="offsetting1.php">Offsetting</a></li>
                            <li><a class="dropdown-item" href="transactions.php">Transaction History</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav order-3 order-lg-3 w-50 gap-3">
                    <div class="d-flex navbar-nav justify-content-center me-auto order-2 order-lg-1 w-100">
                        <form class="d-flex w-100">
                            <input class="form-control me-2" type="search" placeholder="Search for services..." aria-label="Search">
                            <button class="btn btn-warning" type="submit"><strong>Search</strong></button>
                        </form>
                    </div>
                    <li class="nav-item dropdown order-1 order-lg-2">
                        <a class="nav-link dropdown-toggle" href="#" id="userProfileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user-circle me-1"></i>
                            Juan Dela Cruz
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userProfileDropdown">
                            <li><a class="dropdown-item" href="#">Account Settings</a></li>
                            <li><a class="dropdown-item" href="#">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of navbar -->

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
<h1>SEND PAYMENTS</h1>
<p>Input the following details below.</p>
<div class="container-fluid-form">
  <form id="studentForm" method="post" class="row g-3 needs-validation" novalidate>
  <br>
  <br>
  <br>
  <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="course" class="form-label">Course</label>
          <select class="form-select" id="course" name="course" required>
            <option value="">Select Course</option>
            <option value="Course 1" <?php if ($course === 'Course 1') echo 'selected'; ?>>Course 1</option>
            <option value="Course 2" <?php if ($course === 'Course 2') echo 'selected'; ?>>Course 2</option>
            <option value="Course 3" <?php if ($course === 'Course 3') echo 'selected'; ?>>Course 3</option>
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
          <select class="form-select" id="documentType" name="documentType" required>
            <option value="">Select Document Type</option>
            <option value="Document 1" <?php if ($documentType === 'Document 1') echo 'selected'; ?>>Document 1</option>
            <option value="Document 2" <?php if ($documentType === 'Document 2') echo 'selected'; ?>>Document 2</option>
            <option value="Document 3" <?php if ($documentType === 'Document 3') echo 'selected'; ?>>Document 3</option>
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
      <input type="text" onkeydown="restrictName(event)" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
      <div class="invalid-feedback">
        Please provide your name.
      </div>
    </div>

    <div class="col-md-6">
      <label for="surname" class="form-label">Surname</label>
      <input type="text" onkeydown="restrictName(event)" class="form-control" id="surname" name="surname" value="<?php echo $surname; ?>" required>
      <div class="invalid-feedback">
        Please provide your surname.
      </div>
    </div>

    <div class="col-md-6">
      <label for="studentNumber" class="form-label">Student Number</label>
      <input type="text" oninput="restrictInput(event)" class="form-control" id="studentNumber" name="studentNumber" value="<?php echo $studentNumber; ?>" required>
      <div class="invalid-feedback">
        Please provide a student number.
      </div>
    </div>

    <div class="col-md-6">
      <label for="amount" class="form-label">Amount</label>
      <input type="number" oninput="restrictInput(event)" class="form-control" id="amount" name="amount" value="<?php echo $amount; ?>" required>
      <div class="invalid-feedback">
        Please provide the amount.
      </div>
    </div>

 

    <div class="col-12">
      <a class="btn btn-primary back-button" href="index.php">Back</a>
      <!--<button class="btn btn-primary next-button" type="submit">Next</button>-->
      <a class="btn btn-primary next-button" href="payment2.php" onclick="return validateForm();" type="submit">Next</a>
    </div>

    
  </form>
</div>

<button type="submit">Next</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/script.js"></script>


</body>
</html>