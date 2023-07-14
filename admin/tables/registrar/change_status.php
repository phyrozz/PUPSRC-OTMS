<?php
include '../../../conn.php';
header('Content-Type: application/json');
$data = array(); // Create an array to hold the response data
$data = json_decode(file_get_contents('php://input'), true);

$query = "UPDATE reg_transaction SET status_id = ? WHERE reg_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("ii", $data['statusId'], $data['regId']);

if ($stmt->execute()) {
  $data['success'] = true;
  $data['statusId'] = $data['statusId'];
  $data['regId'] = $data['regId'];
} else {
  $data['success'] = false;
  $data['error'] = $stmt->error;
}

echo json_encode($data);

$stmt->close();
$connection->close();