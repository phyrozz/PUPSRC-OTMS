<?php
    session_start();
    session_unset();
    session_destroy();

    $isLoggedIn = false;

    header("Location: /index.php");
    exit();
?>
