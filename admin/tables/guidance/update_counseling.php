<?php
include '../../../conn.php';

$statusId = $_POST['statusId'];
$counselingIds = $_POST['counselingIds'];
$officeId = 5;

try {
    // Set the database time zone to Asia/Manila
    $connection->query("SET time_zone = '+08:00'");

    $placeholders = implode(',', array_fill(0, count($counselingIds), '?'));

    // Fetch appointment descriptions, scheduled datetimes, and user ids for the notifications
    $stmt = $connection->prepare("SELECT appointment_description, DATE_FORMAT(scheduled_datetime, '%M %e, %Y') as formatted_scheduled_datetime, user_id FROM doc_requests INNER JOIN counseling_schedules ON doc_requests.request_id = counseling_schedules.doc_requests_id WHERE counseling_id IN (".$placeholders.")");
    $stmt->bind_param(str_repeat('s', count($counselingIds)), ...$counselingIds);
    $stmt->execute();
    $stmt->bind_result($appointmentDesc, $scheduledDatetime, $userId);

    $updatedCounselingDescriptions = [];
    while ($stmt->fetch()) {
        $updatedCounselingDescriptions[$counselingId] = ['user_id' => $userId, 'description' => $appointmentDesc, 'formatted_scheduled_datetime' => $scheduledDatetime];
    }
    $stmt->close();

    // Update status
    $stmt = $connection->prepare("UPDATE doc_requests INNER JOIN counseling_schedules AS c ON doc_requests.request_id = c.doc_requests_id SET status_id = ? WHERE c.counseling_id IN (".$placeholders.")");
    $stmt->bind_param('i'.str_repeat('s', count($counselingIds)), $statusId, ...$counselingIds);
    $stmt->execute();
    $stmt->close();

    echo json_encode(['message' => 'Status updated successfully']);

    // Insert notifications
    if ($statusId == 6 || $statusId == 7) {
        $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");
    
        foreach ($updatedCounselingDescriptions as $counselingId => $requestInfo) {
            $title = 'Counseling Status Update';
            
            if ($statusId == 7) {
                $description = "Your Counseling Appointment with the following reason: \"$requestInfo[description]\" and scheduled on $requestInfo[formatted_scheduled_datetime] has been approved.";
            }
            else {
                $description = "Your Counseling Appointment with the following reason: \"$requestInfo[description]\" and scheduled on $requestInfo[formatted_scheduled_datetime] has been rejected.";
            }
            $stmt->bind_param('iiss', $requestInfo['user_id'], $officeId, $title, $description);
            $stmt->execute();
        }

        $stmt->close();
    }
    $connection->close();
} catch (Exception $e) {
    echo json_encode(['message' => 'Error occurred while updating status: ' . $e]);
}
?>