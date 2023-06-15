<?php
$office_name = "Accounting Office";
include 'verification.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounting Office - Offsetting</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/payment1.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script> 

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
                <input type="text" onkeypress="return blockSpecialChar(event)"class="form-control" id="studentNumber"name="student_no" required maxlength="15">
                <div class="invalid-feedback">
                    Please provide a student number.
                </div>
            </div>
            <div class="col-md-6">
                <label for="birthdate" class="form-label">Birth Date</label>
                <input type="date" class="form-control" id="birthdate"name="birth_date" required>
                <div class="invalid-feedback">
                    Please provide a birth date.
                </div>
            </div>
            <div class="col-12">
            <a class ="btn btn-primary back-button" href="../accounting.php">Back</a>
                <button class="btn btn-primary next-button" type="submit"onclick="validateForm(event)">Next</button>
            </div>
        </form>
    </div>
    </div>
    <script src="js/offsetting_script.js"></script>
</body>
</html>