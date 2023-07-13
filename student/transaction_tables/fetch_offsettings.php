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
$column = isset($_POST['column']) ? $_POST['column'] : 'request_id';
$order = isset($_POST['order']) ? $_POST['order'] : 'asc';

// Retrieve the document requests
$offsettingsQuery = "SELECT offsetting_id, amountToOffset, offsetType, timestamp, statuses.status_name
                        FROM offsettingtb
                        INNER JOIN statuses ON offsettingtb.status_id = statuses.status_id
                        WHERE user_id = " . $_SESSION['user_id'];

if (!empty($searchTerm)) {
    $offsettingsQuery .= " AND (offsetting_id LIKE '%$searchTerm%'
                           OR amountToOffset LIKE '%$searchTerm%'
                           OR offsetType LIKE '%$searchTerm%'
                           OR status_id LIKE '%$searchTerm%'
                           OR offsettingtb.timestamp LIKE '%$searchTerm%')";
}

// Add the sorting parameters to the query
$offsettingsQuery .= " ORDER BY $column $order
LIMIT $startingRecord, $recordsPerPage";


$result = mysqli_query($connection, $offsettingsQuery);

if ($result) {
    $offsettings = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $offsettings[] = $row;
    }

    // Count the total number of records
    $totalRecordsQuery = "SELECT COUNT(*) AS total_records
                          FROM offsettingtb
                          INNER JOIN statuses ON offsettingtb.status_id = statuses.status_id
                          WHERE user_id = " . $_SESSION['user_id'];
    $totalRecordsResult = mysqli_query($connection, $totalRecordsQuery);
    $totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
    $totalRecords = $totalRecordsRow['total_records'];

    // Calculate the total number of pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Prepare the JSON response
    $response = array(
        'offsettings' => $offsettings,
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
