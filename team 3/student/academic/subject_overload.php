<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Office - Subject Overload</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="academic.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body onload="openModal()">
<div class="wrapper">
    <?php
        $office_name = "Academic Office";
        include('../navbar.php');
        include('uploadmodal.php');
        include('editmodal-se.php');
        include '../../breadcrumb.php';
        //include('generate_pdf.php')
    ?>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div id="modalContent" class="modal-content">
            <img src="/assets/exclamation.png" class="exclamationpic">
            <br/><h2>Are you a student in good standing?</h2>
            <p>(no failing grade in previous semester)</p>
            <div class="modal-radio-group">
                <input type="radio" name="option" value="option1" class="radio-option1">
                <label for="option1">Yes</label>
                <input type="radio" name="option" value="option2" class="radio-option2">
                <label for="option2">No</label>
            </div>
            <br/><button type="button" class="btn btn-primary" id="nextButton" onclick="questionModal()" disabled>Next</button>
            <!-- <span id="countdownText" class="countdown"></span> -->
        </div>
    </div>

    <!-- When answered No Modal-->
    <div id="redirectModal" class="modal">
        <div id="modalContent" class="modal-content">
            <a href="../academic.php" class="btn-close" aria-label="Close"></a>
            <img src="/assets/exclamation.png" class="exclamationpic">
            <br/><h1>Subject overload is only allowed for academically outstanding students.</h1>
            <a href="../academic.php" class="btn btn-primary" id="nextButton">Home</a>
        </div>
    </div>

    <div class="container-fluid academicbanner header" style="height:250px">
        <?php
        $breadcrumbItems = [
            ['text' => 'Academic Office', 'url' => '/student/academic.php', 'active' => false],
            ['text' => 'Subject Overload', 'active' => true],
        ];

        echo generateBreadcrumb($breadcrumbItems, false);
        ?>
        <h1 class="display-1 header-text text-center text-light">Subject Overload</h1>
        <p class="header-text text-center text-light">Add additional subject/s more than the prescribed number of units</p>
    </div>

    <br/>

    <div class="container-fluid">
        <div class="row g-1">
            <div class="card col-md-3 p-0 m-1">
                <div class="card-header">
                    <h6>PUP Data Privacy Notice</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <p><small>PUP respects and values your rights as a data subject under the Data Privacy Act (DPA). PUP is committed to protecting the personal data you provide in accordance with the requirements under the DPA and its IRR. In this regard, PUP implements reasonable and appropriate security measures to maintain the confidentiality, integrity and availability of your personal data. For more detailed Privacy Statement, you may visit <a href="https://www.pup.edu.ph/privacy/" target="_blank">https://www.pup.edu.ph/privacy/</a></small></p>
                    <div class="d-flex flex-column">
                        <button class="btn btn-outline-primary mb-2">
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
                    <div class="row">
                        <div class="col-sm-6">
                            Requirements
                        </div>
                        <div class="col-sm-2">
                            Status
                        </div>
                        <div class="col-sm-2">
                            Attachment
                        </div>
                        <div class="col-sm-2">
                            Action
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            Request Letter for Overload
                            <br/><span class="subtext">(Letter that contains justification of the need for overload)</span>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-secondary"><i class="fa-solid fa-circle-question"></i> Missing</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary"> View Attachment</button> 
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal"><i class="fa-solid fa-paperclip"></i> Upload</button> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            ACE Form
                            <br/><span class="subtext">(Adding of Subject/s)</span>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-info"><i class="fa-solid fa-magnifying-glass"></i> Under Verification</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary"> View Attachment</button> 
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal"><i class="fa-solid fa-pen-to-square"></i> Edit</button> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            Certificate of Registration
                            <br/><span class="subtext">(Current semester)</span>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-success"><i class="fa-solid fa-circle-check"></i> Verified</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary"> View Attachment</button> 
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal"><i class="fa-solid fa-paperclip"></i> Upload</button> 
                        </div>
                    </div>
                </div>

                <div class="d-flex w-100 justify-content-between p-1">
                    <button class="btn btn-primary px-4" onclick="window.history.go(-1); return false;">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </button>
                    <input id="submitBtn" value="Submit "type="button" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#confirmModal" />
                </div>

                <!-- confirmModal -->
                <div class="modal fade modal-dark" id="confirmModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmSubmitModalLabel">Confirm Form Submission</h5>
                                <button type="button" class="btn-close upload" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5><center>Are you sure you want to submit these requirements?</center></h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a href="../survey.php" class="btn btn-primary">Submit</a>
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
    <script src="modal.js"></script>
    <script src="upload.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>