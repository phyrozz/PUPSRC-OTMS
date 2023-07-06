<?php
session_start();
include '../../conn.php';
$user_id = $_SESSION['user_id'];
$status_id = 1;
$office_id = 3;
$date = $_SESSION['date'];
$services_id = $_SESSION['req_student_service'];

unset($_SESSION['date']);
unset($_SESSION['req_student_service']);

$query = "INSERT INTO reg_transaction (office_id, services_id, schedule, status_id, user_id) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "iisii", $office_id, $services_id, $date, $status_id, $user_id);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    // Query executed successfully
    echo "<script>alert(Record inserted successfully.);</script>";
} else {
    // Error executing the query
    echo "<script>alert('Error: " . mysqli_error($connection) . "')</script>";
}

// echo "<script>window.location.href = 'create_request.php';</script>";
exit;
?>