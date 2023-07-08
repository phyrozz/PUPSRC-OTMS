<?php
$office_name = "Accounting Office";
include 'request_offset.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounting Office - Landing Page</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/offsetting2.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
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
    <div class="container-fluid text-center p-4">
        <h1>Offsetting</h1>
    </div>
    <form action="" id="student-offset"method="post">
    <div class="container-fluid-form">
        <h2>Select type of offset</h2>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="offsetType" class="form-label">Offset Type<code>*</code></label>
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
                <label for="amountToOffset" class="form-label2">Amount to be offset:<code>*</code></label>
                <input type="number" class="form-control" id="amountToOffset"name="amountToOffset" pattern="^\d{0,6}(\.\d{0,2})?$" step="any"required min="1" oninput="validateInput(this)">
                <div class="invalid-feedback">
                    Please provide the amount to be offset.
                </div>
                <script>
                    function validateInput(input) {
                    var value = input.value;
                    if (value.startsWith("0")) {
                        input.setCustomValidity("Value cannot start with 0.");
                    } else {
                        input.setCustomValidity("");
                    }
                    }
                </script>
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
    <script src="../../saved_settings.js"></script>
    <script src="../../loading.js"></script>
</body>
</html>