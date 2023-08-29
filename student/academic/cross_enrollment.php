<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Office - Cross-Enrollment</title>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="academic.css">
</head>
<body>
<div class="wrapper">
    <?php
    
    use FontLib\Table\Type\head;

    $office_name = "Academic Office";
    include ('../navbar.php');
    include ('editmodal-ce.php');
    
    //include('helpmodal.php');
    include '../../breadcrumb.php';
    include "../../conn.php";


    // Dynamically display statuses on each requirements
    $query = "SELECT application_letter, application_letter_status FROM acad_cross_enrollment WHERE user_id = ?";

    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $reqData = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $connection->close();

    function academicStatus($status) {
    switch ($status) {
        case 1:
            return '<button type="button" class="btn btn-danger" id="status_button" disabled>
            <i class="fa-solid fa-circle-question"></i> Missing
        </button>';
            break;
        case 2:
            return '<button type="button" class="btn btn-secondary" id="status_button" disabled>
            <i class="fa-solid fa-spinner"></i> Pending
        </button>';
            break;
        case 3:
            return '<button type="button" class="btn btn-info" id="status_button" disabled>
            <i class="fa-solid fa-magnifying-glass"></i> Under Verification
        </button>';
            break;
        case 4:
            return '<button type="button" class="btn btn-success" id="status_button" disabled>
            <i class="fa-solid fa-circle-check"></i> Verified
        </button>';
            break;
    }
}
?>

    <div class="container-fluid academicbanner header" style="height:250px">
        <?php
        $breadcrumbItems = [
            ['text' => 'Academic Office', 'url' => '/student/academic.php', 'active' => false],
            ['text' => 'Cross-Enrollment', 'active' => true],
        ];

        echo generateBreadcrumb($breadcrumbItems, false);
        ?>
        <h1 class="display-1 header-text text-center text-light">Cross-Enrollment</h1>
        <p class="header-text text-center text-light">Enrollment of subject/s at another college or university</p>
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
                        <button class="btn btn-outline-primary mb-2" onclick="location.reload()">
                            <i class="fa-solid fa-arrows-rotate"></i> Reset Form
                        </button>
                        <a href="help-academic.php" class="btn btn-outline-primary mb-2"><i class="fa-solid fa-circle-question"></i> Help</a>
                    </div>
                </div>
            </div>
            <div class="card col-md p-0 m-1">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">Requirements</div>
                        <div class="col-sm-2">Status</div>
                        <div class="col-sm-4">Note</div><!-- Added column -->
                        <div class="col-sm-2">Attachment</div>
                        <div class="col-sm-2">Action</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">Application Letter for Cross-Enrollment</div>
                        <div class="col-sm-2">
                            <?php echo academicStatus($reqData[0]['application_letter_status']); ?>
                        </div>
                        <div class="col-sm-2">
                            <a href="<?php echo (is_null($reqData[0]['application_letter']) ? '' : '../../assets/uploads/generated_pdf/' . $reqData[0]['application_letter']); ?>" class="btn <?php echo (is_null($reqData[0]['application_letter']) ? "disabled" : "btn-primary"); ?>" target="_blank">View Attachment</a>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </button> 
                        </div>
                    </div>
                </div>
                <div class="d-flex w-100 justify-content-between p-1">
                    <a href="../academic.php" class="btn btn-primary px-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
                    <input id="submitBtn" value="Submit" type="button" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#confirmModal" />
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
                                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                <div class="modal-body">
                    Application successfully submitted!
                </div>
                <div class="modal-footer">
                <a href="survey.php" class="btn btn-primary">Okay</a>
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
<script src="../../loading.js"></script>
<script src="modal.js"></script>
<script src="upload.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script>
        // Call the function on page load to check the initial status
        $(document).ready(function() {
            checkRequirements();

            // Function to check if all requirements are uploaded and enable/disable the submit button accordingly
            function checkRequirements() {
                var applicationFormStatus = <?php echo $reqData[0]['application_form_status']; ?>;
                var submitBtn = document.getElementById("submitBtn");

                // Enable the submit button only if all three requirements are uploaded
                if (applicationFormStatus == 2) {
                    submitBtn.disabled = false;
                } else {
                    submitBtn.disabled = true;
                }
            }
        });

    </script>
    <script src="../../saved_settings.js"></script>
</body>
</html>