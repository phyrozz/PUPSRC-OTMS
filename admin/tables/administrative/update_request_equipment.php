<?php
include '../../../conn.php';

$statusId = $_POST['statusId'];
$requestIds = $_POST['requestIds'];

try {
    $placeholders = implode(',', array_fill(0, count($requestIds), '?'));

    $stmt = $connection->prepare("UPDATE request_equipment SET status_id = ? WHERE request_id IN (".$placeholders.")");
    $stmt->bind_param('i'.str_repeat('s', count($requestIds)), $statusId, ...$requestIds);
    $stmt->execute();

    echo json_encode(['message' => 'Status updated successfully']);
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['message' => 'Error occurred while updating status: ' . $e]);
}
?>