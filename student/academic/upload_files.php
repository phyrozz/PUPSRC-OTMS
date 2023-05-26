<?php
// Include the connectToDatabase.php script
require_once('connect_uploaddb.php');

// Check if a file was uploaded successfully
if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
  // Retrieve the temporary file name
  $tmpName = $_FILES['image']['tmp_name'];

  // Read the file content
  $imageData = file_get_contents($tmpName);

  // Prepare the SQL statement
  $stmt = $conn->prepare('INSERT INTO images (name, image) VALUES (?, ?)');
  $stmt->bind_param('ss', $_FILES['image']['name'], $imageData);

  // Execute the statement
  if ($stmt->execute()) {
    echo 'Image uploaded successfully.';
  } else {
    echo 'Error uploading image.';
  }

  // Close the statement
  $stmt->close();
} else {
  echo 'Error uploading image.';
}

// Close the database connection
$conn->close();
?>


<?php

error_reporting(0);

?>

<?php

    $db = mysqli_connect("localhost", "root", "", "acadoffice"); 

        // query to insert the submitted data

        $sql = "INSERT INTO image (filename) VALUES ('$filename')";

        // function to execute above query

        mysqli_query($db, $sql);       

        // Add the image to the "image" folder"

        if (move_uploaded_file($tempname, $folder)) {

            $msg = "Image uploaded successfully";

        }else{

            $msg = "Failed to upload image";

    }



$result = mysqli_query($db, "SELECT * FROM image");

?>