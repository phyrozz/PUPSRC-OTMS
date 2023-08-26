<?php

$office_name = "Registrar Office";
include "../navbar.php";
include "../../conn.php";
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

if(isset($_POST["submit"])){
	$_SESSION['date'] = $_POST['date'];
	$_SESSION['req_student_service'] = $_POST['req_student_service'];
	header("Location: submit_request.php");
};


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
  $(document).ready(function() {
    var optional_config = {
      'minDate': 'today',
      'disable': [
        function(date) {
          return (date.getDay() === 0)
        }
      ]
    };
    $("#date").flatpickr(optional_config);

  });

  function validateForm() {
    // Check if the form is valid
    console.log(document.getElementById("appointment-form").checkValidity());

    if (document.getElementById("appointment-form").checkValidity()) {
      // Show the modal if the form is valid
      $('#confirmSubmitModal').modal('show');
    } else {
      // Trigger HTML5 form validation to display error messages
      document.getElementById("appointment-form").reportValidity();
    }
  }
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
            <form id="appointment-form" method="post" enctype="multipart/form-data" class="row g-3">
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
                <input type="text" class="form-control" id="contactNumber" name="contactNumber"
                  value="<?php echo $row["contact_no"]; ?>" required>
              </div>
              <div class="form-group required col-12">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row["email"]; ?>"
                  required>
              </div>
              <h6 class="mt-5">Request Information</h6>
              <div class="form-group required col-md-12">
                <label for="typeOfServices" class="form-label">Type of Services</label>
                <select required name="req_student_service" class="form-control" id="req_student_service">
                  <option value="" hidden>--Select Here--</option>
                  <!-- connect to db -->
                  <?php
										while ($dropdown = mysqli_fetch_assoc($requirements)){
												echo '<option value="' . $dropdown['services'] . '">' . $dropdown['services'] . '</option>';
										}
									?>

                </select>
              </div>
              <div class="form-group required col-md-12">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" name="date" id="date" max="2023-12-31"
                  min="<?php echo date('Y-m-d'); ?>" required>

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
                        <button name="submit" type="submit" value="submit" class="btn btn-primary">Submit</button>
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
    <div class="push"></div>
  </div>
  <?php include '../../footer.php'; ?>
  <script src="../../loading.js"></script>
  <script src="../../saved_settings.js"></script>
</body>

</html>