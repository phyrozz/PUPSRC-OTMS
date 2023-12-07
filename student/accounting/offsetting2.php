<?php
session_start();
if (!isset($_SESSION['page1_visited'])) {
    header("Location: offsetting1.php");
    exit();
}
$office_name = "Accounting Office";
include '../../conn.php';
if (isset($_POST['submit'])) {
    $_SESSION['page2_visited'] = true;
    $user_id = $_SESSION['user_id'];
    $checkFormQuery = "SELECT COUNT(*) as submission_count FROM offsettingtb WHERE user_id = ? AND timestamp >= DATE_SUB(NOW(), INTERVAL 1 DAY)";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $checkFormQuery)) {
        echo "Error";
    } else {
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $submissionCount = $row['submission_count'];

        if ($submissionCount >= 3) {
            $_SESSION['page1_visited'] = false;
            echo "<div class='custom-alert' id='custom-alert'>
            <div class='custom-alert-message'>You have reached the maximum number of submissions (3) within the last 24 hours. Please wait for 24 hours before submitting another request. Thank you for your understanding.</div>
            <button class='custom-alert-close' onclick='redirectToIndex()'>Go Back</button>
          </div>";
            echo "<script>
            document.getElementById('custom-alert').style.display = 'block';
            function redirectToIndex() {
                window.location.href = '../accounting.php';
            }
          </script>";
        } else {
            $amountToOffset = $_POST['amountToOffset'];
            $offsetType = $_POST['offsetType'];

            $insert = "INSERT INTO offsettingtb (user_id, amountToOffset, offsetType) VALUES (?,?,?)";
            $stmt = mysqli_stmt_init($connection);
            if (!mysqli_stmt_prepare($stmt, $insert)) {
                echo "Error";
            } else {
                mysqli_stmt_bind_param($stmt, 'sds', $user_id, $amountToOffset, $offsetType);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($connection);     
        echo "<script>
            window.location.href = 'offsetting3.php';
        </script>";
        exit();
            }
        }
    }
}

mysqli_close($connection);
?>

<style>
.custom-alert {
    color: #020403;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 300px;
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    display: none;
    z-index: 9999;
    text-align: center;
    }

.custom-alert-message {
font-weight: bold;
margin-bottom: 10px;
}

.custom-alert-close {
padding: 5px 10px;
background-color: #ffc107;
border: solid 1px black;
border-radius: 10%;
color: #212529;
cursor: pointer;
}

.custom-alert-close:hover {
background-color: #e9ecef;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounting Office - Offsetting Verification</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/offsetting1.css">
    <link rel="stylesheet" href="css/offsetting2.css">
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
    <div class="wrapper">
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
    <!--new-->
    <div class="container-fluid text-center p-4">
        <!--Start of content-->
        <h1>Offsetting</h1>
        <p></p>
        <div class="container-fluid-form">
            <form action="" method="post" class="row g-3 needs-validation">
                <div class="container-form custom-d-flex">
                    <div class="col-md-6 content-center">
        <h2>Select type of offset</h2>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="offsetType" class="form-label">Offset Type<code>*</code></label>
                <select class="form-select" id="offsetType"name="offsetType" required>
                    <option value="" selected disabled>Select an option</option>
                    <option value="Tuition Fee" >Tuition Fee</option>
                    <option value="Miscellaneous Fee">Miscellaneous Fee</option>
                </select>
                <div class="invalid-feedback">
                    Please select an offset type.
                </div>
            </div>
            <div class="">
                <label for="amountToOffset" class="form-label2">Amount to be offset:<code>*</code></label>
                <input type="number" class="form-control w-50" id="amountToOffset"name="amountToOffset" pattern="^\d{0,6}(\.\d{0,2})?$" step="any"required min="1" oninput="validateInput(this)">
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
                    document.getElementById('amountToOffset').addEventListener('keydown', function (event) {
                        if (event.key === "-" || event.key === "+" || event.key === "e") {
                            event.preventDefault();
                        }
                    });
                </script>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                        </div>
                    </div>
                </div>
                    <div class="col">
                        <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">
                                <i class="fa-solid fa-circle-info"></i> Reminder
                                </h4>
                                <p>Once you click the "Submit" button, your request to offset your account tuition will be securely forwarded to the relevant department for processing.</p>
                            <p>The confirmation of your request (whether approved or disapproved) will be provided, ensuring that you receive timely updates regarding the status of your tuition offsetting request.</p>
                            <p>We prioritize the confidentiality of your money-related information and remain committed to providing a secure and reliable experience for all our users.</p>
                            </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <?php include '../../footer.php'; ?>
    <script src="js/offsetting_script.js"></script>
    <script src="../../saved_settings.js"></script>
    <script src="../../loading.js"></script>
</body>
</html>
<script>
    fromEvent(window, 'beforeunload')
  .pipe(
    filter(() => this.warn)
  )
  .subscribe((event: BeforeUnloadEvent) => {
    const message = 'You may lose your data if you refresh now';
    (event || window.event).returnValue = message;
    return message;
  });
</script>