<?php
include "../../conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'])) {
    $requestId = $_POST['request_id'];
    //"request_letter" column in doc_request may reserve as temporary reason for rejected process in registrar
    $query = "SELECT request_letter FROM doc_requests WHERE request_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $requestId);
    $stmt->execute();
    $result = $stmt->get_result();
    $request = $result->fetch_assoc();
    $stmt->close();

    echo json_encode($request);
} else {
    echo "Invalid request";
}
?>