<?php
include '../conn.php';

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
        // Retrieve the new password from the form
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the user's password in the database
        if ($newPassword == $confirmPassword) {
            $stmt = $connection->prepare('UPDATE users INNER JOIN password_reset_tokens ON users.user_id = password_reset_tokens.user_id SET users.password = ?, password_reset_tokens.token = NULL, password_reset_tokens.expiry = NULL WHERE password_reset_tokens.token = ?');
            $stmt->bind_param('ss', $hashedPassword, $token);
            $stmt->execute();

            $_SESSION['success'] = true;
        }
        else {
            $_SESSION['pass_does_not_match'] = true;
        }
    }
} else {
    header('Location: /index.php');
}

$stmt->close();
$connection->close();
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
    <div class="jumbotron bg-white d-flex">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center d-flex flex-column align-items-center justify-content-center">
                    <img src="/assets/pup-logo.png" alt="PUP Logo" width="100">
                    <h2 class="fw-normal mt-2"><b>O</b>nline <b>T</b>ransaction <b>M</b>anagement <b>S</b>ystem</h2>
                    <p class="lead">Reset your password</p>

                    <form method="POST" class="d-flex flex-column gap-2 w-100" action="">
                        <div class="form-group col-12">
                            <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Enter your new password" minlength="8" maxlength="80" required>
                        </div>
                        <div class="form-group col-12">
                            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm password" minlength="8" maxlength="80" required>
                        </div>
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
        var passwordValidation = document.getElementById('newPasswordValidation');
        var confirmPasswordValidation = document.getElementById('confirmPasswordValidation');

        passwordField.addEventListener('input', validatePassword);
        confirmPasswordField.addEventListener('input', validateConfirmPassword);

        function validatePassword() {
            var password = passwordField.value;

            if (password.length < 8) {
                passwordField.classList.add('is-invalid');
                passwordValidation.innerText = 'Password must be at least 8 characters long';
            } else {
                passwordField.classList.remove('is-invalid');
                passwordValidation.innerText = '';
            }

            validateConfirmPassword();
        }

        function validateConfirmPassword() {
            var password = passwordField.value;
            var confirmPassword = confirmPasswordField.value;

            if (confirmPassword !== password) {
                confirmPasswordField.classList.add('is-invalid');
                confirmPasswordValidation.innerText = 'Passwords do not match';
            } else {
                confirmPasswordField.classList.remove('is-invalid');
                confirmPasswordValidation.innerText = '';
            }

            var resetBtn = document.getElementById('resetBtn');
            resetBtn.disabled = passwordField.classList.contains('is-invalid') || confirmPasswordField.classList.contains('is-invalid');
        }
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
    unset($_SESSION['pass_does_not_match']);
    ?>
</body>
</html>