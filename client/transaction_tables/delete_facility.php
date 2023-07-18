<?php
include '../../conn.php';
include '../functions.php';

session_start();

// Check if the appointmentIds are provided
$appointmentIds = $_POST['appointment_id'];

try {
    // Start a database transaction
    $connection->begin_transaction();

    // Prepare and execute the SQL query to fetch the facility IDs of the appointments
    $placeholders = implode(',', array_fill(0, count($appointmentIds), '?'));
    $sql = "SELECT facility_id FROM appointment_facility WHERE appointment_id IN ($placeholders)";
    $stmt = $connection->prepare($sql);

    // Bind parameters dynamically based on the number of appointmentIds
    $types = str_repeat('s', count($appointmentIds));
    $stmt->bind_param($types, ...$appointmentIds);
    $stmt->execute();

    // Fetch the facility IDs of the appointments
    $result = $stmt->get_result();
    $facilityIds = [];
    while ($row = $result->fetch_assoc()) {
        $facilityIds[] = $row['facility_id'];
    }

    // Prepare and execute the SQL query to update the availability of the facilities
    $placeholders = implode(',', array_fill(0, count($facilityIds), '?'));
    $sqlUpdate = "UPDATE facility SET availability = 'Available' WHERE facility_id IN ($placeholders)";
    $stmtUpdate = $connection->prepare($sqlUpdate);

    // Bind parameters dynamically based on the number of facilityIds
    $types = str_repeat('s', count($facilityIds));
    $stmtUpdate->bind_param($types, ...$facilityIds);
    $stmtUpdate->execute();

    // Prepare and execute the SQL query to delete the appointment records
    $placeholders = implode(',', array_fill(0, count($appointmentIds), '?'));
    $sqlDelete = "DELETE FROM appointment_facility WHERE appointment_id IN ($placeholders)";
    $stmtDelete = $connection->prepare($sqlDelete);

    // Bind parameters dynamically based on the number of appointmentIds
    $types = str_repeat('s', count($appointmentIds));
    $stmtDelete->bind_param($types, ...$appointmentIds);
    $stmtDelete->execute();

    // Check if the deletion was successful
    if ($stmtDelete->affected_rows > 0) {
        // Commit the transaction and return a response indicating the success of the deletion
        $connection->commit();
        echo json_encode(['success' => true]);
    } else {
        // If the deletion fails, roll back the transaction and return an error response
        $connection->rollback();
        echo json_encode(['success' => false, 'error' => 'Failed to delete the appointment.']);
    }

    // Close the statements
    $stmt->close();
    $stmtUpdate->close();
    $stmtDelete->close();
} catch (Exception $e) {
    // If an exception occurs, roll back the transaction and return an error response
    $connection->rollback();
    echo json_encode(['success' => false, 'error' => 'An error occurred during the transaction.']);
}

// Close the database connection
$connection->close();
?>
