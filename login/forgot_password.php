<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

session_start();
include '../conn.php';

// Generate a CSRF token and store it in the session
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];

if (isset($_POST['resetBtn'])) {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        // Token mismatch, handle the error (e.g., log it and deny the request)
        header("Location: ../index.php");
        exit("CSRF token validation failed");
    }

    // Function to generate a random token
    function generateToken($length = 32)
    {
        return bin2hex(random_bytes($length));
    }

    $mail = new PHPMailer(true);
    $email = sanitizeInput($_POST['email']);

    try {
        date_default_timezone_set('Asia/Manila');

        // Check if the email exists in the database
        $stmt = $connection->prepare('SELECT user_id FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // Fetch the user_id
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];

            // Generate a unique token
            $token = generateToken();

            // Capture the current time
            $currentTime = date('Y-m-d H:i:s');

            // Check if a token already exists for the user
            $stmt = $connection->prepare('SELECT * FROM password_reset_tokens WHERE user_id = ?');
            $stmt->bind_param('s', $user_id);
            $stmt->execute();
            $tokenResult = $stmt->get_result();

            if ($tokenResult->num_rows === 1) {
                // Update the existing token with the current time
                $stmt = $connection->prepare('UPDATE password_reset_tokens INNER JOIN users ON password_reset_tokens.user_id = users.user_id SET password_reset_tokens.token = ?, password_reset_tokens.expiry = DATE_ADD(?, INTERVAL 1 HOUR) WHERE users.user_id = ?');
                $stmt->bind_param('sss', $token, $currentTime, $user_id);
            } else {
                // Insert a new token record with the current time
                $stmt = $connection->prepare('INSERT INTO password_reset_tokens (user_id, token, expiry) VALUES (?, ?, DATE_ADD(?, INTERVAL 1 HOUR))');
                $stmt->bind_param('sss', $user_id, $token, $currentTime);
            }
            $stmt->execute();

            // Send the password reset email
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'joshuamalabanan70@gmail.com';
            $mail->Password = 'flxeyskjtbaqvngz';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465; 
            $mail->setFrom('pupsrc-otms@admin.com', 'PUPSRC-OTMS'); // Your email address and name
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'PUPSRC-OTMS Password Reset';
            $mail->addEmbeddedImage('../assets/verify_email_header.png', 'email_header');
            $mail->Body = "<img src='cid:email_header' alt='PUPSRC-OTMS Email Header' height=50>
                        <p>Please click the following link to reset your password: <a href='/login/reset_password.php?token=$token'>Reset Password</a></p>
                        <hr /><br>
                        <p>This is an auto-generated email. Please do not reply.</p>";
            $mail->send();

            $_SESSION['email_exists'] = true;
        } else {
            $_SESSION['email_does_not_exist'] = true;
        }

        // Close the database connection
        $stmt->close();
        $connection->close();
    } catch (Exception $e) {
        $_SESSION['email_does_not_exist'] = true;
    }
}

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
    <title>PUPSRC-OTMS - Forgot Password</title>
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
</head>
<body>
    <?php

    ?>
    <div class="row m-0 container-bg dark-overlay dark-mode d-flex flex-lg-row flex-column position-relative justify-content-lg-between justify-content-start h-100">
        <div class="col-lg-7 col-12 d-flex flex-column justify-content-center position-relative align-items-lg-start align-items-center pe-none">
            <div class="d-flex position-absolute top-0 left-0 gap-2 mt-4 align-items-center">
                <img src="../assets/pup-logo.png" alt="PUP Logo" width="30" height="30">
                <p class="text-light fs-6 fw-lighter lh-1 m-0 p-0"><b>O</b>nline <b>T</b>ransaction <b>M</b>anagement <b>S</b>ystem</p>
            </div>
            <h1 class="welcome-title-text card-title pt-2 pb-3 pb-lg-0 text-light">Reset your password</h1>
        </div>
        <div class="role-btn-group col-lg-5 col-12 d-flex flex-column align-items-stretch justify-content-center gap-2 px-5">
            <form method="POST" class="d-flex flex-column gap-2 w-100" action="forgot_password.php">
                <small class="text-start my-2">Please enter your account's email address in order to reset your account's password. A verification email will be sent to your inbox and you must click the link to successfully change your password.</small>
                <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                <div class="form-group col-12">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your email address" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" minlength="5" maxlength="100" required>
                </div>
                <div class="mb-3 d-flex w-100 justify-content-between p-1">
                    <a class="btn btn-outline-dark px-4" href="javascript:history.back()">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                    <button id="resetBtn" name="resetBtn" type="submit" class="btn btn-primary w-25">Reset</button>
                </div>
            </form>
        </div>
        <small class="text-light fw-light position-absolute bottom-0 start-0 mb-2">PUPSRC-OTMS Beta 0.5.2</small>
    </div>
    <!-- <div class="pass-reset-container h-100">
        <div class="container-fluid d-flex flex-column justify-content-center align-items-start my-auto h-100">
            <div class="d-flex flex-row align-items-center gap-2 position-absolute top-0 left-0 mt-3">
                <img src="/assets/pup-logo.png" alt="PUP Logo" width="30">
                <h2 class="fw-normal mt-2 fs-5 text-light"><b>O</b>nline <b>T</b>ransaction <b>M</b>anagement <b>S</b>ystem</h2>
            </div>
            <h1 class="lead fs-1 text-light">Reset your password</h1>
            <form method="POST" class="d-flex flex-column gap-2 w-100" action="forgot_password.php">
                <small class="text-start my-2 text-light">Please enter your account's email address in order to reset your account's password. A verification email will be sent to your inbox and you must click the link to successfully change your password.</small>
                <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                <div class="form-group col-12">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your email address" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" minlength="5" maxlength="100" required>
                </div>
                <div class="mb-3 d-flex w-100 justify-content-between p-1">
                    <a class="btn btn-outline-light px-4" href="javascript:history.back()">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                    <button id="resetBtn" name="resetBtn" type="submit" class="btn btn-primary w-25">Reset</button>
                </div>
            </form>
        </div>
    </div> -->
    <!-- Success alert modal -->
    <div id="successModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>A verification link was sent on your email address. Please check it to successfully reset your password.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of success alert modal -->
    <!-- Invalid email modal -->
    <div id="emailDoesNotExistModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="emailDoesNotExistModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailDoesNotExistModalLabel">Invalid email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>The email you provided doesn't exist on our system. Please try again.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of invalid email modal -->
    <?php 
    if (isset($_SESSION['email_exists']) && $_SESSION['email_exists']) {
        echo "
        <script>
        $(window).on('load', function() {
            $('#successModal').modal('show');
        });
        </script>
        ";
    }
    if (isset($_SESSION['email_does_not_exist']) && $_SESSION['email_does_not_exist']) {
        echo "
        <script>
        $(window).on('load', function() {
            $('#emailDoesNotExistModal').modal('show');
        });
        </script>
        ";
    }

    unset($_SESSION['email_exists']);
    unset($_SESSION['email_does_not_exist']);
    ?>
</body>
</html>