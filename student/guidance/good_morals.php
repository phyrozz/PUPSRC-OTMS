<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guidance Office - Request Good Morals</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <!-- Loading page -->
    <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
    <div id="loader" class="center">
        <div class="loading-spinner"></div>
        <p class="loading-text display-3 pt-3">Getting things ready...</p>
    </div>
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
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

            if (isset($_POST['goodMoralsFormSubmit'])) {
                $requestDescription = "Request Good Moral Document";
                $scheduledDateTime = $_POST['date'];
                $officeId = 5;
                $statusId = 1;
                $amountToPay = 0.00;
                $purpose = $_POST['purpose'];
                $purposeText = $_POST['purposeText'];
            
                // Check if a file was uploaded
                if (isset($_FILES['supportingDocuments']) && $_FILES['supportingDocuments']['error'] === UPLOAD_ERR_OK) {
                    $file = $_FILES['supportingDocuments'];

                    // Validate the file size
                    $maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
                    if ($file['size'] <= $maxFileSize) {

                        // Validate the file type
                        $allowedFileTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                        if (in_array($file['type'], $allowedFileTypes)) {

                            // Generate a unique filename to avoid conflicts
                            $filename = uniqid() . '-' . $file['name'];

                            // Move the uploaded file to a desired location
                            $uploadDirectory = '../../assets/uploads/supporting_docs/';
                            $destination = $uploadDirectory . $filename;
                            if (move_uploaded_file($file['tmp_name'], $destination)) {
                                // File uploaded successfully
                                $fileContents = $destination; // Store the file path in the database
                            } else {
                                // Failed to move the uploaded file
                                $_SESSION['failedToUploadAttachment'] = true;
                                exit();
                            }
                        } else {
                            // Invalid file type
                            $_SESSION['failedToUploadAttachment'] = true;
                            exit();
                        }
                    } else {
                        // File size exceeds the limit
                        $_SESSION['failedToUploadAttachment'] = true;
                        exit();
                    }
                }

                // Generate a unique request_id based on the current timestamp
                $timestamp = time(); // Get the current timestamp
                $requestId = 'DR-' . $timestamp;

                // Check the last request_id submitted by the user from the database
                $lastRequestIdQuery = "SELECT MAX(request_id) AS last_request_id FROM doc_requests WHERE user_id = ? AND request_description = ?";
                $stmt = $connection->prepare($lastRequestIdQuery);
                $stmt->bind_param("is", $_SESSION['user_id'], $requestDescription);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $lastRequestId = $row['last_request_id'];
                $stmt->close();

                // If the user has submitted a request within the last 20 minutes, prevent the form submission
                $timeDifference = $timestamp - intval(substr($lastRequestId, 3));
                if ($lastRequestId !== null && $timeDifference < 1200) { // 20 minutes = 20 * 60 seconds = 1200 seconds
                    // Set a session variable to show a message to the user
                    $_SESSION['requestIntervalExceeded'] = true;
                }
                else {
                    // Insert the form data into the database
                    $insertQuery = "INSERT INTO doc_requests (request_description, scheduled_datetime, office_id, user_id, status_id, purpose, amount_to_pay, attached_files, specified_purpose)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $connection->prepare($insertQuery);
                    $stmt->bind_param("ssiiisdss", $requestDescription, $scheduledDateTime, $officeId, $_SESSION['user_id'], $statusId, $purpose, $amountToPay, $fileContents, $purposeText);
                    if ($stmt->execute()) {
                        $_SESSION['success'] = true;

                        $getLastIDQuery = "SELECT MAX(request_id) AS last_inserted_id FROM doc_requests";
                        $result = $connection->query($getLastIDQuery);
                        
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $lastInsertedID = $row['last_inserted_id'];
                            $_SESSION['request_id'] = $lastInsertedID;
                        }
                    } else {
                        var_dump($stmt->error);
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
                ['text' => 'Request Good Moral Certificate', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, true);
            ?>
        </div>
        <div class="container-fluid text-center mt-4 p-4">
            <h1>Request Document - Good Moral</h1>
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
                        <h6>Request Form</h6>
                    </div>
                    <div class="card-body">
                        <form action="good_morals.php" id="appointment-form" class="row g-3" method="POST" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="good_morals">
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
                            <h6 class="mt-5">Request Information</h6>
                            <div class="form-group required col-md-6">
                                <label for="date" class="form-label">Date</label>
                                <input type="text" class="form-control" name="date" id="datepicker" placeholder="Select Date..." style="cursor: pointer !important;" required data-input>
                                <div id="dateValidationMessage" class="text-danger"></div>
                            </div>
                            <div class="form-group required col-md-6">
                                <label for="purpose" class="form-label">Purpose of request</label>
                                <select class="form-control form-select" name="purpose" id="purpose" required>
                                    <option value="">--Select--</option>
                                    <option value="Job Application">Job Application</option>
                                    <option value="School Requirement">School Requirement</option>
                                    <option value="Professional Licenses">Professional Licenses</option>
                                    <option value="Immigration or Visa Applications">Immigration or Visa Applications</option>
                                    <option value="Volunteering and Community Service">Volunteering and Community Service</option>
                                    <option value="Adoption">Adoption</option>
                                    <option value="Government Services">Government Services</option>
                                    <option value="Rental or Lease Agreements">Rental or Lease Agreements</option>
                                    <option value="Legal Proceedings">Legal Proceedings</option>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="invalid-feedback" id="purposeMessage">Please choose a time.</div>
                            </div>
                            <div class="form-group required col-md-12" id="purposeTextField" style="display: none;">
                                <label for="purposeText" class="form-label">Purpose</label>
                                <textarea class="form-control" id="purposeText" name="purposeText" placeholder="Please state your purpose for requesting" maxlength="2048" style="resize: none;" rows="4" required></textarea>
                                <div id="purposeValidationMessage" class="text-danger"></div>
                            </div>
                            <div class="form-group col-12">
                                <label for="supportingDocuments" class="form-label">
                                    <p>Supporting Documents (Referral Slip, etc.) <small>This is optional.</small></p>
                                    <small><b>Maximum file size:</b> 10MB.</small>
                                    <small><b>Allowed file types:</b> .jpg, .png, .pdf.</small>
                                </label>
                                <input class="form-control" type="file" name="supportingDocuments" id="supportingDocuments">
                            </div>
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">
                                <i class="fa-solid fa-circle-info"></i> Reminder
                                </h4>
                                <p>Your document request will be forwarded to the concerned office after submitting.</p>
                                <p>An email and/or text message will be sent to you once the admin has approved your document request.</p>
                                <p class="mb-0">You may constantly monitor the status of your request by going to <b>My Transactions</b> then choosing <b>Document Requests</b>.</p>
                            </div>
                            <div class="d-flex w-100 justify-content-between p-1">
                                <button class="btn btn-primary px-4" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Return to previous page" onclick="window.history.go(-1); return false;">
                                    <i class="fa-solid fa-arrow-left"></i> Back
                                </button>
                                <input id="submitBtn" value="Submit" type="button" class="btn btn-primary w-25" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Submit the document request" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal" />
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
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" id="submit" class="btn btn-primary" name="goodMoralsFormSubmit">Yes</button>
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
                                        <p>Your request has been submitted successfully!</p>
                                        <h5>What should I do next?</h5>
                                        <ol>
                                            <li>Prepare other requirements needed for the request (Refer to the <b>Help</b> page).</li>
                                            <li>Proceed to the <b>Student Services</b> office (Room 210) to submit the requirements.</li>
                                            <li>Wait for the request to be approved by constantly checking its status on the <b>My Transactions</b> page.</li>
                                        </ol>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="../transactions.php" id="redirect-btn" class="btn btn-primary"><i class="fa-solid fa-file-invoice"></i> Go to My Transactions</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of success alert modal -->
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
    <script src="../../loading.js"></script>
    <script src="../../tooltips.js"></script>
    <script src="../../jquery.js"></script>
    <script>
        const contactNoInput = document.getElementById('contactNumber');
        const contactNoValidationMessage = document.getElementById('contactNoValidationMessage');
        const dateInput = document.getElementById('datepicker');
        const dateValidationMessage = document.getElementById('dateValidationMessage');
        const purposeSelectInput = document.getElementById('purpose');
        const purposeSelectMessage = document.getElementById('purposeMessage');
        const purposeText = document.getElementById('purposeText');
        const purposeValidationMessage = document.getElementById('purposeValidationMessage');

        contactNoInput.addEventListener('input', () => {
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
                contactNoValidationMessage.textContent = 'Invalid contact number. The format must be 0xxx-xxx-xxxx';
                contactNoInput.classList.add('is-invalid');
            } else {
                contactNoValidationMessage.textContent = '';
                contactNoInput.classList.remove('is-invalid');
            }
        });

        purposeSelectInput.addEventListener('change', () => {
            const purposeSelectValue = purposeSelectInput.value;
            var purposeTextField = document.getElementById('purposeTextField');

            if (purposeSelectValue == "") {
                purposeSelectMessage.textContent = 'Please choose a purpose for requesting.';
                purposeSelectInput.classList.add('is-invalid');
                purposeText.required = true;
            } else if (purposeSelectValue == "Other") {
                purposeSelectMessage.textContent = '';
                purposeSelectInput.classList.remove('is-invalid');
                purposeText.required = true;
            } else {
                purposeSelectMessage.textContent = '';
                purposeValidationMessage.textContent = '';
                purposeText.value = '';
                purposeSelectInput.classList.remove('is-invalid');
                purposeText.classList.remove('is-invalid');
                purposeText.required = false;
            }
        });

        purposeText.addEventListener('input', () => {
            const purposeTextValue = purposeText.value.trim();
            const purposeSelectValue = purposeSelectInput.value;

            if (purposeTextValue == '' && purposeSelectValue == 'Other') {
                purposeValidationMessage.textContent = 'Invalid purpose.';
                purposeText.classList.add('is-invalid');
            } else {
                purposeValidationMessage.textContent = '';
                purposeText.classList.remove('is-invalid');
            }
        });

        dateInput.addEventListener('input', () => {
            const dateValue = dateInput.value.trim();

            if (dateValue == '') {
                dateValidationMessage.textContent = 'Please enter a schedule date for your request.';
                dateInput.classList.add('is-invalid');
            } else {
                dateValidationMessage.textContent = '';
                dateInput.classList.remove('is-invalid');
            }
        });

        // Function to validate custom fields
        function validateCustomFields() {
            const purposeSelectValue = purposeSelectInput.value;
            const purposeTextValue = purposeText.value.trim();

            if (purposeSelectValue === 'Other' && !/^[\w\d\s]{1,2048}$/.test(purposeTextValue)) {
                purposeValidationMessage.textContent = 'Invalid purpose.';
                purposeText.classList.add('is-invalid');
                return false;
            }

            return true; // All custom validations passed
        }

        // Function to handle form submission
        function handleSubmit() {
            const isCustomValidationValid = validateCustomFields();

            if (document.getElementById('appointment-form').checkValidity() && isCustomValidationValid) {
                $('#confirmSubmitModal').modal('show');
            }
        }

        // Add event listener to the submit button
        document.getElementById('submitBtn').addEventListener('click', handleSubmit);

        // Add a transition effect on the reason text field when it appears and disappears
        $('#purpose').on('change', function() {
            if ($(this).val() == 'Other') {
                $('#purposeTextField').slideToggle(); // Fade in the element
            } else {
                $('#purposeTextField').fadeOut(); // Fade out the element
            }
        });
    </script>
    <script src="../../node_modules/flatpickr/dist/flatpickr.min.js"></script>
    <script>
        flatpickr("#datepicker", {
            readonly: false,
            allowInput: true,
            defaultDate: "today",
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