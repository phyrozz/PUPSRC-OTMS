<?php

include '../../../conn.php'; // Replace with the correct path

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $requestIds = $_POST['requestIds'];

    // Generate placeholders for the IN clause
    $placeholders = implode(',', array_fill(0, count($requestIds), '?'));

    $query = "UPDATE facility SET availability = 'Unavailable' WHERE facility_id IN (SELECT facility_id FROM appointment_facility WHERE appointment_id IN ($placeholders))";
    $stmt = $connection->prepare($query);
    
    // Bind parameters for the placeholders
    $stmt->bind_param(str_repeat('i', count($requestIds)), ...$requestIds);
    
    if ($stmt->execute()) {
        // Facility availability updated successfully
        echo "Facility availability updated successfully";
    } else {
        // Error occurred while updating facility availability
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    $connection->close();
}
?>
