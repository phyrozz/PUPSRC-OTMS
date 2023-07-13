<?php
include '../../../conn.php';

$query = "SELECT reg_transaction.reg_id as reg_id, users.user_id as user_id, offices.office_name, users.user_id AS code, CONCAT(users.first_name, ' ', users.last_name) AS name, user_roles.role as scholar_status, statuses.status_name, reg_services.services, schedule FROM reg_transaction LEFT JOIN offices ON reg_transaction.office_id = offices.office_id LEFT JOIN reg_services ON reg_services.services_id = reg_transaction.services_id LEFT JOIN statuses ON statuses.status_id = reg_transaction.status_id LEFT JOIN users ON users.user_id = reg_transaction.user_id LEFT JOIN user_roles ON users.user_role = user_roles.user_role_id";
$stmt = $connection->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$connection->close();

echo json_encode($data);