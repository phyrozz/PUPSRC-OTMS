<?php
include '../../../conn.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

$request_id = $_POST['request_id'];
$amount_to_pay = $_POST['amount_to_pay'];

$query = "UPDATE doc_requests SET amount_to_pay = ?  WHERE request_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param('ds', $amount_to_pay, $request_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false, 'error' => 'Failed to edit amount.' . $request_id ]);
}

?>