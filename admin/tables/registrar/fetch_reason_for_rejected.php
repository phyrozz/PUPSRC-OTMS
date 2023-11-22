<?php
include '../../../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'])) {
    $requestId = $_POST['request_id'];

    $query = "SELECT request_letter FROM doc_requests WHERE request_id = '$requestId'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo $row['request_letter']; //request letter for reason of rejection from registrar office
    } else {
        echo 'Error fetching purpose';
    }
} else {
    echo 'Invalid request';
}
?>