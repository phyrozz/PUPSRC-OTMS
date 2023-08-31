<?php
session_start();
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES['profile_picture'])) {
        $targetDir = "assets/uploads/profile_pictures/";
        $targetFile = $targetDir . basename($_FILES['profile_picture']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES['profile_picture']['tmp_name']);
        if ($check === false) {
            $uploadOk = 0;
        }

        if ($uploadOk) {
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {
                $user_id = $_SESSION['user_id'];
                $newImagePath = $targetFile;
                $query = "UPDATE user_details SET avatar_url = ? WHERE user_id = ?";
                $stmt = $connection->prepare($query);
                $stmt->bind_param("si", $newImagePath, $user_id);
                if ($stmt->execute()) {
                    echo "Profile picture uploaded successfully.";
                } else {
                    echo "Error updating profile picture.";
                }
                $stmt->close();
            } else {
                echo "Error uploading profile picture.";
            }
        } else {
            echo "Invalid image file.";
        }
    } else {
        echo "No profile picture uploaded.";
    }
} else {
    echo "Invalid request method.";
}
$connection->close();
?>
