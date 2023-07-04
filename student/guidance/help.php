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
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
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
            // header("Location: http://localhost/student/guidance/success.php");
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
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    What does the Guidance Office do?
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                    <div class="accordion-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vehicula tortor dignissim, rutrum justo sed, placerat arcu. Nullam sed sapien id nibh feugiat lacinia. Nunc in faucibus purus. Maecenas ante nunc, sagittis vitae lorem non, finibus aliquam neque. Donec tristique posuere suscipit. In ut tortor sollicitudin urna ultrices feugiat et nec metus. Mauris ultricies massa non libero tempus, in consectetur ex commodo. Etiam velit mi, vulputate quis aliquet quis, condimentum a ante. Vivamus malesuada orci ac arcu gravida pretium. Nunc a condimentum purus, et efficitur massa. Duis pellentesque dui eget risus molestie, at tempor lacus tincidunt. Donec lacinia, purus eu sollicitudin rutrum, nisl sem ullamcorper felis, eget tempus enim ipsum aliquet urna.</p>
                        <p>Quisque ut dapibus arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas viverra mauris lectus, vel faucibus orci sagittis nec. Nunc luctus est vel magna commodo, a blandit mi pharetra. Praesent urna lacus, tempus quis pretium et, suscipit sit amet justo. Praesent porta, sapien sit amet aliquam tempor, turpis eros aliquet nunc, nec vulputate diam quam pellentesque felis. Ut lacus augue, faucibus nec tempor id, viverra eget nulla. Quisque ac nisi nec sapien ultricies sollicitudin a ac nisl. Aenean et volutpat ante. Sed at congue odio. Proin at tincidunt mi. Fusce pretium, felis sed ultrices pretium, sem sem viverra leo, nec bibendum arcu neque at nisl. Ut pretium nulla eget arcu iaculis cursus. Nunc ornare sollicitudin eros, sed placerat lacus pretium eu. Nunc blandit, arcu eu luctus ornare, ante sem venenatis dui, ultrices eleifend dolor velit eget libero. Donec elementum eros tempor ante condimentum, sed varius tortor dictum.</p>
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vehicula tortor dignissim, rutrum justo sed, placerat arcu. Nullam sed sapien id nibh feugiat lacinia. Nunc in faucibus purus. Maecenas ante nunc, sagittis vitae lorem non, finibus aliquam neque. Donec tristique posuere suscipit. In ut tortor sollicitudin urna ultrices feugiat et nec metus. Mauris ultricies massa non libero tempus, in consectetur ex commodo. Etiam velit mi, vulputate quis aliquet quis, condimentum a ante. Vivamus malesuada orci ac arcu gravida pretium. Nunc a condimentum purus, et efficitur massa. Duis pellentesque dui eget risus molestie, at tempor lacus tincidunt. Donec lacinia, purus eu sollicitudin rutrum, nisl sem ullamcorper felis, eget tempus enim ipsum aliquet urna.</p>
                        <p>Quisque ut dapibus arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas viverra mauris lectus, vel faucibus orci sagittis nec. Nunc luctus est vel magna commodo, a blandit mi pharetra. Praesent urna lacus, tempus quis pretium et, suscipit sit amet justo. Praesent porta, sapien sit amet aliquam tempor, turpis eros aliquet nunc, nec vulputate diam quam pellentesque felis. Ut lacus augue, faucibus nec tempor id, viverra eget nulla. Quisque ac nisi nec sapien ultricies sollicitudin a ac nisl. Aenean et volutpat ante. Sed at congue odio. Proin at tincidunt mi. Fusce pretium, felis sed ultrices pretium, sem sem viverra leo, nec bibendum arcu neque at nisl. Ut pretium nulla eget arcu iaculis cursus. Nunc ornare sollicitudin eros, sed placerat lacus pretium eu. Nunc blandit, arcu eu luctus ornare, ante sem venenatis dui, ultrices eleifend dolor velit eget libero. Donec elementum eros tempor ante condimentum, sed varius tortor dictum.</p>
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vehicula tortor dignissim, rutrum justo sed, placerat arcu. Nullam sed sapien id nibh feugiat lacinia. Nunc in faucibus purus. Maecenas ante nunc, sagittis vitae lorem non, finibus aliquam neque. Donec tristique posuere suscipit. In ut tortor sollicitudin urna ultrices feugiat et nec metus. Mauris ultricies massa non libero tempus, in consectetur ex commodo. Etiam velit mi, vulputate quis aliquet quis, condimentum a ante. Vivamus malesuada orci ac arcu gravida pretium. Nunc a condimentum purus, et efficitur massa. Duis pellentesque dui eget risus molestie, at tempor lacus tincidunt. Donec lacinia, purus eu sollicitudin rutrum, nisl sem ullamcorper felis, eget tempus enim ipsum aliquet urna.</p>
                        <p>Quisque ut dapibus arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas viverra mauris lectus, vel faucibus orci sagittis nec. Nunc luctus est vel magna commodo, a blandit mi pharetra. Praesent urna lacus, tempus quis pretium et, suscipit sit amet justo. Praesent porta, sapien sit amet aliquam tempor, turpis eros aliquet nunc, nec vulputate diam quam pellentesque felis. Ut lacus augue, faucibus nec tempor id, viverra eget nulla. Quisque ac nisi nec sapien ultricies sollicitudin a ac nisl. Aenean et volutpat ante. Sed at congue odio. Proin at tincidunt mi. Fusce pretium, felis sed ultrices pretium, sem sem viverra leo, nec bibendum arcu neque at nisl. Ut pretium nulla eget arcu iaculis cursus. Nunc ornare sollicitudin eros, sed placerat lacus pretium eu. Nunc blandit, arcu eu luctus ornare, ante sem venenatis dui, ultrices eleifend dolor velit eget libero. Donec elementum eros tempor ante condimentum, sed varius tortor dictum.</p>
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
                    <textarea class="form-control" pattern="[A-Za-z0-9]+" name="guidanceFeedbackText" id="message" rows="5" minlength="5" maxlength="2048" style="resize: none;" required></textarea>
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
            if (document.getElementById('guidanceFeedbackForm').checkValidity()) {
                $('#confirmSubmitModal').modal('show');
            }
        }
        
        // Add event listener to the submit button
        document.getElementById('submitBtn').addEventListener('click', handleSubmit);
    </script>
    <script src="../../dark_mode.js"></script>
    <?php
    if (isset($_SESSION['success'])) {
        ?>
        <script>
            // window.location.href="http://localhost/student/guidance/clearance.php";
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