<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Office - Manual Enrollment</title>
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
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="academic.css">
</head>
<body>
<div class="wrapper">
    <?php

        use FontLib\Table\Type\head;

        $office_name = "Academic Office";
        include ('../navbar.php');
        include ('editmodal-me.php');

        //include('helpmodal.php');
        include '../../breadcrumb.php';
        include "../../conn.php";

        
        $query = "SELECT r_zero_form, r_zero_form_status, me_remarks FROM acad_manual_enrollment WHERE user_id = ?";

        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $queryData = $result->fetch_all(MYSQLI_ASSOC);
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

    <div class="container-fluid academicbanner header" style="height: 250px">
        <?php
        $breadcrumbItems = [
            ['text' => 'Academic Office', 'url' => '/student/academic.php', 'active' => false],
            ['text' => 'Manual Enrollment', 'active' => true],
        ];

        echo generateBreadcrumb($breadcrumbItems, false);
        ?>
        <h1 class="display-1 header-text text-center text-light">Manual Enrollment</h1>
        <p class="header-text text-center text-light">Failed to enroll during the online registration period set by the University</p>
    </div>

    <br>

    <div class="container-fluid">
        <div class="row g-1">
            <div class="card col-md-3 p-0 m-1">
                <div class="card-header">
                    <h6>PUP Data Privacy Notice</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <p><small>PUP respects and values your rights as a data subject under the Data Privacy Act (DPA). PUP is committed to protecting the personal data you provide in accordance with the requirements under the DPA and its IRR. In this regard, PUP implements reasonable and appropriate security measures to maintain the confidentiality, integrity, and availability of your personal data. For more detailed Privacy Statement, you may visit <a href="https://www.pup.edu.ph/privacy/" target="_blank">https://www.pup.edu.ph/privacy/</a></small></p>
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
                            R0 (R Zero) Form
                        </div>
                        <div class="col-sm-2">
                            <?php echo academicStatus($queryData[0]['r_zero_form_status']);?>
                        </div>
                        <div class="col-sm-2">
                        <a href="<?php echo (is_null($queryData[0]['r_zero_form']) ? '' : '../../assets/uploads/generated_pdf/' . $queryData[0]['r_zero_form']); ?>" class="btn <?php echo (is_null($queryData[0]['r_zero_form']) ? "disabled" : "btn-primary"); ?>" target="_blank">View Attachment</a>
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
                <textarea class="form-control" readonly style="height: 200px; resize: none;"><?php echo htmlspecialchars($queryData[0]['note'], ENT_QUOTES);?></textarea>
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
        <div class="push"></div>
    </div>
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
            var rzeroFormStatus = <?php echo $queryData[0]['r_zero_form_status']; ?>;
            var submitBtn = document.getElementById("submitBtn");

            // Enable the submit button only if all three requirements are uploaded
            if (rzeroFormStatus == 2) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }

    function resetForm() {
        if (confirm("Are you sure you want to reset the form? This will delete attached files and reset their status to 'Missing'. But this will only reset requirements if they're in PENDING status.")) {
            $.ajax({
                url: "resetform_me.php",
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