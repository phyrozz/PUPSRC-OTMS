<?php
include '../../conn.php';
include '../functions.php';

session_start();

$academicTransactions = "SELECT a.subject_overload, a.grade_accreditation, a.cross_enrollment, a.shifting, a.manual_enrollment, 
                        subject_overload.status_name AS subject_overload_status, 
                        grade_accreditation.status_name AS grade_accreditation_status, 
                        cross_enrollment.status_name AS cross_enrollment_status, 
                        shifting.status_name AS shifting_status, 
                        manual_enrollment.status_name AS manual_enrollment_status
                        FROM academic_transactions AS a
                        LEFT JOIN academic_statuses AS subject_overload ON a.subject_overload = subject_overload.academic_status_id
                        LEFT JOIN academic_statuses AS grade_accreditation ON a.grade_accreditation = grade_accreditation.academic_status_id
                        LEFT JOIN academic_statuses AS cross_enrollment ON a.cross_enrollment = cross_enrollment.academic_status_id
                        LEFT JOIN academic_statuses AS shifting ON a.shifting = shifting.academic_status_id
                        LEFT JOIN academic_statuses AS manual_enrollment ON a.manual_enrollment = manual_enrollment.academic_status_id
                        WHERE user_id = " . $_SESSION['user_id'];

$result = mysqli_query($connection, $academicTransactions);

if ($result) {
    $academicTransactions = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $academicTransactions[] = $row;
    }

    // Prepare the JSON response
    $response = array(
        'academic_transactions' => $academicTransactions,
    );

    // Send the JSON response
    echo json_encode($response);
} else {
    echo "Error executing the query: " . mysqli_error($connection);
}
?>
