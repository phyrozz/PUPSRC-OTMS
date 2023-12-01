<?php
include "../../conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'])) {
    $requestId = $_POST['request_id'];
    
    $query = "SELECT admin_reason FROM appointment_facility WHERE appointment_id = ? ";
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