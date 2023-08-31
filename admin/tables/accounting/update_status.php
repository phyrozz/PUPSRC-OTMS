<?php
include '../../../conn.php';

// Get the payment ID and the new status from the AJAX request
$paymentId = $_POST['paymentId'];
$newStatus = $_POST['status'];

// Update the status in the database for the specified payment ID
$sql = "UPDATE student_info SET status = '$newStatus' WHERE payment_id = '$paymentId'";

if ($connection->query($sql) === TRUE) {
    echo "Status updated successfully";
} else {
    echo "Error updating status: " . $connection->error;
}

$connection->close();
?>