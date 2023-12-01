<?php
include '../../../conn.php';

session_start();

// Retrieve the document requests
$subjectOverloadQuery = "SELECT transaction_id, overload_letter, ace_form, cert_of_registration, overload_letter_status, ace_form_status, cert_of_registration_status
                        FROM acad_subject_overload
                        WHERE user_id = " . $_SESSION['user_id'];
$gradeAccreditationQuery = "SELECT transaction_id, completion_form, assessed_fee, completion_form_status, assessed_fee_status
                        FROM acad_grade_accreditation
                        WHERE user_id = " . $_SESSION['user_id'];
$crossEnrollmentQuery = "SELECT transaction_id, application_letter, application_letter_status
                        FROM acad_cross_enrollment
                        WHERE user_id = " . $_SESSION['user_id'];
$shiftingQuery = "SELECT transaction_id, request_letter, first_ctc, second_ctc, request_letter_status, first_ctc_status, second_ctc_status
                        FROM acad_shifting
                        WHERE user_id = " . $_SESSION['user_id'];
$manualEnrollmentQuery = "SELECT transaction_id, r_zero_form, r_zero_form_status
                        FROM acad_manual_enrollment
                        WHERE user_id = " . $_SESSION['user_id'];

$subjectOverloadResult = mysqli_query($connection, $subjectOverloadQuery);
$gradeAccreditationResult = mysqli_query($connection, $gradeAccreditationQuery);
$crossEnrollmentResult = mysqli_query($connection, $crossEnrollmentQuery);
$shiftingResult = mysqli_query($connection, $shiftingQuery);
$manualEnrollmentResult = mysqli_query($connection, $manualEnrollmentQuery);

if ($subjectOverloadResult && $gradeAccreditationResult && $crossEnrollmentResult && $shiftingResult && $manualEnrollmentResult) {
    $so_requirements = array();
    while ($row = mysqli_fetch_assoc($subjectOverloadResult)) {
        $so_requirements[] = $row;
    }

    $ga_requirements = array();
    while ($row = mysqli_fetch_assoc($gradeAccreditationResult)) {
        $ga_requirements[] = $row;
    }
    
    $ce_requirements = array();
    while ($row = mysqli_fetch_assoc($crossEnrollmentResult)) {
        $ce_requirements[] = $row;
    }

    $s_requirements = array();
    while ($row = mysqli_fetch_assoc($shiftingResult)) {
        $s_requirements[] = $row;
    }

    $me_requirements = array();
    while ($row = mysqli_fetch_assoc($manualEnrollmentResult)) {
        $me_requirements[] = $row;
    }

    // Prepare the JSON response
    $response = array(
        'so_requirements' => $so_requirements,
        'ga_requirements' => $ga_requirements,
        'ce_requirements' => $ce_requirements,
        's_requirements' => $s_requirements,
        'me_requirements' => $me_requirements,
    );

    // Send the JSON response
    echo json_encode($response);
} else {
    echo "Error executing the query: " . mysqli_error($connection);
}
?>
