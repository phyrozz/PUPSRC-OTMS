<?php
include '../../../conn.php';

$statusId = $_POST['statusId'];
$requestIds = $_POST['requestIds'];
$officeId = 2;

try {
    // Set the database time zone to Asia/Manila
    $connection->query("SET time_zone = '+08:00'");

    $placeholders = implode(',', array_fill(0, count($requestIds), '?'));

    // Fetch appointment descriptions, scheduled datetimes, and user ids for the notifications
    $stmt = $connection->prepare("SELECT offsetType,amountToOffset, DATE_FORMAT(timestamp, '%M %e, %Y') as formatted_offsetting_datetime, user_id FROM offsettingtb WHERE offsetting_id IN (".$placeholders.")");
    $stmt->bind_param(str_repeat('s', count($requestIds)), ...$requestIds);
    $stmt->execute();
    $stmt->bind_result($offsettingDesc,$amountToOffset, $scheduledDatetime, $userId);

    $updatedOfsettingDescriptions = [];
    while ($stmt->fetch()) {
        $updatedOfsettingDescriptions[$counselingId] = ['user_id' => $userId, 'description' => $offsettingDesc, 'amountToOffset' => $amountToOffset, 'formatted_offsetting_datetime' => $scheduledDatetime];
    }
    $stmt->close();

    //update status
    $stmt = $connection->prepare("UPDATE offsettingtb SET status_id = ? WHERE offsetting_id IN (".$placeholders.")");
    $stmt->bind_param('i'.str_repeat('s', count($requestIds)), $statusId, ...$requestIds);
    $stmt->execute();

    echo json_encode(['message' => 'Status updated successfully']);
    $stmt->close();

    // Insert notifications
    if ($statusId == 6 || $statusId == 7) {
        $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");
    
        foreach ($updatedOfsettingDescriptions as $counselingId => $requestInfo) {
            $title = 'Offsetting Status Update';
            
            if ($statusId == 7) {
                $description = "Your Offsetting request of \"$requestInfo[description]\" with the amount of \"$requestInfo[amountToOffset]\" and listed on $requestInfo[formatted_offsetting_datetime] has been approved.";
            }
            else {
                $description = "Your Offsetting request of \"$requestInfo[description]\" with the amount of \"$requestInfo[amountToOffset]\" and listed on $requestInfo[formatted_offsetting_datetime] has been rejected.";
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