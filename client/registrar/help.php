<?php
  $office_name = "Registrar Office";
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Office - Help</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
  <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../style.css">
  <!-- Loading page -->
  <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
  <div id="loader" class="center">
    <div class="loading-spinner"></div>
    <p class="loading-text display-3 pt-3">Getting things ready...</p>
  </div>
  <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
  <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
  <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="wrapper">
    <div class="container-fluid p-4">
      <?php
            $breadcrumbItems = [
                ['text' => 'Registrar Office', 'url' => '/client/registrar.php', 'active' => false],
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
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            What does the Registrar Office do?
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
          <div class="accordion-body">
            <p>The Registrar Office serves the students during enrollment and during their
              entire residency. It also provides technical services, such as the preparation and issuance of transcript
              of records, certifications, clearances, honorable dismissals and diplomas and evaluates and maintains
              student records.</p>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Where can I find the office?
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
          <div class="accordion-body">
            <p>Room 207</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid text-center p-4">
      <h3>Requirements and Payments</h3>
    </div>
    <div class="accordion p-4" id="faqAccordion">

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            Certification, Verification, Authentication (CAV/Apostile)
          </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour">
          <div class="accordion-body">
            <p>Requirements</p>
            <ul>
              <li>Student's Request Letter</li>
              <li>General Clearance showing the client is cleared of all accountabilities</li>
              <li>2 pcs. 2x2 picture in Formal Attire</li>
              <li>Documentary stamp</li>
              <li>Proof of payment</li>
              <li>1 Long Brown Envelope</li>
            </ul>
            <p>Payments</p>
            <ul>
              <li>P920.00 for DFA</li>
              <li>P150.00 for Special Certification</li>
              <li>P620.00 for CHED</li>
              <li>P470.00 for PRC</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
            Certificates of Attendance
          </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive">
          <div class="accordion-body">
            <p>Requirements</p>
            <ul>
              <li>Student's Request Letter</li>
              <li>General Clearance showing the client is cleared of all accountabilities</li>
              <li>2 pcs. 2x2 picture in Formal Attire</li>
              <li>Documentary stamp</li>
              <li>Proof of payment</li>
              <li>1 Long Brown Envelope</li>
            </ul>
            <p>Payments</p>
            <ul>
              <li>P150.00 per certificate</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingSix">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
            Certificate of Graduation
          </button>
        </h2>
        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix">
          <div class="accordion-body">
            <p>Requirements</p>
            <ul>
              <li>Student's Request Letter</li>
              <li>General Clearance showing the client is cleared of all accountabilities</li>
              <li>2 pcs. 2x2 picture in Formal Attire</li>
              <li>Documentary stamp</li>
              <li>Proof of payment</li>
              <li>1 Long Brown Envelope</li>
            </ul>
            <p>Payments</p>
            <ul>
              <li>P150.00 per certificate</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingSeven">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
            Certificate of Medium of Instruction
          </button>
        </h2>
        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven">
          <div class="accordion-body">
            <p>Requirements</p>
            <ul>
              <li>Student's Request Letter</li>
              <li>General Clearance showing the client is cleared of all accountabilities</li>
              <li>2 pcs. 2x2 picture in Formal Attire</li>
              <li>Documentary stamp</li>
              <li>Proof of payment</li>
              <li>1 Long Brown Envelope</li>
            </ul>
            <p>Payments</p>
            <ul>
              <li>P150.00 per certificate</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingEight">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
            Certificate of General Weighted Average (GWA)
          </button>
        </h2>
        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight">
          <div class="accordion-body">
            <p>Requirements</p>
            <ul>
              <li>Student's Request Letter</li>
              <li>General Clearance showing the client is cleared of all accountabilities</li>
              <li>2 pcs. 2x2 picture in Formal Attire</li>
              <li>Documentary stamp</li>
              <li>Proof of payment</li>
              <li>1 Long Brown Envelope</li>
            </ul>
            <p>Payments</p>
            <ul>
              <li>P150.00 per certificate</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingNine">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
            Non-Issuance of Special Order
          </button>
        </h2>
        <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine">
          <div class="accordion-body">
            <p>Requirements</p>
            <ul>
              <li>Student's Request Letter</li>
              <li>General Clearance showing the client is cleared of all accountabilities</li>
              <li>2 pcs. 2x2 picture in Formal Attire</li>
              <li>Documentary stamp</li>
              <li>Proof of payment</li>
              <li>1 Long Brown Envelope</li>
            </ul>
            <p>Payments</p>
            <ul>
              <li>P150.00 per certificate</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTen">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
            Certified True Copy
          </button>
        </h2>
        <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen">
          <div class="accordion-body">
            <p>Requirements</p>
            <ul>
              <li>Student's Request Letter</li>
              <li>General Clearance showing the client is cleared of all accountabilities</li>
              <li>2 pcs. 2x2 picture in Formal Attire</li>
              <li>Documentary stamp</li>
              <li>Proof of payment</li>
              <li>1 Long Brown Envelope</li>
            </ul>
            <p>Payments</p>
            <ul>
              <li>P150.00 per certificate</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingEleven">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven">
            Course/Subject Description
          </button>
        </h2>
        <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven">
          <div class="accordion-body">
            <p>Requirements</p>
            <ul>
              <li>Student's Request Letter</li>
              <li>General Clearance showing the client is cleared of all accountabilities</li>
              <li>2 pcs. 2x2 picture in Formal Attire</li>
              <li>Documentary stamp</li>
              <li>Proof of payment</li>
              <li>1 Long Brown Envelope</li>
            </ul>
            <p>Payments</p>
            <ul>
              <li>P150.00 per certificate</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwelve">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseTwelve" aria-expanded="true" aria-controls="collapseTwelve">
            Certificate of Transfer Credential/Honorable Dismissal
          </button>
        </h2>
        <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve">
          <div class="accordion-body">
            <p>Requirements</p>
            <ul>
              <li>Student's Request Letter</li>
              <li>General Clearance showing the client is cleared of all accountabilities</li>
              <li>2 pcs. 2x2 picture in Formal Attire</li>
              <li>Documentary stamp</li>
              <li>Proof of payment</li>
              <li>1 Long Brown Envelope</li>
            </ul>
            <p>Payments</p>
            <ul>
              <li>P150.00 per certificate</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThirteen">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseThirteen" aria-expanded="true" aria-controls="collapseThirteen">
            Transcript of Records (First Copy)
          </button>
        </h2>
        <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen">
          <div class="accordion-body">
            <p>Requirements</p>
            <ul>
              <li>Accomplished and printed copy of the application and payment voucher from the branch/campus registrar
              </li>
              <li>General Clearance showing the client is cleared of all accountabilities</li>
              <li>Certificate of Candidacy</li>
              <li>Certificate of Conferment of Degree (Dummy Diploma)</li>
              <li>2 pcs. 2x2 picture in Academic Gown</li>
              <li>Documentary stamp</li>
              <li>Proof of payments (for applicants not covered by RA 10931 otherwise known as Universal Access to
                Quality Tertiary Education Act of 2017)</li>
            </ul>
            <p>Payments</p>
            <ul>
              <li>N/A</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFourteen">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseFourteen" aria-expanded="true" aria-controls="collapseFourteen">
            Transcript of Records (Second and succeeding copies)
          </button>
        </h2>
        <div id="collapseFourteen" class="accordion-collapse collapse" aria-labelledby="headingFourteen">
          <div class="accordion-body">
            <p>Requirements</p>
            <ul>
              <li>Letter of request by the student</li>
              <li>2 pcs. 2x2 picture in formal attire</li>
              <li>Documentary stamp</li>
              <li>Proof of payments</li>
            </ul>
            <p>Payments</p>
            <ul>
              <li>P350.00 - Non Engineering</li>
              <li>P450.00 - Engineering</li>
              <li>P20.00 for White Long Envelope for TOR Copy for Another School</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFifteen">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseFifteen" aria-expanded="true" aria-controls="collapseFifteen">
            Transcript of Records (Copy for Another School)
          </button>
        </h2>
        <div id="collapseFifteen" class="accordion-collapse collapse" aria-labelledby="headingFifteen">
          <div class="accordion-body">
            <p>Requirements</p>
            <ul>
              <li>Letter of request by the student</li>
              <li>2 pcs. 2x2 picture in formal attire</li>
              <li>Documentary stamp</li>
              <li>Proof of payments</li>
              <li>Acknowledged/Signed Copy of Transfer</li>
              <li>Credential/Honorable Dismissal</li>
            </ul>
            <p>Payments</p>
            <ul>
              <li>P400.00 - Non Engineering</li>
              <li>P500.00 - Engineering</li>
              <li>P20.00 for White Long Envelope for TOR Copy for Another School</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingSixteen">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseSixteen" aria-expanded="true" aria-controls="collapseSixteen">
            Academic Verification Service
          </button>
        </h2>
        <div id="collapseSixteen" class="accordion-collapse collapse" aria-labelledby="headingSixteen">
          <div class="accordion-body">
            <p>Requirements</p>
            <ul>
              <li>Letter of request with letter head</li>
              <li>Photocopy of TOR, Diploma or credentials submitted</li>
              <li>Authorization letter signed by the student/graduate</li>
              <li>Proof of payments</li>
              <li>Authorization letter issued by the company to pick up the results of the verification with 2 valid IDs
              </li>
            </ul>
            <p>Payments</p>
            <ul>
              <li>P200.00 (local verification)</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="py-5">
        <div class="container-fluid text-left">
          <h5>When claiming documents:</h5>
          <p>
            Authorization letter and ID if claimant is immediate family member;<br>
            Special Power of Attorney (SPA) if the claimant is other than the immediate family.</p>
        </div>
      </div>

      <div class="container py-5">
        <div class="container-fluid text-center p-4">
          <h3>Submit Feedback</h3>
        </div>
        <form id="guidanceFeedbackForm" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text"
              value="<?php echo $userData[0]['first_name'] . " " . $userData[0]['last_name'] . " ". $userData[0]['extension_name'] ?>"
              class="form-control" id="name" required disabled>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" value="<?php echo $userData[0]['email'] ?>" class="form-control" id="email" required
              disabled>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" pattern="[A-Za-z0-9]+" name="feedbackText" id="message" rows="5"
              minlength="5" maxlength="2048" style="resize: none;" required></textarea>
            <div class="invalid-feedback">Invalid feedback.</div>
          </div>
          <input id="submitBtn" value="Submit" type="button" class="btn btn-primary w-25" data-bs-toggle="modal"
            data-bs-target="#confirmSubmitModal" />
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
                  <button type="submit" id="submit" class="btn btn-primary" name="feedbackSubmit">Yes</button>
                </div>
              </div>
            </div>
          </div>
        </form>
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
              <p>Thank you. Your feedback has been submitted successfully!</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="dismiss-button" data-bs-dismiss="modal">OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End of success alert modal -->
      <div class="push"></div>
    </div>
  </div>
  <script src="../../saved_settings.js"></script>
  <script src="../../loading.js"></script>
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
    if (document.getElementById('guidanceFeedbackForm').checkValidity()) {
      $('#confirmSubmitModal').modal('show');
    }
  }

  // Add event listener to the submit button
  document.getElementById('submitBtn').addEventListener('click', handleSubmit);
  </script>


  <?php

  if(isset($_POST['feedbackSubmit'])) {
    $query = "INSERT INTO registrar_feedbacks (user_id, feedback_text)
    VALUES (?, ?)";

    $stmt = $connection->prepare($query);
    $stmt->bind_param("is", $_SESSION['user_id'],  $_POST['feedbackText']);

    if ($stmt->execute()) {
?>
  <script>
  $(document).ready(function() {
    $("#successModal").modal("show");
    document.querySelector('#dismiss-button').addEventListener('click', (e) => {
      window.location.replace('/client/registrar/help.php');
    })
  })
  </script>
  <?php
      die();
    } else {
        var_dump($stmt->error);
        $stmt->close();
        $connection->close();
    }
  }
?>
</body>

</html>