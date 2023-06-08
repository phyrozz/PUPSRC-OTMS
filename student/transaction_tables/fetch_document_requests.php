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

// Retrieve the document requests
$documentRequestsQuery = "SELECT request_id, office_name, request_description, scheduled_datetime, status_name, amount_to_pay
                        FROM doc_requests
                        INNER JOIN offices ON doc_requests.office_id = offices.office_id
                        INNER JOIN statuses ON doc_requests.status_id = statuses.status_id
                        WHERE user_id = " . $_SESSION['user_id'] . " AND request_description IS NOT NULL
                        ORDER BY request_id DESC
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
                          WHERE user_id = " . $_SESSION['user_id'] . " AND request_description IS NOT NULL";
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
