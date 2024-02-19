<?php
include '../../conn.php';
include '../functions.php';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the appointment IDs from the POST data
    $appointmentIds = isset($_POST['appointment_id']) ? $_POST['appointment_id'] : null;

    if ($appointmentIds) {
        try {
            // Start a database transaction
            $connection->begin_transaction();

            // Prepare and execute the SQL query to update the is_archived column
            $placeholders = implode(',', array_fill(0, count($appointmentIds), '?'));
            $sqlUpdate = "UPDATE appointments SET is_archived = 1, status_id = 8 WHERE appointment_id IN ($placeholders)";
            $stmtUpdate = $connection->prepare($sqlUpdate);

            // Bind parameters dynamically based on the number of appointment IDs
            $types = str_repeat('s', count($appointmentIds));
            $stmtUpdate->bind_param($types, ...$appointmentIds);
            $stmtUpdate->execute();

            // Check if the update was successful
            if ($stmtUpdate->affected_rows > 0) {
                // Commit the transaction and return a success response
                $connection->commit();
                echo json_encode(['success' => true]);
            } else {
                // If the update fails, roll back the transaction and return an error response
                $connection->rollback();
                echo json_encode(['success' => false, 'error' => 'Failed to delete the appointments.']);
            }

            // Close the statement
            $stmtUpdate->close();
        } catch (Exception $e) {
            // If an exception occurs, roll back the transaction and return an error response
            $connection->rollback();
            echo json_encode(['success' => false, 'error' => 'An error occurred during the transaction.']);
        }
    } else {
        // Return an error response if appointment_ids are not provided
        echo json_encode(['error' => 'Appointment IDs not provided']);
    }
} else {
    // Return an error response for non-POST requests
    echo json_encode(['error' => 'Invalid request method']);
}

// Close the database connection
$connection->close();
?>
