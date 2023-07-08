<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility Appointment</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../style.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="wrapper">
        
    <?php  
        $office_name = "Administrative Office";
        include "../navbar.php";
        include "../../breadcrumb.php";
        include "conn.php";

        $query = "SELECT student_no, last_name, first_name, middle_name, extension_name, email FROM users WHERE user_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        if (isset($_POST['facilityFormSubmit'])) {
            $email = $_POST['email'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            $startTime = $_POST['startTime'];
            $endTime = $_POST['endTime'];
            $statusId = 3;
            $course = $_POST['course'];
            $section = $_POST['section'];
            $purpose = $_POST['purposeReq'];
            $startDateTimeSched = $startDate . ' ' . $startTime;
            $endDateTimeSched = $endDate . ' ' . $endTime;
            $facilityID = $_POST['id'];
            
            $insertQuery = "INSERT INTO appointment_facility (start_date_time_sched, end_date_time_sched, user_id, status_id, course, section, email, purpose, facility_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $connection->prepare($insertQuery);
            $insertStmt->bind_param("ssiissssi", $startDateTimeSched, $endDateTimeSched, $_SESSION['user_id'], $statusId, $course, $section, $email, $purpose, $facilityID);

            if ($insertStmt->execute()) {
                $_SESSION['success'] = true;
                // header("Refresh:0");
                
                // Update the facility availability to "Unavailable" after successful request
                $updateQuery = "UPDATE facility SET availability = 'Unavailable' WHERE facility_id = ?";
                $updateStmt = $connection->prepare($updateQuery);
                $updateStmt->bind_param("i", $facilityID);
                $updateStmt->execute();
                $updateStmt->close();
                
                // Add the request details to the session
                $_SESSION['appointment_details'] = [

                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'startTime' => $startTime,
                    'endTime' => $endTime,
                    'user_id' => $_SESSION['user_id'],
                    'status_id' => $statusId,
                    'purposeReq' => $purpose,
                    'facility_id' => $facilityID,
                    'course' => $course,
                    'section' => $section,
                ];
            } else {
                var_dump($insertStmt->error);
            }

            $insertStmt->close();
            $connection->close();
        }
    ?>

        <div class="container-fluid p-4">
            <?php
            $breadcrumbItems = [
                ['text' => 'Administrative Office', 'url' => '../administrative.php', 'active' => false],
                ['text' => 'Facility Appointment', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, true);
            ?>
        <div class="container-fluid text-center p-4">
            <h1>Facility Appointment</h1>
        </div>
        <div class="container-fluid">
            <div class="row g-1">
                <div class="card col-md-3 p-0 m-1">
                    <div class="card-header">
                        <h6>PUP Data Privacy Notice</h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <p><small>PUP respects and values your rights as a data subject under the Data Privacy Act (DPA). PUP is committed to protecting the personal data you provide in accordance with the requirements under the DPA and its IRR. In this regard, PUP implements reasonable and appropriate security measures to maintain the confidentiality, integrity and availability of your personal data. For more detailed Privacy Statement, you may visit <a href="https://www.pup.edu.ph/privacy/" target="_blank">https://www.pup.edu.ph/privacy/</a></small></p>
                        <div class="d-flex flex-column">
                            <a class="btn btn-outline-primary mb-2" href="../transactions.php">
                            <i class="fa-regular fa-clipboard"></i> My Transactions
                            </a>
                           
                            <button class="btn btn-outline-primary mb-2" onclick="location.reload()">
                                <i class="fa-solid fa-arrows-rotate"></i> Reset Form
                            </button>
                            <a href="help.php" class="btn btn-outline-primary mb-2">
                                <i class="fa-solid fa-circle-question"></i> Help
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card col-md p-0 m-1">
                    <div class="card-header">
                        <h6>Appointment Form</h6>
                    </div>
                    <div class="card-body">
                        <form action="request-facility.php" id="appointment-form" class="needs-validated row g-3" method="POST" novalidate>
                            <input type="hidden" name="form_type" value="appointment_form">
                            <small>Fields highlighted in <small style="color: red"><b>*</b></small> are required.</small>
                            <h6>Student Information</h6>
                            <div class="form-group required col-12">
                                <label for="studentNumber" class="form-label">Student Number</label>
                                <input type="text" class="form-control" id="studentNumber" value=" <?php echo $userData[0]['student_no'] ?>" maxlength="15" disabled required>
                            </div>
                            <div class="form-group required col-12">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" value=" <?php echo $userData[0]['last_name'] ?>" maxlength="100" disabled required>
                            </div>
                            <div class="form-group required col-12">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" value=" <?php echo $userData[0]['first_name'] ?>" maxlength="100" disabled required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middleName" value=" <?php echo $userData[0]['middle_name'] ?>" maxlength="100" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="extensionName" class="form-label">Extension Name</label>
                                <input type="text" class="form-control" id="extensionName" value=" <?php echo $userData[0]['extension_name'] ?>" maxlength="11" disabled required>
                            </div>
                            <!-- <div class="form-group col-12">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contactNumber" name="contactNumber" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Example: 0123-456-7890" maxlength="13">
                            </div> -->
                            <div class="form-group required col-12">
                                
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder = "example@gmail.com" maxlength="50" required>
                                <div class="invalid-feedback">Please input a valid email</div>
                            </div>

                            <div class="form-group required col-md-6">
                                <label for="course" class="form-label">Course</label>
                                <select class="form-control form-select" name="course" id="course" required>
                                    <option value="">--Select--</option>
                                    <option value="BSA">BSA</option>
                                    <option value="BSBAMM">BSBAMM</option>
                                    <option value="BSBAHRM">BSBAHRM</option>
                                    <option value="BSECE">BSECE</option>
                                    <option value="BSEdEng">BSEd Eng</option>
                                    <option value="BSEdMath">BSEd Math</option>
                                    <option value="BSEM">BSEM</option>
                                    <option value="BSIE">BSIE</option>
                                    <option value="BSIT">BSIT</option>
                                    <option value="BSPSY">BSPSY</option>
                                </select>

                                <div class="invalid-feedback">Please choose a course.</div>
                            </div>

                            <div class="form-group required col-md-6">
                                <label for="section" class="form-label">Section</label>
                                <select class="form-control form-select" name="section" id="section" required>
                                    <option value="">--Select--</option>
                                    <option value="1-1">1-1</option>
                                    <option value="1-2">1-2</option>
                                    <option value="1-3">1-3</option>
                                    <option value="1-4">1-4</option>
                                    <option value="2-1">2-1</option>
                                    <option value="2-2">2-2</option>
                                    <option value="2-3">2-3</option>
                                    <option value="2-4">2-4</option>
                                    <option value="3-1">3-1</option>
                                    <option value="3-2">3-2</option>
                                    <option value="3-3">3-3</option>
                                    <option value="3-4">3-4</option>
                                    <option value="4-1">4-1</option>
                                    <option value="4-2">4-2</option>
                                    <option value="4-3">4-3</option>
                                    <option value="4-4">4-4</option>
                                </select>
                                <div class="invalid-feedback">Please choose a section.</div>
                            </div>

                            <h6 class="mt-5">Appointment Information</h6>

                            <div class="form-group required col-md-6">
                                <label for="facilityName" class="form-label">Facility Name</label>
                                <input type="text" class="form-control" id="facilityName" name="facilityName" value="<?php echo isset($_GET['facility_name']) ? $_GET['facility_name'] : ''; ?>" disabled required>
                                <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                                
                            </div>

                            <div class="form-group required col-md-6">
                                <label for="facilityNum" class="form-label">Room Number</label>
                                <input type="text" class="form-control" id="facilityNum" name="facilityNum"value="<?php echo isset($_GET['facility_number']) ? $_GET['facility_number'] : ''; ?>" disabled required>
                            </div>
                           
                            
                            <div class="form-group required col-md-6">
                                <label for="startDate" class="form-label">Date Requested</label>
                                <input type="date" class="form-control" name="startDate" id="startDate" required>
                                <div class="invalid-feedback">Please choose a different request date</div>
                            </div>
                            <div class="form-group required col-md-6">
                                <label for="endDate" class="form-label">Date Ended</label>
                                <input type="date" class="form-control" name="endDate" id="endDate" required>
                                <div class="invalid-feedback">Please choose a different end date.</div>
                            </div>
                            <div class="form-group required col-md-6">
                                <label for="startTime" class="form-label">Time Requested</label>
                                <select class="form-control form-select" name="startTime" id="startTime" required>
                                    <option value="">--Select--</option>
                                    <option value="08:00:00">8:00 AM</option>
                                    <option value="08:30:00">8:30 AM</option>
                                    <option value="09:00:00">9:00 AM</option>
                                    <option value="09:30:00">9:30 AM</option>
                                    <option value="10:00:00">10:00 AM</option>
                                    <option value="10:30:00">10:30 AM</option>
                                    <option value="11:00:00">11:00 AM</option>
                                    <option value="11:30:00">11:30 AM</option>
                                    <option value="12:00:00">12:00 PM</option>
                                    <option value="12:30:00">12:30 PM</option>
                                    <option value="13:00:00">1:00 PM</option>
                                    <option value="13:30:00">1:30 PM</option>
                                    <option value="14:00:00">2:00 PM</option>
                                    <option value="14:30:00">2:30 PM</option>
                                    <option value="15:00:00">3:00 PM</option>
                                    <option value="15:30:00">3:30 PM</option>
                                    <option value="16:00:00">4:00 PM</option>
                                    <option value="16:30:00">4:30 PM</option>
                                    <option value="17:00:00">5:00 PM</option>
                                    <option value="17:30:00">5:30 PM</option>
                                    <option value="18:00:00">6:00 PM</option>
                                    <option value="18:30:00">6:30 PM</option>
                                    <option value="19:00:00">7:00 PM</option>
                                    <option value="19:30:00">7:30 PM</option>
                                    <option value="20:00:00">8:00 PM</option>
                                </select>
                                <div class="invalid-feedback">Please choose a requested time.</div>
                            </div>

                            <div class="form-group required col-md-6">
                                <label for="endTime" class="form-label">Time Ended</label>
                                <select class="form-control form-select" name="endTime" id="endTime" required>
                                    <option value="">--Select--</option>
                                    <option value="08:30:00">8:30 AM</option>
                                    <option value="09:00:00">9:00 AM</option>
                                    <option value="09:30:00">9:30 AM</option>
                                    <option value="10:00:00">10:00 AM</option>
                                    <option value="10:30:00">10:30 AM</option>
                                    <option value="11:00:00">11:00 AM</option>
                                    <option value="11:30:00">11:30 AM</option>
                                    <option value="12:00:00">12:00 PM</option>
                                    <option value="12:30:00">12:30 PM</option>
                                    <option value="13:00:00">1:00 PM</option>
                                    <option value="13:30:00">1:30 PM</option>
                                    <option value="14:00:00">2:00 PM</option>
                                    <option value="14:30:00">2:30 PM</option>
                                    <option value="15:00:00">3:00 PM</option>
                                    <option value="15:30:00">3:30 PM</option>
                                    <option value="16:00:00">4:00 PM</option>
                                    <option value="16:30:00">4:30 PM</option>
                                    <option value="17:00:00">5:00 PM</option>
                                    <option value="17:30:00">5:30 PM</option>
                                    <option value="18:00:00">6:00 PM</option>
                                    <option value="18:30:00">6:30 PM</option>
                                    <option value="19:00:00">7:00 PM</option>
                                    <option value="19:30:00">7:30 PM</option>
                                    <option value="20:00:00">8:00 PM</option>
                                </select>
                                <div class="invalid-feedback">Please choose an end time.</div>
                            </div>


                            <div class="form-group required col-md-12">
                                <label for="appointment_description" class="form-label">Purpose of Appointment</label>
                                <textarea type="purposeReq" class="form-control form-control-lg" id="purposeReq"  name="purposeReq" style="resize: none;"  rows="4" minlength="5"maxlength="100" required></textarea>
                                <div class="invalid-feedback">Please provide a reason.</div>
                            </div>
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">
                                <i class="fa-solid fa-circle-info"></i> Reminder
                                </h4>
                                <p>Your appointment request will be forwarded to the concerned office after you click the "Submit" button.</p>
                                <p>A .PDF file of your letter will be generated after successfully submitting this form and must be submitted to the Director's office before your scheduled appointment.</p>
                                <p>Confirmation (approved/disapproved) of the appointment will be sent to your registered email.</p>
                                <p class="mb-0">You may also constantly monitor the status of the appointment by going to <b>My Transactions</b>.</p>
                            </div>
                            <div class="d-flex w-100 justify-content-between p-1">
                                <button class="btn btn-primary px-4" onclick="window.history.go(-1); return false;">
                                    <i class="fa-solid fa-arrow-left"></i> Back
                                </button>
                                <!-- <button id="saveLaterBtn" class="btn btn-primary w-15">Save Later</button> -->
                                <button id="submitBtn" type="button" class="btn btn-primary w-25">Submit</button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmSubmitModalLabel">Confirm Form Submission</h5>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to submit this form?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" id="submit" class="btn btn-primary" name="facilityFormSubmit" data-bs-toggle="modal" data-bs-target="#successModal">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Success alert modal -->
                        <div id="successModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"> 
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>Your appointment request has been submitted successfully!</p>
                                        <p>You can check the status of your appointment request on the <b>My Transactions</b> page.</p>
                                        <p><b>You must print this letter and submit it to the Administrative Office before your request.</b></p>
                                        <button type="button" class="btn btn-primary" onclick="redirectToAnotherPage()">Show Letter</button>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="redirectToViewEquipment()">Create another appointment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="push"></div>
    </div>
    <div class="footer container-fluid w-100 text-md-left text-center d-md-flex align-items-center justify-content-center bg-light flex-nowrap">
        <div>
            <small>PUP Santa Rosa - Online Transaction Management System Beta 0.1.0</small>
        </div>
        <div>
            <small><a href="https://www.pup.edu.ph/terms/" target="_blank" class="btn btn-link">Terms of Use</a>|</small>
            <small><a href="https://www.pup.edu.ph/privacy/" target="_blank" class="btn btn-link">Privacy Statement</a></small>
        </div>
    </div>
    <script src="jquery.js"></script>
    
    <script>
        var date = new Date();

        // Get the day, month, and year
        let day = date.getDate();
        day = day.toString().padStart(2, '0');
        let month = date.getMonth() + 1;
        month = month.toString().padStart(2, '0');
        let year = date.getFullYear();

        // Format the current date
        let currentDate = `${year}-${month}-${day}`;

        // Define the maximum date allowed
        var maxDate = "2030-12-31";

        // Set the minimum and maximum dates for the "Date Requested" input field
        document.getElementById("startDate").min = currentDate;
        document.getElementById("endDate").max = maxDate;


        // Set the minimum date for the "Date Ended" input field to the selected date in "Date Requested"
        document.getElementById("startDate").addEventListener("change", () => {
        const selectedDate = document.getElementById("startDate").value;
        document.getElementById("endDate").min = selectedDate;
        });


        // Get the date requested and date ended input elements
        const startDateInput = document.getElementById("startDate");
        const endDateInput = document.getElementById("endDate");

        // Get the time requested and time ended input elements
        const startTimeInput = document.getElementById("startTime");
        const endTimeInput = document.getElementById("endTime");
        


        // Function to update the options in the time ended dropdown based on selected dates
        function updateEndTimeOptions() {
        const startDateValue = startDateInput.value;
        const endDateValue = endDateInput.value;
        const startTimeValue = startTimeInput.value;
        const endTimeValue = endTimeInput.value;

        if (startDateValue === endDateValue) {
            // Loop through the options in the time ended dropdown
            for (let i = 0; i < endTimeInput.options.length; i++) {
            const option = endTimeInput.options[i];
            // Disable the option if its value is less than or equal to the selected time
            option.disabled = option.value <= startTimeValue;
            }
        } else {
            // Enable all options in the time ended dropdown
            for (let i = 0; i < endTimeInput.options.length; i++) {
            endTimeInput.options[i].disabled = false;
            }
        }
        }

        // Function to handle date and time change errors
        function handleDateTimeChangeError() {
        const startDateValue = startDateInput.value;
        const endDateValue = endDateInput.value;
        const startTimeValue = startTimeInput.value;
        const endTimeValue = endTimeInput.value;

        if (startDateValue > endDateValue) {
            // Throw an error and reset the date ended to an empty value
            endDateInput.setCustomValidity("");
        } else {
            // Clear any previous error messages
            endDateInput.setCustomValidity("");
        }

        if (startDateValue === endDateValue && startTimeValue >= endTimeValue) {
            // Reset the time ended to an empty value (without showing an error)
            endTimeInput.value = "";
        }
        }

        // Add event listener to the date requested input element
        startDateInput.addEventListener("change", function () {
        updateEndTimeOptions();
        handleDateTimeChangeError();
        });

        // Add event listener to the time requested input element
        startTimeInput.addEventListener("change", function () {
        updateEndTimeOptions();
        handleDateTimeChangeError();
        });

        // Add event listener to the date ended input element
        endDateInput.addEventListener("change", function () {
        updateEndTimeOptions();
        handleDateTimeChangeError();
        });

        // Add event listener to the time ended input element
        endTimeInput.addEventListener("change", function () {
        handleDateTimeChangeError();
        });

        // Initial update of end time options
        updateEndTimeOptions();


    </script>

    <script>
        // Function to update the available sections based on the selected course
        function updateSections() {
            var courseSelect = document.getElementById("course");
            var sectionSelect = document.getElementById("section");
            var selectedCourse = courseSelect.value;

            // Clear the section dropdown options
            sectionSelect.innerHTML = "";

            // Check if the selected course is BSBAMM
            if (selectedCourse === "BSBAMM") {
                // Add all sections as options
                var sections = ["1-1", "1-2", "1-3", "1-4", "2-1", "2-2", "2-3", "2-4", "3-1", "3-2", "3-3", "3-4", "4-1", "4-2", "4-3", "4-4"];
                for (var i = 0; i < sections.length; i++) {
                    var option = document.createElement("option");
                    option.value = sections[i];
                    option.text = sections[i];
                    sectionSelect.appendChild(option);
                }
            } else {
                // Add limited sections as options
                var sections = ["1-1", "1-2", "2-1", "2-2", "3-1", "3-2", "4-1", "4-2"];
                for (var i = 0; i < sections.length; i++) {
                    var option = document.createElement("option");
                    option.value = sections[i];
                    option.text = sections[i];
                    sectionSelect.appendChild(option);
                }
            }
        }

        // Add event listener to the course select dropdown
        document.getElementById("course").addEventListener("change", updateSections);
    </script>


    <script>

        document.addEventListener("DOMContentLoaded", function() {
            // Get the date input elements
            var startDateInput = document.getElementById("startDate");
            var endDateInput = document.getElementById("endDate");

            // Add event listeners for when the dates change
            startDateInput.addEventListener("change", validateDate);
            endDateInput.addEventListener("change", validateDate);

            function validateDate() {
            var startDate = new Date(startDateInput.value);
            var endDate = new Date(endDateInput.value);

            // Check if either the start date or end date is a Sunday
            if (startDate.getDay() === 0 || endDate.getDay() === 0) {
                startDateInput.setCustomValidity("Sundays are not allowed. Please choose different dates.");
                endDateInput.setCustomValidity("Sundays are not allowed. Please choose different dates.");
            } else {
                startDateInput.setCustomValidity("");
                endDateInput.setCustomValidity("");
            }
            }
        });

        function validateForm() {
            var form = document.getElementById('appointment-form');
            var selectFields = form.querySelectorAll('select[required]');
            var startDateField = document.getElementById('startDate');
            var endDateField = document.getElementById('endDate');

            for (var i = 0; i < selectFields.length; i++) {
                var selectField = selectFields[i];
                if (selectField.value === "") {
                    selectField.classList.add('is-invalid');
                    selectField.classList.remove('is-valid');
                } else {
                    selectField.classList.add('is-valid');
                    selectField.classList.remove('is-invalid');
                }
            }

            if (startDateField.value === "") {
                startDateField.classList.add('is-invalid');
                startDateField.classList.remove('is-valid');
            } else {
                startDateField.classList.add('is-valid');
                startDateField.classList.remove('is-invalid');
            }

            if (endDateField.value === "") {
                endDateField.classList.add('is-invalid');
                endDateField.classList.remove('is-valid');
            } else {
                endDateField.classList.add('is-valid');
                endDateField.classList.remove('is-invalid');
            }

            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }



            // Function to handle form submission
            function handleSubmit() {
                validateForm();
                if (document.getElementById('appointment-form').checkValidity()) {
                $('#confirmSubmitModal').modal('show');
                }
            }



            // Add event listener to the submit button
            document.getElementById('submitBtn').addEventListener('click', handleSubmit);
            
            function redirectToViewEquipment() {
                // Redirect to the view-equipment.php page
                window.location.href = "view-facility.php";
            }
            function redirectToAnotherPage() {
                var url = "http://localhost/student/administrative/generate-letter.php";
                window.open(url, "_blank"); 
            }

            //  //code that validates email with .com
            // var emailInput = document.getElementById('email');

            // emailInput.addEventListener('input', function() {
            //     var email = emailInput.value;
            //     var domainExtension = email.substring(email.lastIndexOf('.') + 1);

            //     if (domainExtension !== 'com') {
            //         emailInput.setCustomValidity('Please input a valid email address ');
            //     } else {
            //         emailInput.setCustomValidity('');
            //     }
            // });

    </script>

    <script>
        $(document).ready(function() {
            // Get the facility ID from the query parameter in the URL
            var facilityID = <?php echo $_POST['id']; ?>;

            // AJAX request to fetch the facility name and room number based on the facility ID
            $.ajax({
                type: "POST",
                url: "get-facility-details.php",
                data: { facilityID: facilityID },
                success: function(response) {


                    // Update the value of the "Facility Name" input field with the fetched facility name
                    $("#facilityName").val(response);

                    // Update the value of the "Room Number" input field with the fetched room number
                    $("#facilityNum").val(response);
                },
                error: function() {
                    console.log("An error occurred while fetching the facility details.");
                }
            });
        });
    </script>
    <script src="../../saved_settings.js"></script>
    <?php if (isset($_SESSION['success']) && $_SESSION['success']) {
        echo "
        <script>
        $(window).on('load', function() {
            $('#successModal').modal('show');
        });
        </script>
        ";
    } 
    unset($_SESSION['success']);
    ?>
</body>
</html>