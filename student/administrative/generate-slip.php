<?php

require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options;
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

$dompdf->setPaper(array(0, 0, 500.64, 450.53), 'portrait');

$html = <<<HTML
<!DOCTYPE html>
<html>
<head>
  <title>Requisition Slip</title>
  <link rel="icon" href="/assets/icon/pup-logo.png" type="image/x-icon">
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="stylesheets/slip.css">
</head>
<body>
  <div class="header">
    <h5>Polytechnic University of the Philippines</h5>
    <p>Sta. Rosa Campus</p>
  </div>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th colspan="3" class="requisition-slip">REQUISITION SLIP</th>
      </tr>
      <tr>
        <th>EQUIPMENT</th>
        <th>QUANTITY</th>
        <th>DATE</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Chairs</td>
        <td>1</td>
        <td>19-05-2023</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>

  <div class="line signature">
    <p class="bold-text">Signature Over Printed Name</p>
  </div>
</body>
</html>
HTML;

$dompdf->loadHtml($html);

$dompdf->render();

// Output the PDF to the browser
$dompdf->stream("slip.pdf", ["Attachment" => false]);
?>

