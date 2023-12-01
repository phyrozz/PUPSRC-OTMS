<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_POST['session_transaction'] == "s"){
    $_SESSION['session_s'] = true;
}
if ($_POST['session_transaction'] == "so"){
    $_SESSION['session_so'] = true;
}
if ($_POST['session_transaction'] == "ga"){
    $_SESSION['session_ga'] = true;
}

// Redirect back to the original page or perform any necessary actions
echo "<script>window.location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
exit;
?>