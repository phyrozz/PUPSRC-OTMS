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
$query = "SELECT application_letter_status FROM acad_cross_enrollment WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$statusData = $result->fetch_assoc();
$stmt->close();

// Get the paths of the files from the database
$query = "SELECT application_letter FROM acad_cross_enrollment WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$reqData = $result->fetch_assoc();
$stmt->close();

// Check the status of each requirement and delete files if the status is "Pending"
if ($statusData['application_letter_status'] == 2 || $statusData['application_letter_status'] == 5) {
    $applicationLetterPath = '../../assets/uploads/generated_pdf/' . $reqData['application_letter'];
    if (file_exists($applicationLetterPath)) {
        unlink($applicationLetterPath);
    }
    $query = "UPDATE acad_cross_enrollment SET application_letter = NULL, application_letter_status = 1 WHERE user_id = ?";
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
