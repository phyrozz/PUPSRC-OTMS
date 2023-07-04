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
    <!-- Loading page -->
    <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
    <div id="loader" class="center">
        <div class="loading-spinner"></div>
        <p class="loading-text display-3 pt-3">Getting things ready...</p>
    </div>
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
                        <p class="mb-0" >Always check your transaction status to follow instructions.</p>
                        <p class="mb-0">You can delete and edit transactions during <span class="badge rounded-pill bg-dark">Pending</span> status.</p>
                        <p class="mb-0"><small><span class="badge rounded-pill bg-dark">Pending</span> - The requester should settle the deficiency/ies to necessary office.</small></p>
                        <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: orange;">For receiving</span> - The request is currently in Receiving window and waiting for submission of requirements.</small></p>
                        <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: blue;">For evaluation</span> - Evaluation and Processing of records and required documents for releasing.</small></p>
                        <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: DodgerBlue;">Ready for pickup</span> - The requested document/s is/are already available for pickup at the releasing section of student records.</small></p>
                        <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: green;">Released</span> - The requested document/s was/were claimed.</small></p>
                        <!-- <p class="mb-0">You will find answers to the questions we get asked the most about requesting for academic documents through <a href="FAQ.php">FAQs</a>.</p> -->
                    </div>
                    <div class="d-flex w-100 justify-content-between p-0">
                        <div class="d-flex p-2">
                            <form class="d-flex input-group" action="transactions.php" method="post">
                                <select class="form-select" name="table-select">
                                    <option value="document_request" <?php if ($table === 'document_request') echo 'selected'; ?>>Document Requests</option>
                                    <option value="scheduled_appointments" <?php if ($table === 'scheduled_appointments') echo 'selected'; ?>>Counseling Schedules</option>
                                    <option value="payments" <?php if ($table === 'payments') echo 'selected'; ?>>Payments</option>
                                    <option value="request_equipment" <?php if ($table === 'request_equipment') echo 'selected'; ?>>Request of Equipment</option>
                                </select>
                                <button type="submit" name="filter-button" class="btn btn-primary">Filter</button>
                            </form>
                        </div>
                        <div class="d-flex justify-content-end p-2">
                            <div class="input-group d-flex justify-content-end">
                                <input type="text" class="form-control" placeholder="Search..." id="search-input">
                                <button class="btn btn-outline-primary" type="button" id="search-button"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div id="loading-indicator" class="text-center">
                        Loading...
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
                            } elseif ($table === 'request_equipment') {
                                include 'transaction_tables/request_equipment_table.php';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="push"></div>
    </div>
    <?php
        include "../footer.php";
        mysqli_close($connection);
    ?>
    <script src="../loading.js"></script>
    <script>
        $(document).ready(function(){
            $('.sortable-header').on('click', function() {
                var column = $(this).data('column');
                var order = $(this).data('order');

                // Toggle the sort order
                order = (order === 'asc') ? 'desc' : 'asc';

                // Reset the sort icons
                $('.sortable-header').data('order', 'asc').find('.sort-icon').removeClass('fa-sort-up fa-sort-down').addClass('fa-sort');

                // Update the clicked header's sort order and icon
                $(this).data('order', order).find('.sort-icon').removeClass('fa-sort').addClass(order === 'asc' ? 'fa-sort-up' : 'fa-sort-down');

                // Call the handlePagination function with the updated sort parameters
                handlePagination(1, '', column, order);
            });

            $('#search-button').on('click', function() {
                var searchTerm = $('#search-input').val();
                handlePagination(1, searchTerm);
            });

            // $('.dropdown-submenu a.dropdown-toggle').on("click", function(e){
            //     $(this).next('ul').toggle();
            //     e.stopPropagation();
            //     e.preventDefault();
            // });
        });

        function checkViewport() {
            if (window.innerWidth < 768) {
                document.getElementById('transactions-table').classList.add('text-nowrap', 'w-auto');
            } else {
                document.getElementById('transactions-table').classList.remove('text-nowrap', 'w-auto');
            }
        }

        // Check viewport initially and on window resize
        window.addEventListener('DOMContentLoaded', checkViewport);
        window.addEventListener('resize', checkViewport);
    </script>
    <script src="../../dark_mode.js"></script>
</body>
</html>