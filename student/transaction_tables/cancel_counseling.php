<?php
include '../../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the counseling_id from the POST data
    $counseling_id = isset($_POST['counseling_id']) ? $_POST['counseling_id'] : null;

    if ($counseling_id) {
        // Update the status_id in the 'request_equipment' table
        $updateQuery = "UPDATE doc_requests INNER JOIN counseling_schedules ON doc_requests.request_id = counseling_schedules.doc_requests_id SET status_id = 8 WHERE counseling_id = '$counseling_id'";
        $updateResult = mysqli_query($connection, $updateQuery);

        if ($updateResult) {
            // Return a success response
            echo json_encode(['success' => true]);
        } else {
            // Return an error response for the update query
            echo json_encode(['error' => 'Error updating status']);
        }
    } else {
        // Return an error response if counseling_id is not provided
        echo json_encode(['error' => 'Appointment ID not provided']);
    }
} else {
    // Return an error response for non-POST requests
    echo json_encode(['error' => 'Invalid appointment method']);
}
?>
