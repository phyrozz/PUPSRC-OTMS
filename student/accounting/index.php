<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounting Services Office - Landing Page</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/others/style.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
        $office_name = "Accounting Office";
        include "../../navbar.php";
    ?>
    <div class="container-fluid p-4">
        <nav class="breadcrumb-nav" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../home.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="">Accounting Services Office</a></li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid text-center p-4">
        <h1></h1>
    </div>
      <ul class="button-container">
        <li><a class="button" href="payment1.php">Payment</a></li>
        <li><a class="button" href="others/offsetting1.php">Offsetting</a></li>
        <li><a class="button" href="../transactions.php">Transaction History</a></li>
        </ul>
        <script src="js/script.js"></script>
</body>
</html>