<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Office - Help</title>
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
    $office_name = "Academic Office";
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

    if(isset($_POST['academicFeedbackSubmit'])) {
        $query = "INSERT INTO acad_feedbacks (user_id, email, feedback_text)
        VALUES (?, ?, ?)";

        $stmt = $connection->prepare($query);
        $stmt->bind_param("iss", $_SESSION['user_id'], $userData[0] ['email'], $_POST['academicFeedbackText']);
        if ($stmt->execute()) {
            $_SESSION['success'] = true;
            // header("Location: /student/academic/success.php");
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
                ['text' => 'Academic Office', 'url' => '/student/academic.php', 'active' => false],
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
                What is Subject Overload?
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                    <div class="accordion-body">
                        <p>Application for subject overload allows students who intend to add additional subject/s more than the prescribed number of units specified in the curriculum for the current semester prior to the opening of classes or within the adjustment period specified in the University calendar and approved by the Director/ Head of Academic Program.
                           </p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Who can request for Subject Overload?
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                    <div class="accordion-body">
                        <p>Requests for subject overload may be allowed for graduating students during the last school term. For undergraduate students, overload may be allowed under the following considerations:
                           </p>
                        <p>Academically outstanding student as certified by the Director/ Head of Academic Program.<br>
                           Transferee/Shiftee who is in good standing (no failing grade in the previous semester.<br>
                            </p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                What are the requirements for Application for Subject Overload?
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
                    <div class="accordion-body">
                      <p>Request Letter for Subject Overload (Letter that contains justification of the need for overload)<br>
                         Fully Accomplished ACE Form (Adding of Subject)<br>
                         Certificate of Registration for the current semester<br>
                          </p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                What is Application for Change of Enrollment?
                </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour">
                    <div class="accordion-body">
                     <p>Application for Change of Enrollment is specifically for adding of subjects or changing of subject/schedule.
                        This is both for regular and irregular students of the University and is done during the adjustment period.
                          </p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                Where can I get a copy of ACE Form?
                </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive">
                    <div class="accordion-body">
                     <p>To get a copy of ACE form, you can visit the link provided:</p>
                     <p>Application for Change of Enrollment Form (ACE Form 2018, Adding of Subject) -<a href=" https://drive.google.com/file/d/1EiysBrZ9jj1Rfp7XkL6NyYP3mA2U5tHv/view">ACE FORM</a>
                       </p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                How to get the Certificate of Registration?
                </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix">
                    <div class="accordion-body">
                     <p>Students can get a copy of their registration by downloading it in their PUP-SIS account under the enrollment page.
                         The Certificate of Registration is downloadable only for a limited period. Once it is not available to download, students may go to the Registrar office and request for the copy of their Certificate of Registration. 
                          </p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                What is Shifting?
                </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven">
                    <div class="accordion-body">
                     <p>Application for Shifting allows students who intend to shift to another program in the University.
                         Students must have 1 year residency from the current program to qualify for shifting to another program. Application for shifting shall be accomplished prior to the start of the next academic school year. Qualification varies depending on the program where the student intends to shift.
                          </p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                What are the requirements for Application for Shifting?
                </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight">
                    <div class="accordion-body">
                    <p>Request Letter for Shifting (Letter that contains justification of the need to shift)<br>
                       Certified Copy of Grades<br>
                    </p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                Who can request for Shifting?
                </button>
                </h2>
                <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine">
                    <div class="accordion-body">
                    <p>Students with 1 year residency from the current program are qualified for shifting to another program.
                    </p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                How to get a Certified Copy of Grades?
                </button>
                </h2>
                <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen">
                    <div class="accordion-body">
                    <p>Student must prepare the following requirements and submit to Registrar’s Office:</p>
                    <p>Signed request letter (sample template available at the Registrar’s Office)<br>
                       Official Receipt (Payment of Php 150 for the COR)<br>
                       1 pc. documentary stamp (available at the campus)<br>
                       </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-5">
            <div class="container-fluid text-center p-4">
                <h3>Submit Feedback</h3>
            </div>
            <form id="academicFeedbackForm" method="POST">
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
                    <textarea class="form-control" pattern="[A-Za-z0-9]+" name="academicFeedbackText" id="message" rows="5" minlength="5" maxlength="2048" style="resize: none;" required></textarea>
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
                            <button type="submit" id="submit" class="btn btn-primary" name="academicFeedbackSubmit">Yes</button>
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

            if (inputValue.trim() != '') {
                messageTextarea.setCustomValidity('');
                messageTextarea.classList.remove('is-invalid');
            } else {
                messageTextarea.classList.add('is-invalid');
            }
        });

        // Function to handle form submission
        function handleSubmit() {
            validateForm();
            if (document.getElementById('academicFeedbackForm').checkValidity()) {
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