<?php
include "conn.php";
session_start();

if (isset($_POST['studentSignup'])) {
    $studentNo = $_POST['StudentNo'];
    $email = $_POST['Email'];
    $lastName = $_POST['LName'];
    $firstName = $_POST['FName'];
    $middleName = $_POST['MName'];

    // Check if the email already exists
    $checkQuery = "SELECT COUNT(*) FROM users WHERE student_no = ? OR email = ? OR (first_name = ? AND last_name = ? AND middle_name = ?)";
    $checkStmt = $connection->prepare($checkQuery);
    $checkStmt->bind_param("sssss", $studentNo, $email, $firstName, $lastName, $middleName);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        header("Location: http://192.168.100.4/login/student.php");
        $_SESSION['account_exists'] = true;
        exit();
    }
    else {
        // Retrieve the form values
        $extensionName = $_POST['EName'];
        $contactNumber = $_POST['ContactNumber'];
        $birthdate = $_POST['Birthday'];
        $gender = $_POST['Gender'];
        $address = $_POST['Address'];
        $province = $_POST['Province'];
        $city = $_POST['City'];
        $barangay = $_POST['Barangay'];
        $zipCode = $_POST['ZipCode'];
        $password = $_POST['Password'];
        $course = $_POST['Course'];
        $userRole = 1;

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (student_no, last_name, first_name, middle_name, extension_name, contact_no, email, birth_date, password, user_role)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $userDetailsQuery = "INSERT INTO user_details (sex, home_address, province, city, barangay, zip_code, course_id, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $crossEnrollmentQuery = "INSERT INTO acad_cross_enrollment (user_id) VALUES (?)";
        $manualEnrollmentQuery = "INSERT INTO acad_manual_enrollment (user_id) VALUES (?)";
        $gradeAccreditationQuery = "INSERT INTO acad_grade_accreditation (user_id) VALUES (?)";
        $shiftingQuery = "INSERT INTO acad_shifting (user_id) VALUES (?)";
        $subjectOverloadQuery = "INSERT INTO acad_subject_overload (user_id) VALUES (?)";
    
        $stmt = $connection->prepare($query);
        $stmt->bind_param("sssssssssi", $studentNo, $lastName, $firstName, $middleName, $extensionName, $contactNumber, $email, $birthdate, $hashedPassword, $userRole);

        if ($stmt->execute()) {
            $stmt->close();
            $lastId = $connection->insert_id;
            $stmt = $connection->prepare($userDetailsQuery);
            $stmt->bind_param("isssssii", $gender, $address, $province, $city, $barangay, $zipCode, $course, $lastId);
            $stmt->execute();
            $stmt->close();

            // Insert initial value queries on all academic services
            $stmt = $connection->prepare($crossEnrollmentQuery);
            $stmt->bind_param("i", $lastId);
            $stmt->execute();
            $stmt->close();
            $stmt = $connection->prepare($manualEnrollmentQuery);
            $stmt->bind_param("i", $lastId);
            $stmt->execute();
            $stmt->close();
            $stmt = $connection->prepare($gradeAccreditationQuery);
            $stmt->bind_param("i", $lastId);
            $stmt->execute();
            $stmt->close();
            $stmt = $connection->prepare($shiftingQuery);
            $stmt->bind_param("i", $lastId);
            $stmt->execute();
            $stmt->close();
            $stmt = $connection->prepare($subjectOverloadQuery);
            $stmt->bind_param("i", $lastId);
            $stmt->execute();
            $stmt->close();

            header("Location: http://192.168.100.4/login/student.php");
            $_SESSION['account_created'] = true;
        } 
        else {
            header("Location: http://192.168.100.4/login/student.php");
            $_SESSION['account_failed'] = true;
        }
        $connection->close();
    }
}
else if (isset($_POST['clientSignup'])) {
    $email = $_POST['Email'];
    $lastName = $_POST['LName'];
    $firstName = $_POST['FName'];
    $middleName = $_POST['MName'];

    $checkQuery = "SELECT COUNT(*) FROM users WHERE email = ? OR (first_name = ? AND last_name = ? AND middle_name = ?)";
    $checkStmt = $connection->prepare($checkQuery);
    $checkStmt->bind_param("ssss", $email, $firstName, $lastName, $middleName);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        header("Location: http://192.168.100.4/login/client.php");
        $_SESSION['account_exists'] = true;
        exit();
    }
    else {
        $extensionName = $_POST['EName'];
        $contactNumber = $_POST['ContactNumber'];
        $birthdate = $_POST['Birthday'];
        $gender = $_POST['Gender'];
        $address = $_POST['Address'];
        $province = $_POST['Province'];
        $city = $_POST['City'];
        $barangay = $_POST['Barangay'];
        $zipCode = $_POST['ZipCode'];
        $password = $_POST['Password'];
        $userRole = 2;

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (last_name, first_name, middle_name, extension_name, contact_no, email, birth_date, password, user_role)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $userDetailsQuery = "INSERT INTO user_details (sex, home_address, province, city, barangay, zip_code, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ssssssssi", $lastName, $firstName, $middleName, $extensionName, $contactNumber, $email, $birthdate, $hashedPassword, $userRole);

        if ($stmt->execute()) {
            $stmt->close();
            $lastId = $connection->insert_id;
            $stmt = $connection->prepare($userDetailsQuery);
            $stmt->bind_param("isssssi", $gender, $address, $province, $city, $barangay, $zipCode, $lastId);
            $stmt->execute();
            $stmt->close();
            header("Location: http://192.168.100.4/login/client.php");
            $_SESSION['account_created'] = true;
        } 
        else {
            header("Location: http://192.168.100.4/login/client.php");
            $_SESSION['account_failed'] = true;
        }
    }
}
$connection->close();
exit();
?>