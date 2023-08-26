<?php
/*session_start();
$servername = "192.168.84.183";
$username =  "root";
$password = "";
$dbname =  "accountingdb";

$conn = new mysqli ($servername,$username,$password,$dbname);
if ($conn->connect_error){
    die("connection failed".$conn->connect_error);
}
$error="";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $studentNumber = $_POST["studentNumber"];
    $date = $_POST["date"];

    $sql = "SELECT * FROM accountingtb WHERE firstName = '$firstName' && lastName = '$lastName' && studentNumber = '$studentNumber' && date = '$date'";

    $result = $conn->query($sql);
    if($result->num_rows==1){
        header("location:offsetting2.php");
    }
    else{
        $error = "invalid Input";
    }
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounting Office - Landing Page</title>
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/offsetting1.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
        $office_name = "Accounting Office";
        include "../../navbar.php";
    ?>
    <div class="container-fluid p-4">
        <nav class="breadcrumb-nav" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../home.php">Home</a></li>
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
        <form id="studentForm" method="post" class="row g-3 needs-validation" novalidate>
            <div class="col-md-6">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" onkeydown="restrictName(event)"class="form-control" id="firstName" name="firstName"required>
                <div class="invalid-feedback">
                    Please provide a first name.
                </div>
            </div>
            <div class="col-md-6">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" onkeydown="restrictName(event)"class="form-control" id="lastName" name="lastName"required>
                <div class="invalid-feedback">
                    Please provide a last name.
                </div>
            </div>
            <div class="col-md-6">
                <label for="studentNumber" class="form-label">Student Number</label>
                <input type="number" oninput="restrictInput(this)" class="form-control" id="studentNumber"name="studentNumber" required>
                <div class="invalid-feedback">
                    Please provide a student number.
                </div>
            </div>
            <div class="col-md-6">
                <label for="birthdate" class="form-label">Birth Date</label>
                <input type="date" class="form-control" id="birthdate"name="date" required>
                <div class="invalid-feedback">
                    Please provide a birth date.
                </div>
            </div>
            <div class="col-12">
            <a class ="btn btn-primary back-button" href="../index.php">Back</a>
                <!--<button class="btn btn-primary next-button" type="submit">Next</button>-->
                <a class="btn btn-primary next-button" href="offsetting2.php"type="submit">Next</a>
            </div>
        </form>
    </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>