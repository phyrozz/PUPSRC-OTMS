<?php
include "../../../conn.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

$studentIds = $_POST['student_record_ids'];

$placeholders = implode(',', array_fill(0, count($studentIds), '?'));
$sql = "DELETE FROM student_record WHERE student_record_id IN ($placeholders)";
$stmt = $connection->prepare($sql);

$types = str_repeat('s', count($studentIds));
$stmt->bind_param($types, ...$studentIds);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to delete student(s).']);
}

$stmt->close();
$connection->close();
?>
