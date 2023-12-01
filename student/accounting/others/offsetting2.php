<?php
/*IN PROGRESS (waiting for database)
session_start();
$servername = "192.168.84.183";
$username =  "root";
$password = "";
$dbname =  "accountingdb";

$conn = new mysqli ($servername,$username,$password,$dbname);
if ($conn->connect_error){
    die("connection failed".$conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tuitionFee = $_POST["tuitionFee"];
    $amountToOffset = $_POST["amountToOffset"];

    $sql = "UPDATE accountingtb SET tuitionFee = tuitionFee - ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $amountToOffset, $tuitionFee);

    if ($stmt->execute()) {
        echo "<script>alert('Offset successful!'); window.location.href='transaction.php';</script>";
        exit;
    } else {
        echo "Error: " . $stmt->error;
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
    <link rel="stylesheet" href="css/offsetting2.css">
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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="../index.php">Accounting Services Office</a></li>
                <li class="breadcrumb-item active" aria-current="page">Offsetting</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid text-center p-4">
        <h1>Offsetting</h1>
    </div>
    <form action="" id="student-offset"method="post">
    <div class="container-fluid-form">
        <h2>Select type of offset</h2>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="offsetType" class="form-label">Offset Type</label>
                <select class="form-select" id="offsetType" required>
                    <option value="" selected disabled>Select an option</option>
                    <option value="$tuitionFee" name="tuitionFee">Tuition Fee</option>
                    <option value="miscellaneous">Miscellaneous Fee</option>
                </select>
                <div class="invalid-feedback">
                    Please select an offset type.
                </div>
            </div>
            <div class="col-md-7">
                <label for="amountToOffset" class="form-label2">Amount to be offset:</label>
                <input type="number" class="form-control" id="amountToOffset"name="amountToOffset" required>
                <div class="invalid-feedback">
                    Please provide the amount to be offset.
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
    </div>
    </form>
    <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">
                                <i class="fa-regular fa-circle-info fa-lg"></i> Reminder
                            </h4>
                            <p>Once you click the "Submit" button, your request to offset your account tuition will be securely forwarded to the relevant department for processing.</p>
                            <p>The confirmation of your request (whether approved or disapproved) will be provided, ensuring that you receive timely updates regarding the status of your tuition offsetting request.</p>
                            <p>We prioritize the confidentiality of your money-related information and remain committed to providing a secure and reliable experience for all our users.</p>
    </div>
    <div id="popup" class="popup">
  <h3>Success!</h3>
  <p>Your request is being processed!<br>please wait for the confirmation of the admin.</p>
  <button id="okbutton" class="okbutton">OK</button>
</div>
    <script src="js/script.js"></script>
</body>
</html>