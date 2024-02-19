<?php
include '../../conn.php';
include '../functions.php';

session_start();

// Retrieve the page number from the AJAX request
$page = isset($_POST['page']) ? $_POST['page'] : 1;

// Define the number of records per page
$recordsPerPage = 10;

// Calculate the starting record for the requested page
$startingRecord = ($page - 1) * $recordsPerPage;
$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

// Retrieve the sorting parameters from the AJAX request
$column = isset($_POST['column']) ? $_POST['column'] : 'appointment_id';
$order = isset($_POST['order']) ? $_POST['order'] : 'desc';

// Retrieve the facility appointment data
$appointmentQuery = "SELECT appointment_id, status_name, course, section, start_date_time_sched, end_date_time_sched, facility_name, facility_number, letter_content
                        FROM appointment_facility
                        INNER JOIN statuses ON appointment_facility.status_id = statuses.status_id
                        INNER JOIN facility ON appointment_facility.facility_id = facility.facility_id
                        WHERE user_id = '" .  $_SESSION['user_id'] . "' AND is_archived = 0";

if (!empty($searchTerm)) {
    $appointmentQuery .= " AND (appointment_id LIKE '%$searchTerm%'

                           OR start_date_time_sched LIKE '%$searchTerm%'
                           OR end_date_time_sched LIKE '%$searchTerm%'
                           OR status_name LIKE '%$searchTerm%'
                           OR course LIKE '%$searchTerm%'
                           OR section LIKE '%$searchTerm%'
                           OR facility_name LIKE '%$searchTerm%'
                           OR facility_number LIKE '%$searchTerm%'
                           OR letter_content LIKE '%$searchTerm%')";
}

// Add the sorting parameters to the query
$appointmentQuery .= " ORDER BY $column $order
LIMIT $startingRecord, $recordsPerPage";


$result = mysqli_query($connection, $appointmentQuery);

if ($result) {
    $appointmentFacility = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $appointmentFacility[] = $row;
    }

    // Count the total number of records
    $totalRecordsQuery = "SELECT COUNT(*) AS total_records
                          FROM appointment_facility
                          WHERE user_id = '" .  $_SESSION['user_id'] . "'";
    $totalRecordsResult = mysqli_query($connection, $totalRecordsQuery);
    $totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
    $totalRecords = $totalRecordsRow['total_records'];

    // Calculate the total number of pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Prepare the JSON response
    $response = array(
        'appointment_facility' => $appointmentFacility,
        'total_records' => $totalRecords,
        'total_pages' => $totalPages,
        'current_page' => $page
    );

    // Send the JSON response
    echo json_encode($response);
} else {
    echo "Error executing the query: " . mysqli_error($connection);
}
?>
