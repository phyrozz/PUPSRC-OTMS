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
$column = isset($_POST['column']) ? $_POST['column'] : 'payment_id';
$order = isset($_POST['order']) ? $_POST['order'] : 'asc';

// Retrieve the document requests
$offsettingsQuery = "SELECT offsetting_id, CONCAT(DATE_FORMAT(offsettingtb.timestamp, '%c/%e/%Y, %h:%i %p')) AS formatted_timestamp, users.first_name, users.last_name, users.middle_name, users.extension_name, 
                        amountToOffset, offsetType, statuses.status_name
                        FROM offsettingtb
                        INNER JOIN users ON users.user_id = offsettingtb.user_id
                        INNER JOIN statuses ON statuses.status_id = offsettingtb.status_id";
                        

if (!empty($searchTerm)) {
    $offsettingsQuery .= " AND (offsetting_id LIKE '%$searchTerm%'
                        OR DATE_FORMAT(timestamp, '%M %e, %Y %l:%i %p') LIKE '%$searchTerm%'
                        OR users.first_name LIKE '%$searchTerm%'
                        OR users.last_name LIKE '%$searchTerm%'
                        OR users.middle_name LIKE '%$searchTerm%'
                        OR users.extension_name LIKE '%$searchTerm%'
                        OR amountToOffset LIKE '%$searchTerm%'
                        OR offsetType LIKE '%$searchTerm%'
                        OR statuses.status_name LIKE '%$searchTerm%')";
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
                        INNER JOIN users ON users.user_id = offsettingtb.user_id
                        INNER JOIN statuses ON statuses.status_id = offsettingtb.status_id";
    if (!empty($searchTerm)) {
        $totalRecordsQuery .= " AND (offsetting_id LIKE '%$searchTerm%'
                            OR DATE_FORMAT(timestamp, '%M %e, %Y %l:%i %p') LIKE '%$searchTerm%'
                            OR users.first_name LIKE '%$searchTerm%'
                            OR users.last_name LIKE '%$searchTerm%'
                            OR users.middle_name LIKE '%$searchTerm%'
                            OR users.extension_name LIKE '%$searchTerm%'
                            OR amountToOffset LIKE '%$searchTerm%'
                            OR offsetType LIKE '%$searchTerm%'
                            OR statuses.status_name LIKE '%$searchTerm%')";
                            
    }

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
}
else {
    echo "Error executing the query: " . mysqli_error($connection);
}
?>
