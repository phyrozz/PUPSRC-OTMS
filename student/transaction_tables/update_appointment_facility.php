<?php
include "../../conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $editId = $_POST['edit_id'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $course = $_POST['course'];
    $section = $_POST['section'];
    $facility = $_POST['facility']; // Retrieve the selected facility

    // Combine the date and time components
    $startDateTime = $startDate . ' ' . $startTime;
    $endDateTime = $endDate . ' ' . $endTime;

    // Retrieve the current facility ID
    $query = "SELECT facility_id FROM appointment_facility WHERE appointment_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $editId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $currentFacility = $row['facility_id'];
    $stmt->close();

    // Update the appointment facility
    $updateQuery = "UPDATE appointment_facility SET course = ?, section = ?, start_date_time_sched = ?, end_date_time_sched = ?, facility_id = ? WHERE appointment_id = ?";
    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param("ssssss", $course, $section, $startDateTime, $endDateTime, $facility, $editId);

    if ($stmt->execute()) {
        // Update the availability of the current facility
        $currentFacilityQuery = "UPDATE facility SET availability = 'Available' WHERE facility_id = ?";
        $currentFacilityStmt = $connection->prepare($currentFacilityQuery);
        $currentFacilityStmt->bind_param("s", $currentFacility);
        $currentFacilityStmt->execute();
        $currentFacilityStmt->close();

        // Update the availability of the selected facility
        $facilityQuery = "UPDATE facility SET availability = 'Unavailable' WHERE facility_id = ?";
        $facilityStmt = $connection->prepare($facilityQuery);
        $facilityStmt->bind_param("s", $facility);
        $facilityStmt->execute();
        $facilityStmt->close();

        echo "Request updated successfully";
    } else {
        echo "Error occurred while updating request";
    }

    $stmt->close();
} else {
    echo "Invalid request";
}



?>
