<?php
session_start();
include 'conn.php';

// Check if the user is logged in and has a valid user ID
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User is not logged in.']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Delete transactions from doc_requests table
$query = "DELETE FROM doc_requests WHERE user_id = ? AND status_id = 6";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);

if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'error' => 'Failed to delete transactions.']);
    exit();
}

// Delete transactions from request_equipment table
$query = "DELETE FROM request_equipment WHERE user_id = ? AND status_id = 6";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);

if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'error' => 'Failed to delete transactions.']);
    exit();
}

// Delete transactions from appointment_facility table
$query = "DELETE FROM appointment_facility WHERE user_id = ? AND status_id = 6";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);

if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'error' => 'Failed to delete transactions.']);
    exit();
}

// Delete transactions from offsetting table
$query = "DELETE FROM offsettingtb WHERE user_id = ? AND status_id = 6";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);

if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'error' => 'Failed to delete transactions.']);
    exit();
}

// Return a response indicating the success of the deletion
echo json_encode(['success' => true]);

$stmt->close();
$connection->close();
?>
