<?php
include "../../conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $editId = $_POST['edit_id'];

    $query = "SELECT datetime_schedule, equipment_id FROM request_equipment WHERE request_id = ?";
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
