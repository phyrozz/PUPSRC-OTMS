<?php
session_start();
include "../../conn.php";

$previousPage = $_SERVER['HTTP_REFERER'];
$acad_transaction = '';

if (strpos($previousPage, 'subject_overload.php') !== false) {
    $acad_transaction = 'SO';
} elseif (strpos($previousPage, 'grade_accreditation.php') !== false) {
    $acad_transaction = 'GA';
} elseif (strpos($previousPage, 'cross_enrollment.php') !== false) {
    $acad_transaction = 'CE';
} elseif (strpos($previousPage, 'shifting.php') !== false) {
    $acad_transaction = 'S';
}

// Process file upload asynchronously using AJAX
$file = $_FILES['fileToUpload'];

// Retrieve file data
$fileName = $file['name'];
$fileSize = $file['size'];
$fileSizeKB = round($fileSize / 1024, 2); // Convert bytes to kilobytes and round to 2 decimal places
$type = "User Upload";

// Check if the uploaded file is an image
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
$fileType = mime_content_type($file['tmp_name']);

if (!in_array($fileType, $allowedTypes)) {
    echo json_encode(['success' => false, 'message' => 'Only image files (JPEG, PNG, GIF) are allowed.']);
    exit;
}

// Check if the file size exceeds the limit (10 MB)
$maxFileSize = 10 * 1024 * 1024; // 10 MB in bytes
if ($fileSize > $maxFileSize) {
    echo json_encode(['success' => false, 'message' => 'File size exceeds the limit of 10 MB.']);
    exit;
}

// Specify the directory to store the files
$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/user_uploads/";

$student_no = $_POST['student_no'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];

$uniqueFileName = $acad_transaction . "_" . $student_no . "_" . $last_name . "_" . $first_name . "_" . $fileName;

// Create the path where the file will be stored
$filePath = $uploadDirectory . $uniqueFileName;

$setStatus = 1;

// Move the uploaded file to the desired location
if (move_uploaded_file($file['tmp_name'], $filePath)) {
    // Check if the session variables are set and assign values accordingly
    if ($_POST['requirement_name'] == 'requestLetter') {
        // This session variable will be used on view_attachment files
        $stmt = $connection->prepare("UPDATE shifting SET request_letter = ?, request_letter_status = ? WHERE user_id = ?");
        $stmt->bind_param("sii", $uniqueFileName, $setStatus, $_SESSION['user_id']);
        $stmt->execute();
        $stmt->close();
    }
    if ($_POST['requirement_name'] == 'firstCtc') {
        $stmt = $connection->prepare("UPDATE shifting SET first_ctc = ?, first_ctc_status = ? WHERE user_id = ?");
        $stmt->bind_param("sii", $uniqueFileName, $setStatus, $_SESSION['user_id']);
        $stmt->execute();
        $stmt->close();
    }
    if ($_POST['requirement_name'] == 'secondCtc') {
        $stmt = $connection->prepare("UPDATE shifting SET second_ctc = ?, second_ctc_status = ? WHERE user_id = ?");
        $stmt->bind_param("sii", $uniqueFileName, $setStatus, $_SESSION['user_id']);
        $stmt->execute();
        $stmt->close();
    }
    // Add more if statements for each requirements on academic office

    echo json_encode(['success' => true, 'message' => 'File uploaded successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to upload data.']);
}
?>
