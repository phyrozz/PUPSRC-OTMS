<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounting Office - Landing Page</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/payment1.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/style.css">
    <!-- Loading page -->
    <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
    <div id="loader" class="center">
        <div class="loading-spinner"></div>
        <p class="loading-text display-3 pt-3">Getting things ready...</p>
    </div>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>    
</head>
<body>
    <?php
    $office_name = "Accounting Office";
    include '../navbar.php';
    include '../../breadcrumb.php';
    include '../../conn.php';

    if (isset($_POST['submit'])) {
        // Retrieve form data
        $course = $_POST['course'];
        $documentType = $_POST['documentType'];
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        $lastName = $_POST['lastName'];
        //$amount = $_POST['amount'];
        //$referenceNumber = $_POST['referenceNumber'];
        $userId = $_SESSION['user_id'];

        // Insert the data into the database
        $sql = "INSERT INTO student_info (user_id, course, documentType, firstName, middleName, lastName) 
                VALUES ('$userId', '$course', '$documentType', '$firstName', '$middleName', '$lastName')";

        if ($connection->query($sql) === TRUE) {
            // Get the last inserted ID
            $lastInsertedId = $connection->insert_id;
        
            $_SESSION['payment_id'] = $lastInsertedId;
            echo '<script>window.location.href = "payment2.php";</script>';
            exit();
        } else {
            echo "Error inserting data: " . $connection->error;
        }

        // Handle file upload
        /*if (isset($_FILES['receiptImage'])) {
            $file = $_FILES['receiptImage'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];

            // Check if the file is uploaded successfully
            if ($fileError === UPLOAD_ERR_OK) {
                // Insert the data into the database
                $sql = "INSERT INTO student_info (user_id, course, documentType, firstName, middleName, lastName, studentNumber, amount, referenceNumber) 
                        VALUES ('$userId', '$course', '$documentType', '$firstName', '$middleName', '$lastName', '$studentNumber', '$amount', '$referenceNumber')";

                if ($connection->query($sql) === TRUE) {
                    // Get the last inserted ID
                    $lastInsertedId = $connection->insert_id;

                    // Generate a new filename using the last inserted ID, firstName, and lastName
                    $imageFileName = "payment_" . $lastInsertedId . "_" . $firstName . '_' . $lastName . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

                    // Move the uploaded image to the desired directory with the new filename
                    $targetPath = 'uploads/' . $imageFileName;
                    if (move_uploaded_file($fileTmpName, $targetPath)) {
                        // Update the image URL in the database
                        $updateSql = "UPDATE student_info SET image_url = '$targetPath' WHERE payment_id = '$lastInsertedId'";
                        if ($connection->query($updateSql) === TRUE) {
                            $_SESSION['payment_id'] = $lastInsertedId;
                            header("Location: payment2.php");
                            exit();
                        } else {
                            echo "Error updating image URL: " . $connection->error;
                        }
                    } else {
                        echo "Error moving uploaded file.";
                    }
                } else {
                    echo "Error inserting data: " . $connection->error;
                }
            } else {
                echo "Error uploading file. Error code: " . $fileError;
            }
        } else {
            echo "No file uploaded.";
        } */

        $connection->close();
    }
    ?>
    <div class="container-fluid p-4">
        <?php
        $breadcrumbItems = [
            ['text' => 'Accounting Office', 'url' => '../accounting.php', 'active' => false],
            ['text' => 'Payments', 'active' => true],
        ];

        echo generateBreadcrumb($breadcrumbItems, true);
        ?>
    </div>
    
    <div class="fetch-data">
        <?php
        $user_id = $_SESSION["user_id"];
                    $select = mysqli_query($connection, "SELECT * FROM users WHERE user_id = '$user_id'") or die ('query failed');
                    if(mysqli_num_rows($select) > 0){
                        $fetch = mysqli_fetch_assoc($select);
                    }
        ?>
    </div>


<!--Start of content-->
<div class="container-fluid text-center p-4">
<h1>STUDENT PAYMENT INFORMATION</h1>
<br>

<div class="qr-container">
  <form action="" id="" method="post" class="row g-3 needs-validation" autocomplete="off" enctype="multipart/form-data" onsubmit="validateForm(event)">
    <div class="col-12 col-md-6">
      
      <h4>1. Select Options</h4>
      <h4>2. Confirm Details</h4>
      <h4>3. Submit and Save a Copy of Payment Voucher</h4>
      <p style="color: red;">Note: Ensure all information are correct before submitting</p>

      <!-- <div class="box">
        <div class="upload-container">
          <label for="receiptImage" class="form-label">Upload Receipt Here</label>
          <input type="file" class="form-control upload-button" id="receiptImage" name="receiptImage" accept="image/*" required>
          <div class="invalid-feedback">
            Please upload a valid image file.
          </div>
        </div>
      </div> -->
    </div> 

    <!-- <div class="col-12 col-md-6 qr-text">
      <div class="qr-details">
        <p>GCash_Receiver_Name</p>
        <p>012-345-6789</p>
      </div>
      <img src="images/qr.png" alt="QR Code" class="qr-image">
    </div> -->


    <div class="col-12 ">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="course" class="form-label">Role <code>*</code></label>
            <select class="form-select" id="" name="course" required>
              <option value="" disabled selected hidden>Select Role</option>
              <option value="Client">Client</option>
              <option value="Alumni">Alumni</option>
              <!-- Add more options as needed -->
            </select>
            <div class="invalid-feedback">
              Please select an role.
            </div>
          </div>
        </div>
      
        <div class="col-md-6">
          <div class="form-group">
            <label for="documentType" class="form-label">Document Type <code>*</code></label>
            <select class="form-select" id="" name="documentType" required>
              <option value="" disabled selected hidden>Select Document Type</option>
              <option value="Application for Graduation SIS and Non-SIS">Application for Graduation SIS and Non-SIS</option>
              <option value="Correction of Entry of Grade">Correction of Entry of Grade</option>
              <option value="Completion of Incomplete Grade">Completion of Incomplete Grade</option>
              <option value="Late Reporting of Grade">Late Reporting of Grade</option>
              <option value="Processing of Request for Correction of Name: PSA/School Records">Processing of Request for Correction of Name: PSA/School Records</option>
              <option value="Certification, Verification, Authentication (CAV/Apostile)">Certification, Verification, Authentication (CAV/Apostile)</option>
              <option value="Certificate of Attendance">Certificate of Attendance</option>
              <option value="Certificate of Graduation">Certificate of Graduation</option>
              <option value="Certificate of Medium of Instruction">Certificate of Medium of Instruction</option>
              <option value="Certificate of General Weighted Average (GWA)">Certificate of General Weighted Average (GWA)</option>
              <option value="Non Issuance of Special Order">Non Issuance of Special Order </option>
              <option value="Course/Subject Description">Course/Subject Description</option>
              <option value="Certificate of Transfer Credential/Honorable Dismissal">Certificate of Transfer Credential/Honorable Dismissal</option>
              <option value="Transcript of Records (Second and succeeding copies)">Transcript of Records (Second and succeeding copies)</option>
              <option value="Transcript of Records (Copy for Another School)">Transcript of Records (Copy for Another School)</option>
              <option value="Course Accreditation Service (for Transferees)">Course Accreditation Service (for Transferees)</option>
              <option value="Informative Copy of Grades">Informative Copy of Grades</option>
              <option value="Certified True Copy">Certified True Copy</option>
              <option value="Academic Verification Service">Academic Verification Service</option>
              <!-- Add more options as needed -->
            </select>
            <div class="invalid-feedback">
              Please select a document type.
            </div>
          </div>
        </div>
      </div>
    </div>   

    <div class="col-12 col-md-6">
      <div class="form-groups">
        <label for="firstName" class="form-label">First Name <code>*</code></label>
        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo isset($fetch['first_name']) ? $fetch['first_name'] : ''; ?>" pattern="^[A-Za-z\s]+$" oninput="validateFirstName(this, 100)" required readonly style="background-color: #e9ecef">
        <div class="invalid-feedback">
          Please provide a valid first name.
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="form-groups">
        <label for="middleName" class="form-label">Middle Name</label>
        <input type="text" class="form-control" id="middleName" name="middleName" value="<?php echo isset($fetch['middle_name']) ? $fetch['middle_name'] : ''; ?>" pattern="^[A-Za-z\s]+$" oninput="this.value = this.value.slice(0, 100); validateMiddleName(this)" readonly style="background-color: #e9ecef">
        <div class="invalid-feedback">
          Please provide a valid middle name.
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="form-groups">
        <label for="lastName" class="form-label">Last Name <code>*</code></label>
        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo isset($fetch['last_name']) ? $fetch['last_name'] : ''; ?>" pattern="^[A-Za-z\s]+$" oninput="this.value = this.value.slice(0, 100); validateSurname(this)" required readonly style="background-color: #e9ecef">
        <div class="invalid-feedback">
          Please provide a valid last name.
        </div>
      </div>
    </div>

    <!-- <div class="col-12 col-md-6">
      <div class="form-groups">
        <label for="amount" class="form-label">Amount <code>*</code></label>
        <input type="text" class="form-control" id="amount" name="amount" value="" required oninput="validateAmount(this)">
        <div class="invalid-feedback">
          Please provide a valid amount.
        </div>
      </div>
    </div> -->

    <!-- <div class="col-12 col-md-6">
      <div class="form-groups">
        <label for="referenceNumber" class="form-label">Reference Number <code>*</code></label>
        <input type="text" class="form-control" id="referenceNumber" name="referenceNumber" value="" required oninput="validateReferenceNumber(this)" maxlength="20" >
        <div class="invalid-feedback">
          Please provide the reference number.
        </div>
      </div>
    </div> -->

    
    <div class="d-flex justify-content-between">
        <a class="btn btn-primary back-button" href="../accounting.php">Back</a>
        <input style="margin-top: 0px; height: 35px; font-size: 15px" class="btn btn-primary" type="submit" name="submit" value="Submit" data-bs-toggle="tooltip" data-bs-placement="top" 
        title="Make sure all details are correct and true before submitting.">
    </div>

  </form>
</div>






<script>

$(document).ready(function() {
  $('.dropdown-submenu a.dropdown-toggle').on("click", function(e) {
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });

});

function validatefirstName(input, maxLength) {
  var value = input.value.replace(/[^A-Za-z\s]/g, '');

  if (value.length > maxLength) {
    input.value = value.slice(0, maxLength);
    input.classList.add('is-invalid');
    input.parentNode.classList.add('has-error');
    input.setCustomValidity('The input exceeds the maximum length of ' + maxLength + ' characters.');
  } else if (hasMoreThanThreeRepeatingChars(value)) {
    input.classList.add('is-invalid');
    input.parentNode.classList.add('has-error');
    input.setCustomValidity('The input should not contain more than 3 repeating characters.');
  } else {
    input.value = value;
    input.classList.remove('is-invalid');
    input.parentNode.classList.remove('has-error');
    input.setCustomValidity('');
  }
}

function hasMoreThanThreeRepeatingChars(value) {
  var consecutiveCount = 1;
  for (var i = 0; i < value.length - 1; i++) {
    if (value[i] === value[i + 1]) {
      consecutiveCount++;
      if (consecutiveCount > 3) {
        return true;
      }
    } else {
      consecutiveCount = 1;
    }
  }
  return false;
}

function validatemiddleName(input) {
  var value = input.value.replace(/[^A-Za-z\s]/g, '');
  input.value = value.trim();

  // Skip validation if the input is empty
  if (value === '') {
    input.setCustomValidity('');
    input.classList.remove('is-invalid');
    input.parentNode.classList.remove('has-error');
    return;
  }

  var minLength = 2; // Minimum required characters

  if (value.length < minLength) {
    input.setCustomValidity('Please provide a valid middle name with at least 2 characters.');
    input.classList.add('is-invalid');
    input.parentNode.classList.add('has-error');
  } else if (hasMoreThanThreeRepeatingChars(value)) {
    input.setCustomValidity('The input should not contain more than 3 repeating characters.');
    input.classList.add('is-invalid');
    input.parentNode.classList.add('has-error');
  } else {
    input.setCustomValidity('');
    input.classList.remove('is-invalid');
    input.parentNode.classList.remove('has-error');
  }
}




function validatelastName(input) {
  var value = input.value.replace(/[^A-Za-z\s]/g, '');
  input.value = value.trim();

  var minLength = 2; // Minimum required characters

  if (value.length < minLength) {
    input.setCustomValidity('Please provide a valid last name with at least 2 characters.');
    input.classList.add('is-invalid');
    input.parentNode.classList.add('has-error');
  } else if (hasMoreThanThreeRepeatingChars(value)) {
    input.setCustomValidity('The input should not contain more than 3 repeating characters.');
    input.classList.add('is-invalid');
    input.parentNode.classList.add('has-error');
  } else {
    input.setCustomValidity('');
    input.classList.remove('is-invalid');
    input.parentNode.classList.remove('has-error');
  }
}



function validateStudentNumber(input) {
  var value = input.value.toUpperCase().replace(/[^A-Z0-9-]/g, '');
  input.value = value.slice(0, 15);

  // Validate the format: XXXX-XXXXX-SR-X
  var formatRegex = /^[0-9]{4}-[0-9]{5}-SR-[0-9]$/;
  var hasValidFormat = formatRegex.test(value);

  // Validate if the input contains only letters
  var lettersOnlyRegex = /^[A-Z-]+$/;
  var containsOnlyLetters = lettersOnlyRegex.test(value);

  // Validate if the input contains only numbers
  var numbersOnlyRegex = /^[0-9-]+$/;
  var containsOnlyNumbers = numbersOnlyRegex.test(value);

  if (value.length === 15 && hasValidFormat && !containsOnlyLetters && !containsOnlyNumbers) {
    input.setCustomValidity('');
    input.classList.remove('is-invalid');
    input.parentNode.classList.remove('has-error');
  } else {
    input.setCustomValidity('Please provide a valid student number in this format: XXXX-XXXXX-SR-X.');
    input.classList.add('is-invalid');
    input.parentNode.classList.add('has-error');
  }
}


function validateAmount(input) {
  var value = input.value;
  value = value.replace(/[^0-9.]/g, ''); // Remove any non-digit and non-decimal point characters
  value = value.slice(0, 9); // Limit the input to a maximum of 7 characters (6 digits + 1 decimal point)
  input.value = value;

  var regex = /^\d{0,6}(\.\d{0,2})?$/; // Regex pattern to validate input with up to 6 digits and 2 decimal places

  if (!regex.test(input.value)) {
    input.setCustomValidity('Please provide a valid amount with up to 6 digits and 2 decimal places.');
    input.classList.add('is-invalid');
    input.parentNode.classList.add('has-error');
  } else {
    input.setCustomValidity('');
    input.classList.remove('is-invalid');
    input.parentNode.classList.remove('has-error');
  }
}


function validateReferenceNumber(input) {
  var value = input.value.replace(/[^0-9]/g, '');
  input.value = value;

  var maxLength = 20; // Maximum allowed characters

  if (value.length > maxLength) {
    input.value = value.slice(0, maxLength); // Truncate the input value to the maximum length
  }

  if (value.length !== maxLength) {
    input.setCustomValidity('Please provide a reference number with exactly 20 characters.');
    input.classList.add('is-invalid');
    input.parentNode.classList.add('has-error');
  } else if (/(\d)\1{4,}/.test(value)) {
    input.setCustomValidity('Reference number should not contain more than 5 consecutive repeating numbers.');
    input.classList.add('is-invalid');
    input.parentNode.classList.add('has-error');
  } else {
    input.setCustomValidity('');
    input.classList.remove('is-invalid');
    input.parentNode.classList.remove('has-error');
  }
}




/*Validate Upload File if Empty */
function validateForm(event) {
    var fileInput = document.getElementById('receiptImage');
    if (!fileInput.files || fileInput.files.length === 0) {
      event.preventDefault(); // Prevent form submission
      alert('Please choose an image file to upload.'); // Show alert message
    }
  }

  // Enable Bootstrap tooltips SUBMIT BUTTON POPUP
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });




  //dropdown course
  const selectElement = document.querySelector('select[name="course"]');
  const options = Array.from(selectElement.options);

  // Remove the "Select Course" option from the array
  const selectCourseOption = options.shift();

  options.sort((a, b) => a.text.localeCompare(b.text));

  // Add back the "Select Course" option at the top
  selectElement.appendChild(selectCourseOption);

  for (const option of options) {
    selectElement.appendChild(option);
  }



  const documentTypeSelectElement = document.querySelector('select[name="documentType"]');
  const documentTypeOptions = Array.from(documentTypeSelectElement.options);

  // Remove the "Select Document Type" option from the array
  const selectDocumentTypeOption = documentTypeOptions.shift();

  documentTypeOptions.sort((a, b) => a.text.localeCompare(b.text));

  // Add back the "Select Document Type" option at the top
  documentTypeSelectElement.appendChild(selectDocumentTypeOption);

  for (const option of documentTypeOptions) {
    documentTypeSelectElement.appendChild(option);
  }


</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="#"></script>
<script src="../../loading.js"></script>
<script src="../../saved_settings.js"></script>
</body>
</html>