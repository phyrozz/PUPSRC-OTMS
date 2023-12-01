<?php
    function getStatusBadgeClass($status) {
        switch ($status) {
            case 'Approved':
                return 'bg-success';
            case 'Disapproved':
                return 'bg-danger';
            default:
                return 'bg-warning text-dark';
        }
    }
    
    // Add more cases here for other office document requests
    function getSchedulePageRedirect($request) {
        switch ($request) {
            case "Request Good Moral Document":
                return "/student/guidance/doc_appointments/good_morals.php";
            case "Request Clearance":
                return "/student/guidance/doc_appointments/clearance.php";
            default:
                return "#";
        }
    }
?>