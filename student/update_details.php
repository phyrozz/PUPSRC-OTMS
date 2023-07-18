<?php
include "../conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $editLastName = $_POST["editLastName"];
    $editFirstName = $_POST["editFirstName"];
    $editMiddleName = $_POST["editMiddleName"];
    $editExtensionName = $_POST["editExtensionName"];
    $editContactNo = $_POST["editContactNumber"];
    $editBirthDate = $_POST['editBirthDate'];
    $editCourse = $_POST["editCourse"];
    $editYearAndSection = $_POST["editLevelAndSection"];
    // Add more variables for other form fields

    // Update the user details in the database
    $updateQuery = "UPDATE users
                    INNER JOIN user_details ON users.user_id = user_details.user_id
                    SET users.last_name = ?, users.first_name = ?, users.middle_name = ?, users.extension_name = ?, users.contact_no = ?, users.birth_date = ?, user_details.course_id = ?, user_details.year_and_section = ?
                    WHERE users.user_id = ?";

    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param("ssssssisi", $editLastName, $editFirstName, $editMiddleName, $editExtensionName, $editContactNo, $editBirthDate, $editCourse, $editYearAndSection, $_SESSION['user_id']);
    $stmt->execute();
    $stmt->close();
    $connection->close();

    // Update the user session variables to update the navbar
    $_SESSION['last_name'] = $editLastName;
    $_SESSION['first_name'] = $editFirstName;
    $_SESSION['extension_name'] = $editExtensionName;

    $response = array("status" => "success", "message" => "User details updated successfully");
    echo json_encode($response);
    exit;
}

// Send an error response if the request method is not POST
$response = array("status" => "error", "message" => "Invalid request method");
echo json_encode($response);
exit;
?>
