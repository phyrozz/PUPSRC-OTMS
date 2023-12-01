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
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    <link rel="stylesheet" href="../node_modules/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    <div class="wrapper">
        <?php
        $office_name = "Select an Office";
        include "../conn.php";
        include "navbar.php";
        include "../breadcrumb.php";

        $query = "SELECT last_name, first_name, middle_name, extension_name, contact_no, email, birth_date FROM users WHERE user_id = ?";
        $userDetailsQuery = "SELECT sex, home_address, province, city, barangay, zip_code, avatar_url FROM user_details WHERE user_id = ?";

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
                                    <div class="d-flex align-items-center justify-content-center user-avatar-container mb-4" id="avatar-container">
                                        <div class="avatar-wrapper">
                                            <div class="avatar-overlay">
                                                <span class="overlay-text">Upload Profile Picture</span>
                                                <input type="file" id="profile-picture" name="profile_picture" class="d-none" accept="image/*">
                                            </div>
                                            <a href="#" target="_blank">
                                                <img src="<?php echo is_null($userDetailsData[0]['avatar_url']) ? "../assets/avatar.png" : "/" . $userDetailsData[0]['avatar_url']; ?>" alt="User Avatar" class="img-fluid rounded-4 user-avatar">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 px-3">
                                    <div class="m-0">
                                        <p class="fs-5 m-0"><strong>Name</strong></p>
                                        <p class="mx-2"><?php echo $userData[0]['last_name'] . ', ' . $userData[0]['first_name'] . ' ' . $userData[0]['middle_name'] . ' ' . $userData[0]['extension_name']; ?></p>
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
                        <div class="m-0 pt-3">
                            <p class="fs-6 m-0 my-1"><strong>Enable Dark Mode</strong></p>
                            <input id="darkModeSwitch" type="checkbox" data-toggle="switchbutton" data-width="75">
                            <div id="switchValue" class="pt-3"></div>
                        </div>
                        <div class="m-0 pb-3">
                            <p class="fs-6 m-0 my-1"><strong>Allow editing on contact number and email fields</strong></p>
                            <input id="disabledFieldsOrNot" type="checkbox" data-toggle="switchbutton" data-width="75">
                            <div id="disabledSwitchValue" class="pt-3"></div>
                        </div>
                        <div class="m-0 pb-3">
                            <button id="delete-transactions-btn" class="btn btn-outline-primary">Delete All Rejected Transactions</button>
                        </div>
                        <hr />
                        <div class="m-0">
                            <h5 class="mb-4">Dangerous Settings</h5>
                            <div class="d-flex align-items-center gap-4">
                                <button id="delete-account-btn" class="btn btn-primary">Delete Account</button>
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
                                <input type="text" class="form-control" id="editLastName" name="editLastName" value="<?php echo $userData[0]['last_name']; ?>" maxlength="100" size="100" autocomplete="on" class="form-control" required>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="editFirstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="editFirstName" name="editFirstName" value="<?php echo $userData[0]['first_name']; ?>" maxlength="100" size="100" autocomplete="on" class="form-control" required>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="editMiddleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="editMiddleName" name="editMiddleName" value="<?php echo $userData[0]['middle_name']; ?>" maxlength="100" size="100" autocomplete="on" class="form-control">
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
                                <label for="editBirthDate" class="form-label">Birth Date</label>
                                <input type="text" class="form-control" name="editBirthDate" id="editBirthDate" value="
                                <?php
                                $editBirthDate = $userData[0]['birth_date'];
                                $formattedDate = date('Y-m-d', strtotime($editBirthDate));
                                echo $formattedDate;
                                ?>
                                " style="cursor: pointer !important;" required data-input>
                                <div id="birthDateValidationMessage" class="text-danger"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button id="saveChangesButton" type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Transactions success Modal -->
        <div class="modal fade" id="deleteTransactionSuccessModal" tabindex="-1" aria-labelledby="deleteTransactionSuccessModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteTransactionSuccessModalLabel">Success</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Transactions deleted successfully.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Delete Transactions success Modal -->
        <!-- Delete Transactions failed Modal -->
        <div class="modal fade" id="deleteTransactionFailedModal" tabindex="-1" aria-labelledby="deleteTransactionFailedModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteTransactionFailedModalLabel">Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Unable to delete transactions. Please try again later.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Delete Transactions failed Modal -->
        <!-- Delete Account confirm Modal -->
        <div class="modal fade" id="deleteAccountConfirmModal" tabindex="-1" aria-labelledby="deleteAccountConfirmModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAccountConfirmModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure you want to delete your account?</h5>
                        <p>To help confirm that you actually want to delete your account, please enter your account's email address:</p>
                        <div class="mb-3">
                          <label for="emailConfirm" class="form-label">Confirm email:</label>
                          <input type="email"
                            class="form-control" name="emailConfirm" id="emailConfirm" aria-describedby="emailConfirmHelp" placeholder="">
                          <small id="emailConfirmHelp" class="form-text text-muted"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                        <button id="confirm-delete-acc-btn" type="button" class="btn disabled" disabled>Delete Account</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Delete Account confirm Modal -->
        <!-- Delete Account failed Modal -->
        <div class="modal fade" id="deleteAccountFailedModal" tabindex="-1" aria-labelledby="deleteAccountFailedModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAccountFailedModalLabel">Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Unable to delete your account. Please try again.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Delete Account failed Modal -->
        <div class="push"></div>
    </div>
    <?php include '../footer.php'; ?>
    <script src="../loading.js"></script>
    <script src="../saved_settings.js"></script>
    <script src="../node_modules/flatpickr/dist/flatpickr.min.js"></script>
    <script>
        $(document).ready(function() {
            document.getElementById('darkModeSwitch').switchButton();
            document.getElementById('disabledFieldsOrNot').switchButton();

            // Variables for the change profile picture feature
            const avatarContainer = document.getElementById("avatar-container");
            const profilePictureInput = document.getElementById("profile-picture");

            // Listen for changes in the file input
            profilePictureInput.addEventListener("change", function(event) {
                const selectedFile = event.target.files[0];

                if (selectedFile) {
                    const formData = new FormData();
                    formData.append("profile_picture", selectedFile);

                    $.ajax({
                        type: "POST",
                        url: "/upload_profile_picture.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log("Image uploaded successfully");
                            location.reload();
                        },
                        error: function(error) {
                            console.error("Error uploading image:", error);
                        }
                    });
                }
            });

            // Open the file dialog when the avatar container is clicked
            avatarContainer.addEventListener("click", function() {
                profilePictureInput.click();
            });

            // Hide additional details initially
            $('#birthDateDetails').hide();
            $('#contactDetails').hide();
            $('#sexDetails').hide();
            $('#addressDetails').hide();

            // Toggle visibility of additional details
            $('#showMoreLink').click(function(e) {
                e.preventDefault();
                $('#birthDateDetails').slideToggle();
                $('#contactDetails').slideToggle();
                $('#sexDetails').slideToggle();
                $('#addressDetails').slideToggle();

                // Toggle the text of the link
                var linkText = $(this).text();
                $(this).text(linkText === 'Show More' ? 'Show Less' : 'Show More');
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

            // Add event listeners for input validation
            $('#editFirstName').on('input', function() {
                var input = $(this).val();
                var isValid = input.trim() !== '' && /^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/.test(input);
                $(this).toggleClass('is-invalid', !isValid);
            });

            $('#editLastName').on('input', function() {
                var input = $(this).val();
                var isValid = input.trim() !== '' && /^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/.test(input);
                $(this).toggleClass('is-invalid', !isValid);
            });

            $('#editMiddleName').on('input', function() {
                var input = $(this).val();
                var isValid = input.trim() == '' || /^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/.test(input);
                $(this).toggleClass('is-invalid', !isValid);
            });

            $('#editExtensionName').on('input', function() {
                var input = $(this).val();
                var isValid = input.trim() == '' || /^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/.test(input);
                $(this).toggleClass('is-invalid', !isValid);
            });

            $('#editContactNumber').on('input', function() {
                var input = $(this).val();

                var formattedInput = formatContactNumber(input);

                $(this).val(formattedInput);

                var isValid = validateContactNumber(formattedInput);
                $(this).toggleClass('is-invalid', !isValid);
            });

            // Click event for the "Save Changes" button in the modal
            $('#saveChangesButton').click(function() {
                var formData = $('#editForm').serialize();

                // Validate the form inputs before submitting
                var isValidFirstName = $('#editFirstName').val();
                var isValidLastName = $('#editLastName').val();
                var isValidMiddleName = $('#editMiddleName').val();
                var isValidExtensionName = $('#editExtensionName').val();
                var contactNumber = $('#editContactNumber').val();
                var birthDate = $('#editBirthDate').val();

                var isValidContactNumber = validateContactNumber(contactNumber);
                $('#editContactNumber').toggleClass('is-invalid', !isValidContactNumber);

                if (!isValidContactNumber || !(isValidFirstName.trim() !== '' && /^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/.test(isValidFirstName)) || !(isValidLastName.trim() !== '' && /^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/.test(isValidLastName)) || !(isValidMiddleName.trim() == '' || /^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/.test(isValidMiddleName)) || !(isValidExtensionName.trim() == '' || /^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/.test(isValidExtensionName)) || birthDate.trim() == '') {
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

        $('#delete-transactions-btn').click(function() {
            $.ajax({
                type: 'POST',
                url: '../delete_transactions.php',
                success: function(response) {
                    console.log(response);
                    $('#deleteTransactionSuccessModal').modal('show');
                },
                error: function(error) {
                    console.log(error);
                    $('#deleteTransactionFailedModal').modal('show');
                }
            });
        });

        $('#delete-account-btn').click(function() {
            $('#deleteAccountConfirmModal').modal('show');
        });

        var userEmailAddress = "<?php echo $userData[0]['email']; ?>";

        $("#emailConfirm").on("input", function () {
            var enteredEmail = $(this).val();
            if (enteredEmail === userEmailAddress) {
                $("#confirm-delete-acc-btn").removeClass("disabled").removeAttr("disabled");
                $("#confirm-delete-acc-btn").addClass("btn-secondary");
            } else {
                $("#confirm-delete-acc-btn").addClass("disabled").attr("disabled", "disabled");
                $("#confirm-delete-acc-btn").removeClass("btn-secondary");
            }
        });

        $('#confirm-delete-acc-btn').click(function() {
            $.ajax({
                type: 'POST',
                url: '../delete_acc.php',
                success: function(response) {
                    console.log(response);
                    $.ajax({
                        type: 'POST',
                        url: '../sign_out.php',
                        success: function(logoutResponse) {
                            window.location.href = '../index.php';
                        },
                        error: function(logoutError) {
                            console.log(logoutError);
                        }
                    });
                },
                error: function(error) {
                    console.log(error);
                    $('#deleteAccountFailedModal').modal('show');
                }
            });
        });

        flatpickr("#editBirthDate", {
            readonly: false,
            allowInput: true,
            dateFormat: "Y-m-d",
            theme: "custom-datepicker",
            minDate: "1.1.1901",
            maxDate: "today",
            locale: {
                "firstDayOfWeek": 1 // start week on Monday
            },
        });
  </script>
</body>
</html>