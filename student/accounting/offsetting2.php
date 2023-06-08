<?php
$office_name = "Accounting Office";

$servername = "localhost";
$username =  "root";
$password = "";
$dbname =  "accountingdb";

$conn = new mysqli ($servername,$username,$password,$dbname);
if ($conn->connect_error){
    die("connection failed".$conn->connect_error);
}
if (isset($_POST['submit'])) {
    // Retrieve form data
    $amountToOffset = $_POST['amountToOffset'];
    $offsetType = $_POST['offsetType'];


    $sql = "INSERT INTO offsettingtb (amountToOffset, offsetType)
    VALUES ('$amountToOffset', '$offsetType')";

    if ($conn->query($sql) === TRUE) {
        header("location:offsetting3.php");
    } else {
        echo "Error inserting data: " . $conn->error;
    }

    $conn->close();
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
    <link rel="stylesheet" href="css/offsetting2.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
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
            ['text' => 'Offsetting', 'active' => true],
        ];

        echo generateBreadcrumb($breadcrumbItems, true);
        ?>
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
                <select class="form-select" id="offsetType"name="offsetType" required>
                    <option value="" selected disabled>Select an option</option>
                    <option value="tuitionFee" >Tuition Fee</option>
                    <option value="miscellaneous">Miscellaneous Fee</option>
                </select>
                <div class="invalid-feedback">
                    Please select an offset type.
                </div>
            </div>
            <div class="col-md-7">
                <label for="amountToOffset" class="form-label2">Amount to be offset:</label>
                <input type="number" class="form-control" id="amountToOffset"name="amountToOffset" pattern="^\d{0,6}(\.\d{0,2})?$" step="any"required>
                <div class="invalid-feedback">
                    Please provide the amount to be offset.
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            </div>
        </div>
    </div>
    </form>
    <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">
                                <i class="fa-solid fa-circle-info"></i> Reminder
                                </h4>
                                <p>Once you click the "Submit" button, your request to offset your account tuition will be securely forwarded to the relevant department for processing.</p>
                            <p>The confirmation of your request (whether approved or disapproved) will be provided, ensuring that you receive timely updates regarding the status of your tuition offsetting request.</p>
                            <p>We prioritize the confidentiality of your money-related information and remain committed to providing a secure and reliable experience for all our users.</p>
                            </div>
    <script src="js/offsetting_script.js"></script>
</body>
</html>