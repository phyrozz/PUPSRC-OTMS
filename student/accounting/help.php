<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounting Office - Help</title>
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
    $office_name = "Accounting Office";
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

    if(isset($_POST['accountingFeedbackSubmit'])) {
        $query = "INSERT INTO accounting_feedbacks (user_id, email, feedback_text)
        VALUES (?, ?, ?)";

        $stmt = $connection->prepare($query);
        $stmt->bind_param("iss", $_SESSION['user_id'], $userData[0]['email'], $_POST['accountingFeedbackText']);
        if ($stmt->execute()) {
            $_SESSION['success'] = true;
            // header("Location: /student/accounting/success.php");
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
                ['text' => 'Accounting Office', 'url' => '/student/accounting.php', 'active' => false],
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
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    What does the Accounting Office do?
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                    <div class="accordion-body">
                        <p>The Accounting Office facilitates document requests and manages offset payments for school-related purposes. By securely handling financial transactions, our Accounting Office ensures efficient and accurate execution of these transactions.</p>
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
                        <p>The Accounting Office is situated in Room 210 of the PUP Santa Rosa Campus Building.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    How do I inquire with the office?
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
                    <div class="accordion-body">
                        <p>For any additional concerns or inquiries, we kindly request that you visit our office directly and ask for Mrs. Veloz. Upon arrival, we kindly ask you to join the queue and await your turn to process payment transactions and manage your balances. Our office hours are from 8 A.M. to 5 P.M., with the exception of the lunch hours.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                What is Offsetting?
                </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour">
                    <div class="accordion-body">
                        <p>Processing of offsetting of Overpayment of Tuition Fees/Miscellaneous Fees.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                What is an overpayment of tuition fees or miscellaneous fees?
                </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive">
                    <div class="accordion-body">
                        <p>An overpayment occurs when a student pays more than the required amount for their tuition fees or miscellaneous fees.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                How does an overpayment occur?
                </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix">
                    <div class="accordion-body">
                        <p>Overpayments can happen due to various reasons, such as errors in payment calculations, duplicate payments, or changes in enrollment status.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                Who may avail this service?
                </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven">
                    <div class="accordion-body">
                        <p>All students who are currently enrolled.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                What types of offsetting transactions can be offset using the system?
                </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight">
                    <div class="accordion-body">
                        <p>The system is designed to facilitate offsetting transactions related to miscellaneous and tuition fees.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                What should students do if ever they encounter any issues or discrepancies with the offsetting transaction while using the system?
                </button>
                </h2>
                <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine">
                    <div class="accordion-body">
                        <p>Contact the university’s available support channel or report the issue directly to the appropriate office which is the accounting office.</p>
                    </div>
                </div>
            </div>
            <!--faq-->
        </div>
        <div class="container py-5">
            <div class="container-fluid text-center p-4">
                <h3>Submit Feedback</h3>
            </div>
            <form id="accountingFeedbackForm" method="POST">
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
                    <textarea class="form-control" pattern="[A-Za-z0-9]+" name="accountingFeedbackText" id="message" rows="5" minlength="5" maxlength="2048" style="resize: none;" required></textarea>
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
                            <button type="submit" id="submit" class="btn btn-primary" name="accountingFeedbackSubmit">Yes</button>
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
    <script src="../../jquery.js"></script>
    <script>
        const messageTextarea = document.getElementById('message');

        messageTextarea.addEventListener('input', function() {
            const inputValue = messageTextarea.value;

            const pattern = /^[a-zA-Z0-9]{1,}\s[a-zA-Z0-9\s]*$/;
            const isValid = pattern.test(inputValue);

            if (isValid) {
                messageTextarea.setCustomValidity('');
                messageTextarea.classList.remove('is-invalid');
            } else {
                messageTextarea.setCustomValidity('Only letters and numbers are allowed.');
                messageTextarea.classList.add('is-invalid');
            }
        });

        // Function to handle form submission
        function handleSubmit() {
            validateForm();
            if (document.getElementById('accountingFeedbackForm').checkValidity()) {
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
            // window.location.href="/student/accounting/clearance.php";
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