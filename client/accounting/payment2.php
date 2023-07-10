<!-- INSERT PHP SECTION -->
<?php
$office_name = "Accounting Office";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otms_db";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounting Office - Landing Page</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/payment2.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style.css">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php
    include '../navbar.php';
    include '../../breadcrumb.php';
    ?>
    <div class="container-fluid p-4">
        <?php
        $breadcrumbItems = [
            ['text' => 'Accounting Office', 'url' => '../accounting.php', 'active' => false],
            ['text' => 'Payments', 'active' => true],
        ];

        echo generateBreadcrumb($breadcrumbItems, true);
        ?>
    </div>

  
    <div class="container-fluid text-center p-4">
        <!--Start of content-->
        <div class="container-fluid-form">
            <form id="studentForm" method="post" class="row g-3 needs-validation" novalidate>

                
                <div class="col-12 payment-summary">
                    <h1> Payment Summary </h1>
                    <?php
                    include '../../conn.php';
                

                    // Check if a session has already been started
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    // Set the time zone to Philippine time
                     date_default_timezone_set('Asia/Manila');

                    // Retrieve the latest payment data from the database
                    $paymentQuery = "SELECT payment_id, firstName, middleName, lastName, course, documentType, amount, referenceNumber
                                    FROM student_info
                                    WHERE firstName = '" . $_SESSION['first_name'] . "'
                                    ORDER BY payment_id DESC
                                    LIMIT 1";

                    $result = mysqli_query($connection, $paymentQuery);

                    if ($result) {
                        $paymentData = mysqli_fetch_assoc($result);
                        ?>

                        <table class="table">
                        <tbody>
                            <tr>
                                <th>Payment ID</th>
                                <td><?php echo $paymentData['payment_id']; ?></td>
                            </tr>
                            <tr>
                                <th>First Name</th>
                                <td><?php echo $paymentData['firstName']; ?></td>
                            </tr>
                            <tr>
                                <th>Middle Name</th>
                                <td><?php echo $paymentData['middleName']; ?></td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td><?php echo $paymentData['lastName']; ?></td>
                            </tr>
                            <tr>
                                <th>Course</th>
                                <td><?php echo $paymentData['course']; ?></td>
                            </tr>
                            <tr>
                                <th>Document Type</th>
                                <td><?php echo $paymentData['documentType']; ?></td>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <td><?php echo $paymentData['amount']; ?></td>
                            </tr>
                            <tr>
                                <th>Reference Number</th>
                                <td><?php echo $paymentData['referenceNumber']; ?></td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td><?php echo date('Y-m-d'); ?></td>
                            </tr>
                        </tbody>
                        </table>

                        <?php
                    } else {
                        echo "Error executing the query: " . mysqli_error($connection);
                    }
                    ?>
                </div>



                <div class="col-12">
                    <a class="btn btn-primary next-button" href="../accounting.php" type="submit">Accounting Office</a>
                </div>

            </form>
        </div>

        <script src="#"></script>
    </div>
</body>
</html>
