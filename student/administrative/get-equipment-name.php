<?php
require "../content/conn.php";

$equipID = $_GET['equipID'];

$sql = "SELECT equipment_name FROM equipment WHERE equipment_id = '$equipID'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $equipmentName = $row['equipment_name'];

} else {
    echo "Unknown";
}

header("Location: request-equip.php" . "&equipment_name=" . urlencode($equipmentName));
$connection->close();
?>
