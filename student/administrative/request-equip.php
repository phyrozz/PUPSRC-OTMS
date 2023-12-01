<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request of Equipment</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" href="../../assets/icon/pup-logo.png" type="image/x-icon">
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

        // Query to retrieve user data
        $query = "SELECT student_no, last_name, first_name, middle_name, extension_name, email FROM users WHERE user_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        if (isset($_POST['equipFormSubmit'])) {
            $date = $_POST['date'];
            $quantityEquip = $_POST['quantityequip'];
            $time = $_POST['time'];
            $statusId = 1;
            $purpose = $_POST['purposeReq'];
            $dateTimeSched = $date . ' ' . $time;
            $equipID = $_POST['id'];

            // Check if the requested quantity is available
            $checkQuery = "SELECT quantity FROM equipment WHERE equipment_id = ?";
            $checkStmt = $connection->prepare($checkQuery);
            $checkStmt->bind_param("i", $equipID);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
            $equipmentData = $checkResult->fetch_assoc();
            $checkStmt->close();

            if ($equipmentData['quantity'] >= $quantityEquip) {
                // // Deduct the requested quantity from the equipment table
                // $deductQuery = "UPDATE equipment SET quantity = quantity - ? WHERE equipment_id = ?";
                // $deductStmt = $connection->prepare($deductQuery);
                // $deductStmt->bind_param("ii", $quantityEquip, $equipID);
                // $deductStmt->execute();
                // $deductStmt->close();

                // Check if the quantity is 0
                $checkAvailabilityQuery = "SELECT quantity FROM equipment WHERE equipment_id = ?";
                $checkAvailabilityStmt = $connection->prepare($checkAvailabilityQuery);
                $checkAvailabilityStmt->bind_param("i", $equipID);
                $checkAvailabilityStmt->execute();
                $checkAvailabilityResult = $checkAvailabilityStmt->get_result();
                $equipmentData = $checkAvailabilityResult->fetch_assoc();
                $checkAvailabilityStmt->close();

                if ($equipmentData['quantity'] == 0) {
                    // Update the availability to "Unavailable"
                    $updateAvailabilityQuery = "UPDATE equipment SET availability = 'Unavailable' WHERE equipment_id = ?";
                    $updateAvailabilityStmt = $connection->prepare($updateAvailabilityQuery);
                    $updateAvailabilityStmt->bind_param("i", $equipID);
                    $updateAvailabilityStmt->execute();
                    $updateAvailabilityStmt->close();
                }

                // Insert the request into the request_equipment table
                $insertQuery = "INSERT INTO request_equipment (datetime_schedule, quantity_equip, user_id, status_id, purpose, equipment_id) 
                                VALUES (?, ?, ?, ?, ?, ?)";
                
                
                $insertStmt = $connection->prepare($insertQuery);
                $insertStmt->bind_param("siiisi", $dateTimeSched, $quantityEquip, $_SESSION['user_id'], $statusId, $purpose, $equipID);
                
                if ($insertStmt->execute()) {
                    $_SESSION['success'] = true;

                    $_SESSION['request_details'] = [
                        'time' => $time,
                        'date' => $date,
                        'quantity_equip' => $quantityEquip,
                        'user_id' => $_SESSION['user_id'],
                        'status_id' => $statusId,
                        'equipment_id' => $equipID,
                    ];
                    // header("Refresh:0");
                } else {
                    var_dump($insertStmt->error);
                }
                $insertStmt->close();
            } else {
                // Quantity not available, display an error message
                $_SESSION['error'] = "Insufficient quantity available for the requested equipment.";
            }

            $connection->close();
        }
        ?>



        <div class="container-fluid p-4">
            <?php
            $breadcrumbItems = [
                ['text' => 'Administrative Office', 'url' => '../administrative.php', 'active' => false],
                ['text' => 'Request of Equipment', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, true);
            ?>
            
        <div class="container-fluid text-center mt-4 p-4">
            <h1>Request of Equipment</h1>
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
                        <h6>Request Form</h6>
                    </div>
                    <div class="card-body">
                        <form action="request-equip.php" id="request-form" class="needs-validated row g-3" method="POST" novalidate>
                            <input type="hidden" name="form_type" value="request_form">
                            <small>Fields highlighted in <small style="color: red"><b>*</b></small> are required.</small>
                            <h6>Student Information</h6>
                            <div class="form-group required col-12">
                                <label for="studentNumber" class="form-label">Student Number</label>
                                <input type="text" class="form-control" id="studentNumber"  value="<?php echo $userData[0]['student_no'] ?>" maxlength="15" disabled required>
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
                            <!-- <div class="form-group col-12">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contactNumber" name="contactNumber" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Example: 0123-456-7890" maxlength="13">
                            </div> -->
                            
                            <div class="form-group required col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value = "<?php echo $userData[0]['email'] ?>" maxlength="50" disabled required >
                            </div>

                            <h6 class="mt-5">Request Information</h6>

                            <div class="form-group required col-md-6">
                                <label for="equipName" class="form-label">Equipment Name</label>
                                <input type="text" class="form-control" id="equipName" name="equipName" value="<?php echo isset($_GET['equipment_name']) ? $_GET['equipment_name'] : ''; ?>" disabled>
                                <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                                <div class="invalid-feedback">Please input a valid email address.</div>
                            </div>


                            <div class="form-group required col-md-6">
                                <label for="quantityequip" class="form-label">Quantity</label>
                                <!-- get the current quantity of an equipment from equipment table and make it a max quantity  -->
                                <input type="number" class="form-control" id="quantityequip" name="quantityequip" oninput="validateQuantity(this)" min="1" max="<?php echo isset($_GET['quantity']) ? $_GET['quantity'] : ''; ?>" required> 
                                <div class="invalid-feedback">Please input a valid quantity (Max. <?php echo isset($_GET['quantity']) ? $_GET['quantity'] : ''; ?>).</div>
                            </div>

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
                                    <option value="17:00:00">5:00 PM</option>
                                    <option value="17:30:00">5:30 PM</option>
                                    <option value="18:00:00">6:00 PM</option>
                                    <option value="18:30:00">6:30 PM</option>
                                    <option value="19:00:00">7:00 PM</option>
                                    <option value="19:30:00">7:30 PM</option>
                                    <option value="20:00:00">8:00 PM</option>
                                </select>      
                                <div class="invalid-feedback">Please choose a time.</div>
                            </div>
                            <div class="form-group required col-md-12">
                                <label for="request_description" class="form-label">Purpose of Request</label>
                                <textarea type="purposeReq" class="form-control form-control-lg" name="purposeReq" style="resize: none;" id="purposeReq" rows="4" minlength="5"maxlength="100" required></textarea>
                                <div class="invalid-feedback">Please provide a reason for request</div>
                            </div>
                            
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">
                                <i class="fa-solid fa-circle-info"></i> Reminder
                                </h4>
                                <p>Your request will be forwarded to the concerned office after you click the "Submit" button.</p>
                                <p>A .PDF file of your slip will be generated after successfully submitting this form and must be submitted to the Administrative office before your request.</p>
                                <p>Confirmation (approved/disapproved) of the request will be sent to your registered email.</p>
                                <p class="mb-0">You may also constantly monitor the status of the request by going to <b>My Transactions</b>.</p>
                            </div>
                            <div class="d-flex w-100 justify-content-between p-1">
                                <button class="btn btn-primary px-4" onclick="window.history.go(-1); return false;">
                                    <i class="fa-solid fa-arrow-left"></i> Back
                                </button>
                                <!-- <button id="saveLaterBtn" class="btn btn-primary w-15">Save Later</button> -->
                                <input id="submitBtn" value="Submit "type="button" class="btn btn-primary w-25" />
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
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
                                            <button type="submit" id="submit" class="btn btn-primary" name="equipFormSubmit" data-bs-toggle="modal" data-bs-target="#successModal">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </form>
                        <div id="successModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                                        
                                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                    </div>
                                    <div class="modal-body">
                                        <p>Your request has been submitted successfully!</p>
                                        <h5>What should I do next?</h5>
                                        <ol>
                                            <li>Please download the slip needed for the request (Refer to the <b>Help</b> page).</li>
                                            <li>Proceed to the <b>Student Services</b> office (Room 210) to submit the requirements.</li>
                                            <li>Wait for the request to be approved by constantly checking its status on the <b>My Transactions</b> page.</li>
                                        </ol>
                                        <button type="button" class="btn btn-primary" onclick="redirectToAnotherPage()">Show Slip</button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="redirectToViewEquipment()">Create another request</button>
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
    <?php include '../../footer.php'; ?>
    <script src="../../loading.js"></script>
    <script src="../../jquery.js"></script>

    <script>
        const dateValidation = document.getElementById('datepicker');
        const dateValidationMessage = document.getElementById('dateValidationMessage');

            function validateForm() {
                var form = document.getElementById('request-form');
                var selectFields = form.querySelectorAll('select[required]');
                var quantityField = document.getElementById('quantityequip');
                var quantityValue = parseInt(quantityField.value);

                if (quantityValue < 0) {
                    quantityField.classList.add('is-invalid');
                    quantityField.classList.remove('is-valid');
                } else {
                    quantityField.classList.add('is-valid');
                    quantityField.classList.remove('is-invalid');
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
                        selectField.classList.remove('is-valid');
                    } else {
                        selectField.classList.add('is-valid');
                        selectField.classList.remove('is-invalid');
                    }
                }

                quantityField.addEventListener('input', function() {
                    //  limit the length of the input
                if (quantityField.value.length >= 2) {
                    quantityField.value = quantityField.value.slice(0, 2);
                }
                
                });

                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');              
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

            function validateQuantity(input) {
                input.value = input.value.replace(/\D/g, ''); // Remove non-digit characters
            }

            

                // Function to handle form submission
                function handleSubmit() {
                    validateForm();
                    if (document.getElementById('request-form').checkValidity()) {
                    $('#confirmSubmitModal').modal('show');
                    }
                }
                document.getElementById('submitBtn').addEventListener('click', handleSubmit);


           

            function redirectToViewEquipment() {
                // Redirect to the view-equipment.php page
                window.location.href = "view-equipment.php";
            }
            function redirectToAnotherPage() {
                var url = "/student/administrative/generate-slip.php";
                window.open(url, "_blank"); 
            }
            
            

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
                onChange: function(selectedDates, dateStr, instance) {
                    var currentDate = new Date();
                    var selectedDate = selectedDates[0];
                    var timeSelect = document.getElementById("time");
                    
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
                }
            });
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

            <script>
                $(document).ready(function() {
                    // Get the equipment ID from the query parameter in the URL
                    var equipID = <?php echo isset($_POST['id']) ? $_POST['id'] : 0; ?>

                    // Only make the AJAX request if equipID is not 0
                    if (equipID !== 0) {
                        // AJAX request to fetch the equipment name based on the equipment ID
                        $.ajax({
                            type: "POST",
                            url: "get-equipment-name.php",
                            data: { equipID: equipID },
                            success: function(response) {
                                // Update the value of the "Equipment Name" input field with the fetched equipment name
                                $("#equipName").val(response);
                            },
                            error: function() {
                                console.log("An error occurred while fetching the equipment name.");
                            }
                        });
                    }
                });
            </script>
        <script src="../../saved_settings.js"></script>
</body>
</html>