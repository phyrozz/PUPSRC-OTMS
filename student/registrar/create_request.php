<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Office - Create Request</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../../../assets/favicon.ico">
  <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../style.css">
  <!-- Loading page -->
  <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
  <div id="loader" class="center">
    <div class="loading-spinner"></div>
    <p class="loading-text display-3 pt-3">Getting things ready...</p>
  </div>
  <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
  <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
  <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../../node_modules/flatpickr/dist/flatpickr.min.css">
  <script src="../../node_modules/flatpickr/dist/flatpickr.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
  <?php
    include '../../conn.php';
    $office_name = "Registrar Office";
    include "../navbar.php";

    $id = $_SESSION['user_id'];
    $result = mysqli_query($connection, "SELECT student_no, last_name, first_name, middle_name, extension_name, contact_no, email FROM users
    WHERE user_id = $id");
    $row = mysqli_fetch_array($result);

    //fetching registrar services
    $result_services = mysqli_query($connection, "SELECT * FROM reg_services");

    //for submit
    if(isset($_POST["submit"])){
        $req_student_service = sanitizeInput($_POST['req_student_service']);
        $user_id = $id;
        $office_id = 3; //3 - Registrar Office
        $date = sanitizeInput($_POST['date']);
        $status_id = 1; //1-Pending
        $amount = 0.00;
        $requestPurpose = sanitizeInput($_POST['reason_request']);
        //$requestOthers = sanitizeInput($_POST['reasonText']);

      
        $query_check =  mysqli_query($connection, "SELECT * FROM doc_requests WHERE (request_description = '$req_student_service' AND status_id = '1' AND scheduled_datetime = '$date') AND user_id = '$id'");
        if(mysqli_num_rows($query_check) > 0) {
            // Data is redundant
            $_SESSION['redundant'] = true;
        } else {
            // Data is not redundant, proceed with insertion
            // Insert the new data into the database
            if ($requestPurpose == "Other") {
              // If yes, save the specific reason for "Others" in $requestOthers
              $requestOthers = $_POST['reasonText'];
              if ($_POST['reasonText'] !== "") {
                $requestOthers = $_POST['reasonText'];
              } else {
                  $requestOthers = "User did not specify the reason.";
              }
            } else {
                // If not "Others," save the selected reason in $requestPurpose
                $requestOthers = "";
            }

            // Escape the user input to prevent SQL injection
            $escapedPurpose = $connection->real_escape_string($requestPurpose);
            $escapedOthers = $connection->real_escape_string($requestOthers);

            $query_insert = "INSERT INTO doc_requests(request_description, scheduled_datetime, office_id, user_id, status_id, purpose) VALUES('$req_student_service', '$date' , '$office_id' , '$user_id',  '$status_id', '$escapedPurpose')";
            if ($requestPurpose == "Other") {
              $query_insert = "INSERT INTO doc_requests(request_description, scheduled_datetime, office_id, user_id, status_id, purpose) VALUES('$req_student_service', '$date' , '$office_id' , '$user_id',  '$status_id', '$escapedOthers')";
            }
            $result_insert = mysqli_query($connection, $query_insert);
            $_SESSION['letter'] = true;
        }
    
        $connection->close();

    }
    
?>
  <div class="wrapper">
    <?php
        include "../../breadcrumb.php";

        ?>
    <div class="container-fluid p-4">
      <?php
            $breadcrumbItems = [
                ['text' => 'Registrar Office', 'url' => '../registrar.php', 'active' => false],
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
              <!-- <a class="btn btn-outline-primary mb-2">
                            <i class="fa-regular fa-flag"></i> Generate Inquiry
                            </a> -->
              <button class="btn btn-outline-primary mb-2" onclick="resetForm()">
                <i class="fa-solid fa-arrows-rotate"></i> Reset Form
              </button>
              <a class="btn btn-outline-primary mb-2" href="FAQ.php">
                <i class="fa-solid fa-circle-question"></i> Help
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
              <h6>Student Information</h6>
              <div class="form-group required col-12">
                <label for="studentNumber" class="form-label">Student Number</label>
                <input type="text" class="form-control" name="studentNumber" id="studentNumber"
                  value="<?php echo $row["student_no"]; ?>" disabled required>
              </div>
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
                  value="<?php echo $row["middle_name"]; ?>" disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="extensionName" class="form-label">Extension Name</label>
                <input type="text" class="form-control" name="extensionName" id="extensionName"
                  value="<?php echo $row["extension_name"]; ?>" disabled>
              </div>
              <div class="form-group required col-12">
                <label for="contactNumber" class="form-label">Contact Number</label>
                <input type="text" class="form-control" name="contactNumber" id="contactNumber"
                  value="<?php echo $row["contact_no"]; ?>" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}"
                  placeholder="Example: 0123-456-7890" maxlength="13" disabled required>
                <div id="contactNoValidationMessage" class="text-danger"></div>
              </div>
              <div class="form-group col-12">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row["email"]; ?>"
                  placeholder="example@yahoo.com" maxlength="100" disabled required>
              </div>
              <h6 class="mt-5">Request Information</h6>
              <div class="form-group required col-md-12 dropdown">
                <label for="req_student_service" class="form-label">Type of Services</label>
                <div class="input-group has-validation">
                  <select name="req_student_service" class="form-control" id="req_student_service" required>
                    <div class="col-md-6">
                      <option hidden value="">--Select--</option>
                      <!-- connect to db -->
                      <?php
                          while ($dropdown = mysqli_fetch_assoc($result_services)){
                              if ($dropdown['services_id'] < '15' || ($dropdown['services_id'] >= '18' && $dropdown['services_id'] < 23)) {
                                echo '<option value="' . $dropdown['services'] . '" >' . $dropdown['services'] . '</option>';
                              }                          
                          }
                      ?>
                    </div>
                  </select>
                  <div class="invalid-feedback" id="servicesSelectMessage">Please choose an option.</div>
                </div>
              </div>
              <div class="form-group required col-md-12">
                <label for="reason_request" class="form-label">Reason for Requesting Document</label>
                <div class="input-group has-validation">
                  <select class="form-control form-select" name="reason_request" id="reason_request" required>
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
                  style="cursor: pointer !important;" required data-input />
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
                <a class="btn btn-primary px-4" href="../registrar.php">
                  <i class="fa-solid fa-arrow-left"></i> Back
                </a>
                <input id="submitBtn" value="Submit" type="button" class="btn btn-primary w-25">
              </div>
              <!-- Modal -->
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
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                      <button type="submit" id="submit" class="btn btn-primary" name="submit" data-bs-toggle="modal"
                        data-bs-target="#confirmSubmitModal">Yes</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>

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
                    <p>Please generate a payment voucher and present it to the cashier in order for your request to be
                      approved.</p>
                  </div>
                  <div class="modal-footer">
                    <a href="../accounting/payment1.php" class="btn btn-primary"><i class="fa-solid fa-receipt"></i>
                      Generate voucher</a>
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
                            class="fa-solid fa-envelope-open-text"></i>Request Letter Template</a>, which is necessary
                        for requesting the desired document.</li>
                      <li>Provide an authorization letter and ID if the claimant is an immediate family member.</li>
                      <li>Submit a Special Power of Attorney (SPA) if the claimant is someone other than an immediate
                        family member.</li>
                    </ul>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                      id="closeLetterModal">Proceed</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- End of Letter format alert modal -->

            <!-- Redundant alert modal -->
            <div id="redundantModal" class="modal fade" tabindex="-1" role="dialog"
              aria-labelledby="redundantModalLabel" aria-hidden="true" data-bs-backdrop="static"
              data-bs-keyboard="false">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="redundantModalLabel">Unsuccess</h5>
                  </div>
                  <div class="modal-body">
                    <p>Your request has not been submitted successfully!</p>
                    <p>You Already Requested Same Pending Service.</p>
                  </div>
                  <div class="modal-footer">
                    <a href="create_request.php" class="btn btn-primary">Create Request Again</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- End of Redundant alert modal -->
          </div>
        </div>
      </div>
    </div>
    <div class="push"></div>
  </div>
  <div
    class="footer container-fluid w-100 text-md-left text-center d-md-flex align-items-center justify-content-center bg-light flex-nowrap">
    <div>
      <small>PUP Santa Rosa - Online Transaction Management System Beta 0.1.0</small>
    </div>
    <div>
      <small><a href="https://www.pup.edu.ph/terms/" target="_blank" class="btn btn-link">Terms of Use</a>|</small>
      <small><a href="https://www.pup.edu.ph/privacy/" target="_blank" class="btn btn-link">Privacy
          Statement</a></small>
    </div>
  </div>
  <script src="../../jquery.js"></script>
  <script src="../../saved_settings.js"></script>
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
</body>

<script>
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

function validateForm() {
  var form = document.getElementById('appointment-form');
  var selectFields = form.querySelectorAll('select[required]');
  var reasonText = document.getElementById('reasonText');
  var reasonRequest = document.getElementById('reason_request').value;

  if (reasonRequest === 'Other') {
    const pattern = /^[a-zA-Z0-9\s]+$/;
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
    console.log(form.checkValidity());
    event.preventDefault();
    event.stopPropagation();
  }
  contactNoValidation();
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

function handleSubmit() {
  validateForm();
  const dateValue = dateValidation.value.trim();
  if (document.getElementById('appointment-form').checkValidity() && dateValue !== '') {
    $('#confirmSubmitModal').modal('show');
    $('#loadingModal').modal('show');
  }
}

// Add event listener to the submit button
document.getElementById('submitBtn').addEventListener('click', handleSubmit);

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
</script>

<script src="../../loading.js"></script>

<?php
   if (isset($_SESSION['redundant'])) {
        ?>
<script>
$(document).ready(function() {
  $("#redundantModal").modal("show");
})
</script>
<?php
      unset($_SESSION['redundant']);
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

</html>