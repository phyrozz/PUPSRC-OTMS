<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrative - Help</title>
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
    $office_name = "Administrative Office";
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

    if(isset($_POST['administrativeFeedbackSubmit'])) {
        $query = "INSERT INTO administrative_feedbacks (user_id, email, feedback_text)
        VALUES (?, ?, ?)";

        $stmt = $connection->prepare($query);
        $stmt->bind_param("iss", $_SESSION['user_id'], $userData[0]['email'], $_POST['administrativeFeedbackText']);
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
                ['text' => 'Administrative Office', 'url' => '/student/administrative.php', 'active' => false],
                ['text' => 'Help', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, true);
            ?>
        </div>
        <div class="container-fluid text-center p-4">
            <h3>Frequently Asked Questions</h3>
        </div>
        <div class="accordion p-4" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    What does the Administrative Office do?
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                    <div class="accordion-body">
                        <p>The Administrative Office provides students with the ability to request appointments for specific school facilities or borrow equipment for various purposes such as school events, cleaning, and more. 
                        Whether you need to schedule a facility for a meeting or borrow equipment for a specific task, the Administrative Office is here to assist you in making these arrangements. Simply use our online system to request the appointment or equipment you need.</p>
                    </div>
                </div>
            </div>

            <br><br><br>

            <div class="container-fluid text-center p-4">
                <h3>Request of Equipment</h3>
            </div>

            <br>

            <div class="accordion-item">
                
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    How can I request school equipment?
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                    <div class="accordion-body">
                        <p>To request school equipment, please select an available equipment on our website. Fill out the request form and provide all the necessary details, such as your email address, date and time of your request and the purpose of your request.</p>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Is there a limit to the number of equipment items I can request?
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
                    <div class="accordion-body">
                        <p>There is a limit on the number of equipment items you can request due to the limited quantity of available equipment. This is in place to ensure fair distribution and availability for all users.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    How do I check the availability of school equipment before making a request?
                </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour">
                    <div class="accordion-body">
                        <p>To check the availability of school equipment, our system shows if an equipment is available or not.</p>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Can I request equipment for a specific date or time period?
                </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive">
                    <div class="accordion-body">
                        <p>Yes, you can request equipment for a specific date or time period. In your equipment request, provide the desired dates and times for equipment usage. Equipments are subject to availability </p>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    Are there any costs associated with equipment requests?
                </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix">
                    <div class="accordion-body">
                        <p>There are no costs associated with equipment requests. Equipment requests are free of charge.</p>
                    </div>
                </div>
            </div>

            
            <br><br><br>

            <div class="container-fluid text-center p-4">
                <h3>Facility Appointment</h3>
            </div>

            <br>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    How can I request a school facility appointment?
                </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven">
                    <div class="accordion-body">
                        <p>To request a school facility appointment, please visit our website and select the desired facility. Fill out the appointment request form, providing your email address, course and section, start and end date of your appointment and its purpose.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    Is there a limit to the number of school facilities I can request for an appointment?
                </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight">
                    <div class="accordion-body">
                        <p>Facilities are limited to 1 request at a time only.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                    How do I check the availability of school facilities before making an appointment request?
                </button>
                </h2>
                <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen">
                    <div class="accordion-body">
                        <p>Our system allows you to check the availability of school facilities before making an appointment request. You can view the availability of facilities directly on our system.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEleven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                    Can I request a school facility appointment for a specific date or time period?
                </button>
                </h2>
                <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven">
                    <div class="accordion-body">
                        <p>Yes, you can request a school facility appointment for a specific date or time period. Simply provide the desired dates and times for your appointment when filling out the appointment form. Facilities are subject to availability.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwelve">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                    Are there any costs associated with school facility appointments?
                </button>
                </h2>
                <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve">
                    <div class="accordion-body">
                        <p>There are no costs associated with school facility appointments. Requesting a school facility appointment is free of charge.</p>
                    </div>
                </div>
            </div>
            

        </div>



        <div class="container py-5">
    <div class="container-fluid text-center p-4">
        <h3>Submit Feedback</h3>
    </div>
    <form id="administrativeFeedbackForm" method="POST">
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
            <textarea class="form-control" name="administrativeFeedbackText" id="message" rows="5" minlength="5" maxlength="2048" required></textarea>
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
                    <button type="submit" id="submit" class="btn btn-primary" name="administrativeFeedbackSubmit">Yes</button>
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

<script>
    // const messageTextarea = document.getElementById('message');

    // messageTextarea.addEventListener('input', function() {
    //     const inputValue = messageTextarea.value;

    //     const pattern = /^[a-zA-Z0-9'!@#$%^&*()\s.,]+$/;
    //     const isValid = pattern.test(inputValue);

    //     if (isValid) {
    //         messageTextarea.setCustomValidity('');
    //         messageTextarea.classList.remove('is-invalid');
    //     } else {
    //         messageTextarea.setCustomValidity('Please provide a valid feedbacks.');
    //         messageTextarea.classList.add('is-invalid');
    //     }
    // });

    // Function to handle form submission
    function handleSubmit() {
        validateForm();
        if (document.getElementById('administrativeFeedbackForm').checkValidity()) {
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