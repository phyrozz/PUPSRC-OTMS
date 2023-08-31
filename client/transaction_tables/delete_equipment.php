<?php
include '../../conn.php';

session_start();

// Check if the request_ids are provided
$requestIds = $_POST['request_id'];

// Prepare and execute the SQL query to retrieve the statuses and equipment details of the document requests
$placeholders = implode(',', array_fill(0, count($requestIds), '?'));
$sql = "SELECT request_equipment.status_id, request_equipment.quantity_equip, request_equipment.equipment_id, equipment.quantity
        FROM request_equipment
        INNER JOIN equipment ON request_equipment.equipment_id = equipment.equipment_id
        WHERE request_equipment.request_id IN ($placeholders)";
$stmt = $connection->prepare($sql);

// Bind parameters dynamically based on the number of request IDs
$types = str_repeat('s', count($requestIds));
$stmt->bind_param($types, ...$requestIds);
$stmt->execute();

// Fetch the statuses and equipment details of the document requests
$result = $stmt->get_result();
$statuses = [];
$equipmentUpdates = [];
while ($row = $result->fetch_assoc()) {
    $statuses[] = $row['status_id'];

    // If the status is "Pending" or "Rejected", add the equipment quantity to the update array
    if ($row['status_id'] == 1 || $row['status_id'] == 6) {
        $equipmentUpdates[$row['equipment_id']] = $row['quantity_equip'];
    }
}

// Check if all the statuses are either "Pending" or "Rejected"
if (array_diff($statuses, [1, 6]) === []) {
    // Start a database transaction
    $connection->begin_transaction();

    // // Prepare and execute the SQL query to update the equipment quantities and availability
    // $sqlUpdate = "UPDATE equipment SET quantity = quantity + ?, availability = IF(quantity + ? > 0, 'Available', 'Unavailable') WHERE equipment_id = ?";
    // $stmtUpdate = $connection->prepare($sqlUpdate);

    // // Iterate over the equipment updates and execute the update query
    // foreach ($equipmentUpdates as $equipmentId => $quantity) {
    //     $stmtUpdate->bind_param('iii', $quantity, $quantity, $equipmentId);
    //     $stmtUpdate->execute();
    //     if ($stmtUpdate->affected_rows <= 0) {
    //         // If the update fails, roll back the transaction and return an error response
    //         $connection->rollback();
    //         echo json_encode(['success' => false, 'error' => 'Failed to update equipment quantity.']);
    //         exit;
    //     }
    // }

    // Prepare and execute the SQL query to delete the document requests
    $placeholders = implode(',', array_fill(0, count($requestIds), '?'));
    $sqlDelete = "DELETE FROM request_equipment WHERE request_id IN ($placeholders)";
    $stmtDelete = $connection->prepare($sqlDelete);

    // Bind parameters dynamically based on the number of request IDs
    $types = str_repeat('s', count($requestIds));
    $stmtDelete->bind_param($types, ...$requestIds);
    $stmtDelete->execute();

    // Check if the deletion was successful
    if ($stmtDelete->affected_rows > 0) {
        // Commit the transaction and return a response indicating the success of the deletion
        $connection->commit();
        echo json_encode(['success' => true]);
    } else {
        // If the deletion fails, roll back the transaction and return an error response
        $connection->rollback();
        echo json_encode(['success' => false, 'error' => 'Failed to delete the document request.']);
    }
} else {
    // Return a response indicating that the deletion cannot proceed due to conflicting statuses
    echo json_encode(['success' => false, 'error' => 'Cannot delete the document request. Conflicting statuses exist.']);
}

// Close the statements and the database connection
$stmt->close();
$stmtUpdate->close();
$stmtDelete->close();
$connection->close();
?>
