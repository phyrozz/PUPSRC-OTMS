<?php
include '../../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the request_id from the POST data
    $requestIds = isset($_POST['request_id']) ? $_POST['request_id'] : null;

    if ($requestIds) {
        // Prepare the update query
        $placeholders = implode(',', array_fill(0, count($requestIds), '?'));
        $updateQuery = "UPDATE request_equipment SET is_archived = 1, status_id = 8 WHERE request_id IN ($placeholders)";

        // Prepare the statement
        $stmt = $connection->prepare($updateQuery);

        // Bind parameters dynamically based on the number of request IDs
        $types = str_repeat('s', count($requestIds));
        $stmt->bind_param($types, ...$requestIds);

        // Execute the update query
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            // Return a success response
            echo json_encode(['success' => true]);
        } else {
            // Return an error response for the update query
            echo json_encode(['error' => 'Failed to update equipment']);
        }

        // Close the statement
        $stmt->close();
    } else {
        // Return an error response if request_ids are not provided
        echo json_encode(['error' => 'Request IDs not provided']);
    }
} else {
    // Return an error response for non-POST requests
    echo json_encode(['error' => 'Invalid request method']);
}
?>
