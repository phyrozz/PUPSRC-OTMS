<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Accounting Office</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <!-- Loading page -->
    <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
    <div id="loader" class="center">
        <div class="loading-spinner"></div>
        <p class="loading-text display-3 pt-3">Getting things ready...</p>
    </div>
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php
            include "../conn.php";
            include "navbar.php";

            // Avoid admin user from accessing other office pages
            if ($_SESSION['office_name'] != "Accounting Office") {
                header("Location: http://localhost/admin/redirect.php");
            }

            $table = 'payments';

            if (isset($_POST['filter-button'])) {
                $table = $_POST['table-select'];
            }
        ?>
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-xs-12">
                    <div class="d-md-flex w-100 pb-2 justify-content-between align-items-end">
                        <div class="d-flex flex-column gap-1">
                            <div>
                                <form id="defaultTableValueSelect" class="d-flex input-group" action="accounting.php" method="post">
                                    <label class="input-group-text" for="table-select">Service:</label>    
                                    <select id="transactionTableSelect" class="form-select" name="table-select">
                                        <option value="payments" <?php if ($table === 'payments') echo 'selected'; ?>>Payments</option>
                                        <option value="offsetting" <?php if ($table === 'offsetting') echo 'selected'; ?>>Offsetting</option>
                                    </select>
                                    <button id="tableSelectSubmit" type="submit" name="filter-button" class="btn btn-primary">Load Table</button>
                                </form>
                            </div>

                            <div>
                                <div id="filterByDocTypeSection" class="input-group">
                                    <label class="input-group-text" for="filterByDocType">Filter by Document Type:</label>
                                    <select name="filterByDocType" id="filterByDocType" class="form-select">
                                        <option value="all">All</option>
                                        <option value="Application for Graduation SIS and Non-SIS">Application for Graduation SIS and Non-SIS</option>
                                        <option value="Correction of Entry of Grade">Correction of Entry of Grade</option>
                                        <option value="Completion of Incomplete Grade">Completion of Incomplete Grade</option>
                                        <option value="Late Reporting of Grade">Late Reporting of Grade</option>
                                        <option value="Processing of Request for Correction of Name: PSA/School Records">Processing of Request for Correction of Name: PSA/School Records</option>
                                        <option value="Certification, Verification, Authentication (CAV/Apostile)">Certification, Verification, Authentication (CAV/Apostile)</option>
                                        <option value="Certificate of Attendance">Certificate of Attendance</option>
                                        <option value="Certificate of Graduation">Certificate of Graduation</option>
                                        <option value="Certificate of Medium of Instruction">Certificate of Medium of Instruction</option>
                                        <option value="Certificate of General Weighted Average (GWA)">Certificate of General Weighted Average (GWA)</option>
                                        <option value="Non Issuance of Special Order">Non Issuance of Special Order </option>
                                        <option value="Course/Subject Description">Course/Subject Description</option>
                                        <option value="Certificate of Transfer Credential/Honorable Dismissal">Certificate of Transfer Credential/Honorable Dismissal</option>
                                        <option value="Transcript of Records (Second and succeeding copies)">Transcript of Records (Second and succeeding copies)</option>
                                        <option value="Transcript of Records (Copy for Another School)">Transcript of Records (Copy for Another School)</option>
                                        <option value="Course Accreditation Service (for Transferees)">Course Accreditation Service (for Transferees)</option>
                                        <option value="Informative Copy of Grades">Informative Copy of Grades</option>
                                        <option value="Certified True Copy">Certified True Copy</option>
                                        <option value="Academic Verification Service">Academic Verification Service</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                                <button type="button" id="filterButton" name="filterButton" class="btn btn-primary mt-2"><i class="fa-solid fa-filter"></i> Filter</button>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
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
                            if ($table === 'payments') {
                                include 'tables/accounting/payments_table.php';
                            }
                            elseif ($table === 'offsetting') {
                                include 'tables/guidance/counseling_appointments.php';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="push"></div>
    </div>
    <?php include '../footer.php'; ?>
    <script>
        $(document).ready(function(){
            $('.dropdown-submenu a.dropdown-toggle').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
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

            // Function to show or hide the "Filter by Document Type" section
            function toggleFilterByDocTypeSection() {
                var selectedTable = $("#transactionTableSelect").val();

                if (selectedTable === "payments") {
                    $("#filterByDocTypeSection").show();
                } else {
                    $("#filterByDocTypeSection").hide();
                }
            }

            // Call the toggle function initially
            toggleFilterByDocTypeSection();

            // Event listener for the table select dropdown change
            $("#tableSubmitSelect").on('click', function() {
                toggleFilterByDocTypeSection();
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
    <script src="../loading.js"></script>
</body>
</html>