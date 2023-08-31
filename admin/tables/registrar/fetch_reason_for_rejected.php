<?php
include '../../../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'])) {
    $requestId = $_POST['request_id'];

    $query = "SELECT purpose FROM doc_requests WHERE request_id = '$requestId'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo $row['purpose'];
    } else {
        echo 'Error fetching purpose';
    }
} else {
    echo 'Invalid request';
}
?>