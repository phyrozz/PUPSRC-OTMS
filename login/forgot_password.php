<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';


if (isset($_POST['resetBtn'])) {
    // Function to generate a random token
    function generateToken($length = 32)
    {
        return bin2hex(random_bytes($length));
    }

    include '../conn.php';

    $mail = new PHPMailer(true);
    $email = $_POST['email'];

    try {
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

            // Check if a token already exists for the user
            $stmt = $connection->prepare('SELECT * FROM password_reset_tokens WHERE user_id = ?');
            $stmt->bind_param('s', $user_id);
            $stmt->execute();
            $tokenResult = $stmt->get_result();

            if ($tokenResult->num_rows === 1) {
                // Update the existing token
                $stmt = $connection->prepare('UPDATE password_reset_tokens INNER JOIN users ON password_reset_tokens.user_id = users.user_id SET password_reset_tokens.token = ?, password_reset_tokens.expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE users.user_id = ?');
                $stmt->bind_param('ss', $token, $user_id);
            } else {
                // Insert a new token record
                $stmt = $connection->prepare('INSERT INTO password_reset_tokens (user_id, token, expiry) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))');
                $stmt->bind_param('ss', $user_id, $token);
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
                        <p>Please click the following link to reset your password: <a href='http://192.168.84.183/login/reset_password.php?token=$token'>Reset Password</a></p>";
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
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php

    ?>
    <div class="jumbotron bg-white d-flex">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center d-flex flex-column align-items-center justify-content-center">
                    <img src="/assets/pup-logo.png" alt="PUP Logo" width="100">
                    <h2 class="fw-normal mt-2"><b>O</b>nline <b>T</b>ransaction <b>M</b>anagement <b>S</b>ystem</h2>
                    <p class="lead">Reset your password</p>

                    <form method="POST" class="d-flex flex-column gap-2 w-100" action="forgot_password.php">
                        <div class="form-group col-12">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your email address" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" minlength="5" maxlength="100" required>
                        </div>
                        <div class="mb-3 d-flex w-100 justify-content-between p-1">
                            <a class="btn btn-outline-primary px-4" href="../index.php">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </a>
                            <button id="resetBtn" name="resetBtn" type="submit" class="btn btn-primary w-25">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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