<?php
include 'conn.php';

$otmsDbHost = 'localhost';
$otmsDbUsername = 'root';
$otmsDbPassword = '';
$otmsDbName = 'otms_db';

$otmsDbConn = new mysqli($otmsDbHost, $otmsDbUsername, $otmsDbPassword, $otmsDbName);
if ($otmsDbConn->connect_error) {
    die("Connection to the otms_db database failed: " . $otmsDbConn->connect_error);
}
if (isset($_POST['submit'])) {
    session_start();
    $user_id = $_SESSION['user_id'];

    $checkFormQuery = "SELECT COUNT(*) as submission_count FROM offsettingtb WHERE user_id = ? AND timestamp >= DATE_SUB(NOW(), INTERVAL 1 DAY)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $checkFormQuery)) {
        echo "Error";
    } else {
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $submissionCount = $row['submission_count'];

        if ($submissionCount >= 3) {
            echo "<div class='custom-alert' id='custom-alert'>
            <div class='custom-alert-message'>You have reached the maximum number of submissions (3) within the last 24 hours. Please wait for 24 hours before submitting another request. Thank you for your understanding.</div>
            <button class='custom-alert-close' onclick='redirectToIndex()'>Go Back</button>
          </div>";
            echo "<script>
            document.getElementById('custom-alert').style.display = 'block';
            function redirectToIndex() {
                window.location.href = '../accounting.php';
            }
          </script>";
        } else {
            $amountToOffset = $_POST['amountToOffset'];
            $offsetType = $_POST['offsetType'];

            $insert = "INSERT INTO offsettingtb (user_id, amountToOffset, offsetType) VALUES (?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $insert)) {
                echo "Error";
            } else {
                mysqli_stmt_bind_param($stmt, 'sds', $user_id, $amountToOffset, $offsetType);
                mysqli_stmt_execute($stmt);
                header("location: offsetting3.php");
            }
        }
    }
}

mysqli_close($conn);
mysqli_close($otmsDbConn);
?>

<style>
    .alert-info{
    margin-right: 50px;
    width: 600px;
    float: right;
    bottom: 180px;
}
.custom-alert {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 300px;
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    display: none;
    z-index: 9999;
    text-align: center;
    }

.custom-alert-message {
font-weight: bold;
margin-bottom: 10px;
}

.custom-alert-close {
padding: 5px 10px;
background-color: #ffc107;
border: solid 1px black;
border-radius: 10%;
color: #212529;
cursor: pointer;
}

.custom-alert-close:hover {
background-color: #e9ecef;
}
</style>