<?php
include '../../../conn.php';

$statusId = $_POST['statusId'];
$requestIds = $_POST['requestIds'];

try {
    $placeholders = implode(',', array_fill(0, count($requestIds), '?'));

    $stmt = $connection->prepare("UPDATE appointment_facility SET status_id = ? WHERE appointment_id IN (".$placeholders.")");
    $stmt->bind_param('i'.str_repeat('s', count($requestIds)), $statusId, ...$requestIds);
    $stmt->execute();

    if ($statusId == 5) { // Check if the new status is "Released"
        // Update facility availability to "Unavailable"
        $updateStmt = $connection->prepare("UPDATE facility SET availability = 'Unavailable' WHERE facility_id IN (SELECT facility_id FROM appointment_facility WHERE appointment_id IN (".$placeholders."))");
        $updateStmt->bind_param(str_repeat('s', count($requestIds)), ...$requestIds);
        $updateStmt->execute();
        $updateStmt->close();
    }

    echo json_encode(['message' => 'Status updated successfully']);
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['message' => 'Error occurred while updating status: ' . $e]);
}
?>
