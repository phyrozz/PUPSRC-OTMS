<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . '/conn.php';

if (isset($_SESSION['user_id'])) {
    // Fetch notifications for the logged-in user
    $userId = $_SESSION['user_id'];

    $query = "SELECT avatar_url FROM user_details WHERE user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($avatarUrl);
    $stmt->fetch();
    $stmt->close();

    // _small thumb upload does not work on deployment env
    // $extension_pos = strrpos($avatarUrl, '.');
    // $newUrl = substr($avatarUrl, 0, $extension_pos) . '_small' . substr($avatarUrl, $extension_pos);

    // Return the URL as a JSON response
    echo json_encode(['img' => '/' . $avatarUrl]);
    $connection->close();
} else {
    echo json_encode(['error' => 'User not authenticated.']);
}
?>