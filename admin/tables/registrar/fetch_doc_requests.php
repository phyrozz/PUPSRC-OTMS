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

$selectedRequestDescriptions = isset($_POST['selectedRequestDescriptions']) ? $_POST['selectedRequestDescriptions'] : array();
// Convert the array of selected document types to a comma-separated string
$selectedRequestDescriptionsString = implode("','", $selectedRequestDescriptions);

// Retrieve the sorting parameters from the AJAX request
$column = isset($_POST['column']) ? $_POST['column'] : 'request_id';
$order = isset($_POST['order']) ? $_POST['order'] : 'asc';

// Retrieve the document requests
$documentRequestsQuery = "SELECT request_id, request_description, purpose, CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) AS formatted_request_id, scheduled_datetime, status_name, amount_to_pay, attached_files, 
                        users.first_name, users.last_name, users.middle_name, users.extension_name, user_roles.role, doc_requests.user_id AS user_id
                        FROM doc_requests
                        INNER JOIN users ON doc_requests.user_id = users.user_id
                        INNER JOIN user_roles ON users.user_role = user_roles.user_role_id
                        INNER JOIN offices ON doc_requests.office_id = offices.office_id
                        INNER JOIN statuses ON doc_requests.status_id = statuses.status_id
                        WHERE doc_requests.office_id = 3";

if (!empty($searchTerm)) {
    $documentRequestsQuery .= " AND (request_id LIKE '%$searchTerm%'
                           OR users.first_name LIKE '%$searchTerm%'
                           OR users.last_name LIKE '%$searchTerm%'
                           OR users.middle_name LIKE '%$searchTerm%'
                           OR users.extension_name LIKE '%$searchTerm%'
                           OR request_description IN ('$selectedRequestDescriptionsString')
                           OR purpose LIKE '%$searchTerm%'
                           OR user_roles.role LIKE '%$searchTerm%'
                           OR scheduled_datetime LIKE '%$searchTerm%'
                           -- CONCAT name and request_description combinations
                           OR CONCAT(users.last_name, ' ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.last_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.last_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
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
                           OR CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) LIKE '%$searchTerm%'
                           OR DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%M') LIKE '%$searchTerm%' -- Search for worded months
                           OR status_name LIKE '%$searchTerm%'
                           OR amount_to_pay LIKE '%$searchTerm%')";
}

// Add the sorting parameters to the query
$documentRequestsQuery .= " ORDER BY $column $order
LIMIT $startingRecord, $recordsPerPage";

$result = mysqli_query($connection, $documentRequestsQuery);

if ($result) {
    $documentRequests = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $documentRequests[] = $row;
    }

    // Count the total number of records
    $totalRecordsQuery = "SELECT COUNT(*) AS total_records
                          FROM doc_requests
                          INNER JOIN users ON doc_requests.user_id = users.user_id
                          INNER JOIN user_roles ON users.user_role = user_roles.user_role_id
                          INNER JOIN offices ON doc_requests.office_id = offices.office_id
                          INNER JOIN statuses ON doc_requests.status_id = statuses.status_id
                          WHERE doc_requests.office_id = 3";

    if (!empty($searchTerm)) {
        $totalRecordsQuery .= " AND (request_id LIKE '%$searchTerm%'
                               OR users.first_name LIKE '%$searchTerm%'
                               OR users.last_name LIKE '%$searchTerm%'
                               OR users.middle_name LIKE '%$searchTerm%'
                               OR users.extension_name LIKE '%$searchTerm%'
                               OR request_description IN ('$selectedRequestDescriptionsString')
                               OR purpose LIKE '%$searchTerm%'
                               OR user_roles.role LIKE '%$searchTerm%'
                               OR scheduled_datetime LIKE '%$searchTerm%'
                               -- CONCAT name and request_description combinations
                               OR CONCAT(users.last_name, ' ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                               OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                               OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                               OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                               OR CONCAT(users.first_name, ' ', users.last_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                               OR CONCAT(users.first_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                               OR CONCAT(users.last_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
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
                               OR CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) LIKE '%$searchTerm%'
                               OR DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%M') LIKE '%$searchTerm%' -- Search for worded months
                               OR status_name LIKE '%$searchTerm%'
                               OR amount_to_pay LIKE '%$searchTerm%')";
    }

    $totalRecordsResult = mysqli_query($connection, $totalRecordsQuery);
    $totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
    $totalRecords = $totalRecordsRow['total_records'];

    // Calculate the total number of pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Prepare the JSON response
    $response = array(
        'document_requests' => $documentRequests,
        'total_records' => $totalRecords,
        'total_pages' => $totalPages,
        'current_page' => $page
    );

    // Send the JSON response
    echo json_encode($response);
}
else {
    echo "Error executing the query: " . mysqli_error($connection);
}
?>