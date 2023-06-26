<?php
include '../../conn.php';
include '../functions.php';

session_start();

// Check if the request_ids are provided
$requestIds = $_POST['request_id'];

// Prepare and execute the SQL query to delete the counseling schedules and document requests
$placeholders = implode(',', array_fill(0, count($requestIds), '?'));
$sql = "DELETE counseling_schedules, doc_requests
        FROM counseling_schedules
        INNER JOIN doc_requests ON counseling_schedules.doc_requests_id = doc_requests.request_id
        WHERE counseling_schedules.counseling_id IN ($placeholders)";
$stmt = $connection->prepare($sql);

// Bind parameters dynamically based on the number of counseling IDs
$types = str_repeat('s', count($requestIds));
$stmt->bind_param($types, ...$requestIds);
$stmt->execute();

// Check if the deletion was successful
if ($stmt->affected_rows > 0) {
    // Return a response indicating the success of the deletion
    echo json_encode(['success' => true]);
} else {
    // Return a response indicating the failure of the deletion
    echo json_encode(['success' => false, 'error' => 'Failed to delete the document request.']);
}

// Close the statement and the database connection
$stmt->close();
$connection->close();
?>
