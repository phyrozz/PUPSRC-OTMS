<?php
session_start();
$servername = "localhost";
$username =  "root";
$password = "";
$dbname =  "accountingdb";

$conn = new mysqli ($servername,$username,$password,$dbname);
if ($conn->connect_error){
    die("connection failed".$conn->connect_error);
}
//start of account verification
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $student_number = $_POST["student_number"];
    $birthDate = $_POST["birthDate"];

    $sql = "SELECT * FROM accountingtb WHERE first_name = '$first_name' && last_name = '$last_name' && student_number = '$student_number' && birthDate = '$birthDate'";

    $result = $conn->query($sql);
if ($result->num_rows == 1) {
    echo "<div class='custom-alert' id='custom-alert'>
    <div class='custom-alert-message'>Account successfully validated!</div>
    <button class='custom-alert-close' onclick='redirectToOffsetting2()'>Next</button>
  </div>";
echo "<script>
    document.getElementById('custom-alert').style.display = 'block';
    function redirectToOffsetting2() {
        window.location.href = 'offsetting2.php';
    }
  </script>";
} elseif ($result->num_rows == 0) {
    echo "<div class='custom-alert' id='custom-alert'>
            <div class='custom-alert-message'>No matching account found</div>
            <button class='custom-alert-close' onclick='closeAlert()'>Close</button>
          </div>";
    echo "<script>
            document.getElementById('custom-alert').style.display = 'block';
            setTimeout(closeAlert, ); // Automatically close the alert after 3 seconds
          </script>";
} else {
    die("Database error");
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounting Office - Landing Page</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/offsetting1.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

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
                            Offsetting
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="officeServicesDropdown">
                            <li><a class="dropdown-item" href="#">Payment</a></li>
                            <li><a class="dropdown-item" href="#">Transaction History</a></li>
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
                <li class="breadcrumb-item active" aria-current="page">Offsetting</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid text-center p-4">
        <!--Start of content-->
        <h1>Account Verification</h1>
        <p> Verify Your Account to Proceed to the Next Step</p>
    </div>
    <div class="container-fluid-form">
        <form action="" id="studentForm" method="post" class="row g-3 needs-validation">
            <div class="col-md-6">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" onkeydown="restrictName(event)"class="form-control" id="firstName" name="first_name"required maxlength="50">
                <div class="invalid-feedback">
                    Please provide a first name.
                </div>
            </div>
            <div class="col-md-6">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" onkeydown="restrictName(event)"class="form-control" id="lastName" name="last_name"required maxlength="50">
                <div class="invalid-feedback">
                    Please provide a last name.
                </div>
            </div>
            <div class="col-md-6">
                <label for="studentNumber" class="form-label">Student Number</label>
                <input type="text" class="form-control" id="studentNumber"name="student_number" required maxlength="15">
                <div class="invalid-feedback">
                    Please provide a student number.
                </div>
            </div>
            <div class="col-md-6">
                <label for="birthdate" class="form-label">Birth Date</label>
                <input type="date" class="form-control" id="birthdate"name="birthDate" required>
                <div class="invalid-feedback">
                    Please provide a birth date.
                </div>
            </div>
            <div class="col-12">
            <a class ="btn btn-primary back-button" href="index.php">Back</a>
                <button class="btn btn-primary next-button" type="submit"onclick="validateForm(event)">Next</button>
            </div>
        </form>
    </div>
    </div>
    <script src="js/offsetting_script.js"></script>
</body>
</html>