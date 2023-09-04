<?php
include "conn.php";
session_start();

if (isset($_POST['studentSignup'])) {
    $studentNo = sanitizeInput($_POST['StudentNo']);
    $email = sanitizeInput($_POST['Email']);
    $lastName = sanitizeInput($_POST['LName']);
    $firstName = sanitizeInput($_POST['FName']);
    $middleName = sanitizeInput($_POST['MName']);
    $extensionName = sanitizeInput($_POST['EName']);

    // Check if the email already exists
    $checkQuery = "SELECT COUNT(*) FROM users WHERE student_no = ? AND user_role = 1";
    $checkStmt = $connection->prepare($checkQuery);
    $checkStmt->bind_param("s", $studentNo);
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
            if (trim($lastName) === "" || trim($firstName) === "") {
                return false;
            }

            if (
                preg_match("/^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/", $$lastName) &&
                preg_match("/^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/", $firstName) &&
                preg_match("/^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/", $middleName) &&
                preg_match("/^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/", $extensionName)
            ) {
                return true;
            } else {
                return false;
            }
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
                preg_match('/^[a-zA-ZÑñӔӕ0-9,.\- ]+$/u', $address) &&
                preg_match('/^[a-zA-ZÑñӔӕ0-9,.\- ]+$/u', $province) &&
                preg_match('/^[a-zA-ZÑñӔӕ0-9,.\- ]+$/u', $city) &&
                preg_match('/^[a-zA-ZÑñӔӕ0-9,.\- ]+$/u', $barangay) &&
                preg_match('/^[0-9]{4,6}$/', $zipCode)
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

        // // Check if the passwords match
        // if ($password == $confirmPassword) {
        //     // Validate the new password
        //     if (preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~]).{8,}$/', $password)) {
        //         // Hash the new password
        //         $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //         $query = "INSERT INTO users (student_no, last_name, first_name, middle_name, extension_name, contact_no, email, birth_date, password, user_role)
        //         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        //         $userDetailsQuery = "INSERT INTO user_details (sex, home_address, province, city, barangay, zip_code, course_id, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        //         $crossEnrollmentQuery = "INSERT INTO acad_cross_enrollment (user_id) VALUES (?)";
        //         $manualEnrollmentQuery = "INSERT INTO acad_manual_enrollment (user_id) VALUES (?)";
        //         $gradeAccreditationQuery = "INSERT INTO acad_grade_accreditation (user_id) VALUES (?)";
        //         $shiftingQuery = "INSERT INTO acad_shifting (user_id) VALUES (?)";
        //         $subjectOverloadQuery = "INSERT INTO acad_subject_overload (user_id) VALUES (?)";
            
        //         $stmt = $connection->prepare($query);
        //         $stmt->bind_param("sssssssssi", $studentNo, $lastName, $firstName, $middleName, $extensionName, $contactNumber, $email, $birthdate, $hashedPassword, $userRole);

        //         // Check if all of the names match the following regex expression. If not, the query will not proceed to execute
        //         if ($stmt->execute() && (preg_match("/^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/", $lastName) && preg_match("/^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/", $firstName) && preg_match("/^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/", $middleName) && preg_match("/^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/", $extensionName))) {
        //             $stmt->close();
        //             $lastId = $connection->insert_id;
        //             $stmt = $connection->prepare($userDetailsQuery);
        //             $stmt->bind_param("isssssii", $gender, $address, $province, $city, $barangay, $zipCode, $course, $lastId);
        //             $stmt->execute();
        //             $stmt->close();

        //             // Insert initial value queries on all academic services
        //             $stmt = $connection->prepare($crossEnrollmentQuery);
        //             $stmt->bind_param("i", $lastId);
        //             $stmt->execute();
        //             $stmt->close();
        //             $stmt = $connection->prepare($manualEnrollmentQuery);
        //             $stmt->bind_param("i", $lastId);
        //             $stmt->execute();
        //             $stmt->close();
        //             $stmt = $connection->prepare($gradeAccreditationQuery);
        //             $stmt->bind_param("i", $lastId);
        //             $stmt->execute();
        //             $stmt->close();
        //             $stmt = $connection->prepare($shiftingQuery);
        //             $stmt->bind_param("i", $lastId);
        //             $stmt->execute();
        //             $stmt->close();
        //             $stmt = $connection->prepare($subjectOverloadQuery);
        //             $stmt->bind_param("i", $lastId);
        //             $stmt->execute();
        //             $stmt->close();

        //             header("Location: /login/student.php");
        //             $_SESSION['account_created'] = true;
        //         } 
        //         else {
        //             header("Location: /login/student.php");
        //             $_SESSION['account_failed'] = true;
        //         }
        //     } else {
        //         header("Location: /login/student.php");
        //         $_SESSION['invalid_password'] = true;
        //     }
        // } else {
        //     header("Location: /login/student.php");
        //     $_SESSION['pass_does_not_match'] = true;
        // }
    }
    $connection->close();
    exit;
}
else if (isset($_POST['clientSignup'])) {
    $email = $_POST['Email'];
    $lastName = $_POST['LName'];
    $firstName = $_POST['FName'];
    $middleName = $_POST['MName'];
    $extensionName = $_POST['EName'];

    $checkQuery = "SELECT COUNT(*) FROM users WHERE email = ? OR (first_name = ? AND last_name = ? AND middle_name = ?) AND user_role = 2";
    $checkStmt = $connection->prepare($checkQuery);
    $checkStmt->bind_param("ssss", $email, $firstName, $lastName, $middleName);
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
        $confirmPassword = $_POST['ConfirmPassword'];
        $userRole = 2;

        // Check if the passwords match
        if ($password == $confirmPassword) {
            // Validate the new password
            if (preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~]).{8,}$/', $password)) {
                // Hash the new password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $query = "INSERT INTO users (last_name, first_name, middle_name, extension_name, contact_no, email, birth_date, password, user_role)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $userDetailsQuery = "INSERT INTO user_details (sex, home_address, province, city, barangay, zip_code, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
            
                $stmt = $connection->prepare($query);
                $stmt->bind_param("ssssssssi", $lastName, $firstName, $middleName, $extensionName, $contactNumber, $email, $birthdate, $hashedPassword, $userRole);

                // Check if all of the names match the following regex expression. If not, the query will not proceed to execute
                if ($stmt->execute() && (preg_match("/^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/", $lastName) && preg_match("/^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/", $firstName) && preg_match("/^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/", $middleName) && preg_match("/^(?:[a-zA-ZÑñ]+\s?[\-\.']?\s?)*$/", $extensionName))) {
                    $stmt->close();
                    $lastId = $connection->insert_id;
                    $stmt = $connection->prepare($userDetailsQuery);
                    $stmt->bind_param("isssssi", $gender, $address, $province, $city, $barangay, $zipCode, $lastId);
                    $stmt->execute();
                    $stmt->close();
                    header("Location: /login/client.php");
                    $_SESSION['account_created'] = true;
                } 
                else {
                    header("Location: /login/client.php");
                    $_SESSION['account_failed'] = true;
                }
            } else {
                header("Location: /login/client.php");
                $_SESSION['invalid_password'] = true;
            }
        } else {
            header("Location: /login/client.php");
            $_SESSION['pass_does_not_match'] = true;
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