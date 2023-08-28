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
$column = isset($_POST['column']) ? $_POST['column'] : 'payment_id';
$order = isset($_POST['order']) ? $_POST['order'] : 'desc';

// Retrieve the document requests
$paymentsQuery = "SELECT payment_id, course, documentType, transaction_date, status
                        FROM student_info
                        WHERE studentNumber = '" . $_SESSION['student_no'] . "'";

if (!empty($searchTerm)) {
    $paymentsQuery .= " AND (payment_id LIKE '%$searchTerm%'
                           OR course LIKE '%$searchTerm%'
                           OR documentType LIKE '%$searchTerm%'
                           OR referenceNumber LIKE '%$searchTerm%'
                           OR status LIKE '%$searchTerm%'
                           OR amount LIKE '%$searchTerm%')";
}

// Add the sorting parameters to the query
$paymentsQuery .= " ORDER BY $column $order
LIMIT $startingRecord, $recordsPerPage";


$result = mysqli_query($connection, $paymentsQuery);

if ($result) {
    $payments = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $payments[] = $row;
    }

    // Count the total number of records
    $totalRecordsQuery = "SELECT COUNT(*) AS total_records
                          FROM student_info
                          WHERE studentNumber = '" . $_SESSION['student_no'] . "'";
    if (!empty($searchTerm)) {
        $totalRecordsQuery .= " AND (payment_id LIKE '%$searchTerm%'
                            OR course LIKE '%$searchTerm%'
                            OR documentType LIKE '%$searchTerm%'
                            OR referenceNumber LIKE '%$searchTerm%'
                            OR status LIKE '%$searchTerm%'
                            OR amount LIKE '%$searchTerm%')";
    }
    $totalRecordsQuery .= " ORDER BY $column $order
    LIMIT $startingRecord, $recordsPerPage";

    $totalRecordsResult = mysqli_query($connection, $totalRecordsQuery);
    $totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
    $totalRecords = $totalRecordsRow['total_records'];

    // Calculate the total number of pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Prepare the JSON response
    $response = array(
        'payments' => $payments,
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
