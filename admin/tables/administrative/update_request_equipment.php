<?php
include '../../../conn.php';

$statusId = $_POST['statusId'];
$requestIds = $_POST['requestIds'];
$officeId = 1;

try {
    // Set the database time zone to Asia/Manila
    $connection->query("SET time_zone = '+08:00'");

    $placeholders = implode(',', array_fill(0, count($requestIds), '?'));

    // Fetch request equipment, quantity, purpose, and scheduled datetimes
    $stmt = $connection->prepare("SELECT request_id, equipment.equipment_name as equipment_name, quantity_equip, purpose, DATE_FORMAT(datetime_schedule, '%M %e, %Y') as formatted_scheduled_datetime, user_id FROM request_equipment INNER JOIN equipment ON request_equipment.equipment_id = equipment.equipment_id WHERE request_id IN (".$placeholders.")");
    $stmt->bind_param(str_repeat('s', count($requestIds)), ...$requestIds);
    $stmt->execute();
    $stmt->bind_result($requestId, $equipmentName, $quantity, $purpose, $scheduledDatetime, $userId);

    $updatedRequestDescriptions = [];
    while ($stmt->fetch()) {
        $updatedRequestDescriptions[$requestId] = ['user_id' => $userId, 'equipment_name' => $equipmentName, 'quantity_equip' => $quantity, 'purpose' => $purpose, 'formatted_scheduled_datetime' => $scheduledDatetime];
    }
    $stmt->close();

    // Update status
    $stmt = $connection->prepare("UPDATE request_equipment SET status_id = ? WHERE request_id IN (".$placeholders.")");
    $stmt->bind_param('i'.str_repeat('s', count($requestIds)), $statusId, ...$requestIds);
    $stmt->execute();
    $stmt->close();

    echo json_encode(['message' => 'Status updated successfully']);

    // Insert notifications
    if ($statusId == 4 || $statusId == 6) {
        $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");
    
        foreach ($updatedRequestDescriptions as $requestId => $requestInfo) {
            $title = 'Request Equipment Status Update';
            
            if ($statusId == 4) {
                $description = "Your request for $requestInfo[quantity_equip] $requestInfo[equipment_name] scheduled on $requestInfo[formatted_scheduled_datetime] is ready for pickup.";
            }
            else {
                $description = "Your request for $requestInfo[quantity_equip] $requestInfo[equipment_name] scheduled on $requestInfo[formatted_scheduled_datetime] has been rejected.";
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