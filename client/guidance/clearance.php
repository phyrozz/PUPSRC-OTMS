<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guidance Office - Request Clearance</title>
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
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php
            $office_name = "Guidance Office";
            include "../navbar.php"; 
            include "../../breadcrumb.php";
            include "../../conn.php";

            $query = "SELECT last_name, first_name, middle_name, extension_name, contact_no, email FROM users
            WHERE user_id = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();

            if(isset($_POST['clearanceFormSubmit'])) {
                $requestDescription = "Request Clearance";
                $officeId = 5;
                $statusId = 1;
                $amountToPay = 0.00;

                $query = "INSERT INTO doc_requests (request_description, office_id, user_id, status_id, amount_to_pay)
                VALUES (?, ?, ?, ?, ?)";

                $stmt = $connection->prepare($query);
                $stmt->bind_param("siiid", $requestDescription, $officeId, $_SESSION['user_id'], $statusId, $amountToPay);
                if ($stmt->execute()) {
                    $_SESSION['success'] = true;
                    // header("Location: http://localhost/student/guidance/success.php");
                }
                else {
                    var_dump($stmt->error);
                }
                $stmt->close();
                $connection->close();
            }
        ?>
        <div class="container-fluid p-4">
            <?php
            $breadcrumbItems = [
                ['text' => 'Guidance Office', 'url' => '/client/guidance.php', 'active' => false],
                ['text' => 'Request Clearance', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, true);
            ?>
        </div>
        <div class="container-fluid text-center p-4">
            <h1>Request Document - Clearance</h1>
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
                            <a class="btn btn-outline-primary mb-2" href="/client/transactions.php">
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
                        <form action="clearance.php" id="appointment-form" class="row g-3" method="POST">
                        <input type="hidden" name="form_type" value="clearance">
                            <small>Fields highlighted in <small style="color: red"><b>*</b></small> are required.</small>
                            <h6>Alumni Information</h6>
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
                            <div class="form-group col-12">
                                <label for="supportingDocuments" class="form-label">
                                    <p>Supporting Documents (Referral Slip, etc.)</p>
                                    <small>You can attach multiple files</small>
                                </label>
                                <input class="form-control" type="file" id="supportingDocuments" multiple>
                            </div>
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">
                                <i class="fa-solid fa-circle-info"></i> Reminder
                                </h4>
                                <p>Your document request will be forwarded to the concerned office after you click the "Submit" button.</p>
                                <p>Confirmation (approved/disapproved) of the request will be sent to your registered email.</p>
                                <p>You need to appoint a schedule before you can retrieve your requested document.</p>
                                <p class="mb-0">You may appoint a schedule and also constantly monitor the status of your request by going to <b>My Transactions</b>.</p>
                            </div>
                            <div class="d-flex w-100 justify-content-between p-1">
                                <button class="btn btn-primary px-4" onclick="window.history.go(-1); return false;">
                                    <i class="fa-solid fa-arrow-left"></i> Back
                                </button>
                                <input id="submitBtn" value="Submit" type="button" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal" />
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
                                        <button type="submit" id="submit" class="btn btn-primary" name="clearanceFormSubmit">Yes</button>
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
                                        <p>You can check the status of your request on the <b>My Transactions</b> page.</p>
                                        <p>You must print this approval letter and submit it to the Director's Office before scheduling your request.</p>
                                        <a href="./generate_pdf.php" target="_blank" class="btn btn-primary">Show Letter</a>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="../transactions.php" class="btn btn-primary">Go to My Transactions</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of success alert modal -->
                    </div>
                </div>
            </div>
        </div>
        <div class="push"></div>
    </div>
    <?php include '../../footer.php'; ?>
    <script src="../../jquery.js"></script>
    <script>
        const contactNoInput = document.getElementById('contactNumber'); // Corrected typo
        const contactNoValidationMessage = document.getElementById('contactNoValidationMessage');

        contactNoInput.addEventListener('input', () => {
            const contactNo = contactNoInput.value.trim();
            const contactNoValidPattern = /^09\d{2}-\d{3}-\d{4}$/;

            if (!contactNoValidPattern.test(contactNo)) {
                contactNoValidationMessage.textContent = 'Invalid contact number. The format must be 090x-xxx-xxxx';
                contactNoInput.classList.add('is-invalid');
            } else {
                contactNoValidationMessage.textContent = '';
                contactNoInput.classList.remove('is-invalid');
            }
        });

        // Function to handle form submission
        function handleSubmit() {
            validateContactNumber();
            var form = document.getElementById('appointment-form');
            if (form.checkValidity()) {
                $('#confirmSubmitModal').modal('show');
            }
        }
        
        // Add event listener to the submit button
        document.getElementById('submitBtn').addEventListener('click', handleSubmit);
    </script>
    <script src="../../loading.js"></script>
    <?php
    if (isset($_SESSION['success'])) {
        ?>
        <script>
            // window.location.href="http://localhost/student/guidance/clearance.php";
            $(document).ready(function() {
                $("#successModal").modal("show");
            })
        </script>
        <?php
        unset($_SESSION['success']);
        exit();
    }
    ?>
</body>
</html>