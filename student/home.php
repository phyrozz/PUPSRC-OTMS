<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUPSRC-OTMS - Choose an Office</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/bg.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
        <?php
            $office_name = "Select an Office";
            include "../conn.php";
            include "../navbar.php";
        ?>
        <div class="jumbotron container-lg bg-white d-flex vw-100">
            <div class="container-lg container-fluid">
                <div class="row">
                    <div class="col-md-6 text-center d-flex flex-column align-items-center justify-content-center">
                        <img src="/assets/pup-logo.png" alt="PUP Logo" width="100">
                        <h1 class="display-4">PUP-SRC</h1>
                        <h2>Online Transaction Management System</h2>
                        <p class="lead">Choose an office to get started</p>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" class="btn btn-primary btn-lg btn-block mb-2 w-100 text-start">
                                    <img class="p-3" src="/assets/registration.png" alt="Registration Office Logo" width=80>
                                    Registrar
                                </a>
                            </div>
                            <div class="col-md-12">
                                <a href="guidance.php" class="btn btn-primary btn-lg btn-block mb-2 w-100 text-start">
                                    <img class="p-3" src="/assets/guidance.png" alt="Guidance Office Logo" width=80>
                                    Guidance
                                </a>
                            </div>
                            <div class="col-md-12">
                                <a href="academic.php" class="btn btn-primary btn-lg btn-block mb-2 w-100 text-start">
                                    <img class="p-3" src="/assets/academic.png" alt="Academic Office Logo" width=80>
                                    Academic
                                </a>
                            </div>
                            <div class="col-md-12">
                                <a href="#" class="btn btn-primary btn-lg btn-block mb-2 w-100 text-start">
                                    <img class="p-3" src="/assets/accounting.png" alt="Accounting Office Logo" width=80>
                                    Accounting
                                </a>
                            </div>
                            <div class="col-md-12">
                                <a href="#" class="btn btn-primary btn-lg btn-block mb-2 w-100 text-start">
                                    <img class="p-3" src="/assets/administration.png" alt="Administration Office Logo" width=80>
                                    Administrative Services
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script>
        $(document).ready(function(){
            $('.dropdown-submenu a.dropdown-toggle').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
            });
        });
    </script>
    </div>
</body>
</html>