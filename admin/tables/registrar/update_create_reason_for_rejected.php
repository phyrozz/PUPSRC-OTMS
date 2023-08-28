<?php 
include '../../../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'])) {
    $requestId = $_POST['request_id'];
    $office = $_POST['office'];
    $reason = $_POST['reason'];

    $query = "UPDATE doc_requests SET purpose = '$reason' WHERE request_id = '$requestId'";
    $result = mysqli_query($connection, $query);
    // Check if the update was successful
    if ($result) {
        echo json_encode(array('status' => 'success', 'message' => 'Purpose updated successfully.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating purpose.'));
    }
}else {
    echo "Invalid request";
}

?>