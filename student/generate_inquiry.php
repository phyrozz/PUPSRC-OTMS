<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php
            $office_name = "Select an Office";
            include "../navbar.php"
        ?>
        <div class="container-fluid p-4">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="academic.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Generate Inquiry/Concern</li>
                </ol>
            </nav>
        </div>
        <div class="container-fluid text-center p-4">
            <h1>Generate Inquiry/Concern</h1>
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
                    </div>
                    <div class="card-body">
                        <form id="inquiry-form" class="row g-3">
                            <div class="form-group required col-5">
                                <label for="Name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="Name" placeholder="Juan Dela Cruz" disabled required>
                            </div>
                            <div class="form-group required col-3">
                                <label for="crs_yr_sec" class="form-label">Course/Year/Section</label>
                                <input type="text" class="form-control" id="section" placeholder="BSIT 3-1" disabled required>
                            </div>
                            <div class="form-group required col-5">
                                <label for="stud_Num" class="form-label">Student Number</label>
                                <input type="text" class="form-control" id="studentNumber" placeholder="2020-00000-SR-0" disabled required>
                            </div>
                            <div class="form-group required col-3">
                                <label for="office" class="form-label">Office</label>
                                <select class="form-select" id="officedropdown">
                                    <option value="registration">Registration</option>
                                    <option value="guidance">Guidance</option>
                                    <option value="academic">Academic</option>
                                    <option value="accounting">Accounting</option>
                                    <option value="administration">Administration</option>
                                </select>
                            </div>
                            <div class="form-group required col-5">
                                <label for="transaction_Id" class="form-label">Transaction ID (if applicable)</label>
                                <input type="text" class="form-control" id="transactionid" placeholder="AO-SO-001">
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
                                        <a href="academic.php" id="submit" class="btn btn-primary">Submit</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
        <div class="push"></div>
    </div>
    <footer class="footer container-fluid w-100 text-md-left text-center d-md-flex align-items-center justify-content-center bg-light flex-nowrap">
        <div>
            <small>PUP Santa Rosa - Online Transaction Management System Beta 0.1.0</small>
        </div>
        <div>
            <small><a href="https://www.pup.edu.ph/terms/" target="_blank" class="btn btn-link">Terms of Use</a>|</small>
            <small><a href="https://www.pup.edu.ph/privacy/" target="_blank" class="btn btn-link">Privacy Statement</a></small>
        </div>
    </footer>
</body>
</html>