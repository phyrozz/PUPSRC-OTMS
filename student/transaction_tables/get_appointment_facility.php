<?php
include "../../conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $editId = $_POST['edit_id'];

    $query = "SELECT appointment_facility.course, appointment_facility.section, appointment_facility.start_date_time_sched, 
    appointment_facility.end_date_time_sched, appointment_facility.facility_id, facility.facility_name 
    FROM appointment_facility
              INNER JOIN facility ON appointment_facility.facility_id = facility.facility_id
              WHERE appointment_facility.appointment_id = ?";
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
