<?php
// Function to establish database connection
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'dfdf';

  // Create a new mysqli connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check the connection
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  /// Check if a file was uploaded successfully
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
  $tmpName = $_FILES['image']['tmp_name'];
  $imageData = file_get_contents($tmpName);

  $stmt = $conn->prepare('INSERT INTO images (name, image) VALUES (?, ?)');
  $stmt->bind_param('ss', $_FILES['image']['name'], $imageData);

  if ($stmt->execute()) {
    echo 'Image uploaded successfully.';
  } else {
    echo 'Error uploading image.';
  }

  $stmt->close();
} else {
  echo 'Error uploading image.';
}

$conn->close();
?>
