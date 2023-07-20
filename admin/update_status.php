<?php
// Include the database connection file
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestID = $_POST['requestID'];
    $statusID = $_POST['statusID'];

    // Update the status in the acad_subjectoverload table
    $query = "UPDATE acad_subjectoverload SET status_id = $statusID WHERE request_id = $requestID";
    if ($connection->query($query) === TRUE) {
        echo 'Status updated successfully.';
    } else {
        echo 'Error updating status: ' . $connection->error;
    }
} else {
    echo 'Invalid request.';
}
?>
