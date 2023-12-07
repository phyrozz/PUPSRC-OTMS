<?php
include '../../conn.php';

session_start();

// Retrieve the page number from the AJAX request
$page = isset($_POST['page']) ? $_POST['page'] : 1;

// Define the number of records per page
$recordsPerPage = 10;

// Calculate the starting record for the requested page
$startingRecord = ($page - 1) * $recordsPerPage;
$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

// Retrieve the sorting parameters from the AJAX request
$column = isset($_POST['column']) ? $_POST['column'] : 'request_id';
$order = isset($_POST['order']) ? $_POST['order'] : 'asc';

// Retrieve the document requests
$documentRequestsQuery = "SELECT request_id, office_name, request_description, scheduled_datetime, status_name, amount_to_pay, purpose
                        FROM doc_requests
                        INNER JOIN offices ON doc_requests.office_id = offices.office_id
                        INNER JOIN statuses ON doc_requests.status_id = statuses.status_id
                        WHERE user_id = " . $_SESSION['user_id'] . " AND request_description != 'Guidance Counseling'";

if (!empty($searchTerm)) {
    $documentRequestsQuery .= " AND (request_id LIKE '%$searchTerm%'
                           OR office_name LIKE '%$searchTerm%'
                           OR request_description LIKE '%$searchTerm%'
                           OR scheduled_datetime LIKE '%$searchTerm%'
                           OR status_name LIKE '%$searchTerm%'
                           OR amount_to_pay LIKE '%$searchTerm%'
                           OR purpose LIKE '%$searchTerm%'
                           OR CONCAT(offices.office_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(statuses.status_name, ' ', offices.office_name) LIKE '%$searchTerm%')";
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
                          INNER JOIN offices ON doc_requests.office_id = offices.office_id
                          INNER JOIN statuses ON doc_requests.status_id = statuses.status_id
                          WHERE user_id = " . $_SESSION['user_id'] . " AND request_description != 'Guidance Counseling'";
    if (!empty($searchTerm)) {
        $documentRequestsQuery .= " AND (request_id LIKE '%$searchTerm%'
                               OR office_name LIKE '%$searchTerm%'
                               OR request_description LIKE '%$searchTerm%'
                               OR scheduled_datetime LIKE '%$searchTerm%'
                               OR status_name LIKE '%$searchTerm%'
                               OR amount_to_pay LIKE '%$searchTerm%'
                               OR purpose LIKE '%$searchTerm%'
                               OR CONCAT(offices.office_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                               OR CONCAT(statuses.status_name, ' ', offices.office_name) LIKE '%$searchTerm%')";
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
} else {
    echo "Error executing the query: " . mysqli_error($connection);
}
?>
