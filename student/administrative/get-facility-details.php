<?php
require "conn.php";

$facilityID = $_POST['facilityID'];

$sql = "SELECT facility_name, facility_number FROM facility WHERE facility_id = '$facilityID'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $facilityName = $row['facility_name'];
    $facilityNumber = $row['facility_number'];
} else {
    $facilityName = "Unknown";
    $facilityNumber = "Unknown";
}
header("Location: request-facility.php facilityID=$facilityID". "&facility_name=" . urlencode($facilityName) . "&facility_number=" . urlencode($facilityNumber));

$connection->close();
?>

