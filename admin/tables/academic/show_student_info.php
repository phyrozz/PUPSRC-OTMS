<?php
include "../../../conn.php";

$userId = sanitizeInput($_POST["user_id"]);

try {
    $stmt = $connection->prepare("SELECT student_no, last_name, first_name, middle_name, extension_name, contact_no, email, courses.course as course, user_details.year_and_section as year_and_section FROM users 
    INNER JOIN user_details ON users.user_id = user_details.user_id INNER JOIN courses ON user_details.course_id = courses.course_id 
    WHERE users.user_id = ?");
    $stmt->bind_param("i", $userId);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $studentInfo = $result->fetch_assoc();

        echo json_encode($studentInfo);
    } else {
        echo json_encode(['message' => 'Error occurred while retrieving student info.']);
    }
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['message' => 'Error occurred while retrieving student info.']);
}

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}
?>