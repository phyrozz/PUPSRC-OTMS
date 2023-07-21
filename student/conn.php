<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "otms_db";

// Create connection
$connect = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Escape user input to prevent SQL injection
    $rating = $connect->real_escape_string($_POST["rating"]);
    $suggestions = $connect->real_escape_string($_POST["suggestions"]);

    $sql = "INSERT INTO acad_survey (rating, suggestions) VALUES ('$rating', '$suggestions')";

    if ($connect->query($sql) === true) {
        // Success! Redirect to "transactions.php"
        header("Location: transactions.php");
        exit; // Make sure to exit after the redirect
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}

$connect->close();
?>