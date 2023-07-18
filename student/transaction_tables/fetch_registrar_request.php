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
$column = isset($_POST['column']) ? $_POST['column'] : 'reg_id';
$order = isset($_POST['order']) ? $_POST['order'] : 'asc';

// Retrieve the document requests
$registrarRequestsQuery = "SELECT * FROM reg_transaction
                        INNER JOIN users ON reg_transaction.user_id = users.user_id
                        INNER JOIN offices ON reg_transaction.office_id = offices.office_id
                        INNER JOIN reg_services ON reg_transaction.services_id = reg_services.services_id
                        INNER JOIN statuses ON reg_transaction.status_id = statuses.status_id
                        WHERE users.user_id = " . $_SESSION['user_id'] . "";

if (!empty($searchTerm)) {
    $registrarRequestsQuery .= " AND (request_code LIKE '%$searchTerm%'
                           OR office_name LIKE '%$searchTerm%'
                           OR services LIKE '%$searchTerm%'
                           OR scheduled LIKE '%$searchTerm%'
                           OR status_name LIKE '%$searchTerm%')";
}

// Add the sorting parameters to the query
$registrarRequestsQuery .= " ORDER BY $column $order
LIMIT $startingRecord, $recordsPerPage";


$result = mysqli_query($connection, $registrarRequestsQuery);

if ($result) {
    $registrarRequests = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $registrarRequests[] = $row;
    }

    // Count the total number of records
    $totalRecordsQuery = "SELECT COUNT(*) AS total_records
                          FROM reg_transaction
                          WHERE user_id = " . $_SESSION['user_id'] . "";
    $totalRecordsResult = mysqli_query($connection, $totalRecordsQuery);
    $totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
    $totalRecords = $totalRecordsRow['total_records'];

    // Calculate the total number of pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Prepare the JSON response
    $response = array(
        'registrar_requests' => $registrarRequests,
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