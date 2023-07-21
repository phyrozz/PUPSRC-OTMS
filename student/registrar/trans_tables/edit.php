<?php
include '../../../conn.php';
session_start();
$user_id = $_SESSION['user_id'];
$id = $_POST['id'];
$request = $_POST['request'];
$date = $_POST['date'];

// Perform the database update
// Replace "your_db_name", "your_table_name", "your_username", "your_password" with the appropriate values
$query_check = mysqli_query($connection, "SELECT * FROM doc_requests WHERE request_id = '$user_id' AND request_description = '$request' AND status_id = '1' AND scheduled_datetime = '$date'");

if (mysqli_num_rows($query_check) > 0) {
    // Data is redundant
    $table = 'edit_table';
    echo '<script type="text/javascript">';
    echo 'alert("You Already Requested Same Service!");';
    echo 'window.location.href = "../your_transaction.php";';
    echo '</script>';
} else {
    $connection = new PDO("mysql:host=192.168.84.183;dbname=otms_db", "root", "");
    $query = "UPDATE doc_requests SET request_description = :request, scheduled_datetime = :date WHERE request_id = :id";
    $statement = $connection->prepare($query);
    $statement->bindValue(':request', $request, PDO::PARAM_STR);
    $statement->bindValue(':date', $date, PDO::PARAM_STR);
    $statement->bindValue(':id', $id, PDO::PARAM_STR);
    $statement->execute();
    $table = 'edit_table';
    header("Location: ../your_transaction.php?param=" . urlencode($table));
    exit();
}

unset($_POST);
?>