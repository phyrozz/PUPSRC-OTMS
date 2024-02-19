<?php
require '../../../vendor/autoload.php';
include "../../../conn.php";

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Element\Image;

// Create a new PhpWord instance
$phpWord = new PhpWord();

// Add a section to the document
$section = $phpWord->addSection();


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

// Initialize PhpWord
$phpWord = new PhpWord();

// Add a section
$section = $phpWord->addSection();

// Add a header image to the first section
$headerImage = $section->addHeader();
$headerImage->addImage('report_header.png', [
    'width' => Converter::cmToPixel(15),
    'height' => Converter::cmToPixel(2)
]);

// Add a footer image to the first section
$footerImage = $section->addFooter();
$footerImage->addImage('report_footer.png', [
    'width' => Converter::cmToPixel(15),
    'height' => Converter::cmToPixel(2)
]);

$section->addText(''); // Add a blank line
// Add title and date
$section->addText('PUPSRC Online Transaction Management System', ['size' => 16, 'bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
$section->addText('Office of the University Registrar Report', ['size' => 14, 'bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
$section->addText('Generated on: ' . date('F j, Y | g:i A'), ['size' => 12, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
$section->addText(''); // Add a blank line
$section->addText(''); // Add a blank line
// Add the existing table
$table = $section->addTable();
$table->addRow();
$table->addCell(300)->addText('No');
$table->addCell(800)->addText('Request Code');
$table->addCell(1200)->addText('Date Requested');
$table->addCell(1200)->addText('Scheduled Date');
$table->addCell(1200)->addText('Requestor');
$table->addCell(800)->addText('Student/Client');
$table->addCell(1200)->addText('Request');
$table->addCell(1200)->addText('Purpose');
$table->addCell(800)->addText('Amount to Pay');
$table->addCell(1000)->addText('Status');

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $timestamp = $row['request_id'];
        $parsedTimestamp = intval(substr($timestamp, 3));
        $date_new = new DateTime('@' . ($parsedTimestamp));
        $format_date = $date_new->format('Y/m/d'); // date only

        $table->addRow();
        $table->addCell(300)->addText($i);
        $table->addCell(800)->addText($row['request_id']);
        $table->addCell(1200)->addText($format_date);
        $table->addCell(1200)->addText(date('Y/m/d', strtotime($row['scheduled_datetime'])));
        $table->addCell(1200)->addText($row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['extension_name']);
        $table->addCell(800)->addText($row['role']);
        $table->addCell(1200)->addText($row['request_description']);
        $table->addCell(1200)->addText($row['purpose']);
        $table->addCell(800)->addText($row['amount_to_pay']);
        $table->addCell(1000)->addText($row['status_name']);

        $i++;
    }

    $table->addRow();
    $table->addCell(9800)->addText('--- NOTHING FOLLOWS ---', ['colSpan' => 10]);

} else {
    $table->addRow();
    $table->addCell(9800)->addText('No record found!', ['colSpan' => 10]);
}

// Add the provided HTML code
$section->addText(''); // Add a blank line
$section->addText(''); // Add a blank line
$section->addText(''); // Add a blank line
$table = $section->addTable(['width' => 100 * 6]); // Assuming each column is 100 units wide

// Add a row to the table
$table->addRow();

// Add cells to the row (three cells for three columns)
$cell1 = $table->addCell(3000); // Adjust the width as needed
$cell2 = $table->addCell(4000); // Adjust the width as needed
$cellbreak = $table->addCell(500); // Adjust the width as needed
$cell3 = $table->addCell(3000); // Adjust the width as needed

// Add content to each cell
$cell1->addText('GENERATED BY:', ['size' => 14, 'bold' => true]);
$cell2->addText('CERTIFIED TRUE AND CORRECTED BY:', ['size' => 14, 'bold' => true]);
$cellbreak->addText();
$cell3->addText('NOTED BY:' , ['size' => 14, 'bold' => true]);

$section->addText(''); // Add a blank line
$section->addText(''); // Add a blank line
$section->addText(''); // Add a blank line
$section->addText(''); // Add a blank line
$section->addText(''); // Add a blank line
$section->addText(''); // Add a blank line

// Add a row to the table
$table->addRow();

// Add cells to the row (three cells for three columns)
$cell11 = $table->addCell(3000, ['vMerge' => 'restart', 'valign' => 'center']); // Adjust the width as needed
$cell22 = $table->addCell(4000, ['vMerge' => 'restart', 'valign' => 'center']); // Adjust the width as needed
$cellbreak1 = $table->addCell(500);
$cell33 = $table->addCell(3000, ['vMerge' => 'restart', 'valign' => 'center']); // Adjust the width as needed

$cell11->addText('NURIN GLADYS', ['size' => 14, 'bold' => true]);
$cell22->addText('ENGR. EMY LOU G. ALINSOD', ['size' => 14, 'bold' => true]);
$cell33->addText('DIR. LENY V. SALMINGO', ['size' => 14, 'bold' => true]);

$cell11->addText('OUR STAFF');
$cell22->addText('Campus Registrar');
$cellbreak1->addText();
$cell33->addText('Campus Director');

$cell11->addText('PUP Santa Rosa Campus');
$cell22->addText('PUP Santa Rosa Campus');
$cellbreak1->addText();
$cell33->addText('PUP Santa Rosa Campus');

// Save the DOCX file
$directoryPath = '../../generate_report/registrar/';
$NameModified = strtolower(str_replace(' ', '', $formattedDate));

// Replace Word2007 writer with RTF writer
$objWriter = IOFactory::createWriter($phpWord, 'RTF');

// Save the RTF document
$rtfFileName = 'registrar_report_' . $NameModified . '_' . uniqid() . '.doc';
$rtfFilePath = $directoryPath . $rtfFileName;
$objWriter->save($rtfFilePath);

// Load the RTF content
$rtfContent = file_get_contents($rtfFilePath);

// Adjust the RTF content to set the landscape orientation
$rtfContent = str_replace("\\margl1440", "\\margl7200", $rtfContent);
$rtfContent = str_replace("\\margr1440", "\\margr7200", $rtfContent);
$rtfContent = str_replace("\\margt1440", "\\margt7200", $rtfContent);
$rtfContent = str_replace("\\margb1440", "\\margb7200", $rtfContent);

// Save the adjusted RTF content back to the file
file_put_contents($rtfFilePath, $rtfContent);

// Output the adjusted RTF document to the browser
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $rtfFileName . '"');
readfile($rtfFilePath);

?>
