<?php
include '../../conn.php';

$userid = $_POST['userid'];
$query = "SELECT * FROM users
INNER JOIN reg_transaction ON  users.id = reg_transaction.user_id
INNER JOIN office ON reg_transaction.office_id = office.id
INNER JOIN reg_services ON reg_transaction.services_id = reg_services.services_id
INNER JOIN reg_status ON reg_transaction.status_id = reg_status.id where reg_transaction.reg_id=".$userid;
$result = mysqli_query($connect, $query);
while( $row = mysqli_fetch_array($result) ){
?>
    <p>Request Code: <?php echo $row['request_code'];?> </p>
    <p>Office: <?php echo $row['offices'];?></p>
    <p>Request: <?php echo$row['services'];?></p>
    <p>Schedule: <?php echo $row['schedule'];?> </p>
    <p>Status: <?php echo $row['status'];?> </p>

    <?php if ($row['status'] == "Released") { ?>
        <div class="d-flex justify-content-center">
            <a href="http://localhost:3000/student/registrar/create_request.php" type="button" class="btn btn-primary">Do You Want Another Request?</a>
        </div>
    <?php }?>
<?php }


?>