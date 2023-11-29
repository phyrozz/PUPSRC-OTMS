<?php
include '../../conn.php';

$office_name = "Registrar Office";
include "../navbar.php";
include "../../breadcrumb.php";

$user_id = $_SESSION['user_id'];

//fetching student info//
$result = mysqli_query($connection, "SELECT users.user_id, users.last_name, users.first_name, users.middle_name, users.extension_name, users.contact_no, users.email, users.student_no 
FROM users
WHERE users.user_id= $user_id
ORDER BY users.user_id");

$row = mysqli_fetch_array($result);
//fetching registrar services
$requirements = mysqli_query($connection, "SELECT * FROM reg_services WHERE services_id > 22;");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Office - Create Request</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
  <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/style.css">
  <!-- Loading page -->
  <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
  <div id="loader" class="center">
    <div class="loading-spinner"></div>
    <p class="loading-text display-3 pt-3">Getting things ready...</p>
  </div>
  <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
  <script src="/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../../node_modules/flatpickr/dist/flatpickr.min.css">
  <script src="../../node_modules/flatpickr/dist/flatpickr.min.js"></script>
  <!-- <link rel="icon" type="image/x-icon" href="./assets/favicon.ico">
	<link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../style.css">
	<script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
	<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
	<script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
  <script defer>

  </script>
</head>

<body>
  <div class="wrapper">
    <div class="container-fluid p-4">
      <?php
			$breadcrumbItems = [
					['text' => 'Registrar Office', 'url' => '/client/registrar.php', 'active' => false],
					['text' => 'Create Request', 'active' => true],
			];

			echo generateBreadcrumb($breadcrumbItems, true);
		?>
    </div>
    <div class="container-fluid text-center mt-4 p-4">
      <h1>Create Request</h1>
    </div>
    <div class="container-fluid">
      <div class="row g-1">
        <div class="card col-md-3 p-0 m-1">
          <div class="card-header">
            <h6>PUP Data Privacy Notice</h6>
          </div>
          <div class="card-body d-flex flex-column justify-content-between">
            <p><small>PUP respects and values your rights as a data subject under the Data Privacy Act (DPA). PUP is
                committed to protecting the personal data you provide in accordance with the requirements under the DPA
                and its IRR. In this regard, PUP implements reasonable and appropriate security measures to maintain the
                confidentiality, integrity and availability of your personal data. For more detailed Privacy Statement,
                you may visit <a href="https://www.pup.edu.ph/privacy/"
                  target="_blank">https://www.pup.edu.ph/privacy/</a></small></p>
            <div class="d-flex flex-column">
              <a class="btn btn-outline-primary mb-2" href="../transactions.php">
                <i class="fa-regular fa-clipboard"></i> My Transactions
              </a>

              <button class="btn btn-outline-primary mb-2" onclick="location.reload()">
                <i class="fa-solid fa-arrows-rotate"></i> Reset Form
              </button>

              <a class="btn btn-outline-primary mb-2" href='./help.php'>
                <i class="fa-solid fa-circle-question"></i> FAQ
              </a>
            </div>
          </div>
        </div>
        <div class="card col-md p-0 m-1">
          <div class="card-header">
            <h6>Request Form</h6>
          </div>
          <div class="card-body">
            <form id="appointment-form" method="post" enctype="multipart/form-data" class="row g-3 was-validated">
              <small>Fields highlighted in <small style="color: red"><b>*</b></small> are required.</small>
              <h6>User Information</h6>

              <div class="form-group required col-12">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lastName" id="lastName"
                  value="<?php echo $row["last_name"]; ?>" disabled required>
              </div>
              <div class="form-group required col-12">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" name="firstName" id="firstName"
                  value="<?php echo $row["first_name"]; ?>" disabled required>
              </div>
              <div class="form-group col-md-6">
                <label for="middleName" class="form-label">Middle Name</label>
                <input type="text" class="form-control" name="middleName" id="middleName"
                  value="<?php echo $row["middle_name"]; ?>" disabled required>
              </div>
              <div class="form-group col-md-6">
                <label for="extensionName" class="form-label">Extension Name</label>
                <input type="text" class="form-control" name="extensionName" id="extensionName"
                  value="<?php echo $row["extension_name"]; ?>" disabled required>
              </div>
              <div class="form-group required col-12">
                <label for="contactNumber" class="form-label">Contact Number</label>
                <input type="text" class="form-control" name="contactNumber" id="contactNumber"
                  value="<?php echo $row["contact_no"]; ?>" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}"
                  placeholder="Example: 0123-456-7890" maxlength="13" disabled required>
                <div id="contactNoValidationMessage" class="text-danger"></div>
              </div>
              <div class="form-group required col-12">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row["email"]; ?>"
                  required>
              </div>
              <h6 class="mt-5">Request Information</h6>
              <div class="form-group required col-md-12">
                <label for="req_student_service" class="form-label">Type of Services</label>
                <div class="input-group has-validation">
                  <select required name="req_student_service" class="form-control" id="req_student_service">
                    <option value="" hidden>--Select Here--</option>
                    <!-- connect to db -->
                    <?php
										while ($dropdown = mysqli_fetch_assoc($requirements)){
												echo '<option value="' . $dropdown['services'] . '">' . $dropdown['services'] . '</option>';
										}
									?>
                  </select>
				  <div class="invalid-feedback" id="servicesSelectMessage">Please choose an option.</div>
                </div>
              </div>
              <div class="form-group required col-md-12">
                <label for="reason_request" class="form-label">Reason for Requesting Document</label>
                <div class="input-group has-validation">
                  <select class="form-control form-select" name="reason_request is-invalid" id="reason_request" required>
                    <option hidden value="">--Select--</option>
                    <option value="CEAP">CEAP</option>
                    <option value="CHED-FULL SCHOLARSHIP PROGRAM">CHED-FULL SCHOLARSHIP PROGRAM</option>
                    <option value="CHED-STUFAP">CHED-STUFAP</option>
                    <option value="CHED-TDP">CHED-TDP</option>
                    <option value="CHED-TES">CHED-TES</option>
                    <option value="DOST">DOST</option>
                    <option value="ECAP">ECAP</option>
                    <option value="FIF FOUNDATION INC">FIF FOUNDATION INC</option>
                    <option value="GSIS">GSIS</option>
                    <option value="ILSP">ILSP</option>
                    <option value="ISKOLAR NG BAYAN">ISKOLAR NG BAYAN</option>
                    <option value="ISKOLAR NG BAYAN NG SANTA MARIA">ISKOLAR NG BAYAN NG SANTA MARIA</option>
                    <option value="ISKOLAR NG CABUYAO">ISKOLAR NG CABUYAO</option>
                    <option value="ISKOLAR NG CARSIGMA">ISKOLAR NG CARSIGMA</option>
                    <option value="ISKOLAR NG LAGUNA">ISKOLAR NG LAGUNA</option>
                    <option value="MACIGLANG ISKOLAR">MACIGLANG ISKOLAR</option>
                    <option value="MSD">MSD</option>
                    <option value="MUNTINLUPA SCHOLARSHIP PROGRAM">MUNTINLUPA SCHOLARSHIP PROGRAM</option>
                    <option value="OWWA ODSP">OWWA ODSP</option>
                    <option value="SK SCHOLAR">SK SCHOLAR</option>
                    <option value="SKEAP">SKEAP</option>
                    <option value="Other">Other (Please specify)</option>
                  </select>
                  <div class="invalid-feedback" id="reasonSelectMessage">Please choose an option.</div>
                </div>
              </div>
              <div class="form-group col-12 required" id="reasonTextField" style="display: none;">
                <label for="reasonText" class="form-label">Reason</label>
                <textarea class="form-control" name="reasonText" id="reasonText" style="resize: none;" rows="3"
                  maxlength="2048" pattern="[a-zA-Z0-9\s,.!]+" oninput="validateTextArea()"
                  oninvalid="validateTextArea()"></textarea>
                <div id="reasonValidationMessage" class="text-danger"></div>
              </div>
              <div class="form-group required col-md-12">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" name="date" id="dateInput" placeholder="Select Date..."
                  style="cursor: pointer !important;" required data-input>
                <div id="dateValidationMessage" class="text-danger"></div>
              </div>
              <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">
                  <i class="fa-solid fa-circle-info"></i> Reminder
                </h4>
                <p>Your appointment request will be forwarded to the concerned office after you click the "Submit"
                  button.</p>
                <p>Confirmation (approved/disapproved) of the request will be sent to your registered email.</p>
                <p class="mb-0">You may also constantly monitor the status of the request by going to <b>My
                    Transactions</b>.</p>
              </div>
              <div class="d-flex w-100 justify-content-between p-1">
                <button class="btn btn-primary px-4" onclick="window.history.go(-1); return false;">
                  <i class="fa-solid fa-arrow-left"></i> Back
                </button>

                <input id="submitBtn" value="Submit" type="button" class="btn btn-primary w-25"
                  onclick="validateForm()" />
                <div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel"
                  aria-hidden="true">
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button name="submit" type="button" class="btn btn-primary"
                          onclick="submitForm()">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Success alert modal -->
    <div id="successModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
      aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="successModalLabel">Success</h5>
          </div>
          <div class="modal-body">
            <p>Your request has been submitted successfully!</p>
            <p>You can check the status of your request on the <b>My Transactions</b> page.</p>
            <h5>Reminder:</h5>
            <p>Please generate a payment voucher and present it to the cashier in order for your request to be approved.
            </p>
          </div>
          <div class="modal-footer">
            <a href="../accounting/payment1.php" class="btn btn-primary"><i class="fa-solid fa-receipt"></i> Generate
              voucher</a>
            <a href="../transactions.php" class="btn btn-primary">My Transactions</a>
          </div>
        </div>
      </div>
    </div>
    <!-- End of success alert modal -->

    <!-- Letter format alert modal -->
    <div id="letterModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="letterModalLabel"
      aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="letterModalLabel">Important Reminder</h5>
          </div>
          <div class="modal-body">
            <h5>For Claiming Documents:</h5>
            <p>When claiming documents, please ensure the following:</p>
            <ul>
              <li>Download the <a href="reg_request_letter.pdf" target="_blank" class="btn btn-primary"><i
                    class="fa-solid fa-envelope-open-text"></i>Request Letter Template</a>, which is necessary for
                requesting the desired document.</li>
              <li>Provide an authorization letter and ID if the claimant is an immediate family member.</li>
              <li>Submit a Special Power of Attorney (SPA) if the claimant is someone other than an immediate family
                member.</li>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="closeLetterModal">Proceed</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End of Letter format alert modal -->
  <div class="push"></div>
  </div>
  <?php include '../../footer.php'; ?>
  <script>
  $(document).ready(function() {
    $('#loadingModal').modal('show');

    $('#reason_request').on('change', function() {
      if ($(this).val() == 'Other') {
        $('#reasonTextField').slideToggle(); // Fade in the element
      } else {
        $('#reasonTextField').fadeOut(); // Fade out the element
      }
    });
  });

  $(document).ready(function() {
    $('#closeLetterModal').on('click', function() {
      // Programmatically trigger the successModal after closing the letterModal
      $("#successModal").modal("show");
    });
  });

  const contactNoInput = document.getElementById('contactNumber');
  const contactNoValidationMessage = document.getElementById('contactNoValidationMessage');
  const dateValidation = document.getElementById('dateInput');
  const dateValidationMessage = document.getElementById('dateValidationMessage');
  const timeSelect = document.getElementById('time');
  const timeSelectMessage = document.getElementById('timeSelectMessage');
  const reasonSelect = document.getElementById('counseling_description');
  const reasonSelectMessage = document.getElementById('reasonSelectMessage');
  const reasonText = document.getElementById('reasonText');
  const reasonValidationMessage = document.getElementById('reasonValidationMessage');
  const servicesSelectMessage = document.getElementById('servicesSelectMessage');

  function validateForm() {
    var form = document.getElementById('appointment-form');
    var selectFields = form.querySelectorAll('select[required]');
    var reasonText = document.getElementById('reasonText');
    var reasonRequest = document.getElementById('reason_request').value;

    if (reasonRequest === 'Other') {
      const pattern = /^[a-zA-Z0-9\s,.!]+$/;
      reasonText.setAttribute('required', 'required');
      if (reasonText.value.trim() === '') {
        reasonText.classList.add('is-invalid');
      } else {
        reasonText.classList.remove('is-invalid');
      }
      if (!pattern.test(reasonText.value)) {
        reasonText.setCustomValidity('Only letters, numbers, and spaces are allowed.');
        console.log('pattern match')
        reasonText.classList.add('is-invalid');
      } else {
        reasonText.setCustomValidity('');
        reasonText.classList.remove('is-invalid');
      }
    } else {
      reasonText.removeAttribute('required');
      reasonText.classList.remove('is-invalid');
    }

    if (dateValidation.value.trim() === '') {
      dateValidationMessage.textContent = "Please select a date.";
      dateValidation.classList.add('is-invalid');
    } else {
      dateValidationMessage.textContent = "";
      dateValidation.classList.remove('is-invalid');
    }

    for (var i = 0; i < selectFields.length; i++) {
      var selectField = selectFields[i];
      if (selectField.value === "") {
        selectField.classList.add('is-invalid');
      } else {
        selectField.classList.remove('is-invalid');
      }
    }

    if (form.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    }
    contactNoValidation();
    // Check if the form is valid
    console.log(document.getElementById("appointment-form").checkValidity());
    const dateValue = dateValidation.value.trim();
    if (document.getElementById('appointment-form').checkValidity() && dateValue !== '') {
      $('#confirmSubmitModal').modal('show');
      $('#loadingModal').modal('show');
    } else {
      // Trigger HTML5 form validation to display error messages
      document.getElementById("appointment-form").reportValidity();
    }
  }

  function contactNoValidation() {
    const contactNo = contactNoInput.value.trim();
    const contactNoValidPattern = /^0\d{3}-\d{3}-\d{4}$/;

    // Remove any dashes from the current input value
    const cleanedContactNo = contactNo.replace(/-/g, '');

    // Format the contact number with dashes
    let formattedContactNo = '';
    for (let i = 0; i < cleanedContactNo.length; i++) {
      if (i === 4 || i === 7) {
        formattedContactNo += '-';
      }
      formattedContactNo += cleanedContactNo[i];
    }

    // Update the input value with the formatted contact number
    contactNoInput.value = formattedContactNo;

    if (!contactNoValidPattern.test(formattedContactNo)) {
      if (contactNo == '') {
        contactNoValidationMessage.textContent = 'Please enter a contact number.';
        contactNoInput.classList.add('is-invalid');
      } else {
        contactNoValidationMessage.textContent = 'Invalid contact number. The format must be 0xxx-xxx-xxxx';
        contactNoInput.classList.add('is-invalid');
      }
    } else {
      contactNoValidationMessage.textContent = '';
      contactNoInput.classList.remove('is-invalid');
    }
  }

  function resetForm() {
    document.getElementById("appointment-form").reset();
  }

  var selectElement = document.getElementById("req_student_service");
  var options = selectElement.options;

  // for minimizing dropdown width
  for (var i = 0; i < options.length; i++) {
    var option = options[i];
    var optionText = option.text;

    if (optionText.length > 60) {
      option.text = optionText.substring(0, 60) + '...';
    }
  }

  function validateTextArea() {
    var reasonText = document.getElementById('reasonText');
    var reasonRequest = document.getElementById('reason_request').value;

    if (reasonRequest === 'Other') {
      const pattern = /^[a-zA-Z0-9\s,.!]+$/;
      reasonText.setAttribute('required', 'required');
      if (reasonText.value.trim() === '') {
        reasonText.classList.add('is-invalid');
      } else {
        reasonText.classList.remove('is-invalid');
      }
      if (!pattern.test(reasonText.value)) {
        reasonText.setCustomValidity('Only letters, numbers, and spaces are allowed.');
        console.log('pattern match')
        reasonText.classList.add('is-invalid');
      } else {
        reasonText.setCustomValidity('');
        reasonText.classList.remove('is-invalid');
      }
    } else {
      reasonText.removeAttribute('required');
      reasonText.classList.remove('is-invalid');
    }
  }

  function submitForm() {

    // Get the selected date and service
    var selectedDate = document.getElementById("dateInput").value;
    var selectedService = document.getElementById("req_student_service").value;
    var selectedReason = document.getElementById("reason_request").value;
    var selectedOthers = document.getElementById("reasonText").value;

    // Construct the URL with query parameters
    var redirectURL = 'submit_request.php?date=' + encodeURIComponent(selectedDate) +
      '&req_student_service=' + encodeURIComponent(selectedService) +
      '&reason_request=' + encodeURIComponent(selectedReason) +
      '&reasonText=' + encodeURIComponent(selectedOthers);

    // Redirect to submit_request.php with the query parameters
    window.location.href = redirectURL;
  }
  </script>
  <script>
  flatpickr("#dateInput", {
    altInput: true,
    dateFormat: "Y-m-d",
    theme: "custom-datepicker",
    minDate: "today",
    maxDate: "31.12.2033",
    disable: [
      function(date) {
        // Disable date on Sundays
        return (date.getDay() === 0);

      }
    ],
    locale: {
      "firstDayOfWeek": 1 // start week on Monday
    },
  });
  </script>
  <script src="../../loading.js"></script>
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
  } else if (isset($_SESSION['letter'])) {
    ?>
  <script>
  $(document).ready(function() {
    $("#letterModal").modal("show");
  })
  </script>
  <?php 
      unset($_SESSION['letter']);
      exit();
    } ?>
</body>

</html>