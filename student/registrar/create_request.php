<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Office - Create Request</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../../../assets/favicon.ico">
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../style.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<?php
    include '../../conn.php';
    $office_name = "Registrar Office";
    include "../navbar.php";

    $id = $_SESSION['user_id'];
    $result = mysqli_query($connection, "SELECT student_no, last_name, first_name, middle_name, extension_name, contact_no, email FROM users
    WHERE user_id = $id");
    $row = mysqli_fetch_array($result);

    //fetching registrar services
    $result1 = mysqli_query($connection, "SELECT * FROM reg_services");
    
    //for generate registrar code
    $code_query = "SELECT COUNT(reg_id) as count FROM reg_transaction";
    $code_result = mysqli_query($connection, $code_query);
    $code_row = mysqli_fetch_assoc($code_result);
    $count = $code_row['count'];
    // Assuming your text is in the format "REG-1"
    $text = "REG-" . $count;
    // Extract the number from the text using regular expressions
    $pattern = "/\d+/";
    preg_match($pattern, $text, $matches);
    $number = $matches[0];
    $add = "0";
    // Increment the number
    $number++;
    $newText = preg_replace($pattern, $number, $text);

    //for submit
    if(isset($_POST["submit"])){
        $reg_id = $code_row['count'];
        $reg_code = $newText;
        $req_student_service = $_POST["req_student_service"];
        $user_id = $id;
        $office_id = "3"; //1-Registrar Office
        $date = $_POST["date"];
        $status_id = "1"; //1-Pending

        $query = "INSERT INTO reg_transaction VALUES('$reg_id','$reg_code', '$user_id' , '$office_id' , '$req_student_service','$date', '$status_id')";
        $result2 = mysqli_query($connection, $query);
        if ($result2) {
            // Data inserted successfully
            echo
            "<script> alert('Registration Successful'); </script>";
        } else {
            // Error occurred while inserting data
            echo
            "<script> alert('Password Does Not Match'); </script>";
        }
    }

?>
<body>
    <div class="wrapper">
        <?php
        include "../../breadcrumb.php";

        ?>
        <div class="container-fluid p-4">
            <?php
            $breadcrumbItems = [
                ['text' => 'Registrar Office', 'url' => '../registrar.php', 'active' => false],
                ['text' => 'Create Request', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, true);
            ?>
        </div>
        <div class="container-fluid text-center p-4">
            <h1>Create Request</h1>
        </div>
        <div class="container-fluid">
            <div class="row g-1">
                <div class="card col-md-3 p-0 m-1">
                    <div class="card-header">
                        <h6>PUP Data Privacy Notice</h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <p><small>PUP respects and values your rights as a data subject under the Data Privacy Act (DPA). PUP is committed to protecting the personal data you provide in accordance with the requirements under the DPA and its IRR. In this regard, PUP implements reasonable and appropriate security measures to maintain the confidentiality, integrity and availability of your personal data. For more detailed Privacy Statement, you may visit <a href="https://www.pup.edu.ph/privacy/" target="_blank">https://www.pup.edu.ph/privacy/</a></small></p>
                        <div class="d-flex flex-column">
                            <a class="btn btn-outline-primary mb-2" href="your_transaction.php">
                            <i class="fa-regular fa-clipboard"></i> My Registrar Transactions
                            </a>
                            <!-- <a class="btn btn-outline-primary mb-2">
                            <i class="fa-regular fa-flag"></i> Generate Inquiry
                            </a> -->
                            <button class="btn btn-outline-primary mb-2" onclick="resetForm()">
                                <i class="fa-solid fa-arrows-rotate"></i> Reset Form
                            </button>
                            <a class="btn btn-outline-primary mb-2" href="FAQ.php">
                                <i class="fa-solid fa-circle-question"></i> FAQs
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card col-md p-0 m-1">
                    <div class="card-header">
                        <h6>Request Form</h6>
                    </div>
                    <div class="card-body">
                        <form id="appointment-form" method="post" enctype="multipart/form-data" class="row g-3">
                            <small>Fields highlighted in <small style="color: red"><b>*</b></small> are required.</small>
                            <h6>Student Information</h6>
                            <div class="form-group required col-12">
                                <label for="studentNumber" class="form-label">Student Number</label>
                                <input type="text" class="form-control" name="studentNumber" id="studentNumber" value="<?php echo $row["student_no"]; ?>" disabled required>
                            </div>
                            <div class="form-group required col-12">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $row["last_name"]; ?>" disabled required>
                            </div>
                            <div class="form-group required col-12">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $row["first_name"]; ?>" disabled required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" name= "middleName" id="middleName" value="<?php echo $row["middle_name"]; ?>" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="extensionName" class="form-label">Extension Name</label>
                                <input type="text" class="form-control" name="extensionName" id="extensionName" value="<?php echo $row["extension_name"]; ?>" disabled>
                            </div>
                            <div class="form-group required col-12">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" name="contactNumber" id="contactNumber" value="<?php echo $row["contact_no"]; ?>" disabled required>
                            </div>
                            <div class="form-group col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row["email"]; ?>" disabled required>
                            </div>
                            <h6 class="mt-5">Request Information</h6>
                            <div class="form-group required col-md-12">
                                <label for="typeOfServices" class="form-label">Type of Services</label>
                                <select name="req_student_service" class="form-control" id="req_student_service" required>
                                    <option hidden value="">Select options here</option>
                                    <!-- connect to db -->
                                    <?php
                                    while ($dropdown = mysqli_fetch_assoc($result1)){
                                        echo '<option value="' . $dropdown['services_id'] . '">' . $dropdown['services'] . '</option>';
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                            <div class="form-group required col-md-12">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" id="date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" max="<?php echo date('Y-m-d', strtotime('+1 year')); ?>" required>
                            </div>
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">
                                <i class="fa-solid fa-circle-info"></i> Reminder
                                </h4>
                                <p>Your appointment request will be forwarded to the concerned office after you click the "Submit" button.</p>
                                <p>Confirmation (approved/disapproved) of the request will be sent to your registered email.</p>
                                <p class="mb-0">You may also constantly monitor the status of the request by going to <b>My Transactions</b>.</p>
                            </div>
                            <div class="d-flex w-100 justify-content-between p-1">
                                <a class="btn btn-primary px-4" href="../registrar.php">
                                    <i class="fa-solid fa-arrow-left"></i> Back
                                </a>
                                <input id="submitBtn" value="Submit" type="button" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal">
                            </div>
                            <!-- Modal --> 
                             <div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmSubmitModalLabel">Confirm Form Submission</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to submit this form?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="push"></div>
    </div>
    <div class="footer container-fluid w-100 text-md-left text-center d-md-flex align-items-center justify-content-center bg-light flex-nowrap">
        <div>
            <small>PUP Santa Rosa - Online Transaction Management System Beta 0.1.0</small>
        </div>
        <div>
            <small><a href="https://www.pup.edu.ph/terms/" target="_blank" class="btn btn-link">Terms of Use</a>|</small>
            <small><a href="https://www.pup.edu.ph/privacy/" target="_blank" class="btn btn-link">Privacy Statement</a></small>
        </div>
    </div>
    <script src="../../jquery.js"></script>
    <script src="../../saved_settings.js"></script>
</body>
</html>

<script>
    function resetForm() {
        document.getElementById("appointment-form").reset();
    }
</script>