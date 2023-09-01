<?php
include '../../../conn.php'; // Replace with the correct path

if (isset($_POST['requestIds']) && is_array($_POST['requestIds'])) {
    $requestIds = $_POST['requestIds'];

    // Loop through each appointment ID
    foreach ($requestIds as $requestId) {
        // Get the facility ID associated with the appointment
        $query = "SELECT facility_id FROM appointment_facility WHERE appointment_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param('i', $requestId);
        $stmt->execute();
        $stmt->bind_result($facilityId);
        $stmt->fetch();
        $stmt->close();

        // Update the facility's availability to "Unavailable"
        $updateQuery = "UPDATE facility SET availability = 'Unavailable' WHERE facility_id = ?";
        $updateStmt = $connection->prepare($updateQuery);
        $updateStmt->bind_param('i', $facilityId);
        $updateStmt->execute();
        $updateStmt->close();
    }

    // Close the database connection
    $connection->close();

    // Send a success response
    echo json_encode(['success' => true]);
} else {
    // Send an error response
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
}
?>