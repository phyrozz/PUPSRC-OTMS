<?php
session_start();
include '../conn.php'; // Include your database connection

if (isset($_POST['notificationId']) && isset($_SESSION['user_id'])) {
    $notificationId = $_POST['notificationId'];
    $userId = $_SESSION['user_id'];

    // Update the notification in the database
    $query = "UPDATE notifications SET is_read = 1 WHERE notification_id = ? AND user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ii", $notificationId, $userId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Fetch and return updated unread count
        $query = "SELECT COUNT(*) AS unreadCount FROM notifications WHERE user_id = ? AND is_read = 0";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $unreadCount = $result->fetch_assoc()['unreadCount'];

        echo json_encode(['success' => true, 'unreadCount' => $unreadCount]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
