<?php
include '../../conn.php';
include '../functions.php';

session_start();

// Check if the offsetting_id is provided
$requestIds = $_POST['offsetting_id'];

// Prepare and execute the SQL query to retrieve the statuses of the document requests
$placeholders = implode(',', array_fill(0, count($requestIds), '?'));
$sql = "SELECT status_id FROM offsettingtb WHERE offsetting_id IN ($placeholders)";
$stmt = $connection->prepare($sql);

// Bind parameters dynamically based on the number of request IDs
$types = str_repeat('s', count($requestIds));
$stmt->bind_param($types, ...$requestIds);
$stmt->execute();

// Fetch the statuses of the document requests
$result = $stmt->get_result();
$statuses = [];
while ($row = $result->fetch_assoc()) {
    $statuses[] = $row['status_id'];
}

// Check if all the statuses are either "Pending" or "Rejected"
if (array_diff($statuses, [1, 6]) === []) {
    // Prepare and execute the SQL query to delete the document requests
    $placeholders = implode(',', array_fill(0, count($requestIds), '?'));
    $sql = "DELETE FROM offsettingtb WHERE offsetting_id IN ($placeholders)";
    $stmt = $connection->prepare($sql);

    // Bind parameters dynamically based on the number of request IDs
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
} else {
    // Return a response indicating that the deletion cannot proceed due to conflicting statuses
    echo json_encode(['success' => false, 'error' => 'Cannot delete the document request. Conflicting statuses exist.']);
}

// Close the statement and the database connection
$stmt->close();
$connection->close();
?>
