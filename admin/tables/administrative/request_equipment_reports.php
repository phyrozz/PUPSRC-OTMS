<?php
require '../../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include "../../../conn.php";


    
    $status = $_GET['status'];
    $search = $_GET['search'];
    $formattedDate = date('Y-m-d'); //date today
    date_default_timezone_set('Asia/Manila');
     // Generate the current date and time in Philippines' time
     $currentDateTime = date('F j, Y \a\t g:i A');


    $request_equipment_reports = "SELECT request_id, datetime_schedule, CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) AS formatted_request_id, quantity_equip, status_name, equipment_name,
                    users.first_name, users.last_name, users.middle_name, users.extension_name, user_roles.role
                    FROM request_equipment
                    INNER JOIN users ON request_equipment.user_id = users.user_id
                    INNER JOIN user_roles ON users.user_role = user_roles.user_role_id
                    INNER JOIN statuses ON request_equipment.status_id = statuses.status_id
                    INNER JOIN equipment ON request_equipment.equipment_id = equipment.equipment_id";
    
    if (!empty($searchTerm)) {
        $request_equipment_reports .= " AND (request_id LIKE '%$searchTerm%'
        OR users.first_name LIKE '%$searchTerm%'
        OR users.last_name LIKE '%$searchTerm%'
        OR users.middle_name LIKE '%$searchTerm%'
        OR users.extension_name LIKE '%$searchTerm%'
        OR user_roles.role LIKE '%$searchTerm%'
        -- CONCAT name and equipment name combinations
        OR CONCAT(users.last_name, ' ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', equipment.equipment_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
        OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', equipment.equipment_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name, ' ', equipment.equipment_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', equipment.equipment_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
        OR CONCAT(users.first_name, ' ', users.last_name, ' ', equipment.equipment_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
        OR CONCAT(users.first_name, ' ', equipment.equipment_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
        OR CONCAT(users.last_name, ' ', equipment.equipment_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
        -- CONCAT name and status_name combinations
        OR CONCAT(users.last_name, ' ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
        OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
        OR CONCAT(users.first_name, ' ', users.last_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
        OR CONCAT(users.first_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
        OR CONCAT(users.last_name, ' ', statuses.status_name) LIKE '%$searchTerm%'

        OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name) LIKE '%$searchTerm%'
        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name) LIKE '%$searchTerm%'
        OR CONCAT(users.first_name, ' ', users.last_name, ' ', users.extension_name) LIKE '%$searchTerm%'
        OR CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) LIKE '%$searchTerm%'
        OR DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%M') LIKE '%$searchTerm%' -- Search for worded months
        OR quantity_equip LIKE '%$searchTerm%'
        OR datetime_schedule LIKE '%$searchTerm%'
        OR equipment_name LIKE '%$searchTerm%')";

        
    }

    if ($status != 'all') {
        $request_equipment_reports .= " AND request_equipment.status_id = '$status'";
    }

    $request_equipment_reports .= " ORDER BY datetime_schedule DESC";
    
    $result = mysqli_query($connection, $request_equipment_reports);

    $i = 1;


$html = '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrative Office | Generate Reports</title>
    <p>Generated on: ' . $currentDateTime . '</p>
    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
    <style>
    body {
            font-family: Poppins, sans-serif;
        }
        h2, h4 {
            text-align: center;
            margin-top: 20px;
        }
        p {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #4444;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
</style>
<body>
    <h2>PUPSRC - Administrative Office Reports</h2>
    <h4>Request of Equipment</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Request Code</th>
                <th>Equipment Name</th>
                <th>Quantity</th>
                <th>Requestor</th>
                <th>Student/Client</th>
                <th>Schedule</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>';
        $i = 1;
        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $timestamp = $row['request_id'];
                $parsedTimestamp = intval(substr($timestamp, 3));
                $date_new = new DateTime('@' . ($parsedTimestamp));
                $format_date = $date_new->format('Y-m-d H:i:s');
                $html .= '<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['request_id'].'</td>
                    <td>'.$row['equipment_name'].'</td>
                    <td>'.$row['quantity_equip'].'</td>
                    <td>'.$row['last_name'].','.$row['first_name'].' '.$row['middle_name'].' '.$row['extension_name'].'</td>
                    <td>'.$row['role'].'</td>
                    <td>'.date('F j, Y \a\t g:i A', strtotime($row['datetime_schedule'])).'</td>
                    <td>'.$row['status_name'].'</td>
                </tr>';
                $i++;
            }
        } else {
            $html .='<tr>
                <td class="text-center" colspan="9">No record found!</td>
            </tr>';
        }
        $html .= '</tbody>
    </table>
</body>
</html>';
$options = new Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
// Set the paper size to A4 and orientation to portrait
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

$NameModified = strtolower(str_replace(' ', '', $formattedDate));
// Generate the file name with the current time, unique identifier, and equipment name
$fileName = 'administrative_equipment_report'. '_'.  $NameModified . '_' . uniqid(). '.pdf';

// Save the PDF to a directory in your file system
$directoryPath = '../../generate_report/administrative/'; 
$filePath = $directoryPath . $fileName;
file_put_contents($filePath, $dompdf->output());

// Output the PDF to the browser
$dompdf->stream($fileName, ["Attachment" => false]);
?>