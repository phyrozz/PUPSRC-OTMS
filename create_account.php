<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the form values
        $studentNo = $_POST['StudentNo'];
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

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (last_name, first_name, middle_name, extension_name, contact_no, email, password, user_role)
        VALUES ($lastName, $firstName, $middleName, $extensionName, $contactNumber, $email, $hashedPassword, 1)";
    
        // // Execute the query
        // if (mysqli_query($connection, $query)) {
        //     // Success! The record has been inserted into the database
        //     // You can redirect the user to a success page or perform any other actions
        //     // For example:
        //     header("Location: success.php");
        //     exit;
        // } else {
        //     // An error occurred while inserting the record
        //     // You can redirect the user to an error page or display an error message
        //     // For example:
        //     header("Location: error.php");
        //     exit;
        // }

        exit;
    }
?>