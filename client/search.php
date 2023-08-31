<?php
$query = $_GET['query'];

include "../conn.php";

$sql = "SELECT * FROM services 
        INNER JOIN offices ON services.office_id=offices.office_id
        WHERE services.isStudent = 0 AND (service_name LIKE '%$query%' OR office_name LIKE '%$query%' OR service_description LIKE '%$query%')";

$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUPSRC-OTMS Search - Results for "<?php echo $query; ?>"</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
    $office_name = "Select an Office";
    include 'navbar.php';
    include '../breadcrumb.php';
    ?>
    <div class="container-fluid p-4">
        <?php
        $breadcrumbItems = [
            ['text' => 'Search Results', 'active' => true],
        ];

        echo generateBreadcrumb($breadcrumbItems, true);
        ?>
    </div>
    <div class="container-fluid text-center p-4">
        <!-- Easter egg hahaha -->
        <?php
        if ($query === "saygex") {
            // echo "<h1 class='page-heading'>Well, you asked for it. Here you go :)</h1>";
            echo '<img src="../assets/secret.png" alt="secret" width=350 style="filter: invert(93.5%);"/>';
        }
        else {
            echo '<h1 class="page-heading">Search Results - "' . $query . '"</h1>';
        }
        ?>
        <!-- <h1 class="page-heading">Search Results - "<?php ; ?>"</h1> -->
    </div>
    <?php
    // Display the search results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Display each search result
            echo '<div class="search-result card m-2">';
            echo '<a href="/client/'. $row['url'] .'">';
            echo '<div class="card-header">'. highlightText($row['office_name'], $query) .'</div>';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . highlightText($row['service_name'], $query) . '</h3>';
            echo '<p class="card-text">' . highlightText($row['service_description'], $query) . '</p>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
    } else if ($query === 'saygex') {
        echo '';
    } 
    else {
    echo '<p class="text-center">No results found.</p>';
    }

    $connection->close();

    function highlightText($text, $query) {
        $highlightedText = preg_replace('/(' . $query . ')/i', '<strong>$1</strong>', $text);
        return $highlightedText;
    }
    ?>
    <script src="../saved_settings.js"></script>
</body>
</html>
