<?php 
include '../../../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'])) {
    $requestId = $_POST['request_id'];
    $reason = $_POST['reason'];
    $officeId = 1;

    // Fetch request equipment, quantity, purpose, and scheduled datetimes
    $stmt = $connection->prepare("SELECT appointment_id, facility.facility_name as facility_name, purpose, DATE_FORMAT(start_date_time_sched, '%M %e, %Y, %h:%i %p') as start_date_time_sched, DATE_FORMAT(end_date_time_sched, '%M %e, %Y, %h:%i %p') as end_date_time_sched, user_id FROM appointment_facility INNER JOIN facility ON appointment_facility.facility_id = facility.facility_id WHERE appointment_id = ?");
    $stmt->bind_param('s', $requestId);
    $stmt->execute();
    $stmt->bind_result($appointmentId, $facilityName, $purpose, $startTime, $endTime, $userId);
    $stmt->fetch(); // Fetch the results
    $stmt->close();

    // Update reason for rejection
    $query = "UPDATE appointment_facility SET admin_reason = '$reason' WHERE appointment_id = '$requestId'";
    $result = mysqli_query($connection, $query);

    // Check if the update was successful
    if ($result) {
        // Insert notifications
        $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description) VALUES (?, ?, ?, ?)");
    
        $title = 'Facility Appointment Status Update';
        $description = "Your Appointment for $facilityName scheduled on $startTime to $endTime, has been rejected for the following reason: \"$reason.\"";
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