<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Guidance Office</title>
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
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php
            include "../conn.php";
            include "navbar.php";

            // Avoid admin user from accessing other office pages
            if ($_SESSION['office_name'] != "Guidance Office") {
                header("Location: /admin/redirect.php");
            }

            $table = 'document_request';

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
                                <form id="defaultTableValueSelect" class="d-flex input-group" action="guidance.php" method="post">
                                    <label class="input-group-text" for="table-select">Service:</label>    
                                    <select id="transactionTableSelect" class="form-select" name="table-select">
                                        <option value="document_request" <?php if ($table === 'document_request') echo 'selected'; ?>>Document Requests</option>
                                        <option value="scheduled_appointments" <?php if ($table === 'scheduled_appointments') echo 'selected'; ?>>Counseling Schedules</option>
                                        <option value="student_records" <?php if ($table === 'student_records') echo 'selected'; ?>>Student Records</option>
                                        <option value="guidance_feedbacks" <?php if ($table === 'guidance_feedbacks') echo 'selected'; ?>>Feedbacks</option>
                                    </select>
                                    <button id="tableSelectSubmit" type="submit" name="filter-button" class="btn btn-primary"><i class="fas fa-refresh"></i> Load Table</button>
                                </form>
                            </div>
                            <div>
                                <div id="filterByStatusSection" class="input-group">
                                    <label class="input-group-text" for="filterByStatus">Filter by Status:</label>
                                    <select name="filterByStatus" id="filterByStatus" class="form-select">
                                        <!-- Select options are dynamically displayed depending on the table -->
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div id="filterByDocTypeSection" class="input-group">
                                    <label class="input-group-text" for="filterByDocType">Filter by Document Type:</label>
                                    <select name="filterByDocType" id="filterByDocType" class="form-select">
                                        <option value="all">All</option>
                                        <option value="goodMoral">Good Moral Document</option>
                                        <option value="clearance">Clearance</option>
                                    </select>
                                </div>
                                <button type="button" id="filterButton" name="filterButton" class="btn btn-primary mt-2"><i class="fa-solid fa-filter"></i> Filter</button>
                                <?php if ($table === 'document_request') { ?>
                                    <button id="generate-doc-requests" name="generate-doc-requests" class="btn btn-primary mt-2"><i class="fas fa-file-pdf"></i> Generate Document Request Report</button>
                                <?php } ?>
                                <?php if ($table === 'scheduled_appointments') { ?>
                                    <button id="generate-counseling" name="generate-counseling" class="btn btn-primary mt-2"><i class="fas fa-file-pdf"></i> Generate Counseling Schedule Report</button>
                                <?php } ?>
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
                            if ($table === 'document_request') {
                                include 'tables/guidance/doc_requests.php';
                            }
                            elseif ($table === 'scheduled_appointments') {
                                include 'tables/guidance/counseling_appointments.php';
                            }
                            elseif ($table === 'student_records') {
                                include 'tables/guidance/student_records.php';
                            }
                            elseif ($table === 'guidance_feedbacks') {
                                include 'tables/guidance/feedbacks_table.php';
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
            $("#generate-doc-requests").on('click', function() {
                $("#confirmGenerateReportModal").modal("show");
            });
            $("#generate-counseling").on('click', function() {
                $("#confirmGenerateReportModal").modal("show");
            });

            // "dr" stands for document request, "gc" for guidance counseling
            $('#generate-dr-to-pdf-btn').on('click', function() {
                var selectedStatus = $("#filterByStatus").val();
                var selectedDocType = $("#filterByDocType").val();
                var searchValue = $("#search-input").val(); // Get the value of the search input

                // Encode the selected values and search query to be URL-safe
                var encodedStatus = encodeURIComponent(selectedStatus);
                var encodedDocType = encodeURIComponent(selectedDocType);
                var encodedSearchValue = encodeURIComponent(searchValue);

                // Construct the URL with the updated parameters
                var link = "tables/guidance/doc_request_reports.php?status=" + encodedStatus + "&doc_type=" + encodedDocType + "&search=" + encodedSearchValue;
                
                window.open(link, '_blank');
            });

            $('#generate-dr-to-csv-btn').on('click', function() {
                var selectedStatus = $("#filterByStatus").val();
                var selectedDocType = $("#filterByDocType").val();
                var searchValue = $("#search-input").val();

                var encodedStatus = encodeURIComponent(selectedStatus);
                var encodedDocType = encodeURIComponent(selectedDocType);
                var encodedSearchValue = encodeURIComponent(searchValue);

                var link = "tables/guidance/doc_request_csv.php?status=" + encodedStatus + "&doc_type=" + encodedDocType + "&search=" + encodedSearchValue;

                window.open(link, '_blank');
            });

            $('#generate-gc-to-pdf-btn').on('click', function() {
                var selectedStatus = $("#filterByStatus").val();
                var selectedDocType = $("#filterByDocType").val();
                var searchValue = $("#search-input").val();

                var encodedStatus = encodeURIComponent(selectedStatus);
                var encodedDocType = encodeURIComponent(selectedDocType);
                var encodedSearchValue = encodeURIComponent(searchValue);

                var link = "tables/guidance/counseling_reports.php?status=" + encodedStatus + "&doc_type=" + encodedDocType + "&search=" + encodedSearchValue;
                
                window.open(link, '_blank');
            });

            $('#generate-gc-to-csv-btn').on('click', function() {
                var selectedStatus = $("#filterByStatus").val();
                var selectedDocType = $("#filterByDocType").val();
                var searchValue = $("#search-input").val();

                var encodedStatus = encodeURIComponent(selectedStatus);
                var encodedDocType = encodeURIComponent(selectedDocType);
                var encodedSearchValue = encodeURIComponent(searchValue);

                var link = "tables/guidance/counseling_reports_csv.php?status=" + encodedStatus + "&doc_type=" + encodedDocType + "&search=" + encodedSearchValue;
                
                window.open(link, '_blank');
            });


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

                if (selectedTable === "document_request") {
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

        // Get the select element on "Filter by Status" dropdown
        var filterByStatusSelect = document.getElementById('filterByStatus');

        // Define the statuses array
        var statuses = <?php echo json_encode($statuses); ?>;

        // Generate the options
        var allOption = document.createElement('option');
        allOption.value = 'all';
        allOption.textContent = 'All';
        filterByStatusSelect.appendChild(allOption);

        for (var key in statuses) {
            if (statuses.hasOwnProperty(key) && key !== 'all') {
                var option = document.createElement('option');
                option.value = key;
                option.textContent = statuses[key];
                filterByStatusSelect.appendChild(option);
            }
        }
    </script>
    <script src="../loading.js"></script>
</body>
</html>