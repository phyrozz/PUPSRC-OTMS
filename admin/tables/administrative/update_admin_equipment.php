<?php
include '../../../conn.php'; 

// Get the equipment data from the AJAX request
$equipmentId = $_POST['equipmentId'];
$equipmentName = $_POST['equipmentName'];
$quantity = $_POST['quantity'];

// Determine availability based on quantity
$availability = ($quantity >= 1) ? 'Available' : 'Unavailable';

try {
    // Prepare and execute the SQL query to update the equipment data
    $query = "UPDATE equipment SET equipment_name = ?, availability = ?, quantity = ? WHERE equipment_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('ssii', $equipmentName, $availability, $quantity, $equipmentId);
    $stmt->execute();

    // Check if any rows were affected
    if ($stmt->affected_rows > 0) {
        // Equipment data updated successfully
        echo json_encode(['message' => 'Equipment updated successfully']);
    } else {
        // No rows updated
        echo json_encode(['error' => 'Equipment not found or no changes made']);
    }

    // Close the database connection
    $stmt->close();
    $connection->close();
    
} catch (Exception $e) {
  // Error occurred while updating equipment data
  echo json_encode(['error' => 'Error occurred while updating Equipment: ' . $e->getMessage()]);
}
?>
