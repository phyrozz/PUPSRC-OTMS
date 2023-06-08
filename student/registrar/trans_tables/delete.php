<?php
include '../../conn.php';

if(isset($_POST['stud_delete_multiple_btn']))
{
    $all_id = $_POST['stud_delete_id'];
    $extract_id = implode(',' , $all_id);
    // echo $extract_id;

    $query = "DELETE FROM reg_transaction WHERE reg_id IN($extract_id) ";
    $query_run = mysqli_query($connect, $query);

    header("Location: ../your_transaction.php");
}
?>