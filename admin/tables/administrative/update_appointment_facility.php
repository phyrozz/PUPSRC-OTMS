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
    $stmt = $connection->prepare("SELECT appointment_id, facility.facility_name as facility_name, purpose, DATE_FORMAT(start_date_time_sched, '%M %e, %Y, %h:%i %p') as start_date_time_sched, DATE_FORMAT(end_date_time_sched, '%M %e, %Y, %h:%i %p') as end_date_time_sched, user_id FROM appointment_facility INNER JOIN facility ON appointment_facility.facility_id = facility.facility_id WHERE appointment_id IN (".$placeholders.")");
    $stmt->bind_param(str_repeat('s', count($requestIds)), ...$requestIds);
    $stmt->execute();
    $stmt->bind_result($appointmentId, $facilityName, $purpose, $startTime, $endTime, $userId);

    $updatedAppointmentDescriptions = [];
    while ($stmt->fetch()) {
        $updatedAppointmentDescriptions[$appointmentId] = ['user_id' => $userId, 'facility_name' => $facilityName, 'purpose' => $purpose, 'start_date_time_sched' => $startTime, 'end_date_time_sched' => $endTime];
    }
    $stmt->close();

    // Update status
    $stmt = $connection->prepare("UPDATE appointment_facility SET status_id = ? WHERE appointment_id IN (".$placeholders.")");
    $stmt->bind_param('i'.str_repeat('s', count($requestIds)), $statusId, ...$requestIds);
    $stmt->execute();
    $stmt->close();

    if ($statusId == 5) { // Check if the new status is "Released"
        // Update facility availability to "Unavailable"
        $updateStmt = $connection->prepare("UPDATE facility SET availability = 'Unavailable' WHERE facility_id IN (SELECT facility_id FROM appointment_facility WHERE appointment_id IN (".$placeholders."))");
        $updateStmt->bind_param(str_repeat('s', count($requestIds)), ...$requestIds);
        $updateStmt->execute();
        $updateStmt->close();
    }

    echo json_encode(['message' => 'Status updated successfully']);

    // Insert notifications
    if ($statusId == 5 || $statusId == 6) {
        $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");
    
        foreach ($updatedAppointmentDescriptions as $appointmentId => $requestInfo) {
            $title = 'Facility Appointment Status Update';
            
            if ($statusId == 5) {
                $description = "Your appointment for $requestInfo[facility_name] scheduled on $requestInfo[start_date_time_sched] to $requestInfo[end_date_time_sched] has been approved.";
            }
            else {
                $description = "Your appointment for $requestInfo[facility_name] scheduled on $requestInfo[start_date_time_sched] to $requestInfo[end_date_time_sched] has been rejected.";
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
