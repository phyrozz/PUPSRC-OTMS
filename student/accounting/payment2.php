<!-- INSERT PHP SECTION -->
<?php
$office_name = "Accounting Office";
$servername = "192.168.84.183";
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
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/style.css">
    <!-- Loading page -->
    <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
    <div id="loader" class="center">
        <div class="loading-spinner"></div>
        <p class="loading-text display-3 pt-3">Getting things ready...</p>
    </div>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php
    include '../navbar.php';
    include '../../breadcrumb.php';
    ?>
    <div class="container-fluid">
        <?php
        $breadcrumbItems = [
            ['text' => 'Accounting Office', 'url' => '../accounting.php', 'active' => false],
            ['text' => 'Payments', 'active' => true],
        ];

        echo generateBreadcrumb($breadcrumbItems, true);
        ?>
    </div>

  
    <div class="container-fluid text-center">
        <!--Start of content-->
        <div class="m-auto">
            <form id="studentForm" method="post" class="row g-3 needs-validation" novalidate>
                <!-- Main Rectangle Container -->
                <div class="row" id="payment-summary" style="border: 1px solid #000; border-radius: 20px; width: 200px; height: 450px;     
                margin-top: 70px;
                text-align: left;
                background-color: #f5f5f5;
                /*padding: 20px;*/
                border: 5px solid #800000;
                border-radius: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 1300px; /* Adjust the maximum width as per your preference */
                margin-left: auto;
                margin-right: auto;
                margin-bottom: -30px;" >

                    <!-- Left Section -->
                    <div class="col-md-4 text-center p-4" style="background-color: #800000; color: #fff; border-top-left-radius: 15px; border-bottom-left-radius: 15px; height: 448px;">
                        <div class="red-section" style="margin-top: 90px; margin-right:">
                            <img src="/assets/pup-logo.png" alt="PUP Logo" class="img-fluid mb-2">
                            <br><br><br>
                            <p class="font-weight-bold mb-1"><b>POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</b></p>
                            <p>SANTA ROSA CAMPUS</p>
                        </div>
                    </div>

                    <!-- Right Section: Payment Voucher Details -->
                    <div class="col-md-8 text-left p-4" >
                        <h2>PAYMENT VOUCHER</h2>
                        <?php
                        // Existing PHP code for payment details
                        include '../../conn.php';
                        include '../functions.php';

                        // Check if a session has already been started
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }

                        // Set the time zone to Philippine time
                        date_default_timezone_set('Asia/Manila');

                        // Retrieve the latest payment data from the database
                        $paymentQuery = "SELECT payment_id, firstName, middleName, lastName, studentNumber, course, documentType /*amount, referenceNumber */
                                        FROM student_info
                                        WHERE studentNumber = '" . $_SESSION['student_no'] . "'
                                        ORDER BY payment_id DESC
                                        LIMIT 1";

                        $result = mysqli_query($connection, $paymentQuery);

                        if ($result) {
                            $paymentData = mysqli_fetch_assoc($result);
                            ?>
                            <table class="table">
                                <tbody>
                                <tr>
                                            <th>Payment Code</th>
                                            <td> AO-<?php echo $paymentData['payment_id']; ?></td>
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
                                            <th>Student Number</th>
                                            <td><?php echo $paymentData['studentNumber']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Course</th>
                                            <td><?php echo $paymentData['course']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Document Type</th>
                                            <td><?php echo $paymentData['documentType']; ?></td>
                                        </tr>
                                        <!--<tr>
                                            <th>Amount</th>
                                            <td><?php echo $paymentData['amount']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Reference Number</th>
                                            <td><?php echo $paymentData['referenceNumber']; ?></td>
                                        </tr> -->
                                        <tr>
                                            <th>Date</th>
                                            <td><?php echo date('F d, Y'); ?></td> <!-- Format changed to 'F d, Y' -->
                                        </tr>
                                        <tr>
                                            <th>Expiration Date</th>
                                            <td><?php echo date('F d, Y', strtotime("+3 days")); ?></td> <!-- Format changed to 'F d, Y' -->
                                        </tr>
                                </tbody>
                            </table>
                            <?php
                        } else {
                            echo "Error executing the query: " . mysqli_error($connection);
                        }
                        ?>
                    </div>
                   
                </div>
            </form>
        </div>
        <div class="col-12 w-75 mt-5 pb-5 m-auto">
            <p class="mb-3">Please present this payment voucher to the cashier to complete your transaction. You may have to wait for a few days until your document request is ready for pickup. You can check the status any time on <b>My Transactions</b> page.</p>
            <button class="btn btn-primary next-button" type="button" onclick="takeScreenshot()"><i class="fa-solid fa-download"></i> Save</button>
            <a class="btn btn-primary next-button" href="../transactions.php">My Transactions</a>
        </div>
    </div>
    <script src="../../loading.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
        var takeScreenshot = function() {
            html2canvas(document.getElementById("payment-summary"), {
                onrendered: function (canvas) {
                    var a = document.createElement('a');
                    a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
                    a.download = 'payment-summary.jpg';
                    a.click();
                }
            });
        }
    </script>
    <script src="../../saved_settings.js"></script>
</body>
</html>
