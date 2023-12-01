<?php
// Include the database connection file
include '../../../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    $type = $_POST['type']; // 'completionForm' or 'assessedFee'
    $status = $_POST['status'];
    $officeId = 4;

    // Set the database time zone to Asia/Manila
    $connection->query("SET time_zone = '+08:00'");

    // Update the status in the acad_grade_accreditation table based on the type
    switch ($type) {
        case 'completionForm':
            $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");            
            $title = 'Grade Accreditation Status Update';
            if ($status == 4 || $status == 5 || $status == 7 || $status == 8) {
                if ($status == 4) {
                    $description = "Your Completion Form has been verified by the office.";
                } else if ($status == 5) {
                    $description = "Your Completion Form has been rejected.";
                } else if ($status == 7) {
                    $description = "Your Completion Form requires a Face-to-face Evaluation. Please proceed to the Director's Office.";
                } else if ($status == 8) {
                    $description = "Your Completion Form has been approved.";
                }
                $stmt->bind_param('iiss', $userId, $officeId, $title, $description);
                $stmt->execute();
                $stmt->close();
            }
            
            $query = "UPDATE acad_grade_accreditation INNER JOIN users on users.user_id = acad_grade_accreditation.user_id SET completion_form_status = $status WHERE acad_grade_accreditation.user_id = '$userId'";
            break;
        case 'assessedFee':
            $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");            
            $title = 'Grade Accreditation Status Update';
            if ($status == 4 || $status == 5 || $status == 7 || $status == 8) {
                if ($status == 4) {
                    $description = "Your Assessed Fee Receipt has been verified by the office.";
                } else if ($status == 5) {
                    $description = "Your Assessed Fee Receipt has been rejected.";
                } else if ($status == 7) {
                    $description = "Your Assessed Fee Receipt requires a Face-to-face Evaluation. Please proceed to the Director's Office.";
                } else if ($status == 8) {
                    $description = "Your Assessed Fee Receipt has been approved.";
                }
                $stmt->bind_param('iiss', $userId, $officeId, $title, $description);
                $stmt->execute();
                $stmt->close();
            }
            
            $query = "UPDATE acad_grade_accreditation INNER JOIN users on users.user_id = acad_grade_accreditation.user_id SET assessed_fee_status = $status WHERE acad_grade_accreditation.user_id = '$userId'";
            break;
        case 'applicationLetter':
            $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");            
            $title = 'Cross-Enrollment Status Update';
            if ($status == 4 || $status == 5 || $status == 7 || $status == 8) {
                if ($status == 4) {
                    $description = "Your Application Letter for Cross-Enrollment has been verified by the office.";
                } else if ($status == 5) {
                    $description = "Your Application Letter for Cross-Enrollment has been rejected.";
                } else if ($status == 7) {
                    $description = "Your Application Letter for Cross-Enrollment requires a Face-to-face Evaluation. Please proceed to the Director's Office.";
                } else if ($status == 8) {
                    $description = "Your Application Letter for Cross-Enrollment has been approved.";
                }
                $stmt->bind_param('iiss', $userId, $officeId, $title, $description);
                $stmt->execute();
                $stmt->close();
            }
            
            $query = "UPDATE acad_cross_enrollment INNER JOIN users on users.user_id = acad_cross_enrollment.user_id SET application_letter_status = $status WHERE acad_cross_enrollment.user_id = '$userId'";
            break;
        case 'rZeroForm':
            $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");            
            $title = 'Manual Enrollment Status Update';
            if ($status == 4 || $status == 5 || $status == 7 || $status == 8) {
                if ($status == 4) {
                    $description = "Your R Zero Form has been verified by the office.";
                } else if ($status == 5) {
                    $description = "Your R Zero Form has been rejected.";
                } else if ($status == 7) {
                    $description = "Your R Zero Form requires a Face-to-face Evaluation. Please proceed to the Director's Office.";
                } else if ($status == 8) {
                    $description = "Your R Zero Form has been approved.";
                }
                $stmt->bind_param('iiss', $userId, $officeId, $title, $description);
                $stmt->execute();
                $stmt->close();
            }
            
            $query = "UPDATE acad_manual_enrollment INNER JOIN users on users.user_id = acad_manual_enrollment.user_id SET r_zero_form_status = $status WHERE acad_manual_enrollment.user_id = '$userId'";
            break;
        case 'requestLetter':
            $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");            
            $title = 'Academic Shifting Status Update';
            if ($status == 4 || $status == 5 || $status == 7 || $status == 8) {
                if ($status == 4) {
                    $description = "Your Request Letter has been verified by the office.";
                } else if ($status == 5) {
                    $description = "Your Request Letter has been rejected.";
                } else if ($status == 7) {
                    $description = "Your Request Letter requires a Face-to-face Evaluation. Please proceed to the Director's Office.";
                } else if ($status == 8) {
                    $description = "Your Request Letter has been approved.";
                }
                $stmt->bind_param('iiss', $userId, $officeId, $title, $description);
                $stmt->execute();
                $stmt->close();
            }
            
            $query = "UPDATE acad_shifting INNER JOIN users on users.user_id = acad_shifting.user_id SET request_letter_status = $status WHERE acad_shifting.user_id = '$userId'";
            break;
        case 'firstCtc':
            $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");            
            $title = 'Academic Shifting Status Update';
            if ($status == 4 || $status == 5 || $status == 7 || $status == 8) {
                if ($status == 4) {
                    $description = "Your Certified Copy of Grades has been verified by the office.";
                } else if ($status == 5) {
                    $description = "Your Certified Copy of Grades has been rejected.";
                } else if ($status == 7) {
                    $description = "Your Certified Copy of Grades requires a Face-to-face Evaluation. Please proceed to the Director's Office.";
                } else if ($status == 8) {
                    $description = "Your Certified Copy of Grades has been approved.";
                }
                $stmt->bind_param('iiss', $userId, $officeId, $title, $description);
                $stmt->execute();
                $stmt->close();
            }
            
            $query = "UPDATE acad_shifting INNER JOIN users on users.user_id = acad_shifting.user_id SET first_ctc_status = $status WHERE acad_shifting.user_id = '$userId'";
            break;
        case 'secondCtc':
            $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");            
            $title = 'Academic Shifting Status Update';
            if ($status == 4 || $status == 5 || $status == 7 || $status == 8) {
                if ($status == 4) {
                    $description = "Your Certified Copy of Grades (Office copy) has been verified by the office.";
                } else if ($status == 5) {
                    $description = "Your Certified Copy of Grades (Office copy) has been rejected.";
                } else if ($status == 7) {
                    $description = "Your Certified Copy of Grades (Office copy) requires a Face-to-face Evaluation. Please proceed to the Director's Office.";
                } else if ($status == 8) {
                    $description = "Your Certified Copy of Grades (Office copy) has been approved.";
                }
                $stmt->bind_param('iiss', $userId, $officeId, $title, $description);
                $stmt->execute();
                $stmt->close();
            }
            
            $query = "UPDATE acad_shifting INNER JOIN users on users.user_id = acad_shifting.user_id SET second_ctc_status = $status WHERE acad_shifting.user_id = '$userId'";
            break;
        case 'overloadLetter':
            $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");            
            $title = 'Subject Overload Status Update';
            if ($status == 4 || $status == 5 || $status == 7 || $status == 8) {
                if ($status == 4) {
                    $description = "Your Request Letter for Overload has been verified by the office.";
                } else if ($status == 5) {
                    $description = "Your Request Letter for Overload has been rejected.";
                } else if ($status == 7) {
                    $description = "Your Request Letter for Overload requires a Face-to-face Evaluation. Please proceed to the Director's Office.";
                } else if ($status == 8) {
                    $description = "Your Request Letter for Overload has been approved.";
                }
                $stmt->bind_param('iiss', $userId, $officeId, $title, $description);
                $stmt->execute();
                $stmt->close();
            }
            $query = "UPDATE acad_subject_overload INNER JOIN users on users.user_id = acad_subject_overload.user_id SET overload_letter_status = $status WHERE acad_subject_overload.user_id = '$userId'";
            break;
        case 'aceForm':
            $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");            
            $title = 'Subject Overload Status Update';
            if ($status == 4 || $status == 5 || $status == 7 || $status == 8) {
                if ($status == 4) {
                    $description = "Your ACE Form has been verified by the office.";
                } else if ($status == 5) {
                    $description = "Your ACE Form has been rejected.";
                } else if ($status == 7) {
                    $description = "Your ACE Form requires a Face-to-face Evaluation. Please proceed to the Director's Office.";
                } else if ($status == 8) {
                    $description = "Your ACE Form has been approved.";
                }
                $stmt->bind_param('iiss', $userId, $officeId, $title, $description);
                $stmt->execute();
                $stmt->close();
            }
            
            $query = "UPDATE acad_subject_overload INNER JOIN users on users.user_id = acad_subject_overload.user_id SET ace_form_status = $status WHERE acad_subject_overload.user_id = '$userId'";
            break;
        case 'certOfRegistration':
            $stmt = $connection->prepare("INSERT INTO notifications (user_id, office_id, title, description, timestamp) VALUES (?, ?, ?, ?, NOW())");            
            $title = 'Subject Overload Status Update';
            if ($status == 4 || $status == 5 || $status == 7 || $status == 8) {
                if ($status == 4) {
                    $description = "Your Certificate of Registration has been verified by the office.";
                } else if ($status == 5) {
                    $description = "Your Certificate of Registration has been rejected.";
                } else if ($status == 7) {
                    $description = "Your Certificate of Registration requires a Face-to-face Evaluation. Please proceed to the Director's Office.";
                } else if ($status == 8) {
                    $description = "Your Certificate of Registration has been approved.";
                }
                $stmt->bind_param('iiss', $userId, $officeId, $title, $description);
                $stmt->execute();
                $stmt->close();
            }
            
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