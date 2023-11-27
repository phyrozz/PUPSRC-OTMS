<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Office - Grade Accreditation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">

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
<body onload="open_payModal()">
<div class="wrapper">
    <?php
        
        use FontLib\Table\Type\head;

        $office_name = "Academic Office";
        include ('../navbar.php');
        include ('uploadmodal.php');
        include ('editmodal-ga.php');
        
        //include('helpmodal.php');
        include '../../breadcrumb.php';
        include "../../conn.php";
    ?>

    <?php
    // Start the session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the modal has already been shown in this session
    if (!isset($_SESSION['session_ga'])) {
        // Set the session variable to indicate that the modal has been shown
    
        // Display the modal
        // ... Your modal HTML code goes here ...
        echo '<!-- Pay Alert Modal -->
        <div id="payModal" class="modal">
            <div id="modalContent" class="modal-content">
                <img src="/assets/exclamation.png" class="exclamationpic">
                <br/>
                <h2>Pay 30 PHP at the cashier for the assessed fee.</h2>
                <p>Take a picture of the issued receipt as it needs to be uploaded here later.</p>
                <br/>
                <form action="update_session.php" method="POST" id="sessionForm">
                    <input type="hidden" name="session_transaction" value="ga">
                    <button type="submit" class="btn btn-primary" onclick="close_payModal()">Okay</button>
                </form>
            </div>
        </div>';
    } else {
        // Set the session variable to indicate that the modal has been shown
        $_SESSION['session_ga'] = true;
    }
    
    // Dynamically display statuses on each requirements
    $query = "SELECT completion_form, assessed_fee, completion_form_status, assessed_fee_status, ga_remarks FROM acad_grade_accreditation WHERE user_id = ?";

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
                return '<button type="button" class="btn bg-light text-dark" id="status_button" disabled>
                <i class="fa-solid fa-circle-question"></i> Missing
            </button>';
                break;
            case 2:
                return '<button type="button" class="btn bg-secondary" id="status_button" disabled>
                <i class="fa-solid fa-spinner"></i> Pending
            </button>';
                break;
            case 3:
                return '<button type="button" class="btn bg-dark text-light" id="status_button" disabled>
                <i class="fa-solid fa-magnifying-glass"></i> Under Verification
            </button>';
                break;
            case 4:
                return '<button type="button" class="btn bg-success text-light" id="status_button" disabled>
                <i class="fa-solid fa-circle-check"></i> Verified
            </button>';
                break;
            case 5:
                return '<button type="button" class="btn btn-danger" id="status_button" disabled>
                <i class="fa-solid fa-circle-check"></i> Rejected
            </button>';
                break;
            case 6:
                return '<button type="button" class="btn bg-info text-dark" id="status_button" disabled>
                <i class="fa-solid fa-circle-check"></i> To Be Evaluated
            </button>';
                break;
            case 7:
                return '<button type="button" class="btn bg-warning text-dark" id="status_button" disabled>
                <i class="fa-solid fa-circle-check"></i> Need F to F Evaluation
            </button>';
                break;
            case 8:
                return '<button type="button" class="btn bg-success text-light" id="status_button" disabled>
                <i class="fa-solid fa-circle-check"></i> Approved
            </button>';
                break;
        }
}
?>


    <div class="container-fluid academicbanner header" style="height:250px">
        <?php
        $breadcrumbItems = [
            ['text' => 'Academic Office', 'url' => '/student/academic.php', 'active' => false],
            ['text' => 'Grade Accreditation', 'active' => true],
        ];

        echo generateBreadcrumb($breadcrumbItems, false);
        ?>
        <h1 class="display-1 header-text text-center text-light">Grade Accreditation</h1>
        <p class="header-text text-center text-light">For Correction of Grade Entry, Late Reporting of Grades and Removal of Incomplete Mark</p>
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
                        <button class="btn btn-outline-primary mb-2" onclick="resetForm()">
                            <i class="fa-solid fa-arrows-rotate"></i> Reset Form
                        </button>
                        <a href="help-academic.php" class="btn btn-outline-primary mb-2"><i class="fa-solid fa-circle-question"></i> Help</a>
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
                            Completion Form
                        </div>
                        <div class="col-sm-2">
                            <?php echo academicStatus($reqData[0]['completion_form_status']); ?>
                        </div>
                        <div class="col-sm-2">
                            <a href="<?php echo (is_null($reqData[0]['completion_form']) ? '' : '../../assets/uploads/generated_pdf/' . $reqData[0]['completion_form']); ?>" class="btn <?php echo (is_null($reqData[0]['completion_form']) ? "disabled" : "btn-primary"); ?>" target="_blank">View Attachment</a>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
						<div class="request-letter">Assessed Fee</div>
							<div class="subtext">(<span class="justification">Picture of issued receipt</span>)</div>
                        </div>
                        <div class="col-sm-2">
                            <?php echo academicStatus($reqData[0]['assessed_fee_status']); ?>
                        </div>
                        <div class="col-sm-2">
                            <a href="<?php echo (is_null($reqData[0]['assessed_fee']) ? '' : '../../assets/uploads/user_uploads/' . $reqData[0]['assessed_fee']); ?>" class="btn <?php echo (is_null($reqData[0]['assessed_fee']) ? "disabled" : "btn-primary"); ?>" target="_blank">View Attachment</a>
                        </div>
                        <div class="col-sm-2">
                        <form method="post">
                            <input type="hidden" name="assessedFeeUpload" value="2">
                            <button type="button" name="assessedFeeUploadBtn" id="assessedFeeUploadBtn" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal"><i class="fa-solid fa-paperclip"></i> Upload</button> 
                        </form>
                        </div>
                    </div>
                </div>

                <div class="d-flex w-100 justify-content-between p-1">
                    <a href="../academic.php" class="btn btn-primary px-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
                    <input id="remarksBtn" value="Remarks" type="button" class="btn btn-primary w-20" data-bs-toggle="modal" data-bs-target="#remarksModal">
                    <input id="submitBtn" value="Submit" type="button" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#confirmModal" />
                </div>

                <!-- remarksModal -->
<div class="modal fade modal-dark" id="remarksModal" tabindex="-1" aria-labelledby="remarksSubmitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="remarksSubmitModalLabel">Office's Remarks</h5>
                <button type="button" class="btn-close upload" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                <textarea class="form-control" readonly style="height: 200px; resize: none;"><?php echo htmlspecialchars($reqData[0]['note'], ENT_QUOTES);?></textarea>
                </div>
            </div>
        </div>
    </div>
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
<?php include '../../footer.php'; ?>
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
                var completionFormStatus = <?php echo $reqData[0]['completion_form_status']; ?>;
                var assessedFeeStatus = <?php echo $reqData[0]['assessed_fee_status']; ?>;
                var submitBtn = document.getElementById("submitBtn");

                // Enable the submit button only if all three requirements are uploaded
                if (completionFormStatus == 2 && assessedFeeStatus == 2) {
                    submitBtn.disabled = false;
                } else {
                    submitBtn.disabled = true;
                }
            }


        $('#assessedFeeUploadBtn').on('click', function () {
            uploadRequirement('assessedFee');
        });

        function uploadRequirement(requirementName) {
            // Event listener for file upload button click
            $('#uploadSubmit').on('click', function() {
                // Get the file input element
                var fileInput = document.getElementById('hiddenFileInput');

                // Create a new FormData object
                var formData = new FormData();

                // Append the selected file to the FormData object
                formData.append('fileToUpload', fileInput.files[0]);

                // Append the other form data to the FormData object
                formData.append('student_no', '<?php echo htmlspecialchars($userData[0]['student_no'], ENT_QUOTES); ?>');
                formData.append('last_name', '<?php echo htmlspecialchars($userData[0]['last_name'], ENT_QUOTES); ?>');
                formData.append('first_name', '<?php echo htmlspecialchars($userData[0]['first_name'], ENT_QUOTES); ?>');
                formData.append('requirement_name', requirementName);

                // Create a new XMLHttpRequest object
                var xhr = new XMLHttpRequest();

                // Set up the AJAX request
                xhr.open('POST', 'upload.php', true);

                // Set the event listener to handle the response
                xhr.onload = function() {
                if (xhr.status === 200) {
                    // Success: handle the response from the server
                    try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        console.log('File uploaded successfully.');
                        checkRequirements();
                    } else {
                        console.error('Error: ' + response.message);
                    }
                    } catch (e) {
                    console.error('Error parsing JSON response: ' + e);
                    }
                    location.reload();
                } else {
                    console.error('Error: ' + xhr.status);
                }
                };

                // Set the event listener to handle errors
                xhr.onerror = function() {
                console.error('Error occurred during the AJAX request.');
                };

                // Send the AJAX request with the FormData object
                xhr.send(formData);
            });
        }

        function resetForm() {
            if (confirm("Are you sure you want to reset the form? This will delete attached files and reset their status to 'Missing'. But this will only reset requirements if they're in PENDING status.")) {
                $.ajax({
                    url: "resetform_ga.php",
                    type: "POST",
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error resetting form: " + error);
                    }
                });
            }
        }
    </script>
    <script src="../../saved_settings.js"></script>
</body>
</html>
