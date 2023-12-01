<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUPSRC-OTMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <!-- Loading page -->
    <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
    <div id="loader" class="center">
        <div class="loading-spinner"></div>
        <p class="loading-text display-3 pt-3">Getting things ready...</p>
    </div>
    <link rel="stylesheet" href="/bg.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="dark-overlay">
        <?php
            $office_name = "Select an Office";
            include "../conn.php";
            include "navbar.php";
        ?>
        <div class="jumbotron container-lg d-flex vw-100">
            <div class="jumbotron-body container-lg container-fluid">
                <div class="row">
                    <div class="col-md-6 text-center d-flex flex-column align-items-center justify-content-center">
                        <img src="/assets/pup-logo.png" alt="PUP Logo" width="80">
                        <h1 class="display-5">PUP-SRC</h1>
                        <h3>Online Transaction Management System</h3>
                        <p class="lead"><small>Choose an office to get started</small></p>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="registrar.php" class="btn btn-primary btn btn-block mb-2 w-100 text-start">
                                    <img class="p-2" src="/assets/registration.png" alt="Registration Office Logo" width=65>
                                    Registrar
                                </a>
                            </div>
                            <div class="col-md-12">
                                <a href="guidance.php" class="btn btn-primary btn btn-block mb-2 w-100 text-start">
                                    <img class="p-2" src="/assets/guidance.png" alt="Guidance Office Logo" width=65>
                                    Guidance
                                </a>
                            </div>
                            <div class="col-md-12">
                                <a href="academic.php" class="btn btn-primary btn btn-block mb-2 w-100 text-start">
                                    <img class="p-2" src="/assets/academic.png" alt="Academic Office Logo" width=65>
                                    Academic
                                </a>
                            </div>
                            <div class="col-md-12">
                                <a href="accounting.php" class="btn btn-primary btn btn-block mb-2 w-100 text-start">
                                    <img class="p-2" src="/assets/accounting.png" alt="Accounting Office Logo" width=65>
                                    Accounting
                                </a>
                            </div>
                            <div class="col-md-12">
                                <a href="administrative.php" class="btn btn-primary btn btn-block mb-2 w-100 text-start">
                                    <img class="p-2" src="/assets/administration.png" alt="Administration Office Logo" width=65>
                                    Administrative Services
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../loading.js"></script>
    <script>
        $(document).ready(function(){
            $('.dropdown-submenu a.dropdown-toggle').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
            });
        });
    </script>
    <script src="../saved_settings.js"></script>
    </div>
</body>
</html>