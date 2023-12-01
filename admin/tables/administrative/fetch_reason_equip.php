<?php
include '../../../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'])) {
    $requestId = $_POST['request_id'];

    $query = "SELECT admin_reason FROM request_equipment WHERE request_id = '$requestId'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo $row['admin_reason']; //admin_reason for reason of rejection from administrative office
       
    }else {
        echo 'Error fetching purpose';
    }
} else {
    echo 'Invalid request';
}
?>