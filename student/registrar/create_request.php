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
        $req_student_service = $_POST['req_student_service'];
        $user_id = $id;
        $office_id = 3; //3 - Registrar Office
        $date = $_POST['date'];
        $status_id = 1; //1-Pending
        $amount = 0.00;
      
        $query_check =  mysqli_query($connection, "SELECT * FROM doc_requests WHERE request_description = '$req_student_service' AND status_id = '$status_id' AND request_id = '$id'");
        if(mysqli_num_rows($query_check) > 0) {
            // Data is redundant
            $_SESSION['redundant'] = true;
        } else {
            // Data is not redundant, proceed with insertion
            // Insert the new data into the database
            $query_insert = "INSERT INTO doc_requests(request_description, scheduled_datetime, office_id, user_id, status_id) VALUES('$req_student_service', '$date' , '$office_id' , '$user_id',  '$status_id')";
            $result_insert = mysqli_query($connection, $query_insert);
            $_SESSION['success'] = true;
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
    <div class="container-fluid text-center p-4">
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
              <a class="btn btn-outline-primary mb-2" href="your_transaction.php">
                <i class="fa-regular fa-clipboard"></i> Registrar Transactions
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
              </div>
              <div class="form-group col-12">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row["email"]; ?>"
                  placeholder="example@yahoo.com" maxlength="100" disabled required>
              </div>
              <h6 class="mt-5">Request Information</h6>
              <div class="form-group required col-md-12 dropdown">
                <label for="req_student_service" class="form-label">Type of Services</label>
                <select name="req_student_service" class="form-control is-invalid" id="req_student_service" required>
                  <div class="col-md-6">
                    <option hidden value="">Select options here</option>
                    <!-- connect to db -->
                    <?php
                                    while ($dropdown = mysqli_fetch_assoc($result_services)){
                                        if ($dropdown['services_id'] === '23') {
                                            break; // Stop the loop when services_id is 23
                                        }
                                        echo '<option value="' . $dropdown['services'] . '" >' . $dropdown['services'] . '</option>';
                                    }
                                    ?>
                  </div>
                </select>
              </div>
              <div class="form-group required col-md-12">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control is-invalid" name="date" id="dateInput"
                  min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                  max="<?php echo date('Y-m-d', strtotime('+1 year')); ?>" required>
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
                <input id="submitBtn" value="Submit" type="button" class="btn btn-primary w-25" data-bs-toggle="modal"
                  data-bs-target="#confirmSubmitModal">
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
                      <button type="submit" id="submit" class="btn btn-primary" name="submit">Yes</button>
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
                  </div>
                  <div class="modal-footer">
                    <a href="../transactions.php" class="btn btn-primary">My Transactions</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- End of success alert modal -->
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
</body>

</html>

<script>
function resetForm() {
  document.getElementById("appointment-form").reset();
}

// Get the reference to the date input element
var dateInput = document.getElementById('dateInput');

// Add an event listener for the input event
dateInput.addEventListener('input', function() {
  var selectedDate = new Date(this.value);

  // Check if the selected date is a Sunday (0 represents Sunday in JavaScript)
  if (selectedDate.getDay() === 0) {
    // Disable the input field
    dateInput.value = ''; // Clear the input value if necessary
    //dateInput.disabled = true;
    alert('Selection of Sundays is not allowed.');
  } else {
    // Enable the input field if it was previously disabled
    dateInput.disabled = false;
  }
});

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

const contactNoInput = document.getElementById('contactNumber');
const contactNoValidationMessage = document.getElementById('contactNoValidationMessage');

contactNoInput.addEventListener('input', () => {
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
    contactNoValidationMessage.textContent = 'Invalid contact number. The format must be 0xxx-xxx-xxxx';
    contactNoInput.classList.add('is-invalid');
  } else {
    contactNoValidationMessage.textContent = '';
    contactNoInput.classList.remove('is-invalid');
  }
});
</script>
<script src="../../loading.js"></script>

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
    } else if (isset($_SESSION['redundant'])) {
        ?>
<script>
$(document).ready(function() {
  $("#redundantModal").modal("show");
})
</script>
<?php
        unset($_SESSION['redundant']);
        exit();
    }
?>