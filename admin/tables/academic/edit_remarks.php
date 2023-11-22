<?php
include "../../../conn.php";

$userId = sanitizeInput($_POST["user_id"]);
$service = sanitizeInput($_POST["service_name"]);

try {
    switch ($service) {
        case "so":
            $stmt = $connection->prepare("SELECT so_remarks FROM acad_subject_overload WHERE user_id = ?");
            break;
        case "ga":
            $stmt = $connection->prepare("SELECT ga_remarks FROM acad_grade_accreditation WHERE user_id = ?");
            break;
        case "me":
            $stmt = $connection->prepare("SELECT me_remarks FROM acad_manual_enrollment WHERE user_id = ?");
            break;
        case "ce":
            $stmt = $connection->prepare("SELECT ce_remarks FROM acad_cross_enrollment WHERE user_id = ?");
            break;
        case "s":
            $stmt = $connection->prepare("SELECT s_remarks FROM acad_shifting WHERE user_id = ?");
            break;
        default:
            echo "Invalid request.";
            exit;
    }
    $stmt->bind_param("i", $userId);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $remarksData = $result->fetch_assoc();

        echo json_encode($remarksData);
    } else {
        echo json_encode(['message' => 'Error occurred while editing remarks.']);
    }
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['message' => 'Error occurred while editing remarks.']);
}

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}
?>