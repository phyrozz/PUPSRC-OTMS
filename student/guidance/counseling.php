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
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php
            $office_name = "Guidance Office";
            include "../navbar.php";
            include "../../breadcrumb.php";
            include "../../conn.php";

            $query = "SELECT student_no, last_name, first_name, middle_name, extension_name FROM users
            WHERE user_id = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();

            if(isset($_POST['formSubmit'])) {
                $counselingDescription = $_POST['counseling_description'];
                $date = $_POST['date'];
                $time = $_POST['time'];
                $officeId = 5;
                $statusId = 3;
                $amountToPay = 0.00;
                $dateTime = $date . ' ' . $time;

                $query = "INSERT INTO doc_requests (scheduled_datetime, office_id, user_id, status_id, amount_to_pay)
                VALUES (?, ?, ?, ?, ?)";

                $stmt = $connection->prepare($query);
                $stmt->bind_param("siiid", $dateTime, $officeId, $_SESSION['user_id'], $statusId, $amountToPay);
                $stmt->execute();
                $insertedId = $connection->insert_id;
                if (!$insertedId > 0) {
                    $connection->close();
                    header("Location: http://localhost/student/guidance/counseling.php");
                    exit();
                }
                $stmt->close();

                $query = "INSERT INTO counseling_schedules (appointment_description, doc_requests_id)
                VALUES (?, ?)";

                $stmt = $connection->prepare($query);
                $stmt->bind_param("si", $counselingDescription, $insertedId);
                if ($stmt->execute()) {
                    $_SESSION['success'] = true;
                    header("Refresh:0");
                    $stmt->close();
                }
                $connection->close();
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
        <div class="container-fluid text-center p-4">
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
                            <a class="btn btn-outline-primary mb-2" href="/student/transactions.php">
                            <i class="fa-regular fa-clipboard"></i> My Transactions
                            </a>
                            <a class="btn btn-outline-primary mb-2">
                            <i class="fa-regular fa-flag"></i> Generate Inquiry
                            </a>
                            <button class="btn btn-outline-primary mb-2" onclick="location.reload()">
                                <i class="fa-solid fa-arrows-rotate"></i> Reset Form
                            </button>
                            <button class="btn btn-outline-primary mb-2">
                                <i class="fa-solid fa-circle-question"></i> Help
                            </button>
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
                            <div class="form-group col-12">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contactNumber" name="contactNumber" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" placeholder="Example: 0123-456-7890" maxlength="13">
                            </div>
                            <div class="form-group col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="example@yahoo.com" maxlength="100">
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
                                    <div class="invalid-feedback">Please choose an option.</div>
                                </div>
                                
                            </div>
                            <div class="form-group required col-md-6">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" id="date" required>
                                <div class="invalid-feedback">Please choose a valid date.</div>
                            </div>
                            <div class="form-group required col-md-6">
                                <label for="time" class="form-label">Time</label>
                                <select class="form-control form-select" name="time" id="time" required>
                                    <option value="">--Select--</option>
                                    <option value="08:00:00">8:00 AM</option>
                                    <option value="09:00:00">9:00 AM</option>
                                    <option value="10:00:00">10:00 AM</option>
                                    <option value="11:00:00">11:00 AM</option>
                                    <option value="12:00:00">12:00 PM</option>
                                    <option value="13:00:00">1:00 PM</option>
                                    <option value="14:00:00">2:00 PM</option>
                                    <option value="15:00:00">3:00 PM</option>
                                    <option value="16:00:00">4:00 PM</option>
                                    <option value="17:00:00">5:00 PM</option>
                                    <option value="18:00:00">6:00 PM</option>
                                    <option value="19:00:00">7:00 PM</option>
                                    <option value="20:00:00">8:00 PM</option>
                                </select>
                                <div class="invalid-feedback">Please choose a time.</div>
                            </div>
                            <div class="form-group col-12">
                                <label for="supportingDocuments" class="form-label">
                                    <p>Supporting Documents (Referral Slip, etc.)</p>
                                    <small>You can attach multiple files</small>
                                </label>
                                <input class="form-control" name="supportingDocuments" type="file" id="supportingDocuments" multiple>
                            </div>
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">
                                <i class="fa-solid fa-circle-info"></i> Reminder
                                </h4>
                                <p>Your appointment request will be forwarded to the concerned office after you click the "Submit" button.</p>
                                <p>A .PDF file of your approval letter will be generated after successfully submitting this form and must be submitted to the Director's Office before your scheduled appointment.</p>
                                <p>Confirmation (approved/disapproved) of the request will be sent to your registered email.</p>
                                <p class="mb-0">You may also constantly monitor the status of the request by going to <b>My Transactions</b>.</p>
                            </div>
                            <div class="d-flex w-100 justify-content-between p-1">
                                <button class="btn btn-primary px-4" onclick="window.history.go(-1); return false;">
                                    <i class="fa-solid fa-arrow-left"></i> Back
                                </button>
                                <button id="submitBtn" type="button" class="btn btn-primary w-25">Submit</button>
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
                        <div id="successModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Your counseling appointment has been submitted successfully!</p>
                                        <p>You can check the status of your appointment on the <b>My Transactions</b> page.</p>
                                        <p>You must print this approval letter and submit it to the Director's Office before your scheduled appointment.</p>
                                        <a href="./generate_pdf.php" target="_blank" class="btn btn-primary">Show Letter</a>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="../../jquery.js"></script>
    <script>
        let currentDate = new Date().toISOString().split('T')[0];

        var maxDate = "2033-12-31";

        document.getElementById("date").min = currentDate;
        document.getElementById("date").max = maxDate;

        var counselingDesc = document.getElementById('counseling_description').value;

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
    </script>
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