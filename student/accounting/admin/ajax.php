<?php
// Include the database connection file
include 'db_connect.php';

// Check if the AJAX request is valid
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Handle different AJAX actions
    switch ($action) {
        case 'savePayment':
            savePayment();
            break;
        // Add more cases for other AJAX actions if needed

        default:
            // Invalid AJAX action
            echo "Invalid action.";
            break;
    }
}

// Function to save payment details
function savePayment() {
    // Retrieve payment data from the AJAX request
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $studentNumber = $_POST['studentNumber'];
    $amount = $_POST['amount'];
    $course = $_POST['course'];
    $documentType = $_POST['documentType'];
    // Process the data and perform database operations
    // Insert the payment details into the database

    // Example query: Inserting data into the "users" table
    $sql = "INSERT INTO users (name, surname, student_number, amount, course, document_type) VALUES ('$name', '$surname', '$studentNumber', '$amount', '$course', '$documentType')";

    if ($conn->query($sql) === TRUE) {
        // Success message or any additional processing

        // Return a success response to the AJAX request
        echo "success";
    } else {
        // Error message or error handling

        // Return an error response to the AJAX request
        echo "error";
    }
}

// Add more functions for other AJAX actions if needed

?>
