<?php
include '../conn.php';

// Check if the request_id is provided
if (isset($_POST['request_id'])) {
    $requestId = $_POST['request_id'];

    // Prepare and execute the SQL query to delete the document request
    $sql = "DELETE FROM document_requests WHERE request_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $requestId);
    $stmt->execute();

    // Close the statement and the database connection
    $stmt->close();
    $connection->close();

    // Return a response indicating the success or failure of the deletion
    echo json_encode(['success' => true]);
}
?>
