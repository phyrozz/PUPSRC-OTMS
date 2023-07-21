<?php

include '../../../conn.php';

$query = "SELECT DATE_FORMAT(registrar_feedbacks.createdAt, '%M %d, %Y') as time, CONCAT(users.last_name, ', ', users.first_name) as name, feedback_text FROM registrar_feedbacks LEFT JOIN users ON users.user_id = registrar_feedbacks.user_id";
$stmt = $connection->prepare($query);
if ($stmt->execute()) {
  $result = $stmt->get_result();
  $data = $result->fetch_all(MYSQLI_ASSOC);
  echo json_encode($data);
} else {
  echo "error: database query";
}
$stmt->close();