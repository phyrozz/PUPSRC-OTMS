<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUPSRC-OTMS - Student Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bg.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous" defer></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../sign_up_dropdown.js" defer></script>
    <link rel="stylesheet" href="../../node_modules/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    <?php
    session_start();
    include "../conn.php";

    // Generate a CSRF token and store it in the session
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    $csrfToken = $_SESSION['csrf_token'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verify CSRF token
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            // Token mismatch, handle the error (e.g., log it and deny the request)
            header("Location: ../index.php");
            exit("CSRF token validation failed");
        }

        $studentNo = sanitizeInput($_POST['studentNumber']);
        $password = sanitizeInput($_POST['password']);

        if (!preg_match('/^\d{4}-\d{5}-SR-\d$/', $studentNo)) {
            $loginMessage = "Invalid student number.";
        } else {
            $stmt = $connection->prepare("SELECT user_id, student_no, first_name, last_name, extension_name, password FROM users WHERE student_no = ?");
            $stmt->bind_param("s", $studentNo);
            $stmt->execute();
            $stmt->bind_result($userId, $dbStudentNo, $dbFirstName, $dbLastName, $dbExtensionName, $dbPassword);
            $stmt->fetch();

            if ($dbStudentNo && preg_match("/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~]).{8,}$/", $password) && password_verify($password, $dbPassword)) {
                $_SESSION['user_id'] = $userId;
                $_SESSION['student_no'] = $dbStudentNo;
                $_SESSION['first_name'] = $dbFirstName;
                $_SESSION['last_name'] = $dbLastName;
                $_SESSION['extension_name'] = $dbExtensionName;
                $_SESSION['user_role'] = 1;
                header("Location: ../student/home.php");
                exit();
            } else {
                $loginMessage = "Invalid credentials.";
            }

            $stmt->close();
        }
        $connection->close();
    }

    // Function to sanitize user input
    function sanitizeInput($input) {
        return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
    }
    ?>
    <div class="jumbotron bg-white jumbotron-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center d-flex flex-column align-items-center justify-content-center">
                    <img src="/assets/pup-logo.png" alt="PUP Logo" width="100">
                    <h2 class="fw-normal mt-2"><b>O</b>nline <b>T</b>ransaction <b>M</b>anagement <b>S</b>ystem</h2>
                    <p class="lead">Sign in as PUP student</p>

                    <form method="POST" class="d-flex flex-column gap-2" action="">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                        <div class="form-group col-12">
                            <input type="text" class="form-control" name="studentNumber" id="studentNumber" placeholder="Student Number" maxlength="15" required>
                        </div>
                        <div class="form-group col-12 position-relative">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" minlength="8" maxlength="100" required>
                            <button id="togglePassword" type="button" class="btn btn-outline-primary btn-password-toggle">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        <?php if (isset($loginMessage)) { ?>
                        <p style="color: #800000; font-weight: 600;"><?php echo $loginMessage; ?></p>
                        <?php } ?>
                        <div class="col-12">
                            Don't have an account yet? <a href="#" data-bs-toggle="modal" data-bs-target="#Register">Sign up</a>
                        </div>
                        <div class="col-12">
                            <a href="forgot_password.php">I forgot my password</a>
                        </div>
                        <div class="alert alert-info" role="alert">
                            <p class="mb-0"><small>By using this service, you understood and agree to the PUPSRC-OTMS <a href="https://www.pup.edu.ph/terms" target="_blank">Terms of Use</a> and <a href="https://www.pup.edu.ph/privacy" target="_blank">Privacy Statement</a></small></p>
                        </div>
                        <div class="mb-3 d-flex w-100 justify-content-between p-1">
                            <a class="btn btn-outline-primary px-4" href="../index.php" type="button">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </a>
                            <input id="submitBtn" value="Login" type="submit" class="btn btn-primary w-25" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign Up Modal -->
    <form action="../create_account.php" id="signupForm" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        <div class="modal fade" id="Register" tabindex="-1" aria-labelledby="registerLabel" aria-hidden="true"> 
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title">Create New Account</p> 
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                        <input type="hidden" class="form-control font-weigth-light" id="hfDepartment" name="hfDepartment">
                        <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 pt-1 pb-2">
                            <label><b>Personal Details</b></label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">  
                            <div class="row">
                                <div class="form-group">
                                    <label class="mb-0 pb-1">Student Number <code>*</code></label>
                                    <div class="input-group mb-0 mt-0">
                                        <input type="text" name="StudentNo" value="" id="StudentNo" placeholder="Student Number" pattern="\d{4}-\d{5}-SR-\d" maxlength="15" size="50" autocomplete="on" class="form-control" required>
                                    </div>
                                    <div id="studentNoValidationMessage" class="text-danger"></div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="mb-0 pb-1">Last Name <code>*</code></label>
                                    <div class="input-group mb-0 mt-0">
                                        <input type="text" name="LName" value="" id="LName" placeholder="Last Name" pattern="[a-zA-ZñÑ_\-\'\ \.]*" maxlength="100" size="100" autocomplete="on" class="form-control" required>
                                    </div>
                                    <div id="lastNameValidationMessage" class="text-danger"></div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="mb-0 pb-1">First Name <code>*</code></label>
                                    <div class="input-group mb-0 mt-0">
                                        <input type="text" name="FName" value="" id="FName" placeholder="First Name" pattern="[a-zA-ZñÑ_\-\'\ \.]*" maxlength="100" size="100" autocomplete="on" class="form-control" required>
                                    </div>
                                    <div id="firstNameValidationMessage" class="text-danger"></div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="mb-0 pb-1">Middle Name</label>
                                    <div class="input-group mb-0">
                                        <input type="text" name="MName" value="" id="MName" placeholder="Middle Name" pattern="[a-zA-ZñÑ_\-\'\ \.]*" maxlength="100" size="100" autocomplete="on" class="form-control">
                                    </div>
                                    <div id="middleNameValidationMessage" class="text-danger"></div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="mb-0 pb-1">Extension Name <font class="small">(Jr./Sr./III Etc..)</font></label>
                                    <div class="input-group mb-0">
                                        <input type="text" name="EName" value="" id="EName" placeholder="Extension Name" pattern="[a-zA-ZñÑ_\-\'\ \.]*" maxlength="11" size="11" autocomplete="on" class="form-control">
                                    </div>
                                    <div id="extensionNameValidationMessage" class="text-danger"></div>
                                </div>                           
                                </div>
                                <div class="row">
                                <div class="form-group col-6">
                                    <label class="mb-0 pb-1">Course <code>*</code></label>
                                    <div class="input-group mb-0">
                                        <select name="Course" id="Course" class="form-control form-select" autocomplete="on" required>
                                            <option value="" disabled selected hidden>Select Course</option>
                                            <option value="1">Bachelor of Science in Electronics Engineering</option>
                                            <option value="2">Bachelor of Science in Business Administration Major in Human Resource Management</option>
                                            <option value="3">Bachelor of Science in Business Administration Major in Marketing Management</option>
                                            <option value="4">Bachelor in Secondary Education Major in English</option>
                                            <option value="5">Bachelor in Secondary Education Major in Filipino</option>
                                            <option value="6">Bachelor in Secondary Education Major in Mathematics</option>
                                            <option value="7">Bachelor of Science in Industrial Engineering</option>
                                            <option value="8">Bachelor of Science in Information Technology</option>
                                            <option value="9">Bachelor of Science in Psychology</option>
                                            <option value="10">Bachelor in Technology And Livelihood Education Major in Home Economics</option>
                                            <option value="11">Bachelor of Science in Management Accounting</option>
                                        </select>                                    
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="mb-0 pb-1">Year and Section <code>*</code></label>
                                    <div class="input-group mb-0">
                                        <input type="text" name="YearAndSection" id="YearAndSection" placeholder="2-1" maxlength="3" size="3" autocomplete="on" class="form-control" required>                              
                                    </div>
                                    <div id="yrAndSectionValidationMessage" class="text-danger"></div>
                                </div>
                                <div class="form-group col-12">
                                    <label>Contact Number <code>*</code></label>
                                    <div class="input-group mb-0">
                                        <input type="text" name="ContactNumber" value="" id="ContactNumber" placeholder="Eg. 0901-234-5678" pattern="^0\d{3}-\d{3}-\d{4}$" maxlength="13" size="20" autocomplete="on" class="form-control" required>
                                    </div>
                                    <div id="contactNoValidationMessage" class="text-danger"></div>
                                </div>
                                <div class="form-group col-6">
                                    <label>Birthdate <code>*</code></label>
                                    <div data-target="#Birthday" data-toggle="datetimepicker">
                                        <input type="text" class="form-control" name="Birthday" id="Birthday" placeholder="Select Date..." data-target="#Birthday" style="cursor: pointer !important;" autocomplete="on" required data-input>
                                        <!-- <input type="date" name="Birthday" id="Birthday" class="form-control datetimepicker-input" data-target="#Birthday" min="1900-01-01" max="<?php echo date('Y-m-d'); ?>" autocomplete="on" required> -->
                                    </div>
                                    <div class="text-danger" id="birthdateError" style="display: none;">Invalid birth date.</div>
                                </div>
                                <div class="form-group col-6">
                                    <label>Sex  <code>*</code></label><br>
                                    <div class="form-check">
                                    <label class="form-check-label col-3">
                                        <input class="form-check-input" type="radio" id="GenderM" name="Gender" value="1" checked=""> Male
                                    </label>
                                    <label class="form-check-label col-3 px-3">
                                        <input class="form-check-input" type="radio" id="GenderF" name="Gender" value="0"> Female
                                    </label>
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Home Address <code>*</code></label>
                                    <div class="input-group mb-0">
                                        <input type="text" name="Address" value="" id="Address" placeholder="Address" minlength="2" maxlength="255" size="255" autocomplete="on" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label>Province <code>*</code></label>
                                    <div class="input-group mb-0">
                                        <select name="Province" id="Province" class="form-control form-select" autocomplete="on" required>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group col-6">
                                    <label>City <code>*</code></label>
                                    <div class="input-group mb-0">
                                        <select name="City" id="City" class="form-control form-select" autocomplete="on" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label>Barangay <code>*</code></label>
                                    <div class="input-group mb-0">
                                        <input type="text" name="Barangay" value="" id="Barangay" placeholder="Barangay" maxlength="100" size="100" autocomplete="on" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label>Zip Code</label>
                                    <div class="input-group mb-0">
                                        <input type="text" name="ZipCode" value="" id="ZipCode" placeholder="Zip Code" pattern="[0-9]{4,6}" maxlength="6" size="6" autocomplete="on" class="form-control">
                                    </div>
                                    <div id="zipCodeError" class="text-danger"></div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 pt-3 pb-2">
                                <label><b>Account Details</b></label>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">  
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="exampleInputEmail1">Email <code>*</code></label>
                                        <div class="input-group mb-0">
                                            <input type="text" name="Email" value="" id="Email" placeholder="Complete Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" minlength="11" maxlength="50" size="50" autocomplete="on" class="form-control" required>
                                        </div>
                                        <div class="text-danger" id="emailError" style="display: none;">Invalid email address.</div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="exampleInputEmail1">Password <code>*</code></label>
                                        <div class="input-group mb-0">
                                        <input type="password" name="Password" value="" id="Password" placeholder="Password" minlength="8" maxlength="80" size="80" autocomplete="on" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="exampleInputEmail1">Confirm Password <code>*</code></label>
                                        <div class="input-group mb-0">
                                        <input type="password" name="ConfirmPassword" value="" id="ConfirmPassword" placeholder="Retype Password" minlength="8" maxlength="80" size="80" autocomplete="on" class="form-control" required>
                                        </div>
                                    </div>
                                    <ul id="passwordChecklist"></ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="alert alert-info alert-dismissible text-xs" style="height: 90%">
                                    <h4>Data Privacy Notice</h4>
                                    <p>Thank you for providing your data at Polytechnic University of the Philippines (PUP). We respect and value your rights as a data subject under the Data Privacy Act (DPA). PUP is committed to protecting the personal data you provide in accordance with the requirements under the DPA and its IRR. In this regard, PUP implements reasonable and appropriate security measures to maintain the confidentiality, integrity and availability of your personal data. For more detailed Privacy Statement, you may visit <a href="https://www.pup.edu.ph/privacy/" target="_blank">https://www.pup.edu.ph/privacy/</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" value="Sign Up" id="signUpSubmitBtn" name="studentSignup" class="btn btn-primary" disabled />
                    </div>
                </div>
            </div>
        </div>            
    </form>
    <!-- End of sign up modal -->
    <!-- Success alert modal -->
    <div id="successModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Account has been created successfully.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of success alert modal -->
    <!-- Account already exists modal -->
    <div id="accountExistsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="accountExistsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountExistsModalLabel">Create Account Failed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>The account details you provided already exists. Please try again.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of account already exists modal -->
    <!-- Create account failed modal -->
    <div id="createAccountFailedModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createAccountFailedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAccountFailedModalLabel">Create Account Failed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Failed to create an account. Please try again.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of create account failed modal -->
    <!-- Invalid password modal -->
    <div id="invalidPasswordModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="invalidPasswordModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invalidPasswordModalLabel">Oops...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Invalid password. Please try again.</p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of invalid password modal -->
    <!-- Password does not match modal -->
    <div id="passDoesNotMatchModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="passDoesNotMatchModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passDoesNotMatchModalLabel">Oops...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Passwords do not match. Please try again.</p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of password does not match modal -->
    <?php 
    if (isset($_SESSION['account_created']) && $_SESSION['account_created']) {
        echo "
        <script>
        $(window).on('load', function() {
            $('#successModal').modal('show');
        });
        </script>
        ";
    }
    if (isset($_SESSION['account_exists']) && $_SESSION['account_exists']) {
        echo "
        <script>
        $(window).on('load', function() {
            $('#accountExistsModal').modal('show');
        });
        </script>
        ";
    }
    if (isset($_SESSION['account_failed']) && $_SESSION['account_failed']) {
        echo "
        <script>
        $(window).on('load', function() {
            $('#createAccountFailedModal').modal('show');
        });
        </script>
        ";
    }
    if (isset($_SESSION['invalid_password']) && $_SESSION['invalid_password']) {
        echo "
        <script>
        $(window).on('load', function() {
            $('#invalidPasswordModal').modal('show');
        });
        </script>
        ";
    }
    if (isset($_SESSION['pass_does_not_match']) && $_SESSION['pass_does_not_match']) {
        echo "
        <script>
        $(window).on('load', function() {
            $('#passDoesNotMatchModal').modal('show');
        });
        </script>
        ";
    }

    unset($_SESSION['account_created']);
    unset($_SESSION['account_exists']);
    unset($_SESSION['account_failed']);
    unset($_SESSION['invalid_password']);
    unset($_SESSION['pass_does_not_match']);
    ?>
    <!-- End of success alert modal -->

    <script src="../../node_modules/flatpickr/dist/flatpickr.min.js"></script>
    <script>
        flatpickr("#Birthday", {
            altInput: true,
            dateFormat: "Y-m-d",
            theme: "custom-datepicker",
            minDate: "01.01.1901",
            maxDate: "today",
            locale: {
                "firstDayOfWeek": 1 // start week on Monday
            },
        });
    </script>
    <!-- JS validation for form fields -->
    <script>
        // For login form
        const loginPasswordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('togglePassword');
        let passwordVisible = false;

        togglePasswordButton.addEventListener('click', function () {
            passwordVisible = !passwordVisible;
            loginPasswordInput.type = passwordVisible ? 'text' : 'password';

            if (passwordVisible) {
                togglePasswordButton.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
            } else {
                togglePasswordButton.innerHTML = '<i class="fa-solid fa-eye"></i>';
            }
        });

        // For sign-up modal
        const studentNoInput = document.getElementById('StudentNo');
        const lastNameInput = document.getElementById('LName');
        const firstNameInput = document.getElementById('FName');
        const middleNameInput = document.getElementById('MName');
        const extensionNameInput = document.getElementById('EName');
        const lastNameValidationMessage = document.getElementById('lastNameValidationMessage');
        const firstNameValidationMessage = document.getElementById('firstNameValidationMessage');
        const middleNameValidationMessage = document.getElementById('middleNameValidationMessage');
        const extensionNameValidationMessage = document.getElementById('extensionNameValidationMessage');
        const yrAndSectionInput = document.getElementById('YearAndSection');
        const yrAndSectionValidationMessage = document.getElementById('yrAndSectionValidationMessage');
        const contactNoInput = document.getElementById('ContactNumber');
        const studentNoValidationMessage = document.getElementById('studentNoValidationMessage');
        const contactNoValidationMessage = document.getElementById('contactNoValidationMessage');
        const emailInput = document.getElementById('Email');
        const emailError = document.getElementById('emailError');
        const zipCodeInput = document.getElementById('ZipCode');
        const zipCodeError = document.getElementById('zipCodeError');
        const birthdateInput = document.getElementById('Birthday');
        const birthdateError = document.getElementById('birthdateError');
        const genderMInput = document.getElementById('GenderM');
        const genderFInput = document.getElementById('GenderF');
        var passwordInput = document.getElementById("Password");
        var confirmPasswordInput = document.getElementById("ConfirmPassword");
        var submitButton = document.getElementById("signUpSubmitBtn");

        // Password rules:
        // Must have at least one letter (small or capital)
        // Must have at least one number
        // Must have at least one special character (!, @, #, $, %, ^, &, *, (, ), _, +, {, })
        // Must be at least 8 characters long
        const passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~]).{8,}$/;

        function checkFormValidity() {
            const isStudentNoValid = validateStudentNo();
            const isLastNameValid = validateLastName();
            const isFirstNameValid = validateFirstName();
            const isMiddleNameValid = validateMiddleName();
            const isExtensionNameValid = validateExtensionName();
            const isYrAndSectionValid = validateYrAndSection();
            const isContactNoValid = validateContactNo();
            const isBirthdateValid = validateBirthdate(birthdateInput.value);
            const isEmailValid = validateEmail();
            const isZipCodeValid = validateZipCode();
            const isPasswordValid = validatePassword();

            const submitButton = document.getElementById('signUpSubmitBtn');

            if (
                isStudentNoValid &&
                isLastNameValid &&
                isFirstNameValid &&
                isMiddleNameValid &&
                isExtensionNameValid &&
                isYrAndSectionValid &&
                isContactNoValid &&
                isBirthdateValid &&
                isEmailValid &&
                isZipCodeValid &&
                isPasswordValid
            ) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }

        function checkGender() {
            if (genderFInput.checked === true) {
                extensionNameInput.disabled = true;
            } else {
                extensionNameInput.disabled = false;
            }
        }

        // Validation event listeners
        studentNoInput.addEventListener('input', checkFormValidity);
        lastNameInput.addEventListener('input', checkFormValidity);
        firstNameInput.addEventListener('input', checkFormValidity);
        middleNameInput.addEventListener('input', checkFormValidity);
        extensionNameInput.addEventListener('input', checkFormValidity);
        yrAndSectionInput.addEventListener('input', checkFormValidity);
        contactNoInput.addEventListener('input', checkFormValidity);
        birthdateInput.addEventListener('input', checkFormValidity);
        emailInput.addEventListener('input', checkFormValidity);
        zipCodeInput.addEventListener('input', checkFormValidity);
        passwordInput.addEventListener('input', checkFormValidity);
        confirmPasswordInput.addEventListener('input', checkFormValidity);
        genderFInput.addEventListener('click', checkGender);
        genderMInput.addEventListener('click', checkGender);

        // Validate functions
        function validateStudentNo() {
            const studentNo = studentNoInput.value.trim();
            const studentNoValidPattern = /^\d{4}-\d{5}-SR-\d$/;

            if (!studentNoValidPattern.test(studentNo)) {
                if (studentNo === "") {
                    studentNoValidationMessage.textContent = '';
                    studentNoInput.classList.remove('is-invalid');
                } else {
                    studentNoValidationMessage.textContent = 'Invalid student number. The format must be xxxx-xxxxx-SR-x';
                    studentNoInput.classList.add('is-invalid');
                }
                return false;
            } else {
                studentNoValidationMessage.textContent = '';
                studentNoInput.classList.remove('is-invalid');
                return true;
            }
        }

        function validateLastName() {
            const lastName = lastNameInput.value.trim();
            const lastNamePattern = /^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/;

            if (!lastNamePattern.test(lastName)) {
                lastNameValidationMessage.textContent = 'Invalid last name. It must not contain numbers or special characters.';
                lastNameInput.classList.add('is-invalid');
                return false;
            } else if (lastName === "") {
                lastNameValidationMessage.textContent = '';
                lastNameInput.classList.remove('is-invalid');
                return false;
            } else {
                lastNameValidationMessage.textContent = '';
                lastNameInput.classList.remove('is-invalid');
                return true;
            }
        }

        function validateFirstName() {
            const firstName = firstNameInput.value.trim();
            const firstNamePattern = /^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/;

            if (!firstNamePattern.test(firstName)) {
                firstNameValidationMessage.textContent = 'Invalid first name. It must not contain numbers or special characters.';
                firstNameInput.classList.add('is-invalid');
                return false;
            } else if (firstName === "") {
                firstNameValidationMessage.textContent = '';
                firstNameInput.classList.remove('is-invalid');
                return false;
            } else {
                firstNameValidationMessage.textContent = '';
                firstNameInput.classList.remove('is-invalid');
                return true;
            }
        }

        function validateMiddleName() {
            const middleName = middleNameInput.value.trim();
            const middleNamePattern = /^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/;

            if (!middleNamePattern.test(middleName)) {
                middleNameValidationMessage.textContent = 'Invalid middle name. It must not contain numbers or special characters.';
                middleNameInput.classList.add('is-invalid');
                return false;
            } else {
                middleNameValidationMessage.textContent = '';
                middleNameInput.classList.remove('is-invalid');
                return true;
            }
        }

        function validateExtensionName() {
            const extensionName = extensionNameInput.value.trim();
            const extensionNamePattern = /^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/;

            if (!extensionNamePattern.test(extensionName)) {
                extensionNameValidationMessage.textContent = 'Invalid extension name. It must not contain numbers or special characters.';
                extensionNameInput.classList.add('is-invalid');
                return false;
            } else {
                extensionNameValidationMessage.textContent = '';
                extensionNameInput.classList.remove('is-invalid');
                return true;
            }
        }

        function validateYrAndSection() {
            const yrAndSection = yrAndSectionInput.value.trim();
            const pattern = /^[1-5]-[1-4]$/;

            if (!pattern.test(yrAndSection)) {
                if (yrAndSection === "") {
                    yrAndSectionValidationMessage.textContent = '';
                    yrAndSectionInput.classList.remove('is-invalid');
                }
                else {
                    yrAndSectionValidationMessage.textContent = 'Invalid year and section.';
                    yrAndSectionInput.classList.add('is-invalid');
                }
                return false;
            } else {
                yrAndSectionValidationMessage.textContent = '';
                yrAndSectionInput.classList.remove('is-invalid');
                return true;
            }
        }

        function validateContactNo() {
            const contactNo = contactNoInput.value.trim();
            const contactNoValidPattern = /^0\d{3}-\d{3}-\d{4}$/;

            // Remove any dashes from the current input value
            const cleanedContactNo = contactNo.replace(/-/g, '');

            // Format the contact number with dashes
            let formattedContactNo = '';
            for (let i = 0; i < cleanedContactNo.length; i++) {
                if (i === 4 || i === 7) {
                    formattedContactNo += '-';
                }
                formattedContactNo += cleanedContactNo[i];
            }

            // Update the input value with the formatted contact number
            contactNoInput.value = formattedContactNo;

            if (!contactNoValidPattern.test(formattedContactNo)) {
                if (contactNo === "") {
                    contactNoValidationMessage.textContent = '';
                    contactNoInput.classList.remove('is-invalid');
                } else {
                    contactNoValidationMessage.textContent = 'Invalid contact number. The format must be 0xxx-xxx-xxxx';
                    contactNoInput.classList.add('is-invalid');
                }
                return false;
            } else {
                contactNoValidationMessage.textContent = '';
                contactNoInput.classList.remove('is-invalid');
                return true;
            }
        }

        function validateBirthdate(birthdate) {
            const currentDate = new Date();
            const selectedDate = new Date(birthdate);

            if (selectedDate < new Date('1901-01-01') || selectedDate > currentDate || birthdate === "") {
                if (birthdate.trim() === "") {
                    birthdateError.style.display = 'none';
                    birthdateInput.classList.remove('is-invalid');
                } else {
                    birthdateError.style.display = 'block';
                    birthdateInput.classList.add('is-invalid');
                }
                return false;
            } else {
                birthdateError.style.display = 'none';
                birthdateInput.classList.remove('is-invalid');
                return true;
            }
            console.log(Date(birthdate));
        }

        function validateEmail() {
            const email = emailInput.value;
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (emailPattern.test(email)) {
                emailInput.classList.remove('is-invalid');
                emailError.style.display = 'none';
                return true;
            } else {
                if (email.trim() === "") {
                    emailInput.classList.remove('is-invalid');
                    emailError.style.display = 'none';
                } else {
                    emailInput.classList.add('is-invalid');
                    emailError.style.display = 'block';
                }
                return false;
            }
        }

        // Validate functions
        function validateZipCode() {
            const zipCode = zipCodeInput.value.trim();
            const validZipCodePattern = /^[0-9]{4,6}$/;

            if (zipCode === "") {
                zipCodeError.textContent = '';
                zipCodeInput.classList.remove('is-invalid');
                return true;
            } else if (!validZipCodePattern.test(zipCode)) {
                zipCodeError.textContent = 'Zip Code must be 4 to 6 digits long';
                zipCodeInput.classList.add('is-invalid');
                return false;
            } else {
                zipCodeError.textContent = '';
                zipCodeInput.classList.remove('is-invalid');
                return true;
            }
        }

        function validatePassword() {
            const password = passwordInput.value.trim();
            const confirmPassword = confirmPasswordInput.value.trim();

            const isPasswordValid = passwordPattern.test(password);
            const isPasswordMatch = password === confirmPassword;

            passwordInput.classList.remove('is-valid', 'is-invalid');
            confirmPasswordInput.classList.remove('is-valid', 'is-invalid');

            const passwordChecklist = document.getElementById('passwordChecklist');
            passwordChecklist.innerHTML = '';

            if (password === '') {
                passwordChecklist.innerHTML += '<li class="text-danger">Password is required</li>';
            } else if (password.length >= 8) {
                passwordChecklist.innerHTML += '<li class="text-success">&#10004; At least 8 characters</li>';
            } else {
                passwordChecklist.innerHTML += '<li class="text-danger">&#10006; At least 8 characters</li>';
            }

            if (/[A-Za-z]/.test(password)) {
                passwordChecklist.innerHTML += '<li class="text-success">&#10004; Contains at least one letter</li>';
            } else {
                passwordChecklist.innerHTML += '<li class="text-danger">&#10006; Contains at least one letter</li>';
            }

            if (/\d/.test(password)) {
                passwordChecklist.innerHTML += '<li class="text-success">&#10004; Contains at least one number</li>';
            } else {
                passwordChecklist.innerHTML += '<li class="text-danger">&#10006; Contains at least one number</li>';
            }

            if (/[^A-Za-z\d]/.test(password)) {
                passwordChecklist.innerHTML += '<li class="text-success">&#10004; Contains at least one special character</li>';
            } else {
                passwordChecklist.innerHTML += '<li class="text-danger">&#10006; Contains at least one special character</li>';
            }

            if (confirmPassword === '') {
                passwordChecklist.innerHTML += '<li class="text-danger">&#10006; Confirm password is required</li>';
            } else if (isPasswordMatch) {
                passwordChecklist.innerHTML += '<li class="text-success">&#10004; Passwords match</li>';
            } else {
                passwordChecklist.innerHTML += '<li class="text-danger">&#10006; Passwords do not match</li>';
            }

            // Return true only if all validations pass
            return isPasswordValid && isPasswordMatch;
        }
    </script>
</body>
</html>