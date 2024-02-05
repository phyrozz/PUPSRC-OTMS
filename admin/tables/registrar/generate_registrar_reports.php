<?php
require '../../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include "../../../conn.php";
    
    $status = $_GET['status'];
    $search = $_GET['search'];
    $req_desc = json_decode($_GET['req_desc'], true);
    $req_desc_conditions = implode("', '", $req_desc);
    date_default_timezone_set('Asia/Manila');
    $formattedDate = date('Y-m-d'); //date today

    $all_for_query = "SELECT DISTINCT request_description FROM doc_requests";
    $all_for_result = mysqli_query($connection, $all_for_query);
    $all_for_array = array();
    while ($row = mysqli_fetch_assoc($all_for_result)) {
        $all_for_array[] = $row['request_description'];
    }
    $all_for_conditions = implode(", ", $all_for_array);

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
        OR request_description IN ('$all_for_conditions')
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
        OR request_description LIKE '%$search%'
        OR amount_to_pay LIKE '%$search%')";
    }

    if ($status != 'all') {
        $registrar_reports .= " AND doc_requests.status_id = '$status'";
    }
    
    if (!in_array('all', $req_desc))  {
        $registrar_reports .= " AND request_description IN ('$req_desc_conditions')";
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
    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
    <style>
    img {
        width: 100%;
        margin: 0px;
    }
    body {
            font-family: Arial, sans-serif;
            margin-top: 130px;
            margin-bottom: 100px;
        }
        h2 {
            text-align: center;
            margin-top: 0px;
            margin-bottom: 0px;
        }
        p {
            text-align: center;
            margin: 0px;
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
        h5 {
            margin-top: 50;
            margin-bottom: 50;
            text-align: center;
        }
        h4 {
            margin: 0;
            font-weight: 400;
        }
        .center {
            text-align: center;
        }
        .invisible {
            border: none;
            background: none;
        }

        @page {
            margin-top: 10px; /* Adjust as needed */
            margin-bottom: 10px; /* Adjust as needed */
        }

        .header-letter,
        .footer-letter {
            position: fixed;
            left: 0;
            right: 0;
        }

        .header-letter {
            top: 0;
        }

        .footer-letter {
            bottom: 0;
        }

        img {
            width: 100%;
            margin: 0px;
        }
</style>
<div class="header-letter">
<img src="report_header.png" alt="Example Image" class="img-fluid">
</div>
<div class="footer-letter">
<img src="report_footer.png" alt="Example Image" class="img-fluid">
</div>
<body>

    <h2>PUPSRC Online Transaction Management System</h2>
    <p style="font-size: 16">Office of the University Registrar Report</p>
    <p style="margin-bottom: 10px">Generated on: ' . date('F j, Y | g:i A') . '</p>
    <table>
        <thead>
            <tr>
                <th class="center">No</th>
                <th class="center">Request Code</th>
                <th class="center">Date Requested</th>
                <th class="center">Scheduled Date</th>
                <th class="center">Requestor</th>
                <th class="center">Student/Client</th>
                <th class="center">Request</th>
                <th class="center">Purpose</th>
                <th class="center">Amount to Pay</th>
                <th class="center">Status</th>
            </tr>
        </thead>
        <tbody>';
        $i = 1;
        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $timestamp = $row['request_id'];
                $parsedTimestamp = intval(substr($timestamp, 3));
                $date_new = new DateTime('@' . ($parsedTimestamp));
                $format_date = $date_new->format('Y/m/d'); // date only
                $html .= '<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['request_id'].'</td>
                    <td class="center">'.$format_date.'</td>
                    <td class="center">'.date('Y/m/d', strtotime($row['scheduled_datetime'])).'</td>
                    <td style="width: 100%;">'.$row['last_name'].', '.$row['first_name'].' '.$row['middle_name'].' '.$row['extension_name'].'</td>
                    <td class="center">'.$row['role'].'</td>
                    <td class="center">'.$row['request_description'].'</td>
                    <td class="center">'.$row['purpose'].'</td>
                    <td class="center">'.$row['amount_to_pay'].'</td>
                    <td class="center">'.$row['status_name'].'</td>
                </tr>';
                $i++;
            }
        $html .='<tr><th class="invisible" colspan="10"><h5>--- NOTHING FOLLOWS ---</h5></tr>';
        } else {
            $html .='<tr>
                <td class="text-center" colspan="10">No record found!</td>
            </tr>';
        }
        $html .= '</tbody>
    </table>
    <table style="page-break-inside: avoid;">';
    $html .='
    <tr><th class="invisible" colspan="10"></tr>
    <tr><th class="invisible" colspan="10"></tr>
    <tr><th class="invisible" colspan="10"></tr>
    <tr><th class="invisible" colspan="4">GENERATED BY:</th><th class="invisible" colspan="3">CERTIFIED TRUE AND CORRECTED BY:</th><th class="invisible" colspan="3">NOTED BY:</th></tr>
    <tr><th class="invisible" colspan="10"></tr>
    <tr><th class="invisible" colspan="10"></tr>
    <tr><th class="invisible" colspan="10"></tr>
    <tr><th class="invisible" colspan="10"></tr>
    <tr><th class="invisible" colspan="4"><h4><b>NURIN GLADYS</b></h4></th><th class="invisible" colspan="3"><h4><b>ENGR. EMY LOU G. ALINSOD</b></h4></th><th class="invisible" colspan="3"><h4><b>DIR. LENY V. SALMINGO</b></h4></th></tr>
    <tr><th class="invisible" colspan="4"><h4>OUR STAFF</h4></th><th class="invisible" colspan="3"><h4>Campus Registrar</h4></th><th class="invisible" colspan="3"><h4>Campus Director</h4></th></tr>
    <tr><th class="invisible" colspan="4"><h4>PUP Santa Rosa Campus</h4></th><th class="invisible" colspan="3"><h4>PUP Santa Rosa Campus</h4></th><th class="invisible" colspan="3"><h4>PUP Santa Rosa Campus</h4></th></tr>
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