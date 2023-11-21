<?php 
include '../../../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'])) {
    $requestId = $_POST['request_id'];
    $reason = $_POST['reason'];
    $officeId = 3;

    // Fetch request descriptions and scheduled datetimes for the notifications
    $stmt = $connection->prepare("SELECT request_description, DATE_FORMAT(scheduled_datetime, '%M %e, %Y') as formatted_scheduled_datetime, user_id FROM doc_requests WHERE request_id = ?");
    $stmt->bind_param('s', $requestId);
    $stmt->execute();
    $stmt->bind_result($requestDesc, $scheduledDatetime, $userId);
    $stmt->fetch(); // Fetch the results
    $stmt->close();

    // Update reason for rejection
    $query = "UPDATE doc_requests SET request_letter = '$reason' WHERE request_id = '$requestId'";
    $result = mysqli_query($connection, $query);

    // Check if the update was successful
    if ($result) {
        // Insert notifications
        $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description) VALUES (?, ?, ?, ?)");
    
        $title = 'Request Status Update';
        $description = "Your Request for $requestDesc scheduled on $scheduledDatetime has been rejected for the following reason: \"$reason.\"";
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
