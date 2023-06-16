<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php
            $office_name = "Select an Office";
            include "../conn.php";
            include "navbar.php";
            include "../breadcrumb.php";

            $table = 'document_request';

            if (isset($_POST['filter-button'])) {
                $table = $_POST['table-select'];
            }
        ?>
        <div class="container-fluid p-4">
            <?php
            $breadcrumbItems = [
                ['text' => 'My Transactions', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, true);
            ?>
        </div>
        <div class="container-fluid text-center p-4">
            <h1>My Transactions</h1>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">
                        <i class="fa-solid fa-circle-info"></i> Reminder
                        </h4>
                        <p>You must set an appointment for approved document requests before retrieving it from their respective offices.</p>
                        <p class="mb-0">To set or edit an appointment, click the <i class="fa-brands fa-wpforms"></i> button on the table.</p>
                    </div>
                    <div class="d-flex w-100 justify-content-between p-0">
                        <div class="d-flex p-2">
                            <form class="d-flex" action="transactions.php" method="post">
                                <select class="form-select" name="table-select">
                                    <option value="document_request" <?php if ($table === 'document_request') echo 'selected'; ?>>Document Requests</option>
                                    <option value="scheduled_appointments" <?php if ($table === 'scheduled_appointments') echo 'selected'; ?>>Counseling Schedules</option>
                                    <option value="payments" <?php if ($table === 'payments') echo 'selected'; ?>>Payments</option>
                                </select>
                                <button type="submit" name="filter-button" class="btn btn-primary">Filter</button>
                            </form>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <div class="input-group mb-3 d-flex justify-content-end">
                                <input type="text" class="form-control" placeholder="Search...">
                                <button class="btn btn-outline-primary" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div id="table-container">
                        <?php
                            // Load the requested table
                            if ($table === 'document_request') {
                                include 'transaction_tables/document_request_table.php';
                            } elseif ($table === 'scheduled_appointments') {
                                include 'transaction_tables/scheduled_appointments_table.php';
                            } elseif ($table === 'payments') {
                                include 'transaction_tables/payments_table.php';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="push"></div>
    </div>
    <footer class="footer container-fluid w-100 text-md-left text-center d-md-flex align-items-center justify-content-center bg-light flex-nowrap">
        <div>
            <small>PUP Santa Rosa - Online Transaction Management System Beta 0.1.0</small>
        </div>
        <div>
            <small><a href="https://www.pup.edu.ph/terms/" target="_blank" class="btn btn-link">Terms of Use</a>|</small>
            <small><a href="https://www.pup.edu.ph/privacy/" target="_blank" class="btn btn-link">Privacy Statement</a></small>
        </div>
    </footer>
    <?php
        mysqli_close($connection);
    ?>
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