<?php
require '../../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include "../../../conn.php";
    
    $status = $_GET['status'];
    $doc_type = $_GET['doc_type'];
    $search = $_GET['search'];
    date_default_timezone_set('Asia/Manila');
    $formattedDate = date('Y-m-d'); //date today

    $registrar_reports = "SELECT request_id, request_description, CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) AS formatted_request_id, scheduled_datetime, status_name, purpose, amount_to_pay, attached_files, 
                        users.first_name, users.last_name, users.middle_name, users.extension_name, user_roles.role, doc_requests.user_id AS user_id
                        FROM doc_requests
                        INNER JOIN users ON doc_requests.user_id = users.user_id
                        INNER JOIN user_roles ON users.user_role = user_roles.user_role_id
                        INNER JOIN offices ON doc_requests.office_id = offices.office_id
                        INNER JOIN statuses ON doc_requests.status_id = statuses.status_id
                        WHERE doc_requests.office_id = 3";
    
    if (!empty($search)) {
        $registrar_reports .= " AND (request_id LIKE '%$search%'
        OR users.first_name LIKE '%$search%'
        OR users.last_name LIKE '%$search%'
        OR users.middle_name LIKE '%$search%'
        OR users.extension_name LIKE '%$search%'
        OR request_description LIKE '%$search%'
        OR user_roles.role LIKE '%$search%'
        OR scheduled_datetime LIKE '%$search%'
        -- CONCAT name and request_description combinations
        OR CONCAT(users.last_name, ' ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$search%'
        OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$search%'
        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$search%'
        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$search%'
        OR CONCAT(users.first_name, ' ', users.last_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$search%'
        OR CONCAT(users.first_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$search%'
        OR CONCAT(users.last_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$search%'
        -- CONCAT name and status_name combinations
        OR CONCAT(users.last_name, ' ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$search%'
        OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$search%'
        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$search%'
        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', statuses.status_name) LIKE '%$search%'
        OR CONCAT(users.first_name, ' ', users.last_name, ' ', statuses.status_name) LIKE '%$search%'
        OR CONCAT(users.first_name, ' ', statuses.status_name) LIKE '%$search%'
        OR CONCAT(users.last_name, ' ', statuses.status_name) LIKE '%$search%'

        OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name) LIKE '%$search%'
        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name) LIKE '%$search%'
        OR CONCAT(users.first_name, ' ', users.last_name, ' ', users.extension_name) LIKE '%$search%'
        OR CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) LIKE '%$search%'
        OR DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%M') LIKE '%$search%' -- Search for worded months
        OR status_name LIKE '%$search%'
        OR amount_to_pay LIKE '%$search%')";
    }

    if ($status != 'all') {
        $registrar_reports .= " AND doc_requests.status_id = '$status'";
    }
    
    if ($doc_type != 'all') {
        $registrar_reports .= " AND request_description = '$doc_type'";
    }

    $registrar_reports .= " ORDER BY scheduled_datetime DESC";
    
    $result = mysqli_query($connection, $registrar_reports);

    $i = 1;

$html = '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Office | Generate Reports</title>
    <p>Generated on: ' . date('F j, Y | g:i A') . '</p>
    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
    <style>
    body {
            font-family: Poppins, sans-serif;
        }
        h2 {
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
            padding: 4px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
</style>
<body>
    <h2>PUPSRC - Registrar Office Reports</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Request Code</th>
                <th>Date Requested</th>
                <th>Scheduled Date</th>
                <th>Requestor</th>
                <th>Student/Client</th>
                <th>Request</th>
                <th>Purpose</th>
                <th>Amount to Pay</th>
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
                $format_date = $date_new->format('F j, Y'); // date only
                $html .= '<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['request_id'].'</td>
                    <td>'.$format_date.'</td>
                    <td>'.date('F j, Y', strtotime($row['scheduled_datetime'])).'</td>
                    <td>'.$row['last_name'].', '.$row['first_name'].' '.$row['middle_name'].' '.$row['extension_name'].'</td>
                    <td>'.$row['role'].'</td>
                    <td>'.$row['request_description'].'</td>
                    <td>'.$row['purpose'].'</td>
                    <td>'.$row['amount_to_pay'].'</td>
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
$fileName = 'registrar_report'. '_'.  $NameModified . '_' . uniqid(). '.pdf';

// Save the PDF to a directory in your file system
$directoryPath = '../../generate_report/registrar/'; 
$filePath = $directoryPath . $fileName;
file_put_contents($filePath, $dompdf->output());

// Output the PDF to the browser
$dompdf->stream($fileName, ["Attachment" => false]);
?>