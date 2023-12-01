<?php
    require '../../vendor/autoload.php';
    use TCPDF as TCPDF;

    // $formPage = $_POST['form_type'];

    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

    $pdf->SetCreator('Your Creator');
    $pdf->SetAuthor('Your Author');
    $pdf->SetTitle('Approval Letter');
    $pdf->SetSubject('Approval Letter');
    $pdf->SetKeywords('Approval, Letter');

    $pdf->AddPage();

    $pdf->SetTextColor(0, 0, 0);

    $name = "Juan Dela Cruz";
    $title = "Approval Letter";
    $leading = "Dear $name,";
    $counselingLetter = <<<EOD
    We are pleased to inform you that your scheduled appointment for guidance counseling has been approved. You may now proceed to the Guidance office.

    Please bring a valid ID and visit the office during our operating hours. If you have any further questions or concerns, feel free to contact our office.
    
    EOD;
    $goodMoralLetter = <<<EOD
    We are pleased to inform you that your request for a Good Moral Document has been approved. The document is now ready for pickup at the Guidance Office.

    Please bring a valid ID and visit the office during our operating hours to retrieve your Good Moral Document. If you have any further questions or concerns, feel free to contact our office.
    EOD;

    $closing = <<<EOD

    Thank you for your cooperation.

    Best regards,

    Doc Leny
    Director's Office
    Polytechnic University of the Philippines - Santa Rosa
    EOD;
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(0, 10, $title, 0, 1, 'C');
    $pdf->SetFont('times', '', 12);

    $pdf->MultiCell(0, 8, $leading, 0, 'L');
    $pdf->Ln(2);
    // switch ($formPage) {
    //     case "good_morals":
    //         $pdf->MultiCell(0, 8, $goodMoralLetter, 0, "L");
    //         break;
    //     case "counseling_form":
    //         $pdf->MultiCell(0, 8, $counselingLetter, 0, "L");
    //         break;
    //     default:
    //         $pdf->MultiCell(0, 8, "", 0, "L");
    //         break;
    // }
    $pdf->MultiCell(0, 8, $counselingLetter, 0, "L");
    $pdf->Ln(3);
    $pdf->MultiCell(0, 10, $closing, 0, 'L');

    $pdf->Output('approval_letter.pdf', 'I');
?>