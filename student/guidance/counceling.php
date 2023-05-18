<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guidance Office - Counseling</title>
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
            $office_name = "Guidance Office";
            include "../../navbar.php"
        ?>
        <div class="container-fluid p-4">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="../guidance.php">Guidance Office</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Schedule for Counseling</li>
                </ol>
            </nav>
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
                        <form id="appointment-form" class="row g-3">
                            <small>Fields highlighted in <small style="color: red"><b>*</b></small> are required.</small>
                            <h6>Student Information</h6>
                            <div class="form-group required col-12">
                                <label for="studentNumber" class="form-label">Student Number</label>
                                <input type="text" class="form-control" id="studentNumber" disabled required>
                            </div>
                            <div class="form-group required col-12">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" disabled required>
                            </div>
                            <div class="form-group required col-12">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" disabled required>
                            </div>
                            <div class="form-group required col-md-6">
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middleName" disabled required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="extensionName" class="form-label">Extension Name</label>
                                <input type="text" class="form-control" id="extensionName" disabled required>
                            </div>
                            <div class="form-group required col-12">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contactNumber" name="contactNumber" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Example: 0123-456-7890" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="example@yahoo.com" required>
                            </div>
                            <h6 class="mt-5">Appointment Information</h6>
                            <div class="form-group required col-md-6">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" max="2023-12-31" required>
                            </div>
                            <div class="form-group required col-md-6">
                                <label for="time" class="form-label">Time</label>
                                <select class="form-control" id="time">
                                    <option>8:00 AM</option>
                                    <option>9:00 AM</option>
                                    <option>10:00 AM</option>
                                    <option>11:00 AM</option>
                                    <option>12:00 PM</option>
                                    <option>1:00 PM</option>
                                    <option>2:00 PM</option>
                                    <option>3:00 PM</option>
                                    <option>4:00 PM</option>
                                    <option>5:00 PM</option>
                                    <option>6:00 PM</option>
                                    <option>7:00 PM</option>
                                    <option>8:00 PM</option>
                                </select>
                            </div>
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
                                <p>Your appointment request will be forwarded to the concerned office after you click the "Submit" button.</p>
                                <p>Confirmation (approved/disapproved) of the request will be sent to your registered email.</p>
                                <p class="mb-0">You may also constantly monitor the status of the request by going to <b>My Transactions</b>.</p>
                            </div>
                            <div class="d-flex w-100 justify-content-between p-1">
                                <button class="btn btn-primary px-4" onclick="window.history.go(-1); return false;">
                                    <i class="fa-solid fa-arrow-left"></i> Back
                                </button>
                                <input id="submitBtn" value="Submit "type="button" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal" />
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
                                        <a href="#" id="submit" class="btn btn-primary">Submit</a>
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
</body>
</html>