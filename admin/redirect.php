<?php
// Redirect page helps avoid admin users from accessing other office pages

// For example, if the admin user is assigned to accounting office, this page will redirect
// the user into the accounting admin page

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: /index.php');
    exit;
}

switch ($_SESSION['office_name']) {
    case 'Administrative Office':
        header("Location: ../admin/administrative.php");
        break;
    case 'Accounting Office':
        header("Location: ../admin/accounting.php");
        break;
    case 'Registrar Office':
        header("Location: ../admin/registrar.php");
        break;
    case 'Academic Office':
        header("Location: ../admin/subject_overload.php");
        break;
    case 'Guidance Office':
        header("Location: ../admin/guidance.php");
        break;
}
?>