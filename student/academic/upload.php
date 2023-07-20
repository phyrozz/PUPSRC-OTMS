<?php

include "../../conn.php";

$previousPage = $_SERVER['HTTP_REFERER'];
$acad_transaction = '';

if (strpos($previousPage, 'subject_overload.php') !== false) {
    $acad_transaction = 'SO';
}
elseif (strpos($previousPage, 'grade_accreditation.php') !== false) {
    $acad_transaction = 'GA';
}
elseif (strpos($previousPage, 'cross_enrollment.php') !== false) {
    $acad_transaction = 'CE';
}
elseif (strpos($previousPage, 'shifting.php') !== false) {
    $acad_transaction = 'S';
}

// Process file upload
if (isset($_POST['submit'])) {
    $file = $_FILES['fileToUpload'];

    // Retrieve file data
    $fileName = $file['name'];
    $fileSize = $file['size'];
    $fileSizeKB = round($fileSize / 1024, 2); // Convert bytes to kilobytes and round to 2 decimal places
    $type = "User Upload";

    // Specify the directory to store the files
    $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/user_uploads/";

    $student_no = $_POST['student_no'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];

    $uniqueFileName = $acad_transaction . "_" . $student_no . "_" . $last_name . "_" . $first_name . "_" . $fileName;

    // Create the path where the file will be stored
    $filePath = $uploadDirectory . $uniqueFileName;

    // Check if the uploaded file is an image
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = mime_content_type($file['tmp_name']);

    if (!in_array($fileType, $allowedTypes)) {
        echo "<script>alert('Only image files (JPEG, PNG, GIF) are allowed.'); window.location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
        exit;
    }

    // Check if the file size exceeds the limit (5 MB)
    $maxFileSize = 10 * 1024 * 1024; // 10 MB in bytes
    if ($fileSize > $maxFileSize) {
        echo "<script>alert('File size exceeds the limit of 10 MB.'); window.location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
        exit;
    }

    // Move the uploaded file to the desired location
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Prepare and execute the SQL query
        $stmt = $connection->prepare("INSERT INTO files (file_name, file_path, file_size, type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $uniqueFileName, $filePath, $fileSizeKB, $type);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('File uploaded successfully.'); window.location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
        } else {
            echo "<script>alert('Failed to upload data.'); window.location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "<script>alert('Failed to move the uploaded data.'); window.location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
    }
}
?>
