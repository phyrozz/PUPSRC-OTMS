<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUPSRC-OTMS - Welcome Page</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bg.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="vh-100 d-flex align-items-center">
        <div class="container d-flex justify-content-center">
            <div class="card login-card text-center bg-light p-3">
                <div class="card-body">
                    <img class="p-3" src="assets/pup-logo.png" alt="PUP Logo" width="110" height="110">
                    <h3 class="card-title">PUP Santa Rosa</h3>
                    <h5 class="card-title">Online Transaction Management System</h5>
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
    </div>
</body>
</html>