<?php
session_start();
include 'conn.php';

// Check if the user is logged in and has a valid user ID
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User is not logged in.']);
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "DELETE FROM users WHERE user_id = ? AND user_role = 2";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        // Return a response indicating the success of the deletion
        echo json_encode(['success' => true]);
    } else {
        // Return a response indicating the failure of the deletion
        echo json_encode(['success' => false, 'error' => 'Failed to delete account.']);
    }
} else {
    // Return a response indicating the failure of the query execution
    echo json_encode(['success' => false, 'error' => 'Database query error.']);
}

$stmt->close();
$connection->close();
?>
