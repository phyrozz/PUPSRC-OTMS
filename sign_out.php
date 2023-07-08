<?php
    session_start();
    session_unset();
    session_destroy();

    $isLoggedIn = false;

    header("Location: http://pup.otms.local/index.php");
    exit();
?>
