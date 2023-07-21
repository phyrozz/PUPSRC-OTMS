<?php
include '../../../conn.php'; // Assuming you have the database connection file included

// Get the facility ID from the AJAX request
$facilityId = $_POST['facilityId'];

// Prepare and execute the SQL query to fetch the facility data
$query = "SELECT * FROM facility WHERE facility_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param('i', $facilityId);
$stmt->execute();
$result = $stmt->get_result();

// Check if a facility record is found
if ($result->num_rows > 0) {
    // Fetch the facility data
    $row = $result->fetch_assoc();

    // Prepare the response data
    $response = [
        'facilityName' => $row['facility_name'],
        'availability' => $row['availability'],
        'facilityNumber' => $row['facility_number'],
        'facilityTypeId' => $row['facility_type_id']
    ];

    // Return the JSON response
    echo json_encode($response);
} else {
  // Facility record not found
  echo json_encode(['error' => 'Facility not found']);
}

// Close the database connection
$stmt->close();
$connection->close();
?>
