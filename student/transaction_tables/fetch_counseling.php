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
$column = isset($_POST['column']) ? $_POST['column'] : 'counseling_id';
$order = isset($_POST['order']) ? $_POST['order'] : 'desc';

// Retrieve the document requests
$counselingQuery = "SELECT counseling_schedules.counseling_id, counseling_schedules.appointment_description, counseling_schedules.comments, doc_requests.scheduled_datetime, statuses.status_name
FROM counseling_schedules
INNER JOIN doc_requests ON counseling_schedules.doc_requests_id = doc_requests.request_id
INNER JOIN offices ON doc_requests.office_id = offices.office_id
INNER JOIN statuses ON doc_requests.status_id = statuses.status_id
WHERE user_id = " . $_SESSION['user_id'];

if (!empty($searchTerm)) {
    $counselingQuery .= " AND (counseling_id LIKE '%$searchTerm%'
                           OR appointment_description LIKE '%$searchTerm%'
                           OR scheduled_datetime LIKE '%$searchTerm%'
                           OR status_name LIKE '%$searchTerm%')";
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
                          FROM doc_requests
                          WHERE user_id = " . $_SESSION['user_id'] . " AND request_description = 'Guidance Counseling'";
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
