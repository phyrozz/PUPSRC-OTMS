<?php
include "../../conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $editId = $_POST['edit_id'];

    $query = "SELECT request_description, scheduled_datetime FROM doc_requests WHERE request_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $editId);
    $stmt->execute();
    $result = $stmt->get_result();
    $request = $result->fetch_assoc();
    $stmt->close();

    echo json_encode($request);
} else {
    echo "Invalid request";
}
?>
