<style>
  .readonly-input {
  background-color: #f0f0f0; /* Set a background color to mimic disabled appearance */
  color: #999; /* Set a text color to make it visually less prominent */
}
</style>

<?php

include "../../conn.php";

$query = "SELECT student_no, last_name, first_name, middle_name, extension_name FROM users WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog editmod" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Personal Information</h5>
        <button type="button" class="btn-close upload" data-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

      <form action="generatepdf_ga.php" method="POST" id="GAform">
      <div class="container-fluid">
          <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                <label for="input1">First Name</label> 
                <input type="text" class="form-control readonly-input" id="input1" name="first_name" value="<?php echo htmlspecialchars($userData[0]['first_name'], ENT_QUOTES); ?>" required readonly>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="input2">Middle</label>
                <input type="text" class="form-control readonly-input" id="input2" name="middle_name" value="<?php echo htmlspecialchars($userData[0]['middle_name'], ENT_QUOTES); ?>" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="input3">Last Name</label>
                <input type="text" class="form-control readonly-input" id="input3" name="last_name" value="<?php echo htmlspecialchars($userData[0]['last_name'], ENT_QUOTES); ?>" required readonly>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="input4">Suffix</label>
                <input type="text" class="form-control readonly-input" id="input4" name="extension_name"value="<?php echo htmlspecialchars($userData[0]['extension_name'], ENT_QUOTES); ?>" readonly>
              </div>
            </div>
          </div>

          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="input5">Student Number</label>
                  <input type="text" class="form-control readonly-input" id="input5" name="student_no" value="<?php echo htmlspecialchars($userData[0]['student_no'], ENT_QUOTES); ?>" required readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="input6">Yr&Sec</label>
                  <input type="text" name="yr&Sec" class="form-control" id="input6" placeholder="BSIT 3-1" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="input7">Academic Year</label>
                  <input type="text" name="acadYear" pattern="20[1-9][0-9]-20[2-9][0-9]" maxlength="9" class="form-control" id="input7" placeholder="2020-2021" required>
                </div>
              </div>
            </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="semester" id="input10" value="1st Sem" checked>
                <label class="form-check-label" for="radio1">1st Sem</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="semester" id="input11" value="2nd Sem">
                <label class="form-check-label" for="radio2">2nd Sem</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="semester" id="input12" value="Summer">
                <label class="form-check-label" for="radio3">Summer</label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="applicationFor" id="input13" value="Late Reporting of Grades" checked>
                <label class="form-check-label" for="radio4">Late Reporting of Grade</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="applicationFor" id="input14" value="Completion of 'Inc'">
                <label class="form-check-label" for="radio5">Completion of 'Inc'</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="applicationFor" id="input15" value="Correction of Entry">
                <label class="form-check-label" for="radio6">Correction of Entry</label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="input8">Student was reported as</label>
                <input type="text" maxlength="100" class="form-control" id="input8" name="reports" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="input9">Due to the following reason/s</label>
                <input type="text" maxlength="100" class="form-control" id="input9" name="reasons" required>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary submit" name="submit">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--
<script>
  const form = document.getElementById('GAform');

  form.addEventListener('submit', function(event) {
    // Check if the form submission is restricted for this specific form
    if (isFormSubmissionRestricted('GAform')) {
      event.preventDefault(); // Prevent form submission
      const nextSubmissionTime = getNextSubmissionTime('GAform'); // Get the next submission time for this specific form
      showAlert(`You can only submit a form again after 24 hours. The next time submission is: ${nextSubmissionTime}`); // Show alert message
    } else {
      // Store the current timestamp in sessionStorage for this specific form
      sessionStorage.setItem(`formSubmissionTimestamp_GAform`, new Date().getTime());
    }
  });

  function isFormSubmissionRestricted(formId) {
    // Get the stored timestamp from sessionStorage for this specific form
    const lastSubmissionTimestamp = sessionStorage.getItem(`formSubmissionTimestamp_${formId}`);

    // Calculate the time difference in milliseconds
    const currentTime = new Date().getTime();
    const timeDifference = currentTime - lastSubmissionTimestamp;

    const twentyFourHours = 24 * 60 * 60 * 1000; // 24 hours in milliseconds

    // Check if the time difference exceeds the time limit
    return lastSubmissionTimestamp && timeDifference < twentyFourHours;
  }

  function getNextSubmissionTime(formId) {
    // Get the stored timestamp from sessionStorage for this specific form
    const lastSubmissionTimestamp = sessionStorage.getItem(`formSubmissionTimestamp_${formId}`);

    // Calculate the next submission time by adding two hours to the last submission timestamp
    const nextSubmissionTimestamp = parseInt(lastSubmissionTimestamp, 10) + ( 24 * 60 * 60 * 1000);

    // Format the next submission time as a readable date and time
    const nextSubmissionTime = new Date(nextSubmissionTimestamp).toLocaleString();

    return nextSubmissionTime;
  }

  function showAlert(message) {
    alert(message);
  }
</script>
-->