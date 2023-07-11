<?php

require "../../vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;



$options = new Options;
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);



$dompdf = new Dompdf($options);

$dompdf->setPaper(array(0, 0, 500.64, 450.53), 'portrait');

$html = file_get_contents("template.php");



$dompdf->loadHtml($html);

$dompdf->render();

// Output the PDF to the browser
$dompdf->stream("slip.pdf", ["Attachment" => false]);
