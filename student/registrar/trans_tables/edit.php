<?php
include '../../../conn.php';
session_start();
$user_id = $_SESSION['user_id'];
$id = $_POST['id'];
$request = $_POST['request'];
$date = $_POST['date'];

// Perform the database update
// Replace "your_db_name", "your_table_name", "your_username", "your_password" with the appropriate values
$query_check =  mysqli_query($connection, "SELECT * FROM reg_transaction WHERE user_id = '$user_id' AND services_id = '$request' AND status_id = '1' AND schedule = '$date'");
if(mysqli_num_rows($query_check) > 0) {
    // Data is redundant
    $table = 'edit_table';
    echo '<script type="text/javascript">'; 
    echo 'alert("You Already Requested Same Service!");'; echo 'window.location.href = "../your_transaction.php";';
    echo '</script>';
} else {
$connection = new PDO("mysql:host=localhost;dbname=otms_db", "root", "");
$query = "UPDATE reg_transaction SET services_id = :request, schedule = :date WHERE reg_id = :id";
$statement = $connection->prepare($query);
$statement->bindParam(':request', $request);
$statement->bindParam(':date', $date);
$statement->bindParam(':id', $id);
$statement->execute();
$table = 'edit_table';
header("Location: ../your_transaction.php?param=" . urlencode($table));
exit();
}

unset($_POST)
?>