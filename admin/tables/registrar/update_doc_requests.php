<?php
include '../../../conn.php';

$statusId = $_POST['statusId'];
$requestIds = $_POST['requestIds'];
$officeId = 3;

try {
    // Set the database time zone to Asia/Manila
    $connection->query("SET time_zone = '+08:00'");

    $placeholders = implode(',', array_fill(0, count($requestIds), '?'));

    // Fetch request descriptions and scheduled datetimes for the notifications
    $stmt = $connection->prepare("SELECT request_description, DATE_FORMAT(scheduled_datetime, '%M %e, %Y') as formatted_scheduled_datetime, user_id, purpose FROM doc_requests WHERE request_id IN (".$placeholders.")");
    $stmt->bind_param(str_repeat('s', count($requestIds)), ...$requestIds);
    $stmt->execute();
    $stmt->bind_result($requestDesc, $scheduledDatetime, $userId, $reason);

    $updatedRequestDescriptions = [];
    while ($stmt->fetch()) {
        $updatedRequestDescriptions[$requestId] = ['user_id' => $userId, 'description' => $requestDesc, 'formatted_scheduled_datetime' => $scheduledDatetime, 'reason' => $reason];
    }
    $stmt->close();

    // Update status
    $stmt = $connection->prepare("UPDATE doc_requests SET status_id = ? WHERE request_id IN (".$placeholders.")");
    $stmt->bind_param('i'.str_repeat('s', count($requestIds)), $statusId, ...$requestIds);
    $stmt->execute();
    $stmt->close();

    echo json_encode(['message' => 'Status updated successfully']);

    // Insert notifications
    if ($statusId == 4) {
        $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");
    
        foreach ($updatedRequestDescriptions as $requestId => $requestInfo) {
            $title = 'Request Status Update';
            $description = "Your Request for $requestInfo[description] scheduled on $requestInfo[formatted_scheduled_datetime] is ready for pickup.";
            $stmt->bind_param('iiss', $requestInfo['user_id'], $officeId, $title, $description);
            $stmt->execute();
        }

        $stmt->close();
    }
} catch (Exception $e) {
    echo json_encode(['message' => 'Error occurred while updating status: ' . $e]);
}
?>