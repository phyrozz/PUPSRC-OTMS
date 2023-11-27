<?php
include "conn.php";
session_start();

// Generate a CSRF token and store it in the session
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];

if (isset($_POST['studentSignup'])) {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        // Token mismatch, handle the error (e.g., log it and deny the request)
        header("Location: index.php");
        exit("CSRF token validation failed");
    }

    $studentNo = sanitizeInput($_POST['StudentNo']);
    $email = sanitizeInput($_POST['Email']);
    $lastName = sanitizeInput($_POST['LName']);
    $firstName = sanitizeInput($_POST['FName']);
    $middleName = sanitizeInput($_POST['MName']);
    $extensionName = sanitizeInput($_POST['EName']);

    // Check if the email already exists
    $checkQuery = "SELECT COUNT(*) FROM users WHERE student_no = ? OR email = ?";
    $checkStmt = $connection->prepare($checkQuery);
    $checkStmt->bind_param("ss", $studentNo, $email);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        header("Location: /login/student.php");
        $_SESSION['account_exists'] = true;
        exit();
    }
    else {
        // Retrieve the form values
        $extensionName = sanitizeInput($_POST['EName']);
        $contactNumber = sanitizeInput($_POST['ContactNumber']);
        $birthdate = sanitizeInput($_POST['Birthday']);
        $gender = sanitizeInput($_POST['Gender']);
        $address = sanitizeInput($_POST['Address']);
        $province = sanitizeInput($_POST['Province']);
        $city = sanitizeInput($_POST['City']);
        $barangay = sanitizeInput($_POST['Barangay']);
        $zipCode = sanitizeInput($_POST['ZipCode']);
        $password = sanitizeInput($_POST['Password']);
        $confirmPassword = sanitizeInput($_POST['ConfirmPassword']);
        $course = sanitizeInput($_POST['Course']);
        $yrAndSection = sanitizeInput($_POST['YearAndSection']);
        $userRole = 1;

        function validateStudentNumber($studentNo) {
            if (preg_match('/^\d{4}-\d{5}-SR-\d$/', $studentNo) && trim($studentNo) != "") {
                return true;
            } else {
                return false;
            }
        }

        function validateName($lastName, $firstName, $middleName, $extensionName) {
            $pattern = "/^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/";
        
            return trim($lastName) !== "" &&
                   preg_match($pattern, $lastName) &&
                   preg_match($pattern, $firstName) &&
                   preg_match($pattern, $middleName) &&
                   preg_match($pattern, $extensionName);
        }
        

        function validateEmail($email) {
            if (trim($email) === "") {
                return false;
            }

            if (preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
                return true;
            } else {
                return false;
            }
        }

        function validateContactNumber($contactNumber) {
            if (trim($contactNumber) === "") {
                return false;
            }

            if (preg_match("/^0\d{3}-\d{3}-\d{4}$/", $contactNumber)) {
                return true;
            } else {
                return false;
            }
        }

        function validateBirthDate($birthdate) {
            try {
                $birthdateTimestamp = strtotime($birthdate);
                $minBirthdateTimestamp = strtotime("1901-01-01");
                $currentDateTimestamp = strtotime("now");

                if (trim($birthdate) === "") {
                    return false;
                }

                if ($birthdateTimestamp >= $minBirthdateTimestamp && $birthdateTimestamp <= $currentDateTimestamp) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                return false;
            }
        }
        
        function validateAddress($address, $province, $city, $barangay, $zipCode) {
            if (trim($address) === "" || trim($province) === "" || trim($city) === "" || trim($barangay) === "") {
                return false;
            }
        
            // Validate the zip code only if it's not empty
            if (
                (trim($zipCode) === "" || preg_match('/^[0-9]{4,6}$/', $zipCode)) &&
                preg_match('/^[a-zA-ZÑñӔӕ0-9,.\- ]+$/u', $address) &&
                preg_match('/^[a-zA-ZÑñӔӕ0-9,.\- ]+$/u', $province) &&
                preg_match('/^[a-zA-ZÑñӔӕ0-9,.\- ]+$/u', $city) &&
                preg_match('/^[a-zA-ZÑñӔӕ0-9,.\- ]+$/u', $barangay)
            ) {
                return true;
            } else {
                return false;
            }
        }

        function validatePassword($password, $confirmPassword) {
            if (trim($password) === "" || trim($confirmPassword) === "") {
                return false;
            }

            if ($password == $confirmPassword) {
                if (preg_match("/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~]).{8,}$/", $password)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        function validateCourse($course) {
            if (trim($course) === "") {
                return false;
            }

            if (preg_match('/^[a-zA-ZÑñӔӕ0-9,.\- ]+$/u', $course)) {
                return true;
            } else {
                return false;
            }
        }

        function validateYearAndSection($yrAndSection) {
            if (trim($yrAndSection) === "") {
                return false;
            }

            if (preg_match('/^[a-zA-ZÑñӔӕ0-9,.\- ]+$/u', $yrAndSection)) {
                return true;
            } else {
                return false;
            }
        }

        if (
            validateStudentNumber($studentNo) &&
            validateName($lastName, $firstName, $middleName, $extensionName) &&
            validateEmail($email) && validateContactNumber($contactNumber) &&
            validateBirthDate($birthdate) &&
            validateAddress($address, $province, $city, $barangay, $zipCode) &&
            validatePassword($password, $confirmPassword) &&
            validateCourse($course) &&
            validateYearAndSection($yrAndSection)
        ) {
            // Hash the new password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (student_no, last_name, first_name, middle_name, extension_name, contact_no, email, birth_date, password, user_role)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $userDetailsQuery = "INSERT INTO user_details (sex, home_address, province, city, barangay, zip_code, course_id, year_and_section, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $crossEnrollmentQuery = "INSERT INTO acad_cross_enrollment (user_id) VALUES (?)";
            $manualEnrollmentQuery = "INSERT INTO acad_manual_enrollment (user_id) VALUES (?)";
            $gradeAccreditationQuery = "INSERT INTO acad_grade_accreditation (user_id) VALUES (?)";
            $shiftingQuery = "INSERT INTO acad_shifting (user_id) VALUES (?)";
            $subjectOverloadQuery = "INSERT INTO acad_subject_overload (user_id) VALUES (?)";
        
            $stmt = $connection->prepare($query);
            $stmt->bind_param("sssssssssi", $studentNo, $lastName, $firstName, $middleName, $extensionName, $contactNumber, $email, $birthdate, $hashedPassword, $userRole);

            // Check if all of the names match the following regex expression. If not, the query will not proceed to execute
            if ($stmt->execute()) {
                $stmt->close();
                $lastId = $connection->insert_id;
                $stmt = $connection->prepare($userDetailsQuery);
                $stmt->bind_param("isssssisi", $gender, $address, $province, $city, $barangay, $zipCode, $course, $yrAndSection, $lastId);
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

                header("Location: /login/student.php");
                $_SESSION['account_created'] = true;
            } else {
                header("Location: /login/student.php");
                $_SESSION['account_failed'] = true;
            }
        } else {
            header("Location: /login/student.php");
            $_SESSION['account_failed'] = true;
        }
    }
    $connection->close();
    exit;
}
else if (isset($_POST['clientSignup'])) {
    $email = sanitizeInput($_POST['Email']);
    $lastName = sanitizeInput($_POST['LName']);
    $firstName = sanitizeInput($_POST['FName']);
    $middleName = sanitizeInput($_POST['MName']);
    $extensionName = sanitizeInput($_POST['EName']);

    $checkQuery = "SELECT COUNT(*) FROM users WHERE email = ?";
    $checkStmt = $connection->prepare($checkQuery);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        header("Location: /login/client.php");
        $_SESSION['account_exists'] = true;
        exit();
    }
    else {
        $extensionName = sanitizeInput($_POST['EName']);
        $contactNumber = sanitizeInput($_POST['ContactNumber']);
        $birthdate = sanitizeInput($_POST['Birthday']);
        $gender = sanitizeInput($_POST['Gender']);
        $address = sanitizeInput($_POST['Address']);
        $province = sanitizeInput($_POST['Province']);
        $city = sanitizeInput($_POST['City']);
        $barangay = sanitizeInput($_POST['Barangay']);
        $zipCode = sanitizeInput($_POST['ZipCode']);
        $password = sanitizeInput($_POST['Password']);
        $confirmPassword = sanitizeInput($_POST['ConfirmPassword']);
        $userRole = 2;

        function validateName($lastName, $firstName, $middleName, $extensionName) {
            $pattern = "/^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/";
        
            return trim($lastName) !== "" &&
                   preg_match($pattern, $lastName) &&
                   preg_match($pattern, $firstName) &&
                   preg_match($pattern, $middleName) &&
                   preg_match($pattern, $extensionName);
        }

        function validateEmail($email) {
            if (trim($email) === "") {
                return false;
            }

            if (preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
                return true;
            } else {
                return false;
            }
        }

        function validateContactNumber($contactNumber) {
            if (trim($contactNumber) === "") {
                return false;
            }

            if (preg_match("/^0\d{3}-\d{3}-\d{4}$/", $contactNumber)) {
                return true;
            } else {
                return false;
            }
        }

        function validateBirthDate($birthdate) {
            try {
                $birthdateTimestamp = strtotime($birthdate);
                $minBirthdateTimestamp = strtotime("1901-01-01");
                $currentDateTimestamp = strtotime("now");

                if (trim($birthdate) === "") {
                    return false;
                }

                if ($birthdateTimestamp >= $minBirthdateTimestamp && $birthdateTimestamp <= $currentDateTimestamp) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                return false;
            }
        }
        
        function validateAddress($address, $province, $city, $barangay, $zipCode) {
            if (trim($address) === "" || trim($province) === "" || trim($city) === "" || trim($barangay) === "") {
                return false;
            }
        
            if (
                (trim($zipCode) === "" || preg_match('/^[0-9]{4,6}$/', $zipCode)) &&
                preg_match('/^[a-zA-ZÑñӔӕ0-9,.\- ]+$/u', $address) &&
                preg_match('/^[a-zA-ZÑñӔӕ0-9,.\- ]+$/u', $province) &&
                preg_match('/^[a-zA-ZÑñӔӕ0-9,.\- ]+$/u', $city) &&
                preg_match('/^[a-zA-ZÑñӔӕ0-9,.\- ]+$/u', $barangay)
            ) {
                return true;
            } else {
                return false;
            }
        }

        function validatePassword($password, $confirmPassword) {
            if (trim($password) === "" || trim($confirmPassword) === "") {
                return false;
            }

            if ($password == $confirmPassword) {
                if (preg_match("/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~]).{8,}$/", $password)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        if (
            validateName($lastName, $firstName, $middleName, $extensionName) &&
            validateEmail($email) && validateContactNumber($contactNumber) &&
            validateBirthDate($birthdate) &&
            validateAddress($address, $province, $city, $barangay, $zipCode) &&
            validatePassword($password, $confirmPassword)
        ) {
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

                header("Location: /login/client.php");
                $_SESSION['account_created'] = true;
            } else {
                header("Location: /login/client.php");
                $_SESSION['account_failed'] = true;
            }
        } else {
            header("Location: /login/client.php");
            $_SESSION['account_failed'] = true;
        }
    }
}
$connection->close();
exit;

// Function to sanitize user input
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}
?>