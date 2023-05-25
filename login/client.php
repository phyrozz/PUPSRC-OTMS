<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUPSRC-OTMS - Client Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bg.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../sign_up_dropdown.js"></script>
</head>
<body>
    <?php
    session_start();
    include "../conn.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT user_id, email, first_name, last_name, password FROM users WHERE email = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($userId, $dbEmail, $dbFirstName, $dbLastName, $dbPassword);
        $stmt->fetch();

        if ($dbEmail && password_verify($password, $dbPassword)) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['first_name'] = $dbFirstName;
            $_SESSION['last_name'] = $dbLastName;
            header("Location: ../client/home.php");
            exit();
        } else {
                $loginMessage = "Invalid credentials. Please try again.";
            }
    
            $stmt->close();
            $connection->close();
        }

    ?>
    <div class="jumbotron bg-white d-flex">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center d-flex flex-column align-items-center justify-content-center">
                    <img src="/assets/pup-logo.png" alt="PUP Logo" width="100">
                    <h2 class="fw-normal mt-2"><b>O</b>nline <b>T</b>ransaction <b>M</b>anagement <b>S</b>ystem</h2>
                    <p class="lead">Sign in as Client (Alumni, Visitor, etc.)</p>

                    <form method="POST" class="d-flex flex-column gap-2" action="">
                        <div class="form-group col-12">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" maxlength="100" required>
                        </div>
                        <div class="form-group col-12">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="100" required>
                        </div>
                        <?php if (isset($loginMessage)) { ?>
                        <p style="color: #800000; font-weight: 600;"><?php echo $loginMessage; ?></p>
                        <?php } ?>
                        <div class="col-12">
                            Don't have an account yet? <a href="#" data-bs-toggle="modal" data-bs-target="#Register">Sign up</a>
                        </div>
                        <div class="col-12">
                            <a href="#">I forgot my password</a>
                        </div>
                        <div class="alert alert-info" role="alert">
                            <p class="mb-0"><small>By using this service, you understood and agree to the PUPSRC-OTMS <a href="https://www.pup.edu.ph/terms" target="_blank">Terms of Use</a> and <a href="https://www.pup.edu.ph/privacy" target="_blank">Privacy Statement</a></small></p>
                        </div>
                        <div class="mb-3 d-flex w-100 justify-content-between p-1">
                            <a class="btn btn-outline-primary px-4" href="http://localhost/index.php">
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
                                <div class="form-group col-6">
                                <label class="mb-0 pb-1">Last Name <code>*</code></label>
                                    <div class="input-group mb-0 mt-0">
                                    <input type="text" name="LName" value="" id="LName" placeholder="Last Name" pattern="[a-zA-Z0-9Ññ\_\-\'\ \.]*" maxlength="50" size="50" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                <label class="mb-0 pb-1">First Name <code>*</code></label>
                                    <div class="input-group mb-0 mt-0">
                                    <input type="text" name="FName" value="" id="FName" placeholder="First Name" pattern="[a-zA-Z0-9Ññ\_\-\'\ \.]*" maxlength="50" size="50" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                <label class="mb-0 pb-1">Middle Name</label>
                                    <div class="input-group mb-0">
                                    <input type="text" name="MName" value="" id="MName" placeholder="Middle Name" pattern="[a-zA-Z0-9Ññ\_\-\'\ \.]*" maxlength="50" size="50" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                <label class="mb-0 pb-1">Extension Name <font class="small">(Jr./Sr./III Etc..)</font></label>
                                    <div class="input-group mb-0">
                                    <input type="text" name="EName" value="" id="EName" placeholder="Extension Name" pattern="[a-zA-Z0-9Ññ\_\-\'\ \.]*" maxlength="50" size="50" autocomplete="off" class="form-control">
                                    </div>
                                </div>                             
                                </div>
                                <div class="row">
                                <div class="form-group col-12">
                                    <label>Contact Number <code>*</code></label>
                                    <div class="input-group mb-0">
                                        <input type="text" name="ContactNumber" value="" id="ContactNumber" placeholder="Contact No." pattern="[0-9\+\ ]*" maxlength="11" size="20" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label>Birthdate <code>*</code></label>
                                    <div data-target="#Birthday" data-toggle="datetimepicker">
                                        <input type="date" name="Birthday" id="Birthday" class="form-control datetimepicker-input" data-target="#Birthday">
                                    </div>
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
                                        <input type="text" name="Address" value="" id="Address" placeholder="Address" maxlength="50" size="255" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label>Province <code>*</code></label>
                                    <div class="input-group mb-0">
                                        <select name="Province" id="Province" class="form-control form-select">
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group col-6">
                                    <label>City <code>*</code></label>
                                    <div class="input-group mb-0">
                                        <select name="City" id="City" class="form-control form-select">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label>Barangay <code>*</code></label>
                                    <div class="input-group mb-0">
                                        <input type="text" name="Barangay" value="" id="Barangay" placeholder="Barangay" maxlength="50" size="50" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label>Zip Code</label>
                                    <div class="input-group mb-0">
                                        <input type="text" name="ZipCode" value="" id="ZipCode" placeholder="Zip Code" pattern="[0-9]+" maxlength="50" size="50" autocomplete="off" class="form-control">
                                    </div>
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
                                    <input type="text" name="Email" value="" id="Email" placeholder="Complete Email" pattern="[a-zA-Z0-9Ññ\@\_\-\.\(\)\&amp;\,\<\>\'\`]*" maxlength="50" size="50" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="exampleInputEmail1">Password <code>*</code></label>
                                    <div class="input-group mb-0">
                                    <input type="password" name="Password" value="" id="Password" placeholder="Password" maxlength="50" size="50" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="exampleInputEmail1">Confirm Password <code>*</code></label>
                                    <div class="input-group mb-0">
                                    <input type="password" name="ConfirmPassword" value="" id="ConfirmPassword" placeholder="Retype Password" maxlength="50" size="50" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="alert alert-info alert-dismissible text-xs" style="height: 90%">
                                        <h4>Data Privacy Notice</h4>
                                        <p>
                                        <img style="float: right; margin-left: 3px; filter: invert(100%);" src="//i.imgur.com/1fWC7sz.png" title="QR code">Thank you for providing your data at Polytechnic University of the Philippines (PUP). We respect and value your rights as a data subject under the Data Privacy Act (DPA). PUP is committed to protecting the personal data you provide in accordance with the requirements under the DPA and its IRR. In this regard, PUP implements reasonable and appropriate security measures to maintain the confidentiality, integrity and availability of your personal data. For more detailed Privacy Statement, you may visit <a href="https://www.pup.edu.ph/privacy/" target="_blank">https://www.pup.edu.ph/privacy/</a></p>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="clientSignup" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#successModal">Sign Up</button>
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
    <?php if (isset($_SESSION['account_created']) && $_SESSION['account_created']) {
        echo "
        <script>
        $(window).on('load', function() {
            $('#successModal').modal('show');
        });
        </script>
        ";
    } 
    unset($_SESSION['account_created']);
    ?>
    <!-- End of success alert modal -->
</body>
</html>