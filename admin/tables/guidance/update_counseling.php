<?php
include '../../../conn.php';

$statusId = $_POST['statusId'];
$counselingIds = $_POST['counselingIds'];

try {
    $placeholders = implode(',', array_fill(0, count($counselingIds), '?'));

    $stmt = $connection->prepare("UPDATE doc_requests INNER JOIN counseling_schedules AS c ON doc_requests.request_id = c.doc_requests_id SET status_id = ? WHERE c.counseling_id IN (".$placeholders.")");
    $stmt->bind_param('i'.str_repeat('s', count($counselingIds)), $statusId, ...$counselingIds);
    $stmt->execute();

    echo json_encode(['message' => 'Status updated successfully']);
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['message' => 'Error occurred while updating status: ' . $e]);
}
?>