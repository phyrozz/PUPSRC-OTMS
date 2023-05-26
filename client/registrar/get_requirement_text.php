<?php
include 'conn.php';

if (isset($_POST['optionValue'])) {
    $optionValue = $_POST['optionValue'];
    $requirementText = getRequirementText($optionValue, $connect); // Call the function to fetch requirement text
    echo $requirementText;
}
function getRequirementText($optionValue, $connect)
{
    $query = "SELECT requirement, payment FROM reg_requirements WHERE id = '$optionValue'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
    return "Requirements: \n" . $row['requirement'] . "\n\nPayments: \n" . $row['payment'];
}