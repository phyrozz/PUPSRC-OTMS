<?php
    // Include the database connection file (conn.php)
    include "../conn.php";

    $office_name = "Academic Office";
    include "navbar.php";

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
    <title>Admin - Academic Office - Cross Enrollment Transactions</title>
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
</head>
<body>
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
                    <div class="d-flex w-100 justify-content-between p-0">
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
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <div class="input-group mb-3 d-flex justify-content-end">
                                <input type="text" class="form-control" placeholder="Search...">
                                <button class="btn btn-outline-primary" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <table id="transactions-table" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col" style="background-color: #f2f2f2;">Requestor</th>
                                <th class="text-center" scope="col" style="background-color: #f2f2f2;">Application</th>
                                <th class="text-center" scope="col" style="background-color: #f2f2f2;">Transaction ID</th>
                                <th class="text-center" scope="col" style="background-color: #f2f2f2;">Application Letter</th>
                                <th class="text-center" scope="col" style="background-color: #f2f2f2;">Status</th>
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
                                        5 => "Rejected"
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
                                $query = "SELECT ao.transaction_id, u.user_id, u.student_no, ao.application_letter, ao.application_letter_status
                                          FROM acad_cross_enrollment ao
                                          INNER JOIN users u ON ao.user_id = u.user_id";
                                $result = $connection->query($query);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['student_no'] . "</td>";
                                        echo "<td>Cross Enrollment</td>";
                                        echo "<td>" . $row['transaction_id'] . "</td>";
                                        echo "<td>";

                                        // Display link to overload letter attachment, if available
                                        if (!empty($row['application_letter'])) {
                                            echo '<a href="../assets/uploads/user_uploads/' . $row['r_application_letter'] . '" target="_blank" class="btn btn-primary">View attachment</a>';
                                        } else {
                                            echo 'No attachment';
                                        }

                                        echo "</td>";
                                        echo '<td><select class="form-select status-dropdown" data-user-id="' . $row['user_id'] . '" data-status-type="applicationLetter">';
                                        echo generateStatusOptions($row['application_letter_status']);
                                        echo "</select></td>";

                                        
                                    }
                                } else {
                                    echo "<tr><td colspan='9' class='text-center'>No records found.</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex w-100 justify-content-between p-2">
                <!-- Add footer buttons here -->
            </div>
        </div>
        <div class="push"></div>
    </div>
    <?php include '../footer.php'; ?>
    <script>
        // ... (existing JavaScript code remains unchanged) ...
    </script>
</body>
</html>