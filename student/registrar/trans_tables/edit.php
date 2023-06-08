<?php
$id = $_POST['id'];
$request = $_POST['request'];
$date = $_POST['date'];

// Perform the database update
// Replace "your_db_name", "your_table_name", "your_username", "your_password" with the appropriate values
$connection = new PDO("mysql:host=localhost;dbname=reg_db", "root", "");
$query = "UPDATE reg_transaction SET services_id = :request, schedule = :date WHERE reg_id = :id";
$statement = $connection->prepare($query);
$statement->bindParam(':request', $request);
$statement->bindParam(':date', $date);
$statement->bindParam(':id', $id);
$statement->execute();

if ($statement) {
    // Data updated successfully
     echo
    "<script>alert('Data Updated Successfully!'); </script>";
  } else {
    // Error occurred while updating data
    echo
      "<script> alert('Data Not Updated Successfully!'); </script>";
  }
    header("Location: ../your_transaction.php");
exit();
?>