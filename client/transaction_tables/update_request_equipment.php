<?php
include "../../conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $editId = $_POST['edit_id'];
    $datetimeSched = $_POST['datetimeSched'];
    $timeSched = $_POST['timeSched'];

    // Combine the date and time components
    $datetime = $datetimeSched . ' ' . $timeSched;

    $query = "UPDATE request_equipment SET datetime_schedule = ? WHERE request_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $datetime, $editId);

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
