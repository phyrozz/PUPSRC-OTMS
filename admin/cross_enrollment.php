<?php
    // Include the database connection file (conn.php)
    include "../conn.php";

    $office_name = "Academic Office";
    include "navbar.php";
    include "tables/academic/student_info_modal.php";

    // Avoid admin user from accessing other office pages
    if ($_SESSION['office_name'] != "Academic Office") {
        header("Location: /admin/redirect.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Cross-Enrollment Transactions</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script src="../loading.js"></script>
	<script>
        // Wait for the page to load
        $(document).ready(function() {
            // Set the value of the dropdown to "crossenrollment" on page load
            $("#transaction-type").val("crossenrollment");

            // Handle the dropdown change event
            $("#transaction-type").change(function() {
                switch ($(this).val()) {
                    case "subjectoverload":
                        window.location.href = "subject_overload.php";
                        break;
                    case "gradeaccreditation":
                        window.location.href = "grade_accreditation.php";
                        break;
                    case "crossenrollment":
                        window.location.href = "cross_enrollment.php";
                        break;
                    case "shifting":
                        window.location.href = "shifting.php";
                        break;
                    case "manualenrollment":
                        window.location.href = "manual_enrollment.php";
                        break;
                    default:
                        break;
                }
            });

            // Handle status dropdown change event
            $("select.status-dropdown").change(function () {
                const userId = $(this).data("user-id");
                const statusType = $(this).data("status-type");
                const status = $(this).val();

                // Call the function to update the status in the database using AJAX
                updateStatusInDatabase(userId, statusType, status);

                // Remove the previous status class
                $(this).removeClass(function (index, className) {
                    return (className.match(/(^|\s)(bg-|text-)\S+/g) || []).join(" ");
                });

                // Add the new status class based on the selected status value
                switch (status) {
                    case "1":
                        $(this).addClass("bg-light");
                        $(this).addClass("text-dark");
                        break;
                    case "2":
                        $(this).addClass("bg-secondary");
                        $(this).addClass("text-light");
                        break;
                    case "3":
                        $(this).addClass("bg-dark");
                        $(this).addClass("text-light");
                        break;
                    case "4":
                        $(this).addClass("bg-success");
                        $(this).addClass("text-light");
                        break;
                    case "5":
                        $(this).addClass("bg-danger");
                        $(this).addClass("text-light");
                        break;
                    case "6":
                        $(this).addClass("bg-info");
                        $(this).addClass("text-dark");
                        break;
                    case "7":
                        $(this).addClass("bg-warning");
                        $(this).addClass("text-dark");
                        break;
                }
            });

            // Function to update the status in the database using AJAX
            function updateStatusInDatabase(userId, statusType, status) {
                $.ajax({
                    url: "tables/academic/update_status.php",
                    type: "POST",
                    data: {
                        userId: userId,
                        type: statusType,
                        status: status,
                    },
                    success: function (response) {
                        // Handle the response (optional)
                        console.log(response);
                    },
                    error: function (xhr, status, error) {
                        // Handle errors, if any
                        console.log("Error: " + error);
                    },
                });
            }
        });
    </script>
    <script src="tables/academic/student_info.js" defer></script>
</head>
<body>
    <?php include "tables/academic/status_info_modal.php"; ?>
    <div class="wrapper">
        <!-- Loading page -->
        <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
        <div id="loader" class="center">
            <div class="loading-spinner"></div>
            <p class="loading-text display-3 pt-3">Getting things ready...</p>
        </div>
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-xs-12">
                    <div class="d-flex w-100 justify-content-between align-items-center p-0">
                        <div class="d-flex p-2">
                            <div class="input-group">
                                <label for="transaction-type" class="input-group-text">Service: </label>
                                <select class="form-select" id="transaction-type">
                                    <option value="subjectoverload">Subject Overload</option>
                                    <option value="gradeaccreditation">Grade Accreditation</option>
                                    <option value="crossenrollment">Cross-Enrollment</option>
                                    <option value="shifting">Shifting</option>
                                    <option value="manualenrollment">Manual Enrollment</option>
                                </select>
                            </div>
                            <div class="input-group mx-2">
                                <label for="rows-per-page" class="input-group-text">Rows per Page:</label>
                                <select class="form-select" id="rows-per-page">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            <button class="btn btn-outline-primary w-100" id="status-info-btn">What do these statuses mean?</button>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <div class="input-group mb-3 d-flex justify-content-end">
                            <input type="text" class="form-control" id="search-input" placeholder="Search...">
                                <button class="btn btn-outline-primary" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="transactions-table" class="table table-hover table-hidden">
                            <thead>
                                <tr class="table-active">
                                    <th class="text-center" scope="col" style="background-color: #f2f2f2;">Requestor</th>
                                    <th class="text-center" scope="col" style="background-color: #f2f2f2;">Student Name</th>
                                    <!-- <th class="text-center" scope="col" style="background-color: #f2f2f2;">Transaction ID</th> -->
                                    <th class="text-center" scope="col" style="background-color: #f2f2f2;">Application Letter</th>
                                    <th class="text-center" scope="col" style="background-color: #f2f2f2;">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // Function to generate the options for the status dropdown
                                    function generateStatusOptions($selectedStatusID)
                                    {
                                        // You can fetch the status options from your database or define them manually
                                        $statusOptions = array(
                                            1 => "Missing",
                                            2 => "Pending",
                                            3 => "Under Verification",
                                            4 => "Verified",
                                            5 => "Rejected",
                                            6 => "To Be Evaluated",
                                            7 => "Need F to F Evaluation"
                                        );

                                        // Generate the options
                                        $options = "";
                                        foreach ($statusOptions as $statusID => $statusName) {
                                            $selected = ($statusID == $selectedStatusID) ? "selected" : "";
                                            $options .= "<option value='{$statusID}' {$selected}>{$statusName}</option>";
                                        }

                                        return $options;
                                    }

                                    // Fetch data from the acad_subject_overload table with join queries
                                    $query = "SELECT ao.transaction_id, u.user_id, u.last_name, u.first_name, u.middle_name, u.extension_name, u.student_no, ao.application_letter, ao.application_letter_status 
                                    FROM acad_cross_enrollment ao
                                    INNER JOIN users u ON ao.user_id = u.user_id
                                    ORDER BY u.student_no ASC";
                                    $result = $connection->query($query);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['student_no'] . "</td>";
                                            echo "<td><a href='#' class='user-details-link' data-user-id='" . $row['user_id'] . "'>" . $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['extension_name'] . "</a></td>";
                                            // echo "<td>" . $row['transaction_id'] . "</td>";
                                            echo "<td class='border'><div class='d-flex align-items-center justify-content-between'>";

                                            // Display link to overload letter attachment, if available
                                            if (!empty($row['application_letter'])) {
                                                echo '<a href="../assets/uploads/user_uploads/' . $row['application_letter'] . '" target="_blank" class="btn btn-primary"><i class="fa-solid fa-paperclip"></i> View attachment</a>';
                                            } else {
                                                echo 'No attachment';
                                            }

                                            echo '<select data-user-id="' . $row['user_id'] . '" data-status-type="applicationLetter" class="form-select status-dropdown';
                                            switch ($row['application_letter_status']) {
                                                case 1:
                                                    echo ' bg-light text-dark';
                                                    break;
                                                case 2:
                                                    echo ' bg-secondary text-light';
                                                    break;
                                                case 3:
                                                    echo ' bg-dark text-light';
                                                    break;
                                                case 4:
                                                    echo ' bg-success text-light';
                                                    break;
                                                case 5:
                                                    echo ' bg-danger text-light';
                                                    break;
                                                case 6:
                                                    echo ' bg-info text-dark';
                                                    break;
                                                case 7:
                                                    echo ' bg-warning text-dark';
                                                    break;
                                            }
                                            echo '">';
                                            echo generateStatusOptions($row['application_letter_status']);
                                            echo "</select></td></div>";
                                            echo "<td></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='9' class='text-center'>No records found.</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <nav class="d-flex w-100 justify-content-between p-2">
                <ul class="pagination">
                    <!-- Pagination links (generated dynamically using JavaScript) -->
                </ul>
            </nav>
        </div>
        <div class="push"></div>
    </div>
    <?php include '../footer.php'; ?>
    <script>
    $(document).ready(function () {
        // Number of rows to display per page
        var rowsPerPage = 10;
        var currentPage = 1;
        var totalPages;

        // Function to show a specific page
        function showPage(page) {
            var table = document.getElementById("transactions-table");
            var tr = table.getElementsByTagName("tr");
            for (var i = 1; i < tr.length; i++) {
                if (i >= (page - 1) * rowsPerPage + 1 && i <= page * rowsPerPage) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        // Initialize pagination
        showPage(1);

        // Function to calculate the total number of pages
        function calculateTotalPages() {
            var table = document.getElementById("transactions-table");
            var tr = table.getElementsByTagName("tr");
            totalPages = Math.ceil((tr.length - 1) / rowsPerPage);
        }

        // Update the pagination links based on the number of rows
        function updatePaginationButtons() {
            var paginationLinks = "";
            var maxButtons = 10; // Maximum number of buttons to show

            if (totalPages <= maxButtons) {
                // Show all buttons if total pages are less than or equal to maxButtons
                for (var i = 1; i <= totalPages; i++) {
                    paginationLinks += createPaginationButton(i);
                }
            } else {
                // Determine the range of buttons to show based on the current page
                var startButton = currentPage - Math.floor(maxButtons / 2);
                if (startButton < 1) {
                    startButton = 1;
                }
                var endButton = startButton + maxButtons - 1;
                if (endButton > totalPages) {
                    endButton = totalPages;
                    startButton = endButton - maxButtons + 1;
                }

                // Create previous button
                paginationLinks += createPaginationButton("prev");

                // Create numbered buttons within the range
                for (var i = startButton; i <= endButton; i++) {
                    paginationLinks += createPaginationButton(i);
                }

                // Create next button
                paginationLinks += createPaginationButton("next");
            }

            $(".pagination").html(paginationLinks);
        }

        // Function to create a pagination button
        function createPaginationButton(page) {
            var buttonText = page === "prev" ? "<i class='fa-solid fa-caret-left'></i> Previous" : page === "next" ? "Next <i class='fa-solid fa-caret-right'></i>" : page;
            var aClass = page === currentPage ? "btn-primary text-light" : "btn-outline-primary";
            var buttonLink = page === currentPage ? "#" : "#";

            // Add a custom class for "Next" and "Previous" buttons
            if (page === "prev" || page === "next") {
                aClass += " custom-nav-button";
            }

            return '<li class="page-item"><a class="page-link ' + aClass + '" href="' + buttonLink + '" data-page="' + page + '">' + buttonText + '</a></li>';
        }

        // Calculate the initial total pages and update pagination
        calculateTotalPages();
        updatePaginationButtons();

        // Handle pagination clicks
        $(".pagination").on("click", "a", function () {
            var page = $(this).data("page");
            if (page === "prev" && currentPage > 1) {
                currentPage--;
            } else if (page === "next" && currentPage < totalPages) {
                currentPage++;
            } else if (typeof page === "number" && page !== currentPage) {
                currentPage = page;
            }

            showPage(currentPage);
            updatePaginationButtons();
        });

        $('#status-info-btn').on('click', function() {
            $('#statusInfoModal').modal('show');
        });

        // Function to filter table rows based on student number
        function filterTable() {
            var input, filter, table, tr, tdNo, tdName, i, txtValueNo, txtValueName;
            input = document.getElementById("search-input");
            filter = input.value.toUpperCase();
            table = document.getElementById("transactions-table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                tdNo = tr[i].getElementsByTagName("td")[0];
                tdName = tr[i].getElementsByTagName("td")[1];

                if (tdNo || tdName) {
                    txtValueNo = tdNo ? tdNo.textContent || tdNo.innerText : "";
                    txtValueName = tdName ? tdName.textContent || tdName.innerText : "";

                    if (txtValueNo.toUpperCase().indexOf(filter) > -1 || txtValueName.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        $("#search-input").on("input", function () {
            filterTable();
        });

        // Handle changes in the "Rows per Page" dropdown
        $("#rows-per-page").change(function () {
            rowsPerPage = parseInt($(this).val());
            calculateTotalPages();
            showPage(1);
            updatePaginationButtons();
        });
    });
    </script>
</body>
</html>
