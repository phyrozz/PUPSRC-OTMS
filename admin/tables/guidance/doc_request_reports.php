<?php
require '../../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include "../../../conn.php";

$status = $_GET['status'];
$searchTerm = $_GET['search'];
$formattedDate = date('Y-m-d'); //date today

$doc_request_reports = "SELECT request_id, request_description, CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%M %e, %Y %l:%i:%s %p')) AS formatted_request_id, DATE_FORMAT(scheduled_datetime, '%M %e, %Y') as formatted_scheduled_datetime, status_name, amount_to_pay, attached_files, 
                        doc_requests.user_id, users.first_name, users.last_name, users.middle_name, users.extension_name, user_roles.role
                        FROM doc_requests
                        INNER JOIN users ON doc_requests.user_id = users.user_id
                        INNER JOIN user_roles ON users.user_role = user_roles.user_role_id
                        INNER JOIN offices ON doc_requests.office_id = offices.office_id
                        INNER JOIN statuses ON doc_requests.status_id = statuses.status_id
                        WHERE request_description != 'Guidance Counseling' AND doc_requests.office_id = 5";

if (!empty($searchTerm)) {
$doc_request_reports .= " AND (request_id LIKE '%$searchTerm%'
                        OR users.first_name LIKE '%$searchTerm%'
                        OR users.last_name LIKE '%$searchTerm%'
                        OR users.middle_name LIKE '%$searchTerm%'
                        OR users.extension_name LIKE '%$searchTerm%'
                        OR request_description LIKE '%$searchTerm%'
                        OR user_roles.role LIKE '%$searchTerm%'
                        -- CONCAT name and request_description combinations
                        OR CONCAT(users.last_name, ' ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.extension_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.last_name, ', ', users.first_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.first_name, ' ', users.last_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.first_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.last_name, ' ', request_description, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        -- CONCAT name and status_name combinations
                        OR CONCAT(users.last_name, ' ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.last_name, ', ', users.first_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.first_name, ' ', users.last_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.first_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.last_name, ' ', statuses.status_name) LIKE '%$searchTerm%'
                        -- CONCAT name and user role combinations
                        OR CONCAT(users.last_name, ' ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', user_roles.role) LIKE '%$searchTerm%'
                        OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name, ' ', user_roles.role) LIKE '%$searchTerm%'
                        OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.extension_name, ' ', user_roles.role) LIKE '%$searchTerm%'
                        OR CONCAT(users.last_name, ', ', users.first_name, ' ', user_roles.role) LIKE '%$searchTerm%'
                        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name, ' ', user_roles.role) LIKE '%$searchTerm%'
                        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', user_roles.role) LIKE '%$searchTerm%'
                        OR CONCAT(users.first_name, ' ', users.last_name, ' ', user_roles.role) LIKE '%$searchTerm%'
                        OR CONCAT(users.first_name, ' ', user_roles.role) LIKE '%$searchTerm%'
                        OR CONCAT(users.last_name, ' ', user_roles.role) LIKE '%$searchTerm%'

                        OR CONCAT(users.last_name, ', ', users.first_name, ' ', users.middle_name, ' ', users.extension_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name, ' ', users.extension_name) LIKE '%$searchTerm%'
                        OR CONCAT(users.first_name, ' ', users.last_name, ' ', users.extension_name) LIKE '%$searchTerm%'
                        OR DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(request_id, 4)), '%M %e, %Y %l:%i:%s %p') LIKE '%$searchTerm%'
                        -- OR DATE_FORMAT(scheduled_datetime, '%M %e, %Y') LIKE '%$searchTerm%'
                        OR status_name LIKE '%$searchTerm%'
                        OR amount_to_pay LIKE '%$searchTerm%')";
}

if ($status != 'all') {
    $doc_request_reports .= " AND doc_requests.status_id = '$status'";
}

$result = mysqli_query($connection,  $doc_request_reports);

$i = 1;


$html = '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrative Office | Generate Reports</title>
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
        h2,h4 {
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
    <h2>PUPSRC - Guidance Office Reports</h2>
    <h4>Document Requests</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Request Code</th>
                <th>Date Requested</th>
                <th>Scheduled Date</th>
                <th>Requestor</th>
                <th>Student/Guest</th>
                <th>Request</th>
                <th>Amount to pay</th>
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
                    <td>'.$format_date.'</td>
                    <td>'.$row['formatted_scheduled_datetime'].'</td>
                    <td>'.$row['last_name'].', '.$row['first_name'].' '.$row['middle_name'].' '.$row['extension_name'].'</td>
                    <td>'.$row['role'].'</td>
                    <td>'.$row['request_description'].'</td>
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
$fileName = 'guidance_doc_request_report'. '_'.  $NameModified . '_' . uniqid(). '.pdf';

// Save the PDF to a directory in your file system
$directoryPath = '../../generate_report/guidance/'; 
$filePath = $directoryPath . $fileName;
file_put_contents($filePath, $dompdf->output());

// Output the PDF to the browser
$dompdf->stream($fileName, ["Attachment" => false]);
?>