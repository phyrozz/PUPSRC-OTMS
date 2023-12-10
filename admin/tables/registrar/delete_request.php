<?php
include '../../../conn.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

$request_id = $_POST['request_id'];

$query = "DELETE FROM doc_requests WHERE request_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param('s', $request_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false, 'error' => 'Failed to delete student(s).' . $request_id ]);
}

?>