<?php
include '../../../conn.php';

session_start();

// Retrieve the page number from the AJAX request
$page = isset($_POST['page']) ? $_POST['page'] : 1;

// Define the number of records per page
$recordsPerPage = 20;

// Calculate the starting record for the requested page
$startingRecord = ($page - 1) * $recordsPerPage;
$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

// Retrieve the sorting parameters from the AJAX request
$column = isset($_POST['column']) ? $_POST['column'] : 'counseling_id';
$order = isset($_POST['order']) ? $_POST['order'] : 'desc';

// Retrieve the document requests
$counselingQuery = "SELECT counseling_schedules.counseling_id, counseling_schedules.appointment_description, counseling_schedules.comments, doc_requests.scheduled_datetime, statuses.status_name, 
users.first_name, users.last_name, users.middle_name, users.extension_name, user_roles.role
FROM counseling_schedules
INNER JOIN doc_requests ON counseling_schedules.doc_requests_id = doc_requests.request_id
INNER JOIN users ON doc_requests.user_id = users.user_id
INNER JOIN user_roles ON users.user_role = user_roles.user_role_id
INNER JOIN offices ON doc_requests.office_id = offices.office_id
INNER JOIN statuses ON doc_requests.status_id = statuses.status_id";

if (!empty($searchTerm)) {
    $counselingQuery .= " AND (counseling_id LIKE '%$searchTerm%'
                           OR appointment_description LIKE '%$searchTerm%'
                           OR scheduled_datetime LIKE '%$searchTerm%'
                           OR status_name LIKE '%$searchTerm%'
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
                           OR CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(counseling_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) LIKE '%$searchTerm%'
                           OR DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(counseling_id, 4)), '%M') LIKE '%$searchTerm%' -- Search for worded months
                           )";
}

// Add the sorting parameters to the query
$counselingQuery .= " ORDER BY $column $order
LIMIT $startingRecord, $recordsPerPage";


$result = mysqli_query($connection, $counselingQuery);

if ($result) {
    $counseling_schedules = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $counseling_schedules[] = $row;
    }

    // Count the total number of records
    $totalRecordsQuery = "SELECT COUNT(*) AS total_records
                            FROM counseling_schedules
                            INNER JOIN doc_requests ON counseling_schedules.doc_requests_id = doc_requests.request_id
                            INNER JOIN users ON doc_requests.user_id = users.user_id
                            INNER JOIN user_roles ON users.user_role = user_roles.user_role_id
                            INNER JOIN offices ON doc_requests.office_id = offices.office_id
                            INNER JOIN statuses ON doc_requests.status_id = statuses.status_id";

    if (!empty($searchTerm)) {
        $totalRecordsQuery .= " AND (counseling_id LIKE '%$searchTerm%'
                            OR appointment_description LIKE '%$searchTerm%'
                            OR scheduled_datetime LIKE '%$searchTerm%'
                            OR status_name LIKE '%$searchTerm%'
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
                            OR CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(counseling_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) LIKE '%$searchTerm%'
                            OR DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(counseling_id, 4)), '%M') LIKE '%$searchTerm%' -- Search for worded months
                            )";
    }

    $totalRecordsResult = mysqli_query($connection, $totalRecordsQuery);
    $totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
    $totalRecords = $totalRecordsRow['total_records'];

    // Calculate the total number of pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Prepare the JSON response
    $response = array(
        'counseling_schedules' => $counseling_schedules,
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
