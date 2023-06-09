<?php
require "conn.php";

function displayFacilities($facility_table,$connection, $filterCategory = null)
{
    $sql = "SELECT f.*, ft.facility_type
    FROM " . mysqli_real_escape_string($connection, $facility_table) . " AS f
    INNER JOIN facility_type AS ft ON f.facility_type_id = ft.facility_type_id";

    if ($filterCategory) {
        $filterCategory = mysqli_real_escape_string($connection, $filterCategory);
        $sql .= " WHERE ft.facility_type = '$filterCategory'";
    }

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table table-hover table-bordered'>";
        echo "<thead>
                <tr class='text-center bigger-font'>
                    <th>Facility</th>
                    <th>Availability</th>
                    <th>Number</th>
                    <th>Location</th>
                    <th>Request</th>
                </tr>
            </thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr class='text-center'>";
            echo "<td>" . htmlspecialchars($row["facility_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["availability"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["facility_number"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["facility_type"]) . "</td>";
            echo "<td><button class='btn btn-primary custom-font-size' onclick='redirectToRequest(" . htmlspecialchars($row["facility_id"]) . ", \"" . htmlspecialchars($facility_table) . "\", \"" . htmlspecialchars($row["facility_name"]) . "\",  \"" . htmlspecialchars($row["facility_number"]) . "\")'>Create Request</button></td>";

            
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No data available.";
    }
}

// Filter form handling
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $selectedCategory = $_POST["category"];
    displayFacilities("facility",$connection, $selectedCategory);
} else {
    // Display the facilities table without filtering
    displayFacilities("facility",$connection);
}

$connection->close();
?>

