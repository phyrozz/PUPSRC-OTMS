<?php 
include '../../../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'])) {
    $requestId = $_POST['request_id'];
    $reason = $_POST['reason'];
    $officeId = 1;

    // Fetch request equipment, quantity, purpose, and scheduled datetimes
    $stmt = $connection->prepare("SELECT request_id, equipment.equipment_name as equipment_name, quantity_equip, purpose, DATE_FORMAT(datetime_schedule, '%M %e, %Y') as formatted_scheduled_datetime, user_id FROM request_equipment INNER JOIN equipment ON request_equipment.equipment_id = equipment.equipment_id WHERE request_id =?");
    $stmt->bind_param('s',$requestId);
    $stmt->execute();
    $stmt->bind_result($requestId, $equipmentName, $quantity, $purpose, $scheduledDatetime, $userId);
    $stmt->fetch(); // Fetch the results
    $stmt->close();

    // Update reason for rejection
    $query = "UPDATE request_equipment SET admin_reason = '$reason' WHERE request_id = '$requestId'";
    $result = mysqli_query($connection, $query);

    // Check if the update was successful
    if ($result) {
        // Insert notifications
        $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description) VALUES (?, ?, ?, ?)");
    
        $title = 'Request Status Update';
        $description = "Your Request for $equipmentName scheduled on $scheduledDatetime has been rejected for the following reason: \"$reason.\"";
        $stmt->bind_param('iiss', $userId, $officeId, $title, $description);
        $stmt->execute();
        $stmt->close();
        
        echo json_encode(array('status' => 'success', 'message' => 'Purpose updated successfully.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating purpose.'));
    }

    $connection->close();
} else {
    echo "Invalid request";
}
?>