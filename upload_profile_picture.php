<?php
session_start();
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES['profile_picture'])) {
        // File size limit: 8 MB
        $maxFileSize = 8 * 1024 * 1024;

        $targetDir = "assets/uploads/profile_pictures/";
        $targetFile = $targetDir . basename($_FILES['profile_picture']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES['profile_picture']['size'] > $maxFileSize) {
            echo "File size exceeds the limit of 8 MB.";
            $uploadOk = 0;
        }

        $check = getimagesize($_FILES['profile_picture']['tmp_name']);
        if ($check === false) {
            $uploadOk = 0;
        }

        if ($uploadOk) {
            $compressedImage = compressImage($_FILES['profile_picture']['tmp_name'], 90); // Adjust the quality as needed

            if (imagejpeg($compressedImage, $targetFile)) {
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

                // Commented out the implementation of a smaller copy of profile image because it doesn't work on deployment environment

                // // Rescale the image for the profile icon while maintaining aspect ratio
                // $smallIconPath = $targetDir . basename($_FILES['profile_picture']['name']);
                // $extension_pos = strrpos($smallIconPath, '.'); // find position of the last dot, so where the extension starts
                // $newPath = substr($smallIconPath, 0, $extension_pos) . '_small' . substr($smallIconPath, $extension_pos);
                // $uploadedImage = imagecreatefromjpeg($_FILES['profile_picture']['tmp_name']);
                // $smallIconImage = imagescale($uploadedImage, 100, -1, IMG_BICUBIC);
                // imagejpeg($smallIconImage, $newPath);
                // imagedestroy($smallIconImage);
            } else {
                echo "Error uploading profile picture.";
            }

            // Free up memory by destroying the compressed image resource
            imagedestroy($compressedImage);
            // imagedestroy($uploadedImage);
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

// Function to compress an image
function compressImage($sourcePath, $quality) {
    $sourceImage = imagecreatefromjpeg($sourcePath);
    $compressedImage = imagecreatetruecolor(imagesx($sourceImage), imagesy($sourceImage));
    imagecopyresampled($compressedImage, $sourceImage, 0, 0, 0, 0, imagesx($sourceImage), imagesy($sourceImage), imagesx($sourceImage), imagesy($sourceImage));
    ob_start();
    imagejpeg($compressedImage, null, $quality);
    $compressedImageData = ob_get_contents();
    ob_end_clean();
    imagedestroy($sourceImage);
    imagedestroy($compressedImage);
    return imagecreatefromstring($compressedImageData);
}
?>
