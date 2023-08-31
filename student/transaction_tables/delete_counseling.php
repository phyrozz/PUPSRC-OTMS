<?php
include '../../conn.php';
include '../functions.php';

session_start();

// Check if the appointmentIds are provided
$appointmentIds = $_POST['appointment_id'];

// Prepare and execute the SQL query to fetch the statuses of the appointments
$placeholders = implode(',', array_fill(0, count($appointmentIds), '?'));
$sql = "SELECT status_id FROM doc_requests INNER JOIN counseling_schedules ON doc_requests.request_id = counseling_schedules.doc_requests_id WHERE counseling_schedules.counseling_id IN ($placeholders)";
$stmt = $connection->prepare($sql);

// Bind parameters dynamically based on the number of appointmentIds
$types = str_repeat('s', count($appointmentIds));
$stmt->bind_param($types, ...$appointmentIds);
$stmt->execute();

// Fetch the statuses of the appointments
$result = $stmt->get_result();
$statuses = [];
while ($row = $result->fetch_assoc()) {
    $statuses[] = $row['status_id'];
}

// Check if all the statuses are either "Pending" or "Rejected"
if (array_diff($statuses, [1, 6]) === []) {
    // Prepare and execute the SQL query to delete the document requests
    $placeholders = implode(',', array_fill(0, count($appointmentIds), '?'));
    $sql = "DELETE counseling_schedules, doc_requests
        FROM counseling_schedules
        INNER JOIN doc_requests ON counseling_schedules.doc_requests_id = doc_requests.request_id
        WHERE counseling_schedules.counseling_id IN ($placeholders)";
    $stmt = $connection->prepare($sql);

    // Bind parameters dynamically based on the number of appointmentIds
    $types = str_repeat('s', count($appointmentIds));
    $stmt->bind_param($types, ...$appointmentIds);
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        // Return a response indicating the success of the deletion
        echo json_encode(['success' => true]);
    } else {
        // Return a response indicating the failure of the deletion
        echo json_encode(['success' => false, 'error' => 'Failed to delete the appointment.']);
    }
} else {
    // Return a response indicating that the deletion cannot proceed due to conflicting statuses
    echo json_encode(['success' => false, 'error' => 'Cannot delete the document request. Conflicting statuses exist.']);
}

// Close the statement and the database connection
$stmt->close();
$connection->close();
?>
