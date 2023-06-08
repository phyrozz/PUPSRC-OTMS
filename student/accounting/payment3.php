<!-- INSERT PHP SECTION -->
<?php
$office_name = "Accounting Office";
include 'admin/db_connect.php';

// Execute a test query
$query = "SELECT 1";
$result = mysqli_query($conn, $query);

// Check for errors
if (!$result) {
    die("Database connection error: " . mysqli_error($conn));
} else {
    echo "Database connection successful!";
}

// Close the database connection
mysqli_close($conn);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounting Office - Landing Page</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/payment3.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>    
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
  <form id="studentForm" method="post" class="row g-3 needs-validation" novalidate>
    <div class="col-12">
      <h1>THANK YOU!</h1>
      <h3>Download Receipt</h3>
      <a class="btn btn-primary download-button" href="receipt.pdf" download>Download Receipt</a>
    </div>

    <div class="col-12">
      <a class="btn btn-primary back-button" href="payment2.php">Back</a>
      <!--<button class="btn btn-primary next-button" type="submit">Next</button>-->
      <a class="btn btn-primary next-button" href="index.php" type="submit">Home</a>
    </div>
  </form>
</div>

<script src="js/script.js"></script>






</body>
</html>