<?php
include '../../../conn.php';


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

$appointmentQuery = "SELECT appointment_id, course, section, start_date_time_sched, CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(appointment_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) AS formatted_appointment_id, end_date_time_sched, status_name, purpose, facility_name, facility_number,
                 users.first_name, users.last_name, users.middle_name, users.extension_name, user_roles.role
                 FROM appointment_facility
                 INNER JOIN users ON appointment_facility.user_id = users.user_id
                 INNER JOIN user_roles ON users.user_role = user_roles.user_role_id
                 INNER JOIN statuses ON appointment_facility.status_id = statuses.status_id
                 INNER JOIN facility ON appointment_facility.facility_id = facility.facility_id
                 WHERE start_date_time_sched IS NOT NULL
                 AND is_archived = 1";
 

if (!empty($searchTerm)) {
    $appointmentQuery .= " AND (appointment_id LIKE '%$searchTerm%'
                           OR users.first_name LIKE '%$searchTerm%'
                           OR users.last_name LIKE '%$searchTerm%'
                           OR users.middle_name LIKE '%$searchTerm%'
                           OR users.extension_name LIKE '%$searchTerm%'
                           OR user_roles.role LIKE '%$searchTerm%'
                            -- CONCAT name and facility name combinations
                           OR CONCAT(users.last_name, ' ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', facility.facility_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', facility.facility_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name, ' ', facility.facility_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', facility.facility_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.last_name, ' ', facility.facility_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', facility.facility_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.last_name, ' ', facility.facility_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           -- CONCAT name and status_name combinations
                           OR CONCAT(users.last_name, ' ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.last_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.last_name, ' ', statuses.status_name) LIKE '%$searchTerm%'

                           OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.last_name, ' ', users.extension_name) LIKE '%$searchTerm%'
                           OR CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(appointment_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) LIKE '%$searchTerm%'
                           OR DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(appointment_id, 4)), '%M') LIKE '%$searchTerm%' -- Search for worded months
                           OR start_date_time_sched LIKE '%$searchTerm%'
                           OR end_date_time_sched LIKE '%$searchTerm%'
                           OR course LIKE '%$searchTerm%'
                           OR section LIKE '%$searchTerm%'
                           OR facility_name LIKE '%$searchTerm%'
                           OR facility_number LIKE '%$searchTerm%')";
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
                          WHERE start_date_time_sched IS NOT NULL";
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
