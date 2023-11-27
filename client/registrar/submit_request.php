<?php
session_start();

if(isset($_GET["date"]) && isset($_GET["req_student_service"])
  && isset($_GET["reason_request"]) && isset($_GET["reasonText"])) {
  $_SESSION['date'] = $_GET['date'];
  $_SESSION['req_student_service'] = $_GET['req_student_service'];
  $_SESSION['reason_request'] = $_GET["reason_request"];
  $_SESSION['reasonText'] = $_GET["reasonText"];

} else {
  echo "Error: Date and/or service not provided.";
  exit;
}

include '../../conn.php';
$user_id = $_SESSION['user_id'];
$status_id = 1;
$office_id = 3;
$date = $_SESSION['date'];
$service = $_SESSION['req_student_service'];
$requestPurpose = $_SESSION['reason_request'];
//$requestOthers = $_SESSION['reasonText'];

unset($_SESSION['date']);
unset($_SESSION['req_student_service']);
unset($_SESSION['reason_request']);

if ($requestPurpose == "Other") {
  // If yes, save the specific reason for "Others" in $requestOthers
  if ($_SESSION['reasonText'] !== "") {
    $requestOthers = $_SESSION['reasonText'];
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

$query = "INSERT INTO doc_requests (office_id, request_description, scheduled_datetime, status_id, user_id, purpose) VALUES (?, ?, ?, ?, ?, ?)";

// Assuming $connection is your database connection object
$stmt = $connection->prepare($query);

if ($requestPurpose == "Other") {
    // If $requestPurpose is "Other," bind parameters for $escapedOthers
    $stmt->bind_param("ississ", $office_id, $service, $date, $status_id, $user_id, $escapedOthers);
} else {
    // If $requestPurpose is not "Other," bind parameters for $escapedPurpose
    $stmt->bind_param("ississ", $office_id, $service, $date, $status_id, $user_id, $escapedPurpose);
}

if ($stmt->execute()) {
    // Query executed successfully
    $_SESSION['letter'] = true;
    echo "<script>
        window.location.href = 'create_request.php';
    </script>";
} else {
    // Error executing the query
    echo "<script>
        alert('Error: " . $stmt->error . "');
        window.location.href = 'create_request.php';
    </script>";
}

// echo "<script>window.location.href = 'create_request.php';</script>";
exit;
?>