<?php
include '../../../conn.php'; // Replace with the correct path

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $requestIds = $_POST['requestIds'];

    // Generate placeholders for the IN clause
    $placeholders = implode(',', array_fill(0, count($requestIds), '?'));

    $query = "SELECT quantity_equip, equipment_id FROM request_equipment WHERE request_id IN ($placeholders)";
    $stmt = $connection->prepare($query);
    
    // Bind parameters for the placeholders
    $stmt->bind_param(str_repeat('s', count($requestIds)), ...$requestIds);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $equipmentId = $row['equipment_id'];
            $quantityToDeduct = $row['quantity_equip'];

            // Update the equipment quantity in the database using prepared statement
            $updateQuery = "UPDATE equipment SET quantity = quantity - ? WHERE equipment_id = ?";
            $updateStmt = $connection->prepare($updateQuery);
            $updateStmt->bind_param("ii", $quantityToDeduct, $equipmentId);

            if ($updateStmt->execute()) {
                // Quantity deducted successfully
            
                // Fetch the updated quantity after deduction
                $updatedQuantityQuery = "SELECT quantity FROM equipment WHERE equipment_id = ?";
                $updatedQuantityStmt = $connection->prepare($updatedQuantityQuery);
                $updatedQuantityStmt->bind_param("i", $equipmentId);
                $updatedQuantityStmt->execute();
                $updatedQuantityResult = $updatedQuantityStmt->get_result();
            
                if ($updatedQuantityResult && $updatedQuantityResult->num_rows > 0) {
                    $updatedRow = $updatedQuantityResult->fetch_assoc();
                    $updatedQuantity = $updatedRow['quantity'];
            
                    // Check if the updated quantity becomes zero, update availability to 'Unavailable'
                    if ($updatedQuantity <= 0) {
                        $updateAvailabilityQuery = "UPDATE equipment SET availability = 'Unavailable' WHERE equipment_id = ?";
                        $updateAvailabilityStmt = $connection->prepare($updateAvailabilityQuery);
                        $updateAvailabilityStmt->bind_param("i", $equipmentId);
                        $updateAvailabilityStmt->execute();
                        $updateAvailabilityStmt->close();
                    }
                }
            
                $updatedQuantityStmt->close();
            } else {
                // Error occurred while updating quantity
                echo "Error: " . $updateStmt->error;
            }
            $updateStmt->close();
        }
    }

    $stmt->close();

    // Close the database connection
    $connection->close();
}
?>
