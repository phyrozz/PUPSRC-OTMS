<?php
require "conn.php";

function displayInventory($equip_table, $connection, $filterCategory = null)
{
    $sql = "SELECT e.*, et.equipment_type FROM " . mysqli_real_escape_string($connection, $equip_table) . " AS e
            INNER JOIN equipment_type AS et ON e.equipment_type_id = et.equipment_type_id";

    if ($filterCategory) {
        $filterCategory = mysqli_real_escape_string($connection, $filterCategory);
        $sql .= " WHERE et.equipment_type = '$filterCategory'";
    }

    // Add the ORDER BY clause to arrange the equipment alphabetically


    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table table-hover table-bordered'>";
        echo "<thead>
                <tr class='text-center bigger-font'>
                    <th>Equipment</th>
                    <th>Availability</th>
                    <th>Quantity</th>
                    <th>Type</th>
                    <th>Request</th>
                </tr>
            </thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr class='text-center'>";
            echo "<td>" . htmlspecialchars($row["equipment_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["availability"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["quantity"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["equipment_type"]) . "</td>";
            echo "<td><button class='btn btn-primary custom-font-size' onclick='redirectToRequest(" . htmlspecialchars($row["equipment_id"]) . ", \"" . htmlspecialchars($equip_table) . "\", \"" . htmlspecialchars($row["equipment_name"]) . "\")'>Create Request</button></td>";
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
    displayInventory("equipment", $connection, $selectedCategory);
} else {
    // Display the inventory table without filtering
    displayInventory("equipment", $connection);
}

$connection->close();
?>

