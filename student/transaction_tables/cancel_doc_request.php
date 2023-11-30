<?php
include '../../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the request_id from the POST data
    $request_id = isset($_POST['request_id']) ? $_POST['request_id'] : null;

    if ($request_id) {
        // Update the status_id in the 'request_equipment' table
        $updateQuery = "UPDATE doc_requests SET status_id = 8 WHERE request_id = '$request_id'";
        $updateResult = mysqli_query($connection, $updateQuery);

        if ($updateResult) {
            // Return a success response
            echo json_encode(['success' => true]);
        } else {
            // Return an error response for the update query
            echo json_encode(['error' => 'Error updating status']);
        }
    } else {
        // Return an error response if request_id is not provided
        echo json_encode(['error' => 'Request ID not provided']);
    }
} else {
    // Return an error response for non-POST requests
    echo json_encode(['error' => 'Invalid request method']);
}
?>
