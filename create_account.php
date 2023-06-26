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
        header("Location: http://localhost/login/student.php");
        // $loginMessage = "An account already exists with the information you provided.";
        // exit();
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
        $userRole = 1;

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (student_no, last_name, first_name, middle_name, extension_name, contact_no, email, birth_date, password, user_role)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $connection->prepare($query);
        $stmt->bind_param("sssssssssi", $studentNo, $lastName, $firstName, $middleName, $extensionName, $contactNumber, $email, $birthdate, $hashedPassword, $userRole);

        if ($stmt->execute()) {
            // $stmt->close();
            // $checkUserId = "SELECT user_id FROM users WHERE email = ?";
            // $checkUserIdstmt = $connection->prepare($checkUserId);
            // $checkUserIdstmt->bind_param("s", $email);
            // $checkUserIdstmt->execute();
            // $checkUserIdstmt->bind_result($userId);
            // $checkUserIdstmt->fetch();
            // $checkUserIdstmt->close();

            // $studentsQuery = "INSERT INTO students (users_id, student_no) VALUES (?, ?)";
            // $studentsStmt = $connection->prepare($studentsQuery);
            // $studentsStmt->bind_param("is", $userId, $studentNo);
            // $studentsStmt->close();
            header("Location: http://localhost/login/student.php");
            $_SESSION['account_created'] = true;
        } 
        else {
            header("Location: http://localhost/index.php");
            // $loginMessage = "Sign up failed. Please try again.";
        }
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
        header("Location: http://localhost/login/client.php");
        // $loginMessage = "An account already exists with the information you provided.";
        // exit();
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
    
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ssssssssi", $lastName, $firstName, $middleName, $extensionName, $contactNumber, $email, $birthdate, $hashedPassword, $userRole);

        if ($stmt->execute()) {
            header("Location: http://localhost/login/client.php");
            $_SESSION['account_created'] = true;
        } 
        else {
            header("Location: http://localhost/index.php");
            // $loginMessage = "Sign up failed. Please try again.";
        }
    }
}
$connection->close();
exit();
?>