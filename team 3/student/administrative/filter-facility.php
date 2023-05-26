<?php
require "connection.php";

function displayFacilities($conn, $filterCategory = null)
{
    $sql = "SELECT f.facility_id, f.facility_name, f.availability, f.facility_number, ft.facility_type
            FROM facility AS f
            INNER JOIN facility_type AS ft ON f.facility_type_id = ft.facility_type_id";

    if ($filterCategory) {
        $filterCategory = mysqli_real_escape_string($conn, $filterCategory);
        $sql .= " WHERE ft.facility_type = '$filterCategory'";
    }

    $result = $conn->query($sql);

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
            echo "<td><button class='btn btn-primary custom-font-size' onclick='redirectToRequest(" . htmlspecialchars($row["facility_id"]) . ", \"" . htmlspecialchars($row["facility_type"]) . "\")'>Create Request</button></td>";
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
    displayFacilities($conn, $selectedCategory);
} else {
    // Display the facilities table without filtering
    displayFacilities($conn);
}

$conn->close();
?>

