<?php
include '../../../conn.php';

session_start();

// Retrieve the page number from the AJAX request
$page = isset($_POST['page']) ? $_POST['page'] : 1;

// Define the numeber of records per page
$recordsPerPage = 20;

// Calculate the starting record for the requested page
$startingRecord = ($page - 1) * $recordsPerPage;
$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

// Retrieve the sorting parameters from the AJAX request
$column = isset($_POST['column']) ? $_POST['column'] : 'payment_id';
$order = isset($_POST['order']) ? $_POST['order'] : 'asc';

// Retrieve the document requests
$paymentsQuery = "SELECT payment_id, CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(payment_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) AS formatted_payment_id, firstName, lastName, middleName,
                        documentType, referenceNumber, course, amount, image_url, transaction_date, studentNumber, status
                        FROM student_info
                        WHERE documentType != 'Hotdog'";
                        

if (!empty($searchTerm)) {
    $paymentsQuery .= " AND (payment_id LIKE '%$searchTerm%'
                        OR firstName LIKE '%$searchTerm%'
                        OR middleName LIKE '%$searchTerm%'
                        OR lastName LIKE '%$searchTerm%'
                        OR documentType LIKE '%$searchTerm%'
                        OR referenceNumber LIKE '%$searchTerm%'
                        OR amount LIKE '%$searchTerm%'
                        OR status LIKE '%$searchTerm%'
                        -- CONCAT name and request_description combinations
                        OR CONCAT(lastName, ', ', firstName, ' ', middleName, ' ', documentType) LIKE '%$searchTerm%'
                        OR CONCAT(firstName, ' ', middleName, ' ', lastName, ' ', documentType) LIKE '%$searchTerm%'
                        OR CONCAT(firstName, ' ', lastName, ' ', documentType) LIKE '%$searchTerm%'
                        OR CONCAT(firstName, ' ', documentType) LIKE '%$searchTerm%'
                        OR CONCAT(lastName, ' ', documentType) LIKE '%$searchTerm%'
                        OR CONCAT(lastName, ', ', firstName, ' ', documentType) LIKE '%$searchTerm%'
                        OR CONCAT(lastName, ', ', firstName, ' ', middleName, ' ', documentType) LIKE '%$searchTerm%'
                        OR CONCAT(DATE_FORMAT(transaction_date, '%c/%e/%Y, %h:%i:%s %p')) LIKE '%$searchTerm%'
                        OR DATE_FORMAT(transaction_date, '%M') LIKE '%$searchTerm%')"; // Corrected closing parenthesis position
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
                        WHERE documentType != 'Hotdog'";
    if (!empty($searchTerm)) {
        $totalRecordsQuery .= " AND (payment_id LIKE '%$searchTerm%'
                            OR firstName LIKE '%$searchTerm%'
                            OR middleName LIKE '%$searchTerm%'
                            OR lastName LIKE '%$searchTerm%'
                            OR documentType LIKE '%$searchTerm%'
                            OR referenceNumber LIKE '%$searchTerm%'
                            OR amount LIKE '%$searchTerm%'
                            OR status LIKE '%$searchTerm%'
                            -- CONCAT name and request_description combinations
                            OR CONCAT(lastName, ', ', firstName, ' ', middleName, ' ', documentType) LIKE '%$searchTerm%'
                            OR CONCAT(firstName, ' ', middleName, ' ', lastName, ' ', documentType) LIKE '%$searchTerm%'
                            OR CONCAT(firstName, ' ', lastName, ' ', documentType) LIKE '%$searchTerm%'
                            OR CONCAT(firstName, ' ', documentType) LIKE '%$searchTerm%'
                            OR CONCAT(lastName, ' ', documentType) LIKE '%$searchTerm%'
                            OR CONCAT(lastName, ', ', firstName, ' ', documentType) LIKE '%$searchTerm%'
                            OR CONCAT(lastName, ', ', firstName, ' ', middleName, ' ', documentType) LIKE '%$searchTerm%'
                            OR CONCAT(DATE_FORMAT(transaction_date, '%c/%e/%Y, %h:%i:%s %p')) LIKE '%$searchTerm%'
                            OR DATE_FORMAT(transaction_date, '%M') LIKE '%$searchTerm%')"; // Corrected closing parenthesis position
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
}
else {
    echo "Error executing the query: " . mysqli_error($connection);
}
?>
