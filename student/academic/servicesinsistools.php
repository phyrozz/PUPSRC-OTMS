<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Office - Services in SIS Tools</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../style.css">
    <!-- Loading page -->
    <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
    <div id="loader" class="center">
        <div class="loading-spinner"></div>
        <p class="loading-text display-3 pt-3">Getting things ready...</p>
    </div>
    <link rel="stylesheet" href="academic.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body onload="open_payModal()">
    <div class="wrapper">
        <?php
            $office_name = "Academic Office";
            include ('../navbar.php');
            include '../../breadcrumb.php';
            //include('generate_pdf.php')
        ?>

    <?php
    // Start the session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the modal has already been shown in this session
    if (!isset($_SESSION['session_sistools'])) {
        // Set the session variable to indicate that the modal has been shown
        $_SESSION['session_sistools'] = true;
        $_SESSION['isLoggedIn'] = true;
    
        // Display the modal
        // ... Your modal HTML code goes here ...
        echo '<!-- Pay Alert Modal -->
        <div id="payModal" class="modal">
            <div id="modalContent" class="modal-content">
                <img src="/assets/exclamation.png" class="exclamationpic"><br/>
                <h2>You will complete this transaction in the SIS Tools Website</h2>
                <p>Please prepare your SIS Account.<br/>Once you are finished, click the "Done" button.</p><br/>
                <button type="button" class="btn btn-primary" id="nextButton" onclick="close_payModal()">Okay</button>
            </div>
        </div>';
    }
    ?>
        

        <div class="container-fluid academicbanner header" style="height: 250px">
            <?php
            $breadcrumbItems = [
                ['text' => 'Academic Office', 'url' => '/student/academic.php', 'active' => false],
                ['text' => 'Services in SIS Tools', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, false);
            ?>
            <h1 class="display-1 header-text text-center text-light">Services in SIS Tools</h1>
            <p class="header-text text-center text-light">(a) ACE Form - Add subjects or change your officially enrolled subjects,<br>(b) Subject Petition/Tutorial - Request for subject not offered in the current semester</p>
        </div>

        <br>

        <div class="container d-flex align-items-center justify-content-center">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/PhON4myQo_4" allowfullscreen></iframe>
            </div>
        </div>

        <div class="container d-flex align-items-center justify-content-center">
            <a href="https://apps.pup.edu.ph/sisstudent/Login" target="_blank" class="btn btn-primary">Open SIS Tools Website</a>
        </div>

        <div class="container d-flex align-items-center justify-content-center">
            <input value="Done" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">
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
                        <h5><center>Are you sure you want to go back to the list of services?</center></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a href="../academic.php" class="btn btn-primary">Yes</a>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="../../saved_settings.js"></script>
</body>
</html>