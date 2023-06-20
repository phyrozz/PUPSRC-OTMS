<!-- INSERT PHP SECTION -->
<?php
$office_name = "Accounting Office";
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
    <link rel="stylesheet" href="/style.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
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
                    <a class="btn btn-primary next-button" href="../accounting.php" type="submit">Accounting Office</a>
                </div>

            </form>
        </div>

        <script src="#"></script>
    </div>
</body>
</html>
