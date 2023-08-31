<?php
require "conn.php";

function displayFacilities($facility_table, $connection, $filterCategory = null)
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
                    <th>Appointment</th>
                </tr>
            </thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr class='text-center'>";
            echo "<td>" . htmlspecialchars($row["facility_name"]) . "</td>";
            
            // Check if the facility is available
            $facilityAvailability = htmlspecialchars($row["availability"]);
            
            // // Check if the facility has been appointed
            // $facilityId = $row["facility_id"];
            // $query = "SELECT * FROM appointment_facility WHERE facility_id = ?";
            // $stmt = $connection->prepare($query);
            // $stmt->bind_param("i", $facilityId);
            // $stmt->execute();
            // $appointmentResult = $stmt->get_result();
            // $facilityAppointment = $appointmentResult->fetch_assoc();
            // $stmt->close();

            // Determine if the button should be disabled and change the text based on availability and appointment
            if ($facilityAvailability === "Unavailable") {
                $disabled = "disabled";
                $buttonText = "Not Available";
                $buttonClass = "btn-primary btn-dark text-black"; 
            } else {
                $disabled = "";
                $buttonText = "Create Appointment";
                $buttonClass = "btn-primary"; 
            }

            echo "<td>" . $facilityAvailability . "</td>";
            echo "<td>" . htmlspecialchars($row["facility_number"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["facility_type"]) . "</td>";

            echo "<td><button class='btn custom-font-size $buttonClass' onclick='redirectToRequest(" . htmlspecialchars($row["facility_id"]) . ", \"" . htmlspecialchars($facility_table) . "\", \"" . htmlspecialchars($row["facility_name"]) . "\",  \"" . htmlspecialchars($row["facility_number"]) . "\")' $disabled>$buttonText</button></td>";

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
    displayFacilities("facility", $connection, $selectedCategory);
} else {
    // Display the facilities table without filtering
    displayFacilities("facility", $connection);
}

$connection->close();
?>
<script src="../../saved_settings.js"></script>