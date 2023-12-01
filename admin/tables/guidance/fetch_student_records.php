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
$column = isset($_POST['column']) ? $_POST['column'] : 'request_id';
$order = isset($_POST['order']) ? $_POST['order'] : 'asc';

// Retrieve the document requests
$query = "SELECT student_record_id, name, year, shelf_location, courses.course AS course_name
                        FROM student_record
                        INNER JOIN courses ON student_record.course_id = courses.course_id";

if (!empty($searchTerm)) {
    $query .= " AND (name LIKE '%$searchTerm%'
                                OR courses.course LIKE '%$searchTerm%'
                                OR year LIKE '%$searchTerm%'
                                OR shelf_location LIKE '%$searchTerm%')";
}

// Add the sorting parameters to the query
$query .= " ORDER BY $column $order
LIMIT $startingRecord, $recordsPerPage";

$result = mysqli_query($connection, $query);

if ($result) {
    $students = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $students[] = $row;
    }

    // Count the total number of records
    $totalRecordsQuery = "SELECT COUNT(*) AS total_records
                          FROM student_record
                          INNER JOIN courses ON student_record.course_id = courses.course_id";

    if (!empty($searchTerm)) {
        $totalRecordsQuery .= " AND (name LIKE '%$searchTerm%'
                                OR courses.course LIKE '%$searchTerm%'
                                OR year LIKE '%$searchTerm%'
                                OR shelf_location LIKE '%$searchTerm%')";
    }

    $totalRecordsResult = mysqli_query($connection, $totalRecordsQuery);
    $totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
    $totalRecords = $totalRecordsRow['total_records'];

    // Calculate the total number of pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Prepare the JSON response
    $response = array(
        'students' => $students,
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
