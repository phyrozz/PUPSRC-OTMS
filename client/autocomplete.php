<?php
$query = $_POST['query'];

include "../conn.php";

$sql = "SELECT * FROM services 
        INNER JOIN offices ON services.office_id=offices.office_id
        WHERE services.isStudent = 0 AND service_name LIKE '%$query%'";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display each autocomplete result
        echo '<a href="/client/'. $row['url'] .'"><div class="autocomplete-item">' . highlightText($row['service_name'], $query) . '</div></a>';
    }
}

$connection->close();

function highlightText($text, $query) {
    $highlightedText = preg_replace('/(' . $query . ')/i', '<strong>$1</strong>', $text);
    return $highlightedText;
}
?>
