<?php
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

    $html = '';
    $i = 1;

$html = '
    <style>
    img {
        width: 100%;
        margin: 0px;
    }
    body {
            font-family: Poppins, sans-serif;
        }
        h2 {
            text-align: center;
            margin-top: 0px;
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
        h5 {
            margin-top: 30px;
            margin-bottom: 100px;
            text-align: center;
        }
        h4 {
            margin: 0;
            font-weight: 400;
        }
        .footer-letter {
            position: fixed;
            bottom: 0;
            left: 0;
        }
        .center {
            text-align: center;
        }
        .header {
            height: 60px; /* Set your preferred height */
        }
</style>
    <table>
        <thead>
        <tr><th colspan="10" class="center header"><img src="report_header_excel.jpg"></tr>
        <tr><th colspan="10"></tr>
        <tr><th colspan="10"></tr>
        <tr><th colspan="10"></tr>
        <tr><th colspan="10"></tr>
        <tr><th colspan="10"></tr>
        <tr><th colspan="10"></tr>
            <tr><th colspan="10" class="center"><h4><b>PUPSRC Online Transaction Managment System</b></h4></tr>
            <tr><th colspan="10" class="center">Office of the University Registrar Report</tr>
            <tr><th colspan="10" class="center">Generated on: ' . date('F j, Y | g:i A') . '</tr>
            <tr><th colspan="10"></tr>
        </thead>
    </table>
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
            $html .='<tr><th colspan="10"><h5>--- NOTHING FOLLOWS ---</h5></tr>
            <tr><th colspan="10"></tr>
            <tr><th colspan="10"></tr>
            <tr><th colspan="10"></tr>
            <tr><th colspan="10"></tr>
            <tr><th colspan="4">GENERATED BY:</th><th colspan="3">CERTIFIED TRUE AND CORRECTED BY:</th><th colspan="3">NOTED BY:</th></tr>
            <tr><th colspan="10"></tr>
            <tr><th colspan="10"></tr>
            <tr><th colspan="4"><h4><b>NURIN GLADYS</b></h4></th><th colspan="3"><h4><b>ENGR. EMY LOU G. ALINSOD</b></h4></th><th colspan="3"><h4><b>DIR. LENY V. SALMINGO</b></h4></th></tr>
            <tr><th colspan="4"><h4>OUR STAFF</h4></th><th colspan="3"><h4></h4>Campus Registrar</th><th colspan="3"><h4>Campus Director</h4></th></tr>
            <tr><th colspan="4"><h4>PUP Santa Rosa Campus</h4></th><th colspan="3"><h4>PUP Santa Rosa Campus</h4></th><th colspan="3"><h4>PUP Santa Rosa Campus</h4></th></tr>';
        } else {
            $html .='<tr>
                <td class="text-center" colspan="10">No record found!</td>
            </tr>';
        }
        $html .= '
        </tbody>
    </table>
<img src="report_footer_excel.jpg">';

    $currentDate = date('Y-m-d');
    $uniqueId = uniqid();
    $fileName = 'registrar_report_' . $currentDate . '_' . $uniqueId . '.xls';
    $filePath = '../../generate_report/registrar//' . $fileName; // Replace with the actual path to your folder
    file_put_contents($filePath, $html);

    // Provide the file as a download
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=' . $fileName);
    echo $html;
?>