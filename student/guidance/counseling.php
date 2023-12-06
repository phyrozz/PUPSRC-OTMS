<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guidance Office - Counseling</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
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
            $office_name = "Guidance Office";
            include "../navbar.php";
            include "../../breadcrumb.php";
            include "../../conn.php";

            $query = "SELECT student_no, last_name, first_name, middle_name, extension_name, contact_no, email FROM users
            WHERE user_id = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();

            if(isset($_POST['formSubmit'])) {
                $counselingDescription = sanitizeInput($_POST['counseling_description']);
                $comments = sanitizeInput($_POST['reasonText']);
                $date = sanitizeInput($_POST['date']);
                $time = sanitizeInput($_POST['time']);
                $officeId = 5;
                $statusId = 1;
                $amountToPay = 0.00;
                $requestDesc = "Guidance Counseling";
                $dateTime = $date . ' ' . $time;

                $timestamp = time(); // Get the current timestamp
                $requestId = 'GC-' . $timestamp;

                $lastRequestIdQuery = "SELECT MAX(request_id) AS last_request_id FROM doc_requests WHERE user_id = ? AND request_description = ?";
                $stmt = $connection->prepare($lastRequestIdQuery);
                $stmt->bind_param("is", $_SESSION['user_id'], $requestDesc);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $lastRequestId = $row['last_request_id'];
                $stmt->close();

                $timeDifference = $timestamp - intval(substr($lastRequestId, 3));
                if ($lastRequestId !== null && $timeDifference < 1200) { // 20 minutes = 20 * 60 seconds = 1200 seconds
                    $_SESSION['requestIntervalExceeded'] = true;
                }
                else {
                    $query = "INSERT INTO doc_requests (request_description, scheduled_datetime, office_id, user_id, status_id, amount_to_pay)
                                VALUES (?, ?, ?, ?, ?, ?)";

                    $stmt = $connection->prepare($query);
                    $stmt->bind_param("ssiiid", $requestDesc, $dateTime, $officeId, $_SESSION['user_id'], $statusId, $amountToPay);
                    $stmt->execute();
                    // Uncomment if primary key id of doc_requests table is AUTO_INCREMENT int

                    // $insertedId = $connection->insert_id;
                    // if (!$insertedId > 0) {
                    //     $connection->close();
                    //     // header("Location: /student/guidance/counseling.php");
                    //     exit();
                    // }
                    $stmt->close();

                    $query = "INSERT INTO counseling_schedules (appointment_description, comments, doc_requests_id)
                    VALUES (?, ?, ?)";
                    $docRequestsId = 'DR-' . time();

                    $stmt = $connection->prepare($query);
                    $stmt->bind_param("sss", $counselingDescription, $comments, $docRequestsId);
                    if ($stmt->execute()) {
                        $_SESSION['success'] = true;
                    }
                    $stmt->close();
                    $connection->close();
                }
            }
        ?>
        <div class="container-fluid p-4">
            <?php
            $breadcrumbItems = [
                ['text' => 'Guidance Office', 'url' => '/student/guidance.php', 'active' => false],
                ['text' => 'Schedule for Counseling', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, true);
            ?>
        </div>
        <div class="container-fluid text-center mt-4 p-4">
            <h1>Schedule for Counseling</h1>
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
                            <a class="btn btn-outline-primary mb-2" href="/student/transactions.php" data-bs-toggle="tooltip" data-bs-placement="right" title="Check your document requests/scheduled appointments and their statuses">
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
                        <form action="counseling.php" id="appointment-form" class="needs-validated row g-3" method="POST" novalidate>
                            <input type="hidden" name="form_type" value="counseling_form">
                            <small>Fields highlighted in <small style="color: red"><b>*</b></small> are required.</small>
                            <h6>Student Information</h6>
                            <div class="form-group required col-12">
                                <label for="studentNumber" class="form-label">Student Number</label>
                                <input type="text" class="form-control" id="studentNumber" value="<?php echo $userData[0]['student_no'] ?>" maxlength="15" disabled required>
                            </div>
                            <div class="form-group required col-12">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" value="<?php echo $userData[0]['last_name'] ?>" maxlength="100" disabled required>
                            </div>
                            <div class="form-group required col-12">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" value="<?php echo $userData[0]['first_name'] ?>" maxlength="100" disabled required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middleName" value="<?php echo $userData[0]['middle_name'] ?>" maxlength="100" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="extensionName" class="form-label">Extension Name</label>
                                <input type="text" class="form-control" id="extensionName" value="<?php echo $userData[0]['extension_name'] ?>" maxlength="11" disabled required>
                            </div>
                            <div class="form-group required col-12">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contactNumber" value="<?php echo $userData[0]['contact_no'] ?>" name="contactNumber" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" placeholder="Example: 0123-456-7890" maxlength="13" required>
                                <div id="contactNoValidationMessage" class="text-danger"></div>
                            </div>
                            <div class="form-group col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" value="<?php echo $userData[0]['email'] ?>" name="email" placeholder="example@yahoo.com" maxlength="100">
                            </div>
                            <h6 class="mt-5">Appointment Information</h6>
                            <div class="form-group required col-md-12">
                                <label for="counseling_description" class="form-label">Reason for Counseling</label>
                                <div class="input-group has-validation">
                                    <select class="form-control form-select" name="counseling_description" id="counseling_description" required>
                                        <option value="">--Select--</option>
                                        <option value="Academic Performance">Academic Performance</option>
                                        <option value="Academic Guidance">Academic Guidance</option>
                                        <option value="Career Path Guidance">Career Path Guidance</option>
                                        <option value="Personal Development">Personal Development</option>
                                        <option value="Goal Setting">Goal Setting</option>
                                        <option value="Study Skills">Study Skills</option>
                                        <option value="Report Issue">Report Issue</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <div class="invalid-feedback" id="reasonSelectMessage">Please choose an option.</div>
                                </div>
                                
                            </div>
                            <!-- <div class="form-group required col-md-6">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" id="date" required onchange="validateDate()">
                                <div class="invalid-feedback">Please choose a valid date.</div>
                            </div> -->
                            <div class="form-group required col-md-6">
                                <label for="date" class="form-label">Date</label>
                                <input type="text" class="form-control" name="date" id="datepicker" placeholder="Select Date..." style="cursor: pointer !important;" required data-input>
                                <div id="dateValidationMessage" class="text-danger"></div>
                            </div>
                            <div class="form-group required col-md-6">
                                <label for="time" class="form-label">Time</label>
                                <select class="form-control form-select" name="time" id="time" required>
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
                                </select>
                                <div class="invalid-feedback" id="timeSelectMessage">Please choose a time.</div>
                            </div>
                            <div class="form-group col-12 required" id="reasonTextField" style="display: none;">
                                <label for="reasonText" class="form-label">Reason</label>
                                <textarea class="form-control" name="reasonText" id="reasonText" style="resize: none;" rows="3" maxlength="2048" required></textarea>
                                <div id="reasonValidationMessage" class="text-danger"></div>
                            </div>
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">
                                <i class="fa-solid fa-circle-info"></i> Reminder
                                </h4>
                                <p>Your appointment request will be forwarded to the concerned office after you click the "Submit" button.</p>
                                <p>A .PDF file of your request letter will be generated after successfully submitting this form and must be submitted to the Director's Office before your scheduled appointment.</p>
                                <p>An email and/or text message will be sent to you once the admin has approved your document request.</p>
                                <p class="mb-0">You may constantly monitor the status of the request by going to <b>My Transactions</b>.</p>
                            </div>
                            <div class="d-flex w-100 justify-content-between p-1">
                                <button class="btn btn-primary px-4" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Return to previous page" onclick="window.history.go(-1); return false;">
                                    <i class="fa-solid fa-arrow-left"></i> Back
                                </button>
                                <button id="submitBtn" type="button" class="btn btn-primary w-25" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Submit the appointment">Submit</button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmSubmitModalLabel">Confirm Form Submission</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to submit this form?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <button type="submit" id="submit" class="btn btn-primary" name="formSubmit" data-bs-toggle="modal" data-bs-target="#successModal">Yes</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Success alert modal -->
                        <div id="successModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>Your counseling appointment has been submitted successfully!</p>
                                        <h5>What should I do next?</h5>
                                        <ol>
                                            <li>Wait for the appointment to be approved by constantly checking its status on the <b>My Transactions</b> page.</li>
                                            <li>Once approved, proceed to the office for counseling.</li>
                                        </ol>
                                    </div>
                                    <div class="modal-footer">
                                    <a href="../transactions.php" class="btn btn-primary"><i class="fa-solid fa-file-invoice"></i> Go to My Transactions</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- File upload failed modal -->
                        <div id="failedToUploadModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="failedToUploadModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="failedToUploadModalLabel">File Upload Failed</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Failed to upload attached file. Please make sure the file type is an image or .PDF and the file size is less than 10 MB then try again.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of file upload failed modal -->
                        <!-- Request Interval Exceeded modal -->
                        <div id="requestIntervalExceededModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="requestIntervalExceededModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="requestIntervalExceededModalLabel">Error</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>You have already recently requested. Please try again within the next 20 minutes or delete your previous request on the <b>My Transactions</b> page.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Request Interval Exceeded modal -->
                    </div>
                </div>
            </div>
        </div>
        <div class="push"></div>
    </div>
    <?php include '../../footer.php'; ?>
    <script src="../../tooltips.js"></script>
    <script src="../../loading.js"></script>
    <script src="../../jquery.js"></script>
    <script>
        const contactNoInput = document.getElementById('contactNumber');
        const contactNoValidationMessage = document.getElementById('contactNoValidationMessage');
        const dateValidation = document.getElementById('datepicker');
        const dateValidationMessage = document.getElementById('dateValidationMessage');
        const timeSelect = document.getElementById('time');
        const timeSelectMessage = document.getElementById('timeSelectMessage');
        const reasonSelect = document.getElementById('counseling_description');
        const reasonSelectMessage = document.getElementById('reasonSelectMessage');
        const reasonText = document.getElementById('reasonText');
        const reasonValidationMessage = document.getElementById('reasonValidationMessage');

        // let currentDate = new Date().toISOString().split('T')[0];

        // var maxDate = "2033-12-31";

        // document.getElementById("date").min = currentDate;
        // document.getElementById("date").max = maxDate;

        function validateForm() {
            var form = document.getElementById('appointment-form');
            var selectFields = form.querySelectorAll('select[required]');
            var reasonText = document.getElementById('reasonText');
            var counselingDesc = document.getElementById('counseling_description').value;

            if (counselingDesc === 'Other') {
                reasonText.setAttribute('required', 'required');
                if (reasonText.value.trim() === '') {
                    reasonText.classList.add('is-invalid');
                } else {
                    reasonText.classList.remove('is-invalid');
                }
            } else {
                reasonText.removeAttribute('required');
                reasonText.classList.remove('is-invalid');
            }

            if (dateValidation.value.trim() === '') {
                dateValidationMessage.textContent = "Please select a date.";
                dateValidation.classList.add('is-invalid');
            }
            else {
                dateValidationMessage.textContent = "";
                dateValidation.classList.remove('is-invalid');
            }

            for (var i = 0; i < selectFields.length; i++) {
                var selectField = selectFields[i];
                if (selectField.value === "") {
                    selectField.classList.add('is-invalid');
                } else {
                    selectField.classList.remove('is-invalid');
                }
            }

            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            contactNoValidation();
        }

        dateValidation.addEventListener('change', () => {
            const dateValue = dateValidation.value.trim();

            if (dateValue === '') {
                dateValidationMessage.textContent = "Please select a date.";
                dateValidation.classList.add('is-invalid');
            }
            else {
                dateValidationMessage.textContent = "";
                dateValidation.classList.remove('is-invalid');
            }

            console.log(dateValue);
        });

        timeSelect.addEventListener('change', () => {
            if (timeSelect.value == '') {
                timeSelectMessage.textContent = "Please select a time.";
                timeSelect.classList.add('is-invalid');
            }
            else {
                timeSelectMessage.textContent = "";
                timeSelect.classList.remove('is-invalid');
            }
        });

        reasonSelect.addEventListener('change', () => {
            if (reasonSelect.value == '') {
                reasonSelectMessage.textContent = "Please select a reason for counseling.";
                reasonSelect.classList.add('is-invalid');
            }
            else {
                reasonSelectMessage.textContent = "";
                reasonSelect.classList.remove('is-invalid');
            }
        })

        reasonText.addEventListener('input', () => {
            if (reasonText.value.trim() === '') {
                reasonValidationMessage.textContent = "Please state a reason why you want to counsel.";
                reasonText.classList.add('is-invalid');
            }
            else {
                reasonValidationMessage.textContent = "";
                reasonText.classList.remove('is-invalid');
            }
        })

        function contactNoValidation() {
            const contactNo = contactNoInput.value.trim();
            const contactNoValidPattern = /^0\d{3}-\d{3}-\d{4}$/;

            // Remove any dashes from the current input value
            const cleanedContactNo = contactNo.replace(/-/g, '');

            // Format the contact number with dashes
            let formattedContactNo = '';
            for (let i = 0; i < cleanedContactNo.length; i++) {
                if (i === 4 || i === 7) {
                    formattedContactNo += '-';
                }
                formattedContactNo += cleanedContactNo[i];
            }

            // Update the input value with the formatted contact number
            contactNoInput.value = formattedContactNo;

            if (!contactNoValidPattern.test(formattedContactNo)) {
                if (contactNo == '') {
                    contactNoValidationMessage.textContent = 'Please enter a contact number.';
                    contactNoInput.classList.add('is-invalid');
                } 
                else {
                    contactNoValidationMessage.textContent = 'Invalid contact number. The format must be 0xxx-xxx-xxxx';
                    contactNoInput.classList.add('is-invalid');
                }
            }
            else {
                contactNoValidationMessage.textContent = '';
                contactNoInput.classList.remove('is-invalid');
            }
        }

        contactNoInput.addEventListener('input', () => {
            contactNoValidation();
        });

        function reasonTextValidation() {
            if (reasonSelect === 'Other' && !/^[\w\d\s]{1,2048}$/.test(reasonText.value.trim())) {
                reasonValidationMessage.textContent = 'Invalid purpose.';
                reasonText.classList.add('is-invalid');
                return false;
            }
            return true;
        }

        // Function to handle form submission
        function handleSubmit() {
            const isCustomValidationValid = reasonTextValidation();

            validateForm();
            const dateValue = dateValidation.value.trim();
            if (document.getElementById('appointment-form').checkValidity() && dateValue !== '' && isCustomValidationValid) {
                $('#confirmSubmitModal').modal('show');
                $('#loadingModal').modal('show');
            }
        }
        
        // Add event listener to the submit button
        document.getElementById('submitBtn').addEventListener('click', handleSubmit);

        $(document).ready(function() {
            $('#loadingModal').modal('show');

            // Add a transition effect on the reason text field when it appears and disappears
            $('#counseling_description').on('change', function() {
                if ($(this).val() == 'Other') {
                    $('#reasonTextField').slideToggle(); // Fade in the element
                } else {
                    $('#reasonTextField').fadeOut(); // Fade out the element
                }
            });
        });
    </script>
    <script src="../../node_modules/flatpickr/dist/flatpickr.min.js"></script>
    <script>
        flatpickr("#datepicker", {
            altInput: true,
            dateFormat: "Y-m-d",
            theme: "custom-datepicker",
            minDate: "today",
            maxDate: "31.12.2033",
            disable: [
                function(date) {
                    // Disable date on Sundays
                    return (date.getDay() === 0);

                }
            ],
            locale: {
                "firstDayOfWeek": 1 // start week on Monday
            },
        });
    </script>
    <script src="../../saved_settings.js"></script>
    <?php
    if (isset($_SESSION['success'])) {
        ?>
        <script>
            $(document).ready(function() {
                $("#successModal").modal("show");
            })
        </script>
        <?php
        unset($_SESSION['success']);
        exit();
    }
    if (isset($_SESSION['failedToUploadAttachment'])) {
        ?>
        <script>
            $(document).ready(function() {
                $("#failedToUploadModal").modal("show");
            })
        </script>
        <?php
        unset($_SESSION['failedToUploadAttachment']);
    }
    if (isset($_SESSION['requestIntervalExceeded'])) {
        ?>
        <script>
            $(document).ready(function() {
                $("#requestIntervalExceededModal").modal("show");
            })
        </script>
        <?php
        unset($_SESSION['requestIntervalExceeded']);
    }
    exit();
    ?>
</body>
</html>