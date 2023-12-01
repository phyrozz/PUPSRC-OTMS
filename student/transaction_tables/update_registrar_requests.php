<?php
include "../../conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $editId = $_POST['edit_id'];
    $requestDescription = $_POST['requestDescription'];
    $scheduledDate = $_POST['scheduledDate'];

    $query = "UPDATE doc_requests SET request_description = ?, scheduled_datetime = ? WHERE request_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sss", $requestDescription, $scheduledDate, $editId);

    if ($stmt->execute()) {
        echo "Request updated successfully";
    } else {
        echo "Error occurred while updating request";
    }

    $stmt->close();
} else {
    echo "Invalid request";
}
?>