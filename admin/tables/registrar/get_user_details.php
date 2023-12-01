<?php
include "../../../conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    $query = "SELECT student_no, last_name, first_name, middle_name, extension_name, contact_no, email, DATE_FORMAT(birth_date, '%M %e, %Y') AS formatted_birth_date,
                user_details.sex, user_details.home_address, user_details.province, user_details.city, user_details.barangay, 
                user_details.zip_code, user_details.year_and_section, user_roles.user_role_id, courses.course
                FROM users 
                INNER JOIN user_details ON users.user_id = user_details.user_id
                INNER JOIN courses ON user_details.course_id = courses.course_id
                INNER JOIN user_roles ON users.user_role = user_roles.user_role_id
                WHERE users.user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $request = $result->fetch_assoc();
    $stmt->close();

    echo json_encode($request);
} else {
    echo "Invalid request";
}
?>
