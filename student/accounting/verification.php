<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otms_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $student_no = $_POST["student_no"];
    $birth_date = $_POST["birth_date"];
    $sql = "SELECT * FROM users WHERE first_name = '$first_name' && last_name = '$last_name' && student_no = '$student_no' &&  birth_date = '$birth_date'";
    
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = mysqli_fetch_array($result);
        $_SESSION['user_id'] = $row['user_id'];
        echo "<div class='custom-alert' id='custom-alert'>
        <div class='custom-alert-message'>Account successfully validated!</div>
        <button class='custom-alert-close' onclick='redirectToOffsetting2()'>Next</button>
        </div>";
        echo "<script>
        document.getElementById('custom-alert').style.display = 'block';
        function redirectToOffsetting2() {
            window.location.href = 'offsetting2.php';
        }
        </script>";
    } elseif ($result->num_rows == 0) {
        echo "<div class='custom-alert' id='custom-alert'>
        <div class='custom-alert-message'>Account did not match!</div>
        <button class='custom-alert-close' onclick='closeAlert()'>Close</button>
        </div>";
        echo "<script>
        document.getElementById('custom-alert').style.display = 'block';
        setTimeout(closeAlert, );
        </script>";
    } else {
        die("Database error");
    }
}
?>
<style>
      /*alert*/
.success-alert {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    text-align: center;
    margin-bottom: 10px;
    display: none; /* Hide the alert by default */
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
