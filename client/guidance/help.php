<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guidance Office - Help</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../style.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
    $office_name = "Guidance Office";
    include "../navbar.php";
    include "../../breadcrumb.php";
    include "../../conn.php";

    $query = "SELECT last_name, first_name, extension_name, email FROM users
            WHERE user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    if(isset($_POST['guidanceFeedbackSubmit'])) {
        $query = "INSERT INTO guidance_feedbacks (user_id, email, feedback_text)
        VALUES (?, ?, ?)";

        $stmt = $connection->prepare($query);
        $stmt->bind_param("iss", $_SESSION['user_id'], $userData[0]['email'], $_POST['guidanceFeedbackText']);
        if ($stmt->execute()) {
            $_SESSION['success'] = true;
            // header("Location: /student/guidance/success.php");
        }
        else {
            var_dump($stmt->error);
        }
        $stmt->close();
        $connection->close();
    }
    ?>
    <div class="wrapper">
        <div class="container-fluid p-4">
            <?php
            $breadcrumbItems = [
                ['text' => 'Guidance Office', 'url' => '/student/guidance.php', 'active' => false],
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
        <div class="accordion p-4" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingZero">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
                    What does the Guidance Office do?
                </button>
                </h2>
                <div id="collapseZero" class="accordion-collapse collapse" aria-labelledby="headingZero">
                    <div class="accordion-body">
                        <p>The Guidance Office is a faculty within PUP-SRC's Student Services that is responsible in maintaining the social, ethical, and moral integrity within the campus by offering services for the students and alumnus that performs and maintains those objectives.</p>
                        <p>To learn more about the office, you may inquire or schedule a counseling within the office through this application.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    What services do the office offer?
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                    <div class="accordion-body">
                        <p>The Guidance Office provides the following services available in PUPSRC-OTMS for guests:</p>
                        <dl class="row">
                            <dt class="col-sm-6 text-truncate">Request for Good Moral Document</dt>
                            <dd class="col-sm-6">Request for the Good Moral Document without the need of queueing in long lines outside the office by getting the status of your request within PUPSRC-OTMS.</dd>
                            <dt class="col-sm-6 text-truncate">Request for Clearance</dt>
                            <dd class="col-sm-6">Request for the Academic Clearance Document without the need of queueing in long lines outside the office by getting the status of your request within PUPSRC-OTMS.</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Where can I find the office?
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                    <div class="accordion-body">
                        <p>You can find the office on the second floor by looking for the <b>Student Services</b> room (Room 210).</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    What should I do after creating a document request?
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
                    <div class="accordion-body">
                        <p>After creating a request, you must prepare the requirements and proceed to the Student Services office to submit them.</p>
                        <p>Always check the status on the <a href="../transactions.php"><b>My Transactions</b></a> page and see if your request has been approved or not.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    How do I inquire with the office?
                </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive">
                    <div class="accordion-body">
                        You may submit a feedback by filling out the form below or by visiting the office.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    What are the requirements for the document requests?
                </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix">
                    <div class="accordion-body">
                        <p>Here are the requirements for the two document requests provided by the office:</p>
                        <ul>
                            <li>Signed request letter (will be generated by the application for you to print as .PDF after submitting your request)</li>
                            <li>Official receipt (pay at the cashier)</li>
                            <li>1 pc. documentary stamp (for certification only)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-5">
            <div class="container-fluid text-center p-4">
                <h3>Submit Feedback</h3>
            </div>
            <form id="guidanceFeedbackForm" method="POST">
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
                    <textarea class="form-control" name="guidanceFeedbackText" id="message" rows="5" maxlength="2048" style="resize: none;" required></textarea>
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
                            <button type="submit" id="submit" class="btn btn-primary" name="guidanceFeedbackSubmit">Yes</button>
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
    <div class="footer container-fluid w-100 text-md-left text-center d-md-flex align-items-center justify-content-center bg-light flex-nowrap">
        <div>
            <small>PUP Santa Rosa - Online Transaction Management System Beta 0.1.0</small>
        </div>
        <div>
            <small><a href="https://www.pup.edu.ph/terms/" target="_blank" class="btn btn-link">Terms of Use</a>|</small>
            <small><a href="https://www.pup.edu.ph/privacy/" target="_blank" class="btn btn-link">Privacy Statement</a></small>
        </div>
    </div>
    <script src="../../jquery.js"></script>
    <script>
        const messageTextarea = document.getElementById('message');

        messageTextarea.addEventListener('input', function() {
            const inputValue = messageTextarea.value;

            if (inputValue.trim() != '') {
                messageTextarea.setCustomValidity('');
                messageTextarea.classList.remove('is-invalid');
            } else {
                messageTextarea.classList.add('is-invalid');
            }
        });

        // Function to handle form submission
        function handleSubmit() {
            if (messageTextarea.value.trim() != '') {
                $('#confirmSubmitModal').modal('show');
            }
        }
        
        // Add event listener to the submit button
        document.getElementById('submitBtn').addEventListener('click', handleSubmit);
    </script>
    <script src="../../saved_settings.js"></script>
    <?php
    if (isset($_SESSION['success'])) {
        ?>
        <script>
            // window.location.href="/student/guidance/clearance.php";
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