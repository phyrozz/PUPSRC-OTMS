<?php
include "../../../conn.php";

$userId = isset($_POST["user_id"]) ? sanitizeInput($_POST["user_id"]) : null;
$service = isset($_POST["service_name"]) ? sanitizeInput($_POST["service_name"]) : null;
$noteText = isset($_POST["note_text"]) ? sanitizeInput($_POST["note_text"]) : null;

try {
    switch ($service) {
        case "so":
            $stmt = $connection->prepare("UPDATE acad_subject_overload SET note = ? WHERE user_id = ?");
            break;
        case "ga":
            $stmt = $connection->prepare("UPDATE acad_grade_accreditation SET note = ? WHERE user_id = ?");
            break;
        case "me":
            $stmt = $connection->prepare("UPDATE acad_manual_enrollment SET note = ? WHERE user_id = ?");
            break;
        case "ce":
            $stmt = $connection->prepare("UPDATE acad_cross_enrollment SET note = ? WHERE user_id = ?");
            break;
        case "s":
            $stmt = $connection->prepare("UPDATE acad_shifting SET note = ? WHERE user_id = ?");
            break;
        default:
            echo "Invalid request.";
            exit;
    }
    $stmt->bind_param("si", $noteText, $userId);
    
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Note updated successfully.']);
    } else {
        echo json_encode(['message' => 'Error occurred while editing note.']);
    }
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['message' => 'Error occurred while editing note.']);
}

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}
?>