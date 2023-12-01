<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Office - Help</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../../../assets/favicon.ico">
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../style.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php
            $office_name = "Registrar Office";
            include "../navbar.php";
            include "../../breadcrumb.php";
            include "../../conn.php";

            $query_faq = "SELECT * FROM reg_faq";

            $query = "SELECT last_name, first_name, extension_name, email FROM users
            WHERE user_id = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();

            if(isset($_POST['registrarFeedbackSubmit'])) {
                $query = "INSERT INTO registrar_feedbacks (user_id, feedback_text)
                VALUES (?, ?)";
        
                $stmt = $connection->prepare($query);
                $stmt->bind_param("is", $_SESSION['user_id'], $_POST['registrarFeedbackText']);
                if ($stmt->execute()) {
                    $_SESSION['success'] = true;
                    // 
                }
                else {
                    var_dump($stmt->error);
                }
                $stmt->close();
                unset($_POST);
                //$connection->close();
            }

        ?>
        <div class="container-fluid p-4">
            <?php
            $breadcrumbItems = [
                ['text' => 'Registrar Office', 'url' => '../registrar.php', 'active' => false],
                ['text' => 'Help', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, true);
            ?>
        </div>
        <div class="container-fluid text-center p-4">
            <h1>How may I help you?</h1>
        </div>
        <div class="container-fluid text-center p-4">
            <h3>Frequently Asked Questions</h3>
        </div>
        <div class="container-fluid">
            <div class="accordion p-4" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fa-solid fa-circle-info"> Reminder:</i>   For Claiming Documents
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                    <div class="accordion-body">
                    <p class="mb-0">- Kindly download the <a href="reg_request_letter.pdf" download>Request Letter file</a>, which is necessary for requesting the desired document.</p>
                    <p class="mb-0">- Authorization letter and ID if claimant is immediate family member.</p>
                    <p class="mb-0">- Special Power of Attorney (SPA) if the claimant is other than the immediate family.</p>
                    </div>
                </div>
            </div>
            <?php 
                $query_run = mysqli_query($connection, $query_faq);
                    if(mysqli_num_rows($query_run) > 0){
                    foreach($query_run as $row) {
            ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading<?=$row['faq_id'];?>">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$row['faq_id'];?>" aria-expanded="true" aria-controls="collapseOne">
                    <?=$row['document'];?>
                </button>
                </h2>
                <div id="collapse<?=$row['faq_id'];?>" class="accordion-collapse collapse" aria-labelledby="heading<?=$row['faq_id'];?>">
                    <div class="accordion-body">
                        <p>Requirements:</p>
                        <p><?=$row['requirements'];?></p>
                        <p>Payment:</p>
                        <p><?=$row['payment'];?></p>
                    </div>
                </div>
            </div>
            <?php
                } 
            }?>     
            </div>
        </div>
        <div class="container py-5">
            <div class="container-fluid text-center p-4">
                <h3>Submit Feedback</h3>
            </div>
            <form id="registrarFeedbackForm" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" value="<?php echo $userData[0]['first_name'] . " " . $userData[0]['last_name'] . " ". $userData[0]['extension_name'] ?>" class="form-control" id="name" required disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" value="<?php echo $userData[0]['email'] ?>" class="form-control" id="email" required disabled>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" pattern="[A-Za-z0-9]+" name="registrarFeedbackText" id="message" rows="5" minlength="5" maxlength="2048" style="resize: none;" required></textarea>
                    <div class="invalid-feedback">Invalid feedback.</div>
                </div>
                <input id="submitBtn" value="Submit" type="button" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal" />
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
                            <button type="submit" id="submit" class="btn btn-primary" name="registrarFeedbackSubmit">Yes</button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Success alert modal -->
        <div id="successModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                    </div>
                    <div class="modal-body">
                        <p>Thank you. Your feedback has been submitted successfully!</p>
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
    <script src="../../saved_settings.js"></script>
    <?php
    if (isset($_SESSION['success'])) {
        ?>
        <script>
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