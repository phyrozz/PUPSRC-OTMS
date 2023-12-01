<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUPSRC-OTMS - Welcome Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bg.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous" defer></script>
</head>
<body>
    <?php
        session_start();

        if (!empty($_SESSION['user_id'])) {
            if ($_SESSION['user_role'] == 1) {
                header("Location: /student/home.php");
            }
            else if ($_SESSION['user_role'] == 2) {
                header("Location: /client/home.php");
            }
            // else if (!empty($_SESSION['admin_id'])) {
            //     header("Location: /admin/redirect.php");
            // }
            else {
                header("Location: /admin/redirect.php");
            }
            exit;
        }
    ?>
    <div class="row m-0 container-bg dark-overlay dark-mode d-flex flex-lg-row flex-column position-relative justify-content-lg-between justify-content-start">
        <div class="col-lg-7 col-12 d-flex flex-column justify-content-center position-relative align-items-lg-start align-items-center pe-none">
            <div class="d-flex position-absolute top-0 left-0 gap-2 mt-4 align-items-center">
                <img src="assets/pup-logo.png" alt="PUP Logo" width="30" height="30">
                <p class="text-light fs-6 fw-bold lh-1 m-0 p-0">Polytechnic University of the Philippines</p>
            </div>
            <h1 class="welcome-title-text card-title pt-2 text-light">PUP Santa Rosa</h1>
            <h2 class="welcome-text lead card-title text-light fw-lighter"><b>O</b>nline <b>T</b>ransaction <b>M</b>anagement <b>S</b>ystem</h2>
        </div>
        <div class="role-btn-group col-lg-5 col-12 d-flex flex-column align-items-stretch justify-content-center gap-2 px-5">
            <p class="text-center m-0 m-2 fw-bold">Choose your role to get started</p>
            <a href="login/student.php" class="btn btn-student p-3 btn-lg">
                <i class="fa fa-user-circle mr-2"></i> Student
            </a>
            <a href="login/client.php" class="btn btn-client p-3 btn-lg">
                <i class="fa fa-user mr-2"></i> Guest
            </a>
            <a href="login/admin.php" class="btn btn-admin p-3 btn-lg">
                <i class="fa fa-user-shield mr-2"></i> Admin
            </a>
        </div>
        <small class="text-light fw-light position-absolute bottom-0 start-0 mb-2">PUPSRC-OTMS Beta 0.5.2</small>
    </div>

    <!-- <div class="vh-100 d-flex align-items-center">
        <div class="container d-flex justify-content-center">
            <div class="card login-card text-center bg-light p-3 jumbotron-bg">
                <div class="card-body">
                    <img class="p-3" src="assets/pup-logo.png" alt="PUP Logo" width="110" height="110">
                    <h3 class="card-title">PUP Santa Rosa</h3>
                    <h5 class="lead card-title"><b>O</b>nline <b>T</b>ransaction <b>M</b>anagement <b>S</b>ystem</h5>
                    <p class="card-text">Choose your role to get started</p>
                    <div class="d-flex justify-content-center align-items-center p-3 gap-2">
                        <a href="login/student.php" class="btn btn-student p-3 btn-lg">
                            <i class="fa fa-user-circle mr-2"></i> Student
                        </a>
                        <a href="login/client.php" class="btn btn-client p-3 btn-lg">
                            <i class="fa fa-user mr-2"></i> Client
                        </a>
                        <a href="login/admin.php" class="btn btn-admin p-3 btn-lg">
                            <i class="fa fa-user-shield mr-2"></i> Admin
                        </a>
                    </div>
                    <p class="card-text p-3">By using this service, you understood and agree to the PUP Online Services <a href="https://www.pup.edu.ph/terms/" target="_blank">Terms of Use</a> and <a href="https://www.pup.edu.ph/privacy/" target="_blank">Privacy Statement</a></p>
                </div>
            </div>
        </div>
    </div> -->
    <script src="/jquery.js"></script>
</body>
</html>