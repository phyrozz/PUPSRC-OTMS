<?php
include '../../../conn.php';

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

// Retrieve the request_equipment requests
$requestQuery = "SELECT request_id, datetime_schedule, CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) AS formatted_request_id, quantity_equip, purpose, status_name, equipment_name,
                 users.first_name, users.last_name, users.middle_name, users.extension_name, user_roles.role
                 FROM request_equipment
                 INNER JOIN users ON request_equipment.user_id = users.user_id
                 INNER JOIN user_roles ON users.user_role = user_roles.user_role_id
                 INNER JOIN statuses ON request_equipment.status_id = statuses.status_id
                 INNER JOIN equipment ON request_equipment.equipment_id = equipment.equipment_id
                 AND is_archived = 0";

if (!empty($searchTerm)) {
    $requestQuery .= " AND (request_id LIKE '%$searchTerm%'
                           OR users.first_name LIKE '%$searchTerm%'
                           OR users.last_name LIKE '%$searchTerm%'
                           OR users.middle_name LIKE '%$searchTerm%'
                           OR users.extension_name LIKE '%$searchTerm%'
                           OR user_roles.role LIKE '%$searchTerm%'
                            -- CONCAT name and equipment name combinations
                           OR CONCAT(users.last_name, ' ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', equipment.equipment_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', equipment.equipment_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name, ' ', equipment.equipment_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', equipment.equipment_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.last_name, ' ', equipment.equipment_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', equipment.equipment_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.last_name, ' ', equipment.equipment_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           -- CONCAT name and status_name combinations
                           OR CONCAT(users.last_name, ' ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.last_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.last_name, ' ', statuses.status_name) LIKE '%$searchTerm%'

                           OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name) LIKE '%$searchTerm%'
                           OR CONCAT(users.first_name, ' ', users.last_name, ' ', users.extension_name) LIKE '%$searchTerm%'
                           OR CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) LIKE '%$searchTerm%'
                           OR DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%M') LIKE '%$searchTerm%' -- Search for worded months
                           OR quantity_equip LIKE '%$searchTerm%'
                           OR datetime_schedule LIKE '%$searchTerm%'
                           OR equipment_name LIKE '%$searchTerm%')";
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
                          WHERE datetime_schedule IS NOT NULL";
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