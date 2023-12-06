<?php
include '../../../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the request_id from the POST data
    $request_id = isset($_POST['request_id']) ? $_POST['request_id'] : null;

    if ($request_id) {
        // Fetch the reason for cancellation from the 'appointment_facility' table
        $selectQuery = "SELECT user_reason FROM appointment_facility WHERE appointment_id = '$request_id'";
        $selectResult = mysqli_query($connection, $selectQuery);

        if ($selectResult) {
            $row = mysqli_fetch_assoc($selectResult);
            $reason = isset($row['user_reason']) ? $row['user_reason'] : 'Reason not available';

            // Return the reason for cancellation as the response
            echo $reason;
        } else {
            // Return an error response for the select query
            echo 'Error fetching reason for cancellation';
        }
    } else {
        // Return an error response if request_id is not provided
        echo 'Request ID not provided';
    }
} else {
    // Return an error response for non-POST requests
    echo 'Invalid request method';
}
?>
