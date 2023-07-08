<!-- INSERT PHP SECTION -->
<?php
$office_name = "Accounting Office";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otms_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $course = $_POST['course'];
    $documentType = $_POST['documentType'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $surname = $_POST['surname'];
    $studentNumber = $_POST['studentNumber'];
    $amount = $_POST['amount'];
    $referenceNumber = $_POST['referenceNumber'];

    // Handle file upload
    if (isset($_FILES['receiptImage'])) {
        $file = $_FILES['receiptImage'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        // Check if the file is uploaded successfully
        if ($fileError === UPLOAD_ERR_OK) {
            // Insert the data into the database
            $sql = "INSERT INTO student_info (course, documentType, firstname, middlename, surname, studentNumber, amount, referenceNumber) 
                    VALUES ('$course', '$documentType', '$firstname', '$middlename', '$surname', '$studentNumber', '$amount', '$referenceNumber')";

            if ($conn->query($sql) === TRUE) {
                // Get the last inserted ID
                $lastInsertedId = $conn->insert_id;

                // Generate a new filename using the last inserted ID, firstname, and surname
                $imageFileName = "payment_" . $lastInsertedId . "_" . $firstname . '_' . $surname . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

                // Move the uploaded image to the desired directory with the new filename
                $targetPath = 'uploads/' . $imageFileName;
                if (move_uploaded_file($fileTmpName, $targetPath)) {
                    // Update the image URL in the database
                    $updateSql = "UPDATE student_info SET image_url = '$targetPath' WHERE payment_id = '$lastInsertedId'";
                    if ($conn->query($updateSql) === TRUE) {
                        $_SESSION['payment_id'] = $lastInsertedId;
                        header("Location: payment2.php");
                        exit();
                    } else {
                        echo "Error updating image URL: " . $conn->error;
                    }
                } else {
                    echo "Error moving uploaded file.";
                }
            } else {
                echo "Error inserting data: " . $conn->error;
            }
        } else {
            echo "Error uploading file. Error code: " . $fileError;
        }
    } else {
        echo "No file uploaded.";
    }

    $conn->close();
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounting Office - Landing Page</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/payment1.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
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
    include '../navbar.php';
    include '../../breadcrumb.php';
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



<!--Start of content-->
<div class="container-fluid text-center p-4">
<h1>STUDENT PAYMENT INFORMATION</h1>
<br>

<div class="qr-container">
  <form action="" id="" method="post" class="row g-3 needs-validation" autocomplete="off" enctype="multipart/form-data" onsubmit="validateForm(event)">
    <div class="col-12 col-md-6">
      
      <h4>1. Scan QR Code</h4>
      <h4>2. Upload Screenshot of Payment</h4>
      <h4>3. Input Student Details</h4>
      <p style="color: red;">Note: CASH PAYMENT receipts must also be uploaded.</p>

    <div class="box">
      <div class="upload-container">
        <label for="receiptImage" class="form-label">Upload Receipt Here</label>
        <input type="file" class="form-control upload-button" id="receiptImage" name="receiptImage" accept="image/*" required>
        <div class="invalid-feedback">
          Please upload a valid image file.
        </div>
      </div>
    </div>
    </div>

    <div class="col-12 col-md-6 qr-text">
      <div class="qr-details">
        <p>GCash_Receiver_Name</p>
        <p>012-345-6789</p>
      </div>
      <img src="images/qr.png" alt="QR Code" class="qr-image">
    </div>


    <div class="col-12 ">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="course" class="form-label">Course <code>*</code></label>
            <select class="form-select" id="" name="course" required>
              <option value="">Select Course</option>
              <option value="Course 1">Course 1</option>
              <option value="Course 2">Course 2</option>
              <option value="Course 3">Course 3</option>
              <!-- Add more options as needed -->
            </select>
            <div class="invalid-feedback">
              Please select a course.
            </div>
          </div>
        </div>
      
        <div class="col-md-6">
          <div class="form-group">
            <label for="documentType" class="form-label">Document Type <code>*</code></label>
            <select class="form-select" id="" name="documentType" required>
              <option value="">Select Document Type</option>
              <option value="Document 1">Document 1</option>
              <option value="Document 2">Document 2</option>
              <option value="Document 3">Document 3</option>
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
        <label for="firstname" class="form-label">First Name <code>*</code></label>
        <input type="text" class="form-control" id="firstname" name="firstname" value="" pattern="^[A-Za-z\s]+$" oninput="validateFirstName(this, 100)" required>
        <div class="invalid-feedback">
          Please provide a valid first name.
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="form-groups">
        <label for="middlename" class="form-label">Middle Name</label>
        <input type="text" class="form-control" id="middlename" name="middlename" value="" pattern="^[A-Za-z\s]+$" oninput="this.value = this.value.slice(0, 100); validateMiddleName(this)">
        <div class="invalid-feedback">
          Please provide a valid middle name.
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="form-groups">
        <label for="surname" class="form-label">Last Name <code>*</code></label>
        <input type="text" class="form-control" id="surname" name="surname" value="" pattern="^[A-Za-z\s]+$" oninput="this.value = this.value.slice(0, 100); validateSurname(this)" required>
        <div class="invalid-feedback">
          Please provide a valid last name.
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="form-groups">
        <label for="studentNumber" class="form-label">Student Number <code>*</code></label>
        <input type="text" class="form-control" id="studentNumber" name="studentNumber" value="" required oninput="validateStudentNumber(this)" maxlength="15">
        <div class="invalid-feedback">
          Please provide a valid student number.
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="form-groups">
        <label for="amount" class="form-label">Amount <code>*</code></label>
        <input type="text" class="form-control" id="amount" name="amount" value="" required oninput="validateAmount(this)">
        <div class="invalid-feedback">
          Please provide a valid amount.
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="form-groups">
        <label for="referenceNumber" class="form-label">Reference Number <code>*</code></label>
        <input type="text" class="form-control" id="referenceNumber" name="referenceNumber" value="" required oninput="validateReferenceNumber(this)" maxlength="20" >
        <div class="invalid-feedback">
          Please provide the reference number.
        </div>
      </div>
    </div>

    
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

function validateFirstName(input, maxLength) {
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

function validateMiddleName(input) {
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




function validateSurname(input) {
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

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="#"></script>
<script src="../../saved_settings.js"></script>
<script src="../../loading.js"></script>
</body>
</html>