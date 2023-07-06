<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <!-- Loading page -->
    <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
    <div id="loader" class="center">
        <div class="loading-spinner"></div>
        <p class="loading-text display-3 pt-3">Getting things ready...</p>
    </div>
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php
        $office_name = "Select an Office";
        include "../conn.php";
        include "navbar.php";
        include "../breadcrumb.php";

        $query = "SELECT student_no, last_name, first_name, middle_name, extension_name, contact_no, email, birth_date FROM users WHERE user_id = ?";
        $userDetailsQuery = "SELECT sex, home_address, province, city, barangay, zip_code FROM user_details WHERE user_id = ?";

        // Fetch user table
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        // Fetch user details table
        $stmt = $connection->prepare($userDetailsQuery);
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $userDetailsData = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $connection->close();
        ?>
        <div class="container-fluid p-4">
            <?php
            $breadcrumbItems = [
                ['text' => 'Account Settings', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, true);
            ?>
        </div>
        <div class="container-fluid text-center p-4">
            <h1>My Account</h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card pt-5 px-5 py-3 mb-3 shadow-lg">
                        <div class="container">
                            <div class="row d-flex flex-row justify-content-between">
                                <button id="editButton" data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-primary position-absolute end-0 mx-5 w-auto"><i class="fa-solid fa-pen-to-square"></i></button>
                                <h4 class="pb-3 text-md-start text-center">Account Details</h4>
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center justify-content-center user-avatar-container pb-4">
                                        <img src="../assets/avatar.png" alt="User Avatar" class="img-fluid rounded-4 user-avatar">
                                    </div>
                                </div>
                                <div class="col-md-9 px-3">
                                    <div class="m-0">
                                        <p class="fs-5 m-0"><strong>Name</strong></p>
                                        <p class="mx-2"><?php echo $userData[0]['last_name'] . ', ' . $userData[0]['first_name'] . ' ' . $userData[0]['middle_name'] . ' ' . $userData[0]['extension_name']; ?></p>
                                    </div>
                                    <div class="m-0">
                                        <p class="fs-5 m-0"><strong>Course</strong></p>
                                        <p class="mx-2">Bachelor of Science in Information Technology</p>
                                    </div>
                                    <div class="m-0">
                                        <p class="fs-5 m-0"><strong>Level & Section</strong></p>
                                        <p class="mx-2">3-1</p>
                                    </div>
                                    <div class="m-0" id="birthDateDetails">
                                        <p class="fs-5 m-0"><strong>Birth Date</strong></p>
                                        <p class="mx-2">
                                            <?php
                                            $birthDate = $userData[0]['birth_date'];
                                            $formattedDate = date('F j, Y', strtotime($birthDate));
                                            echo $formattedDate;
                                            ?>
                                        </p>
                                    </div>
                                    <div class="m-0" id="contactDetails">
                                        <p class="fs-5 m-0"><strong>Contact Number</strong></p>
                                        <p class="mx-2"><?php echo $userData[0]['contact_no']; ?></p>
                                    </div>
                                    <div class="m-0" id="emailDetails">
                                        <p class="fs-5 m-0"><strong>Email Address</strong></p>
                                        <p class="mx-2"><?php echo $userData[0]['email']; ?></p>
                                    </div>
                                    <div class="m-0" id="sexDetails">
                                        <p class="fs-5 m-0"><strong>Sex</strong></p>
                                        <p class="mx-2"><?php echo $userDetailsData[0]['sex'] ? "Male" : "Female"; ?></p>
                                    </div>
                                    <div class="m-0" id="addressDetails">
                                        <p class="fs-5 m-0"><strong>Address</strong></p>
                                        <p class="mx-2 m-0"><?php echo $userDetailsData[0]['home_address']; ?></p>
                                        <p class="mx-2 m-0"><?php echo $userDetailsData[0]['barangay'] . ', ' . $userDetailsData[0]['city']; ?></p>
                                        <p class="mx-2"><?php echo $userDetailsData[0]['province'] . ', ' . $userDetailsData[0]['zip_code']; ?></p>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="#" id="showMoreLink">Show More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4 px-5 py-5 shadow-lg">
                        <h4 class="pb-3 text-md-start text-center">Settings</h4>
                        <div class="m-0 py-3">
                            <p class="fs-6 m-0 my-1"><strong>Enable Dark Mode</strong></p>
                            <input id="darkModeSwitch" type="checkbox" data-toggle="switchbutton" data-width="75">
                            <div id="switchValue" class="pt-3"></div>
                        </div>
                        <hr />
                        <div class="m-0">
                            <h5 class="mb-4">Dangerous Settings</h5>
                            <div class="d-flex align-items-center gap-4">
                                <a href="#" class="btn btn-primary">Delete Account</a>
                                <a href="#" class="btn btn-primary">Delete All Transactions</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Account Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for editing details -->
                        <form id="editForm">
                            <div class="mb-3 form-group">
                                <label for="editLastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="editLastName" name="editLastName" value="<?php echo $userData[0]['last_name']; ?>" required>
                                <div class="invalid-feedback">Please enter your last name.</div>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="editFirstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="editFirstName" name="editFirstName" value="<?php echo $userData[0]['first_name']; ?>" required>
                                <div class="invalid-feedback">Please enter your first name.</div>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="editMiddleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="editMiddleName" name="editMiddleName" value="<?php echo $userData[0]['middle_name']; ?>">
                            </div>
                            <div class="mb-3 form-group">
                                <label for="editExtensionName" class="form-label">Extension Name</label>
                                <input type="text" name="editExtensionName" value="<?php echo $userData[0]['extension_name']; ?>" id="editExtensionName" pattern="[a-zA-Z0-9Ññ\_\-\'\ \.]*" maxlength="11" size="11" autocomplete="on" class="form-control">
                            </div>
                            <div class="mb-3 form-group">
                                <label for="editContactNumber" class="form-label">Contact Number</label>
                                <input type="text" name="editContactNumber" value="<?php echo $userData[0]['contact_no']; ?>" id="editContactNumber" placeholder="Eg. 0901-234-5678" pattern="^090\d{1}-\d{3}-\d{4}$" maxlength="13" size="20" autocomplete="on" class="form-control" required>
                                <div class="invalid-feedback">Please enter a valid contact number.</div>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="editEmail" class="form-label">Email Address</label>
                                <input type="text" name="editEmail" value="<?php echo $userData[0]['email']; ?>" id="editEmail" placeholder="Complete Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" minlength="11" maxlength="50" size="50" autocomplete="on" class="form-control" required>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                            <!-- Add more fields for other details to edit -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button id="saveChangesButton" type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="push"></div>
    </div>
    <?php include '../footer.php'; ?>
    <script src="../loading.js"></script>
    <script>
        $(document).ready(function() {
            document.getElementById('darkModeSwitch').switchButton();

            // Hide additional details initially
            $('#birthDateDetails').hide();
            $('#contactDetails').hide();
            $('#emailDetails').hide();
            $('#sexDetails').hide();
            $('#addressDetails').hide();

            // Toggle visibility of additional details
            $('#showMoreLink').click(function(e) {
                e.preventDefault();
                $('#birthDateDetails').slideToggle();
                $('#contactDetails').slideToggle();
                $('#emailDetails').slideToggle();
                $('#sexDetails').slideToggle();
                $('#addressDetails').slideToggle();
            });

            function validateContactNumber(contactNumber) {
                var pattern = /^0\d{3}-\d{3}-\d{4}$/;
                return pattern.test(contactNumber);
            }

            function formatContactNumber(input) {
                // Remove dashes and non-numeric characters
                var number = input.replace(/[^0-9]/g, '');

                // Format the number with dashes
                var formattedNumber = '';
                for (let i = 0; i < number.length; i++) {
                    if (i === 4 || i === 7) {
                        formattedNumber += '-';
                    }
                    formattedNumber += number[i];
                }

                return formattedNumber;
            }

            function validateEmail(email) {
                var pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                return pattern.test(email);
            }

            // Add event listeners for input validation
            $('#editFirstName').on('input', function() {
                var input = $(this).val();
                var isValid = input.trim() !== '';
                $(this).toggleClass('is-invalid', !isValid);
            });

            $('#editLastName').on('input', function() {
                var input = $(this).val();
                var isValid = input.trim() !== '';
                $(this).toggleClass('is-invalid', !isValid);
            });

            $('#editContactNumber').on('input', function() {
                var input = $(this).val();

                var formattedInput = formatContactNumber(input);

                $(this).val(formattedInput);

                var isValid = validateContactNumber(formattedInput);
                $(this).toggleClass('is-invalid', !isValid);
            });

            $('#editEmail').on('input', function() {
                var email = $(this).val();
                var isValid = validateEmail(email);
                $(this).toggleClass('is-invalid', !isValid);
            });

            // Click event for the "Save Changes" button in the modal
            $('#saveChangesButton').click(function() {
                var formData = $('#editForm').serialize();

                // Validate the form inputs before submitting
                var isValidFirstName = $('#editFirstName').val();
                var isValidLastName = $('#editLastName').val();

                var contactNumber = $('#editContactNumber').val();
                var isValidContactNumber = validateContactNumber(contactNumber);
                $('#editContactNumber').toggleClass('is-invalid', !isValidContactNumber);

                var email = $('#editEmail').val();
                var isValidEmail = validateEmail(email);
                $('#editEmail').toggleClass('is-invalid', !isValidEmail);

                if (!isValidContactNumber || !isValidEmail || isValidFirstName.trim() == '' || isValidLastName.trim() == '') {
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: 'update_details.php',
                    data: formData,
                    success: function(response) {
                        console.log('Details updated successfully');
                    },
                    error: function(error) {
                        console.error('Error updating details:', error);
                    }
                });

                location.reload(0);
            });
        });
  </script>
  <script src="../dark_mode.js"></script>
</body>
</html>