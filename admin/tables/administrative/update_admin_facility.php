<?php
include '../../../conn.php'; 

// Get the facility data from the AJAX request
$facilityId = $_POST['facilityId'];
$facilityName = $_POST['facilityName'];
$availability = $_POST['availability'];
$facilityNumber = $_POST['facilityNumber'];

try {
    // Prepare and execute the SQL query to update the facility data
    $query = "UPDATE facility SET facility_name = ?, availability = ?, facility_number = ? WHERE facility_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('sssi', $facilityName, $availability, $facilityNumber, $facilityId);
    $stmt->execute();

    // Check if any rows were affected
    if ($stmt->affected_rows > 0) {
        // Facility data updated successfully
        echo json_encode(['message' => 'Facility updated successfully']);
    } else {
        // No rows updated
        echo json_encode(['error' => 'Facility not found or no changes made']);
    }

    // Close the database connection
    $stmt->close();
    $connection->close();
    
} catch (Exception $e) {
  // Error occurred while updating facility data
  echo json_encode(['error' => 'Error occurred while updating facility: ' . $e->getMessage()]);
}
?>
