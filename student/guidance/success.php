<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUPSRC-OTMS - Transaction Success</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php
            $office_name = "Guidance Office";
            include "../navbar.php";
            include "../../breadcrumb.php";
            
            if(!isset($_SESSION['success'])) {
                ?>
                <script type="text/javascript">
                    window.location.href="/student/guidance.php";
                </script>
                <?php
                exit;
            }
            unset($_SESSION['success']);
        ?>
        <div class="container-fluid vh-100 d-flex flex-column justify-content-center align-items-center">
            <h1 class="text-center">Transaction Success!</h1>
            <p class="text-center">You may now check your transaction status by going to the Transactions page.</p>
            <button class="btn btn-primary px-4" onclick="window.history.go(-1); return false;">
                <i class="fa-solid fa-arrow-left"></i> Generate another transaction
            </button>
            <a href="../transactions.php" class="btn btn-primary">My Transactions</a>
        </div>
        <!-- Success alert modal -->
        <div id="successModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Your request has been submitted successfully!</p>
                        <p>You can check the status of your request on the <b>My Transactions</b> page.</p>
                        <p>You must print this approval letter and submit it to the Director's Office before scheduling your request.</p>
                        <a href="./generate_pdf.php" target="_blank" class="btn btn-primary">Show Letter</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of success alert modal -->
        <div class="push"></div>
    </div>
    <?php include '../../footer.php'; ?>
    <script src="../../jquery.js"></script>
    <script src="../../saved_settings.js"></script>
</body>
</html>