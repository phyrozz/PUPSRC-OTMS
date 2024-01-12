<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: /index.php');
    exit;
}

require '../../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include "../../../conn.php";

$searchTerm = $_GET['search'];
$formattedDate = date('Y-m-d');

$tz = '+08:00';
$timestamp = time();
$generatedOnDatetime = new DateTime("now", new DateTimeZone($tz));
$generatedOnDatetime->setTimestamp($timestamp);

$query = "SELECT completion_form, assessed_fee, completion_form_status.status_name AS completion_form_status, assessed_fee_status.status_name AS assessed_fee_status, ga_remarks, 
        users.first_name, users.last_name, users.middle_name, users.extension_name, users.student_no
        FROM acad_grade_accreditation
        INNER JOIN users ON acad_grade_accreditation.user_id = users.user_id
        INNER JOIN acad_status AS completion_form_status ON acad_grade_accreditation.completion_form_status = completion_form_status.academic_status_id 
        INNER JOIN acad_status AS assessed_fee_status ON acad_grade_accreditation.assessed_fee_status = assessed_fee_status.academic_status_id";
if (!empty($searchTerm)) {
    $query .= " WHERE users.first_name LIKE '%$searchTerm%'
                OR users.last_name LIKE '%$searchTerm%'
                OR users.middle_name LIKE '%$searchTerm%'
                OR users.extension_name LIKE '%$searchTerm%'
                OR users.student_no LIKE '%$searchTerm%'";
}
$query .= " ORDER BY users.student_no ASC";

$result = mysqli_query($connection, $query);
$i = 1;

$html = '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Office | Generate Reports</title>
    <p>Generated on: ' . $generatedOnDatetime->format('F j, Y | g:i A') . '</p>
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
    <h2>PUPSRC - Academic Office Reports</h2>
    <h4>Grade Accreditation</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Student Number</th>
                <th>Student Name</th>
                <th>Completion Form</th>
                <th>Assessed Fee</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>';
        $i = 1;
        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $html .= '<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['student_no'].'</td>
                    <td>'.$row['last_name'].', '.$row['first_name'].' '.$row['middle_name'].' '.$row['extension_name'].'</td>
                    <td>'.$row['completion_form_status'].'</td>
                    <td>'.$row['assessed_fee_status'].'</td>
                    <td>'.$row['ga_remarks'].'</td>
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
$fileName = 'academic_ga_report'. '_'.  $NameModified . '_' . uniqid(). '.pdf';

// Save the PDF to a directory in your file system
$directoryPath = '../../generate_report/academic/'; 
$filePath = $directoryPath . $fileName;
file_put_contents($filePath, $dompdf->output());

// Output the PDF to the browser
$dompdf->stream($fileName, ["Attachment" => false]);
?>