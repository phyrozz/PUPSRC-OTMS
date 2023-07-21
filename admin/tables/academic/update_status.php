<?php
// Include the database connection file
include '../../../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    $type = $_POST['type']; // 'completionForm' or 'assessedFee'
    $status = $_POST['status'];

    // Update the status in the acad_grade_accreditation table based on the type
    switch ($type) {
        case 'completionForm':
            $query = "UPDATE acad_grade_accreditation INNER JOIN users on users.user_id = acad_grade_accreditation.user_id SET completion_form_status = $status WHERE acad_grade_accreditation.user_id = '$userId'";
            break;
        case 'assessedFee':
            $query = "UPDATE acad_grade_accreditation INNER JOIN users on users.user_id = acad_grade_accreditation.user_id SET assessed_fee_status = $status WHERE acad_grade_accreditation.user_id = '$userId'";
            break;
        case 'applicationLetter':
            $query = "UPDATE acad_cross_enrollment INNER JOIN users on users.user_id = acad_cross_enrollment.user_id SET application_letter_status = $status WHERE acad_cross_enrollment.user_id = '$userId'";
            break;
        case 'rZeroForm':
            $query = "UPDATE acad_manual_enrollment INNER JOIN users on users.user_id = acad_manual_enrollment.user_id SET r_zero_form_status = $status WHERE acad_manual_enrollment.user_id = '$userId'";
            break;
        case 'requestLetter':
            $query = "UPDATE acad_shifting INNER JOIN users on users.user_id = acad_shifting.user_id SET request_letter_status = $status WHERE acad_shifting.user_id = '$userId'";
            break;
        case 'firstCtc':
            $query = "UPDATE acad_shifting INNER JOIN users on users.user_id = acad_shifting.user_id SET first_ctc_status = $status WHERE acad_shifting.user_id = '$userId'";
            break;
        case 'secondCtc':
            $query = "UPDATE acad_shifting INNER JOIN users on users.user_id = acad_shifting.user_id SET second_ctc_status = $status WHERE acad_shifting.user_id = '$userId'";
            break;
        case 'overloadLetter';
            $query = "UPDATE acad_subject_overload INNER JOIN users on users.user_id = acad_subject_overload.user_id SET overload_letter_status = $status WHERE acad_subject_overload.user_id = '$userId'";
            break;
        case 'aceForm';
            $query = "UPDATE acad_subject_overload INNER JOIN users on users.user_id = acad_subject_overload.user_id SET ace_form_status = $status WHERE acad_subject_overload.user_id = '$userId'";
            break;
        case 'certOfRegistration';
            $query = "UPDATE acad_subject_overload INNER JOIN users on users.user_id = acad_subject_overload.user_id SET cert_of_registration_status = $status WHERE acad_subject_overload.user_id = '$userId'";
            break;
        default:
            echo 'Invalid type.';
            exit;
            break;

    }

    if ($connection->query($query) === TRUE) {
        echo 'Status updated successfully.';
    } else {
        echo 'Error updating status: ' . $connection->error;
    }
} else {
    echo 'Invalid request.';
}
?>