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
    <!-- Loading page -->
    <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
    <div id="loader" class="center">
        <div class="loading-spinner"></div>
        <p class="loading-text display-3 pt-3">Getting things ready...</p>
    </div>
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../node_modules/flatpickr/dist/flatpickr.min.css">
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
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            $startTime = $_POST['startTime'];
            $endTime = $_POST['endTime'];
            $statusId = 1;
            $course = $_POST['course'];
            $section = $_POST['section'];
            $purpose = $_POST['purposeReq'];
            $startDateTimeSched = $startDate . ' ' . $startTime;
            $endDateTimeSched = $endDate . ' ' . $endTime;
            $facilityID = $_POST['id'];
            
            $insertQuery = "INSERT INTO appointment_facility (start_date_time_sched, end_date_time_sched, user_id, status_id, course, section, purpose, facility_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $connection->prepare($insertQuery);
            $insertStmt->bind_param("ssiisssi", $startDateTimeSched, $endDateTimeSched, $_SESSION['user_id'], $statusId, $course, $section, $purpose, $facilityID);

            if ($insertStmt->execute()) {
                $_SESSION['success'] = true;
                // header("Refresh:0");
                
                // // Update the facility availability to "Unavailable" after successful request
                // $updateQuery = "UPDATE facility SET availability = 'Unavailable' WHERE facility_id = ?";
                // $updateStmt = $connection->prepare($updateQuery);
                // $updateStmt->bind_param("i", $facilityID);
                // $updateStmt->execute();
                // $updateStmt->close();
                
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
        <div class="container-fluid text-center mt-4 p-4">
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
                                <input type="email" class="form-control" id="email" name="email" value = "<?php echo $userData[0]['email'] ?>" maxlength="50">
                                <div class="invalid-feedback">Please input a valid email</div>
                            </div>

                            <div class="form-group required col-md-6">
                                <label for="course" class="form-label">Course</label>
                                <select class="form-control form-select" name="course" id="course" required>
                                    <option value="">--Select--</option>
                                    <option value="BSEE">Bachelor of Science in Electronics Engineering</option>
                                    <option value="BSBA-HRM">Bachelor of Science in Business Administration Major in Human Resource Management</option>
                                    <option value="BSBA-MM">Bachelor of Science in Business Administration Major in Marketing Management</option>
                                    <option value="BSED-Eng">Bachelor in Secondary Education Major in English</option>
                                    <option value="BSED-Fil">Bachelor in Secondary Education Major in Filipino</option>
                                    <option value="BSED-Math">Bachelor in Secondary Education Major in Mathematics</option>
                                    <option value="BSIE">Bachelor of Science in Industrial Engineering</option>
                                    <option value="BSIT">Bachelor of Science in Information Technology</option>
                                    <option value="BSP">Bachelor of Science in Psychology</option>
                                    <option value="BTL-HE">Bachelor in Technology And Livelihood Education Major in Home Economics</option>

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
                                <input type="text" class="form-control" name="startDate" id="startDate" placeholder="Select Date..." style="cursor: pointer !important;" required data-input>
                                <div id="startDateValidationMessage" class="text-danger"></div>
                            </div>

                            <div class="form-group required col-md-6">
                                <label for="endDate" class="form-label">Date Ended</label>
                                <input type="text" class="form-control" name="endDate" id="endDate" placeholder="Select Date..." style="cursor: pointer !important;" required data-input>
                                <div id="endDateValidationMessage" class="text-danger"></div>
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
                                <div class="invalid-feedback">Please provide a reason for appointment</div>
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
                                        <p>Your appointment has been submitted successfully!</p>
                                        <h5>What should I do next?</h5>
                                        <ol>
                                            <li>Please download the letter needed for the appointment (Refer to the <b>Help</b> page).</li>
                                            <li>Proceed to the <b>Student Services</b> office (Room 210) to submit the requirements.</li>
                                            <li>Wait for the request to be approved by constantly checking its status on the <b>My Transactions</b> page.</li>
                                        </ol>
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
    <?php include '../../footer.php'; ?>
    <script src="../../loading.js"></script>
    <script src="../../jquery.js"></script>
    
    <script>
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
        var startDateValidation = document.getElementById("startDate");
        var endDateValidation = document.getElementById("endDate");
        var startDateValidationMessage = document.getElementById("startDateValidationMessage");
        var endDateValidationMessage = document.getElementById("endDateValidationMessage");
            function validateForm() {
                var form = document.getElementById('appointment-form');
                var selectFields = form.querySelectorAll('select[required]');


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
                // Check if start date is empty
                if (startDateValidation.value.trim() === '') {
                    startDateValidationMessage.textContent = "Please select a starting date.";
                    startDateValidation.classList.add('is-invalid');
                }
                    else {
                        startDateValidationMessage.textContent = "";
                        startDateValidation.classList.remove('is-invalid');
                    }
                // Check if end date is empty
                if (endDateValidation.value.trim() === '') {
                    endDateValidationMessage.textContent = "Please select a ending date.";
                    endDateValidation.classList.add('is-invalid');
                }
                    else {
                        endDateValidationMessage.textContent = "";
                        endDateValidation.classList.remove('is-invalid');
                    }
                


                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }
                
                // startDateValidationMEssage disappears after the user select an date
                startDateValidation.addEventListener('change', () => {
                const dateValue = startDateValidation.value.trim();

                    if (dateValue === '') {
                        startDateValidationMessage.textContent = "Please select a date.";
                        startDateValidation.classList.add('is-invalid');
                    }
                    else {
                        startDateValidationMessage.textContent = "";
                        startDateValidation.classList.remove('is-invalid');
                    }

                });
                // endDateValidationMEssage disappears after the user select an date
                endDateValidation.addEventListener('change', () => {
                    const dateValue = endDateValidation.value.trim();

                    if (dateValue === '') {
                        endDateValidationMessage.textContent = "Please select a date.";
                        endDateValidation.classList.add('is-invalid');
                    }
                    else {
                        endDateValidationMessage.textContent = "";
                        endDateValidation.classList.remove('is-invalid');
                    }

                });

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
                    var url = "/student/administrative/generate-letter.php";
                    window.open(url, "_blank"); 
                }
    </script>


    <!-- custom calendar where sundays are disabled -->
    <script src="../../node_modules/flatpickr/dist/flatpickr.min.js"></script>
    <script>
        var disableSundays = function(date) {
        // Disable date on Sundays
        return (date.getDay() === 0);
        };

        var startDatePicker = flatpickr("#startDate", {
        altInput: true,
        dateFormat: "Y-m-d",
        theme: "custom-datepicker",
        minDate: "today",
        maxDate: "31.12.2033",
        disable: [
            disableSundays
        ],
        locale: {
            "firstDayOfWeek": 1 // start week on Monday
        },
        onChange: function(selectedDates, dateStr, instance) {
            var currentDate = new Date();
                    var selectedDate = selectedDates[0];
                    var timeSelect = document.getElementById("startTime");
                    
                    if (selectedDate.toDateString() === currentDate.toDateString()) {
                        // Reset the selected time value when the date is changed to today
                        timeSelect.value = '';
                        // Enable all options in the time select for today's date
                        for (var i = 0; i < timeSelect.options.length; i++) {
                            timeSelect.options[i].disabled = false;
                        }
                        
                        // Disable past times in the time select based on the current time
                        var currentHour = currentDate.getHours();
                        var currentMinute = currentDate.getMinutes();
                        for (var i = 0; i < timeSelect.options.length; i++) {
                            var timeValue = timeSelect.options[i].value.split(":");
                            var optionHour = parseInt(timeValue[0]);
                            var optionMinute = parseInt(timeValue[1]);
                            if (optionHour < currentHour || (optionHour === currentHour && optionMinute <= currentMinute)) {
                                timeSelect.options[i].disabled = true;
                            }
                        }
                    } else {
                        // Enable all options in the time select for other dates
                        for (var i = 0; i < timeSelect.options.length; i++) {
                            timeSelect.options[i].disabled = false;
                        }
                    }

                // Update the minDate of the endDate datepicker
                if (selectedDates.length > 0) {
                endDatePicker.set("minDate", selectedDates[0]);
                }
            }
        });

        var endDatePicker = flatpickr("#endDate", {
        altInput: true,
        dateFormat: "Y-m-d",
        theme: "custom-datepicker",
        minDate: "today",
        maxDate: "31.12.2033",
        disable: [
            disableSundays
        ],
        locale: {
            "firstDayOfWeek": 1 // start week on Monday
        },
        });

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
            if (selectedCourse === "BSBA-MM") {
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