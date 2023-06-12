<?php
require "conn.php";

$equipID = $_POST['equipID'];

$sql = "SELECT equipment_name FROM equipment WHERE equipment_id = '$equipID'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $equipmentName = $row['equipment_name'];

} else {
    echo "Unknown";
}

$encodedEquipmentName = urlencode($equipmentName);
header("Location: request-equip.php equipID=$equipID&equipment_name=" . $encodedEquipmentName);
$connection->close();
?>

