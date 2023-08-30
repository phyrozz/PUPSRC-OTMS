<?php
session_start();

// Reset the attached files and their status to "Missing" and delete corresponding files
// Only reset if the status is "Pending"
include('../../conn.php');

$user_id = $_SESSION['user_id'];

// Get the status of the requirements from the database
$query = "SELECT overload_letter_status, ace_form_status, cert_of_registration_status FROM acad_subject_overload WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$statusData = $result->fetch_assoc();
$stmt->close();

// Get the paths of the files from the database
$query = "SELECT overload_letter, ace_form, cert_of_registration FROM acad_subject_overload WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$reqData = $result->fetch_assoc();
$stmt->close();

// Check the status of each requirement and delete files if the status is "Pending"
if ($statusData['overload_letter_status'] == 2) {
    $overloadLetterPath = '../../assets/uploads/user_uploads/' . $reqData['overload_letter'];
    if (file_exists($overloadLetterPath)) {
        unlink($overloadLetterPath);
    }
}

if ($statusData['ace_form_status'] == 2) {
    $aceFormPath = '../../assets/uploads/generated_pdf/' . $reqData['ace_form'];
    if (file_exists($aceFormPath)) {
        unlink($aceFormPath);
    }
}

if ($statusData['cert_of_registration_status'] == 2) {
    $certOfRegPath = '../../assets/uploads/user_uploads/' . $reqData['cert_of_registration'];
    if (file_exists($certOfRegPath)) {
        unlink($certOfRegPath);
    }
}

// Update the database entries for each requirement to reset the status and attachment
$query = "UPDATE acad_subject_overload SET overload_letter = NULL, overload_letter_status = 1, ace_form = NULL, ace_form_status = 1, cert_of_registration = NULL, cert_of_registration_status = 1 WHERE user_id = ? AND (overload_letter_status = 2 OR ace_form_status = 2 OR cert_of_registration_status = 2)";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->close();
$connection->close();

// Redirect back to the form page
header("Location: subject_overload.php");
exit();
?>
