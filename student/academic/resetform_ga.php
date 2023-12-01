<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Reset the attached files and their status to "Missing" and delete corresponding files
// Only reset if the status is "Pending"
$path = $_SERVER['DOCUMENT_ROOT'];
include($path . '/conn.php');

$user_id = $_SESSION['user_id'];

// Get the status of the requirements from the database
$query = "SELECT completion_form_status, assessed_fee_status FROM acad_grade_accreditation WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$statusData = $result->fetch_assoc();
$stmt->close();

// Get the paths of the files from the database
$query = "SELECT completion_form, assessed_fee FROM acad_grade_accreditation WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$reqData = $result->fetch_assoc();
$stmt->close();

// Check the status of each requirement and delete files if the status is "Pending"
if ($statusData['completion_form_status'] == 2 || $statusData['completion_form_status'] == 5) {
    $completionFormPath = '../../assets/uploads/generated_pdf/' . $reqData['completion_form'];
    if (file_exists($completionFormPath)) {
        unlink($completionFormPath);
    }
    $query = "UPDATE acad_grade_accreditation SET completion_form = NULL, completion_form_status = 1 WHERE user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}

if ($statusData['assessed_fee_status'] == 2 || $statusData['assessed_fee_status'] == 5) {
    $assessedFeePath = '../../assets/uploads/user_uploads/' . $reqData['assessed_fee'];
    if (file_exists($assessedFeePath)) {
        unlink($assessedFeePath);
    }
    $query = "UPDATE acad_grade_accreditation SET assessed_fee = NULL, assessed_fee_status = 1 WHERE user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}
$connection->close();

// Redirect back to the form page
echo '<script>history.back();</script>';
exit();
?>
