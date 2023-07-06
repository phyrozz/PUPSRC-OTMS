<?php
include "../conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $editLastName = $_POST["editLastName"];
    $editFirstName = $_POST["editFirstName"];
    $editMiddleName = $_POST["editMiddleName"];
    $editExtensionName = $_POST["editExtensionName"];
    $editContactNo = $_POST["editContactNumber"];
    $editEmail = $_POST["editEmail"];
    // Add more variables for other form fields

    // Update the user details in the database
    $updateQuery = "UPDATE users SET last_name = ?, first_name = ?, middle_name = ?, extension_name = ?, contact_no = ?, email = ? WHERE user_id = ?";

    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param("ssssssi", $editLastName, $editFirstName, $editMiddleName, $editExtensionName, $editContactNo, $editEmail, $_SESSION['user_id']);
    $stmt->execute();
    $stmt->close();
    $connection->close();

    $response = array("status" => "success", "message" => "User details updated successfully");
    echo json_encode($response);
    exit;
}

// Send an error response if the request method is not POST
$response = array("status" => "error", "message" => "Invalid request method");
echo json_encode($response);
exit;
?>
