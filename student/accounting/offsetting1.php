<?php
session_start();
$office_name = "Accounting Office";
include "../../conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $student_no = $_POST["student_no"];
    $birth_date = $_POST["birth_date"];
    $sql = "SELECT * FROM users WHERE first_name = '$first_name' && last_name = '$last_name' && student_no = '$student_no' &&  birth_date = '$birth_date'";
    
    $result = $connection->query($sql);

    if ($result->num_rows == 1) {
       $row = mysqli_fetch_array($result);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['page1_visited'] = true;
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
        <div class='custom-alert-message'>Account did not match!</div>
        <button class='custom-alert-close' onclick='closeAlert()'>Close</button>
        </div>";
        echo "<script>
        document.getElementById('custom-alert').style.display = 'block';
        setTimeout(closeAlert, );
        </script>";
    } else {
        die("Database error");
    }
}
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
    <title>Accounting Office - Offsetting</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/offsetting1.css">
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
    <div class="fetch-data">
        <?php
        $user_id = $_SESSION["user_id"];
                    $select = mysqli_query($connection, "SELECT * FROM users WHERE user_id = '$user_id'") or die ('query failed');
                    if(mysqli_num_rows($select) > 0){
                        $fetch = mysqli_fetch_assoc($select);
                    }
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
                <label for="firstName" class="form-label">First Name<code>*</code></label>
                <input type="text" onkeydown="restrictName(event)"class="form-control" placeholder="First Name"id="firstName" name="first_name"required minlength="1" maxlength="100"value="<?php echo isset($fetch['first_name']) ? $fetch['first_name'] : ''; ?>" readonly>
                <div class="invalid-feedback">
                    Please provide a first name.
                </div>
            </div>
            <div class="col-md-6">
                <label for="lastName" class="form-label">Last Name<code>*</code></label>
                <input type="text" onkeydown="restrictName(event)"class="form-control" placeholder="Last Name"id="lastName" name="last_name"required minlength="2" maxlength="100"value="<?php echo isset($fetch['last_name']) ? $fetch['last_name'] : ''; ?>" readonly>
                <div class="invalid-feedback">
                    Please provide a last name.
                </div>
            </div>
            <div class="col-md-6">
                <label for="studentNumber" class="form-label">Student Number<code>*</code></label>
                <input type="text" onkeypress="return blockSpecialChar(event)"class="form-control" placeholder="Student Number"id="student-number"name="student_no" required minlength="15" maxlength="15"value="<?php echo isset($fetch['student_no']) ? $fetch['student_no'] : ''; ?>" readonly>
                <div class="invalid-feedback">
                    Please provide a student number.
                </div>
            </div>
            <div class="col-md-6">
                <label for="birthdate" class="form-label">Birth Date<code>*</code></label>
                <input type="date" class="form-control" id="birthdate"name="birth_date" required value="<?php echo isset($fetch['birth_date']) ? $fetch['birth_date'] : ''; ?>" readonly>
                <div class="invalid-feedback">
                    Please provide a birth date.
                </div>
            </div>
            <div class="col-12" style="display: flex; justify-content: space-between">
            <a class ="btn btn-primary back-button" href="../accounting.php">Back</a>
            <div class="m-2"></div>
                <button class="btn btn-primary back-button" type="submit" name="next"onclick="validateForm(event)">Next</button>
            </div>
             <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">
                                <i class="fa-solid fa-circle-info"></i> Reminder
                                </h4>
                                <p>Make sure that the information provided in every field match the correct details of the account</p>
                                <p>This is a confirmation of your account’s validity</p>
                                <p>You may begin with <b>Offsetting</b> once you pressed the Next button</p>
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
<style>
    input[readonly],input[type="date"] {
        background-color: #e9ecef; 
        cursor: not-allowed; 
    }
</style>