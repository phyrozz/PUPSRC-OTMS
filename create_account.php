<?php
    include "conn.php";

    if (isset($_POST['signup'])) {
        $studentNo = $_POST['StudentNo'];

        // Check if the email already exists
        $checkQuery = "SELECT COUNT(*) FROM students WHERE student_no = ?";
        $checkStmt = $connection->prepare($checkQuery);
        $checkStmt->bind_param("s", $studentNo);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            echo '<div class="modal fade" id="failedModal" tabindex="-1" aria-labelledby="failedModalLabel" aria-hidden="true">';
            echo '    <div class="modal-dialog">';
            echo '        <div class="modal-content">';
            echo '            <div class="modal-header">';
            echo '                <h5 class="modal-title" id="failedModalLabel">Success</h5>';
            echo '                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '            </div>';
            echo '            <div class="modal-body">';
            echo '                <p>Your account has been created successfully.</p>';
            echo '            </div>';
            echo '            <div class="modal-footer">';
            echo '                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
            echo '            </div>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
            
            echo '<script>';
            echo '    $(document).ready(function() {';
            echo '        $("#failedModal").modal("show");';
            echo '    });';
            echo '</script>';
        }
        else {
            // Retrieve the form values
            $lastName = $_POST['LName'];
            $firstName = $_POST['FName'];
            $middleName = $_POST['MName'];
            $extensionName = $_POST['EName'];
            $contactNumber = $_POST['ContactNumber'];
            $birthdate = $_POST['Birthday'];
            $gender = $_POST['Gender'];
            $address = $_POST['Address'];
            $province = $_POST['Province'];
            $city = $_POST['City'];
            $barangay = $_POST['Barangay'];
            $zipCode = $_POST['ZipCode'];
            $email = $_POST['Email'];
            $password = $_POST['Password'];
            $userRole = 1;

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (last_name, first_name, middle_name, extension_name, contact_no, email, password, user_role)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
            $stmt = $connection->prepare($query);
            $stmt->bind_param("sssssssi", $lastName, $firstName, $middleName, $extensionName, $contactNumber, $email, $hashedPassword, $userRole);

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
                header("Location: ../index.php");
            } 
            else {
                header("Location: ../index.php");
            }
        }

        $connection->close();
        exit();
    }
?>