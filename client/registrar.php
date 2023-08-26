<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Office - Welcome</title>
  <!-- <link rel="icon" type="image/x-icon" href="../../">
	<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./registrar/css/style.css"> -->
  <!-- <link rel="stylesheet" href="./registrar/css/bg.css"> -->
  <!-- <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
	<script src="../node_modules/jquery/dist/jquery.min.js"></script>
	<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style.css">
  <!-- Loading page -->
  <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
  <div id="loader" class="center">
    <div class="loading-spinner"></div>
    <p class="loading-text display-3 pt-3">Getting things ready...</p>
  </div>
  <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
  <script src="../node_modules/jquery/dist/jquery.min.js"></script>
  <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="wrapper">
    <?php
            $office_name = "Registrar Office";
            include "navbar.php";
			include "../breadcrumb.php";
        ?>
    <div class="container-fluid registrarbanner header"
      style="background-image: url('./registrar/assets/registrar.jpg')">
      <a href="registrar/help.php" class="header-btn btn btn-primary position-absolute p-3 m-2 bottom-0 start-0">
        <i class="fa-regular fa-circle-question"></i>
        Help
      </a>
      <!-- <a href="#" class="header-btn btn btn-primary position-absolute p-3 m-2 bottom-0 start-0">Generate Inquiry</a>
            <a href="/student/transactions.php" class="header-btn btn btn-primary position-absolute p-3 m-2 bottom-0 end-0">Transactions</a> -->
      <?php
            $breadcrumbItems = [
                ['text' => 'Registrar Office', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, false);
            ?>
      <h1 class="display-1 header-text text-center text-light">Registrar Office</h1>
      <p class="header-text text-center text-light">Choose from one of the services below to get started</p>
    </div>
    <div class="container-fluid p-2 d-flex flex-wrap flex-column justify-content-center gap-2 text-center">
      <a href="./registrar/create_request.php"
        class="btn btn-primary d-block text-decoration-none bg-maroon text-light p-4 rounded">
        <h2>Create Request</h2>
        <p>Seeks the registrar office's help in requesting related to academic records</p>
      </a>
      <a href="transactions.php"
        class="btn btn-primary d-block text-decoration-none bg-maroon text-light p-4 rounded">
        <h2>Your Transactions</h2>
        <p>Status of current requests</p>
      </a>
    </div>
    <div class="push"></div>
  </div>
  <?php include '../footer.php'; ?>
  <script>
  $(document).ready(function() {
    $('.dropdown-submenu a.dropdown-toggle').on("click", function(e) {
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });
  });
  </script>
  <script src="../loading.js"></script>
  <script src="../saved_settings.js"></script>
</body>

</html>