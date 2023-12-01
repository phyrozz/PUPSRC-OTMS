<?php
session_start();
if (!isset($_SESSION['page1_visited']) || !isset($_SESSION['page2_visited'])) {
    if (!isset($_SESSION['page1_visited'])) {
        header("Location: offsetting1.php");
    } else {
        header("Location: offsetting2.php");
    }
    exit;
}
unset($_SESSION['page1_visited']);
unset($_SESSION['page2_visited']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounting Office - successfully Submitted</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/offsetting2.css">
    <link rel="stylesheet" href="css/offsetting3.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <!-- Loading page -->
    <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
    <div id="loader" class="center">
        <div class="loading-spinner"></div>
        <p class="loading-text display-3 pt-3">Getting things ready...</p>
    </div>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script> 
</head>
<body>
    <?php
    $office_name = "Accounting Office";
    @include '../navbar.php';
    include '../../breadcrumb.php';
    ?>
    <div class="container-fluid p-4">
        <?php
        $breadcrumbItems = [
            ['text' => 'Accounting Office', 'url' => '../accounting.php', 'active' => false],
            ['text' => 'Offsetting', 'active' => true],
        ];

        echo generateBreadcrumb($breadcrumbItems, true);
        ?>
    </div>
    <center>
   <div class="card1">
    <h1>The request has been successfully submitted</h1>
    <h3>Your request has been received and will be processed by the administrative office. Kindly check your transaction history for updates.</h3>
    <br> <br>
    <a class="btn btn-warning" href="../accounting.php" name="back"><strong>BACK TO HOME</strong></a>

    </div>
</center>
    <script src="js/offsetting_script.js"></script>
    <script src="../../saved_settings.js"></script>
    <script src="../../loading.js"></script>
</body>
</html>