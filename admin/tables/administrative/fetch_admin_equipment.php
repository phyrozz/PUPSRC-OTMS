<?php
include '../../../conn.php'; // Assuming you have the database connection file included

// Get the equipment ID from the AJAX request
$equipmentId = $_POST['equipmentId'];

// Prepare and execute the SQL query to fetch the equipment data
$query = "SELECT * FROM equipment WHERE equipment_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param('i', $equipmentId);
$stmt->execute();
$result = $stmt->get_result();

// Check if a equipment record is found
if ($result->num_rows > 0) {
    // Fetch the equipment data
    $row = $result->fetch_assoc();

    // Prepare the response data
    $response = [
        'equipmentName' => $row['equipment_name'],
        'availability' => $row['availability'],
        'quantity' => $row['quantity'],
        'equipmentTypeId' => $row['equipment_type_id']
    ];

    // Return the JSON response
    echo json_encode($response);
} else {
  // Equipment record not found
  echo json_encode(['error' => 'Equipment not found']);
}

// Close the database connection
$stmt->close();
$connection->close();
?>
