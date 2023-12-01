<?php
include "../../../conn.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

$name = sanitizeInput($_POST['add-name']);
$courseId = sanitizeInput($_POST['add-course']);
$year = sanitizeInput($_POST['add-year']);
$shelfLocation = sanitizeInput($_POST['add-shelf-location']);

$stmt = $connection->prepare("INSERT INTO student_record (name, year, shelf_location, course_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sisi", $name, $year, $shelfLocation, $courseId);

if ($stmt->execute()) {
    // Student record added successfully
    $response = ['status' => 'success', 'message' => 'Student record added successfully'];
    echo json_encode($response);
} else {
    // Error occurred
    $response = ['status' => 'error', 'message' => 'Failed to add student record'];
    echo json_encode($response);
}

$stmt->close();
$connection->close();

// Function to sanitize user input
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}