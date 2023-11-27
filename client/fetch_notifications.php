<?php
session_start();
include '../conn.php';

if (isset($_SESSION['user_id'])) {
    // Fetch notifications for the logged-in user
    $userId = $_SESSION['user_id'];

    $query = "SELECT notification_id, office_name, title, description, DATE_FORMAT(timestamp, '%M %e, %Y, %h:%i %p') as timestamp, is_read FROM notifications
            INNER JOIN offices ON notifications.office_id = offices.office_id
            WHERE user_id = ? AND is_read = 0 ORDER BY timestamp DESC";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $notifications = [];
    $unreadCount = 0;

    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
        if (!$row['is_read']) {
            $unreadCount++;
        }
    }

    // Return the notifications and unread count as JSON
    echo json_encode(['notifications' => $notifications, 'unreadCount' => $unreadCount]);
} else {
    echo json_encode(['error' => 'User not authenticated.']);
}
?>
