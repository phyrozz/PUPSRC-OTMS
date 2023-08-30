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
$query = "SELECT request_letter_status, first_ctc_status, second_ctc_status FROM acad_shifting WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$statusData = $result->fetch_assoc();
$stmt->close();

// Get the paths of the files from the database
$query = "SELECT request_letter, first_ctc, second_ctc FROM acad_shifting WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$reqData = $result->fetch_assoc();
$stmt->close();

// Check the status of each requirement and delete files if the status is "Pending"
if ($statusData['request_letter_status'] == 2 || $statusData['request_letter_status'] == 5) {
    $requestLetterPath = '../../assets/uploads/user_uploads/' . $reqData['request_letter'];
    if (file_exists($requestLetterPath)) {
        unlink($requestLetterPath);
    }
    $query = "UPDATE acad_shifting SET request_letter = NULL, request_letter_status = 1 WHERE user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}

if ($statusData['first_ctc_status'] == 2 || $statusData['first_ctc_status'] == 5) {
    $firstCtcPath = '../../assets/uploads/user_uploads/' . $reqData['first_ctc'];
    if (file_exists($firstCtcPath)) {
        unlink($firstCtcPath);
    }
    $query = "UPDATE acad_shifting SET first_ctc = NULL, first_ctc_status = 1 WHERE user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}

if ($statusData['second_ctc_status'] == 2 || $statusData['second_ctc_status'] == 5) {
    $secondCtcPath = '../../assets/uploads/user_uploads/' . $reqData['second_ctc'];
    if (file_exists($secondCtcPath)) {
        unlink($secondCtcPath);
    }
    $query = "UPDATE acad_shifting SET second_ctc = NULL, second_ctc_status = 1 WHERE user_id = ?";
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
