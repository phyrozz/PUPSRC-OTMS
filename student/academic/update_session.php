<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set the session variable to true
$_SESSION['session_so'] = true;

// Redirect back to the original page or perform any necessary actions
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>