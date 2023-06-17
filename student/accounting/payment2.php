<!-- INSERT PHP SECTION -->
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payment_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form inputs
    $course = isset($_POST['course']) ? $_POST['course'] : '';
    $documentType = isset($_POST['documentType']) ? $_POST['documentType'] : '';
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : '';
    $surname = isset($_POST['surname']) ? $_POST['surname'] : '';
    $studentNumber = isset($_POST['studentNumber']) ? $_POST['studentNumber'] : '';
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
    $referenceNumber = isset($_POST['referenceNumber']) ? $_POST['referenceNumber'] : '';

    // Set the session variables
    $_SESSION['course'] = $course;
    $_SESSION['documentType'] = $documentType;
    $_SESSION['firstname'] = $firstname;
    $_SESSION['middlename'] = $middlename;
    $_SESSION['surname'] = $surname;
    $_SESSION['studentNumber'] = $studentNumber;
    $_SESSION['amount'] = $amount;
    $_SESSION['referenceNumber'] = $referenceNumber;
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
    <link rel="stylesheet" href="css/payment2.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Start of navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-maroon p-3">
        <div class="container-fluid">
            <img class="p-2" src="images/puplogo.png" alt="PUP Logo" width="40">
            <a class="navbar-brand" href="#"><strong>PUPSRC-OTMS</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto order-2 order-lg-1">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="officeServicesDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
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
                        <a class="nav-link dropdown-toggle" href="#" id="officeServicesDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
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
                            <input class="form-control me-2" type="search" placeholder="Search for services..."
                                aria-label="Search">
                            <button class="btn btn-warning" type="submit"><strong>Search</strong></button>
                        </form>
                    </div>
                    <li class="nav-item dropdown order-1 order-lg-2">
                        <a class="nav-link dropdown-toggle" href="#" id="userProfileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
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
        <div class="container-fluid-form">
            <form id="studentForm" method="post" class="row g-3 needs-validation" novalidate>

                

                <div class="col-12 payment-summary">
                    <?php
                    // Check if session variables are set and display the summary
                    if (isset($_SESSION['course']) && isset($_SESSION['documentType']) && isset($_SESSION['firstname']) && isset($_SESSION['middlename']) && isset($_SESSION['surname']) && isset($_SESSION['studentNumber']) && isset($_SESSION['amount']) && isset($_SESSION['referenceNumber'])) {
                        // Get the form inputs
                        $course = $_SESSION['course'];
                        $documentType = $_SESSION['documentType'];
                        $firstname = $_SESSION['firstname'];
                        $middlename = $_SESSION['middlename'];
                        $surname = $_SESSION['surname'];
                        $studentNumber = $_SESSION['studentNumber'];
                        $amount = $_SESSION['amount'];
                        $referenceNumber = $_SESSION['referenceNumber'];

                        // Get the current date
                        $date = date('F j, Y');

                        // Display the summary of the inputs
                        echo "<h1>Transaction Summary</h1>";
                        echo "<p><strong>Course:</strong> $course</p>";
                        echo "<p><strong>Document Type:</strong> $documentType</p>";
                        echo "<p><strong>First Name:</strong> $firstname</p>";
                        echo "<p><strong>Middle Name:</strong> $middlename</p>";
                        echo "<p><strong>Last Name:</strong> $surname</p>";
                        echo "<p><strong>Student Number:</strong> $studentNumber</p>";
                        echo "<p><strong>Amount:</strong> $amount</p>";
                        echo "<p><strong>Reference Number:</strong> $referenceNumber</p>";
                        echo "<p><strong>Date:</strong> $date</p>";
                    } else {
                        echo "<h1>Error</h1>";
                        echo "<p>Payment details not found.</p>";
                    }
                    ?>
                </div>


                <div class="col-12">
                    <a class="btn btn-primary next-button" href="index.php" type="submit">Accounting Office</a>
                </div>

            </form>
        </div>

        <script src="#"></script>
    </div>
</body>
</html>
