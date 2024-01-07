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
$order = isset($_POST['order']) ? $_POST['order'] : 'desc';

// Retrieve the request_equipment requests
$requestQuery = "SELECT request_id, datetime_schedule, quantity_equip, status_name, equipment_name, slip_content
                        FROM request_equipment
                        INNER JOIN statuses ON request_equipment.status_id = statuses.status_id
                        INNER JOIN equipment ON request_equipment.equipment_id = equipment.equipment_id
                        WHERE user_id = '" .  $_SESSION['user_id'] . "'";

if (!empty($searchTerm)) {
    $requestQuery .= " AND (request_id LIKE '%$searchTerm%'
                           OR quantity_equip LIKE '%$searchTerm%'
                           OR datetime_schedule LIKE '%$searchTerm%'
                           OR equipment_name LIKE '%$searchTerm%'
                           OR slip_content LIKE '%$searchTerm%')";
}

// Add the sorting parameters to the query
$requestQuery .= " ORDER BY $column $order
LIMIT $startingRecord, $recordsPerPage";


$result = mysqli_query($connection, $requestQuery);

if ($result) {
    $requestEquipment = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $requestEquipment[] = $row;
    }

    // Count the total number of records
    $totalRecordsQuery = "SELECT COUNT(*) AS total_records
                          FROM request_equipment
                          WHERE user_id = '" .  $_SESSION['user_id'] . "'";
    $totalRecordsResult = mysqli_query($connection, $totalRecordsQuery);
    $totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
    $totalRecords = $totalRecordsRow['total_records'];

    // Calculate the total number of pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Prepare the JSON response
    $response = array(
        'request_equip' => $requestEquipment,
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
