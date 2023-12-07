<?php
require '../../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include "../../../conn.php";

$status = $_GET['status'];
$searchTerm = $_GET['search'];
$formattedDate = date('Y-m-d'); //date today

$doc_request_reports = "SELECT counseling_schedules.counseling_id, counseling_schedules.appointment_description, counseling_schedules.comments, doc_requests.scheduled_datetime, statuses.status_name, 
                        users.first_name, users.last_name, users.middle_name, users.extension_name, user_roles.role
                        FROM counseling_schedules
                        INNER JOIN doc_requests ON counseling_schedules.doc_requests_id = doc_requests.request_id
                        INNER JOIN users ON doc_requests.user_id = users.user_id
                        INNER JOIN user_roles ON users.user_role = user_roles.user_role_id
                        INNER JOIN offices ON doc_requests.office_id = offices.office_id
                        INNER JOIN statuses ON doc_requests.status_id = statuses.status_id";

if (!empty($searchTerm)) {
$doc_request_reports .= " AND (counseling_id LIKE '%$searchTerm%'
                        OR appointment_description LIKE '%$searchTerm%'
                        OR scheduled_datetime LIKE '%$searchTerm%'
                        OR status_name LIKE '%$searchTerm%'
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
                        OR CONCAT(DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(counseling_id, 4)), '%c/%e/%Y, %h:%i:%s %p')) LIKE '%$searchTerm%'
                        OR DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(counseling_id, 4)), '%M') LIKE '%$searchTerm%' -- Search for worded months
                        )";
}

if ($status != 'all') {
    $doc_request_reports .= " AND doc_requests.status_id = '$status'";
}

$result = mysqli_query($connection,  $doc_request_reports);

// Output CSV headers
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="guidance_counseling_report.csv"');
$output = fopen('php://output', 'w');
fputcsv($output, array('No', 'Schedule Code', 'Date Requested', 'Requestor', 'Student/Guest', 'Description', 'Schedule', 'Status'));

$i = 1;
if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $timestamp = $row['counseling_id'];
        $parsedTimestamp = intval(substr($timestamp, 3));
        $date_new = new DateTime('@' . ($parsedTimestamp));
        $format_date = $date_new->format('Y-m-d H:i:s');
        fputcsv($output, array(
            $i,
            $row['counseling_id'],
            $format_date,
            $row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['extension_name'],
            $row['role'],
            $row['appointment_description'],
            date('F j, Y', strtotime($row['scheduled_datetime'])),
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