<?php
include '../../../conn.php';

$userid = $_POST['userid'];
$query = "SELECT * FROM doc_requests
INNER JOIN offices ON doc_requests.office_id = offices.office_id
INNER JOIN statuses ON doc_requests.status_id = statuses.status_id
WHERE request_id = '$userid'";
$result = mysqli_query($connection, $query);
while( $row = mysqli_fetch_array($result) ){
?>
    <p>Request Code: <?php echo $row['request_id'];?> </p>
    <p>Office: <?php echo $row['office_name'];?></p>
    <p>Request: <?php echo$row['request_description'];?></p>
    <p>Schedule: <?php echo $row['scheduled_datetime'];?> </p>
    <p>Amout to pay: <?php echo $row['amount_to_pay'];?> </p>
    <p>Status: <?php echo $row['status_name'];?> </p>

    <?php if ($row['status_id'] == "5" && $row['status_id'] == "6") { ?>
        <div class="d-flex justify-content-center">
            <a href="http://192.168.84.183/student/registrar/create_request.php" type="button" class="btn btn-primary">Do You Want Another Request?</a>
        </div>
    <?php }?>
<?php }
?>