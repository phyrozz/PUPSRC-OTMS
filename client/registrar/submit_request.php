<?php
session_start();
include '../../conn.php';
$user_id = $_SESSION['user_id'];
$status_id = 1;
$office_id = 3;
$date = $_SESSION['date'];
$service = $_SESSION['req_student_service'];

unset($_SESSION['date']);
unset($_SESSION['req_student_service']);

$query = "INSERT INTO doc_requests (office_id, request_description, scheduled_datetime, status_id, user_id) VALUES (?, ?, ?, ?, ?)";
$stmt = $connection->prepare($query);
$stmt->bind_param("issii", $office_id, $service, $date, $status_id, $user_id);
$stmt->execute();
$fetch_result = $stmt->get_result();

if ($fetch_result) {
    // Query executed successfully
    echo "<script>
        alert('Record inserted successfully.');
        window.location.href = '../transactions.php';
    </script>";
} else {
    // Error executing the query
    echo "<script>
        alert('Error: " . mysqli_error($connection) . "');
        window.location.href = '../transaction.php';
    </script>";
}

// echo "<script>window.location.href = 'create_request.php';</script>";
exit;
?>