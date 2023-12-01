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
$column = isset($_POST['column']) ? $_POST['column'] : 'so_id';
$order = isset($_POST['order']) ? $_POST['order'] : 'transaction_id';

// Retrieve the document requests
$soQuery = "SELECT acad_subject_overload.transaction_id, acad_subject_overload.overload_letter, acad_subject_overload.ace_form, acad_subject_overload.cert_of_registration, acad_subject_overload.overload_letter_status, acad_subject_overload.ace_form_status, acad_subject_overload.cert_of_registration_status
FROM acad_subject_overload
WHERE user_id = " . $_SESSION['user_id'];

if (!empty($searchTerm)) {
    $soQuery .= " AND (transaction_id LIKE '%$searchTerm%'
                           OR overload_letter LIKE '%$searchTerm%'
                           OR ace_form LIKE '%$searchTerm%'
                           OR cert_of_registration LIKE '%$searchTerm%'
                           OR overload_letter_status LIKE '%$searchTerm%'
                           OR ace_form_status LIKE '%$searchTerm%'
                           OR cert_of_registration_status LIKE '%$searchTerm%')";
}

// Add the sorting parameters to the query
$soQuery .= " ORDER BY $column $order
LIMIT $startingRecord, $recordsPerPage";


$result = mysqli_query($connection, $counselingQuery);

if ($result) {
    $acad_subject_overload = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $acad_subject_overload[] = $row;
    }

    // Count the total number of records
    $totalRecordsQuery = "SELECT COUNT(*) AS total_records
                          FROM acad_subject_overload
                          WHERE user_id = " . $_SESSION['user_id'];
    $totalRecordsResult = mysqli_query($connection, $totalRecordsQuery);
    $totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
    $totalRecords = $totalRecordsRow['total_records'];

    // Calculate the total number of pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Prepare the JSON response
    $response = array(
        'acad_subject_overload' => $acad_subject_overload,
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
