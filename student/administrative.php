<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrative - Welcome</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>

<?php
    $office_name = "Administrative Office";
    include "navbar.php";
    include "../breadcrumb.php";
?>

<body>
 
    <div class="container-fluid administrative-header header">
        <?php
        $breadcrumbItems = [
            ['text' => 'Administrative Office', 'active' => true],
        ];

        echo generateBreadcrumb($breadcrumbItems, false);
        ?>
        <h1 class="display-1 header-text text-center text-light font-weight-bold">Administrative Office</h1>
        <p class="header-text text-center text-light">Choose from one of the services below to get started</p>
    </div>
    <div class="container-fluid p-2 d-flex flex-wrap flex-column justify-content-center gap-2 text-center">
        <a href="./administrative/request-equip.php" class="btn btn-maroon btn-link d-block text-decoration-none bg-maroon text-light p-4 rounded-0">
            <h2>Request of School Equipment</h2>
            <p>Request of equipment inside the campus.</p>
        </a>
   
        <a href="./administrative/request-equip.php" class="btn btn-maroon btn-link d-block text-decoration-none bg-maroon text-light p-4 rounded-0">
        <h2>School Facility Appointment</h2>
            <p>Request of Facilities for campus event purposes. </p>
        </a>
    </div>
    <div class="footer container-fluid w-100 d-flex flex-column text-center align-items-center justify-content-end p-3">
        <h6>PUPSRC-OTMS Beta version 0.1.0</h6>
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
</body>
</html>