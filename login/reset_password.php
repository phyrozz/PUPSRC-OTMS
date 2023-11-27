<?php
session_start();
include '../conn.php';

// Generate a CSRF token and store it in the session
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];

date_default_timezone_set('Asia/Manila');

// Retrieve the token from the URL
$token = $_GET['token'];

// Check if the token is valid and not expired
$stmt = $connection->prepare('SELECT * FROM password_reset_tokens WHERE token = ? AND expiry > NOW()');
$stmt->bind_param('s', $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // Token is valid, allow the user to reset their password
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verify CSRF token
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            // Token mismatch, handle the error (e.g., log it and deny the request)
            header("Location: ../index.php");
            exit("CSRF token validation failed");
        }

        // Retrieve the new password from the form
        $newPassword = sanitizeInput($_POST['newPassword']);
        $confirmPassword = sanitizeInput($_POST['confirmPassword']);

        // Check if the passwords match
        if ($newPassword == $confirmPassword) {
            // Validate the new password
            if (preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~]).{8,}$/', $newPassword)) {
                // Hash the new password
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the user's password in the database
                $stmt = $connection->prepare('UPDATE users INNER JOIN password_reset_tokens ON users.user_id = password_reset_tokens.user_id SET users.password = ?, password_reset_tokens.token = NULL, password_reset_tokens.expiry = NULL WHERE password_reset_tokens.token = ?');
                $stmt->bind_param('ss', $hashedPassword, $token);
                $stmt->execute();

                $_SESSION['success'] = true;
            } else {
                $_SESSION['invalid_password'] = true;
            }
        } else {
            $_SESSION['pass_does_not_match'] = true;
        }
    }
} else {
    header('Location: /index.php');
}

$stmt->close();
$connection->close();

// Function to sanitize user input
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUPSRC-OTMS - Reset Password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bg.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="jumbotron bg-white d-flex jumbotron-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center d-flex flex-column align-items-center justify-content-center">
                    <img src="/assets/pup-logo.png" alt="PUP Logo" width="100">
                    <h2 class="fw-normal mt-2"><b>O</b>nline <b>T</b>ransaction <b>M</b>anagement <b>S</b>ystem</h2>
                    <p class="lead">Reset your password</p>
                    <form method="POST" class="d-flex flex-column gap-2 w-100" action="">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                        <div class="form-group col-12">
                            <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Enter your new password" minlength="8" maxlength="80" required>
                        </div>
                        <div class="form-group col-12">
                            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm password" minlength="8" maxlength="80" required>
                        </div>
                        <ul id="passwordChecklist" class="text-start"></ul>
                        <div class="mb-3 d-flex w-100 justify-content-between p-1">
                            <a class="btn btn-outline-primary px-4" href="/login/forgot_password.php">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </a>
                            <button id="resetBtn" name="resetBtn" type="submit" class="btn btn-primary w-25">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Success alert modal -->
    <div id="successModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Password has been successfully reset!</p>
                </div>
                <div class="modal-footer">
                    <a href="/index.php" class="btn btn-primary">Return to Login</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End of success alert modal -->
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
    <script>
        var passwordField = document.getElementById('newPassword');
        var confirmPasswordField = document.getElementById('confirmPassword');

        // Password rules:
        // Must have at least one letter (small or capital)
        // Must have at least one number
        // Must have at least one special character (!, @, #, $, %, ^, &, *, (, ), _, +, {, })
        // Must be at least 8 characters long
        const passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~]).{8,}$/;

        function validatePassword() {
            const password = passwordField.value.trim();
            const confirmPassword = confirmPasswordField.value.trim();

            // Check if the password meets the requirements
            const isPasswordValid = passwordPattern.test(password);
            const isPasswordMatch = password === confirmPassword;

            // Update the validation messages and styles
            if (password === '' || !isPasswordValid) {
                passwordField.classList.remove('is-valid');
                passwordField.classList.add('is-invalid');
            } else {
                passwordField.classList.remove('is-invalid');
                passwordField.classList.add('is-valid');
            }

            if (confirmPassword === '' || !isPasswordMatch) {
                confirmPasswordField.classList.remove('is-valid');
                confirmPasswordField.classList.add('is-invalid');
            } else {
                confirmPasswordField.classList.remove('is-invalid');
                confirmPasswordField.classList.add('is-valid');
            }

            // Update the checklist message
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
        }

        passwordField.addEventListener('input', validatePassword);
        confirmPasswordField.addEventListener('input', validatePassword);
    </script>
    <?php 
    if (isset($_SESSION['success']) && $_SESSION['success']) {
        echo "
        <script>
        $(window).on('load', function() {
            $('#successModal').modal('show');
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

    unset($_SESSION['success']);
    unset($_SESSION['invalid_password']);
    unset($_SESSION['pass_does_not_match']);
    ?>
</body>
</html>