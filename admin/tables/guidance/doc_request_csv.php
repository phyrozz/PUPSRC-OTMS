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

// Output CSV headers
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="guidance_doc_request_report.csv"');
$output = fopen('php://output', 'w');
fputcsv($output, array('No', 'Request Code', 'Date Requested', 'Scheduled Date', 'Requestor', 'Student/Guest', 'Request', 'Amount to pay', 'Status'));

$i = 1;
if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $timestamp = $row['request_id'];
        $parsedTimestamp = intval(substr($timestamp, 3));
        $date_new = new DateTime('@' . ($parsedTimestamp));
        $format_date = $date_new->format('Y-m-d H:i:s');
        fputcsv($output, array(
            $i,
            $row['request_id'],
            $format_date,
            $row['formatted_scheduled_datetime'],
            $row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['extension_name'],
            $row['role'],
            $row['request_description'],
            $row['amount_to_pay'],
            $row['status_name']
        ));
        $i++;
    }
} else {
    fputcsv($output, array('No record found!'));
}

fclose($output);
mysqli_close($connection);
?>