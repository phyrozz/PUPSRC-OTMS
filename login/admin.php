<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUPSRC-OTMS - Admin</title>
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

        $email = sanitizeInput($_POST['email']);
        $password = sanitizeInput($_POST['password']);

        $query = "SELECT admins.admin_id, admins.email, admins.first_name, admins.last_name, admins.password, offices.office_name FROM admins INNER JOIN offices ON admins.office_id = offices.office_id WHERE admins.email = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($adminId, $dbEmail, $dbFirstName, $dbLastName, $dbPassword, $dbOffice);
        $stmt->fetch();

        if ($dbEmail && password_verify($password, $dbPassword)) {
            $_SESSION['admin_id'] = $adminId;
            $_SESSION['first_name'] = $dbFirstName;
            $_SESSION['last_name'] = $dbLastName;
            $_SESSION['email'] = $dbEmail;
            $_SESSION['office_name'] = $dbOffice;
            header("Location: ../admin/redirect.php");
            exit();
        } else {
            $loginMessage = "Invalid credentials. Please try again.";
        }
    
        $stmt->close();
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
                    <p class="lead">Sign in as Faculty Admin</p>

                    <form method="POST" class="d-flex flex-column gap-2" action="">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                        <div class="form-group col-12">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email address"  maxlength="100" required>
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
                        <div class="alert alert-info" role="alert">
                            <p class="mb-0">By using this service, you understood and agree to the PUPSRC-OTMS <a href="https://www.pup.edu.ph/terms" target="_blank">Terms of Use</a> and <a href="https://www.pup.edu.ph/privacy" target="_blank">Privacy Statement</a></p>
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
    <script>
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
    </script>
</body>
</html>