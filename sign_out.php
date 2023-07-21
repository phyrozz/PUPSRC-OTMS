<?php
    session_start();
    session_unset();
    session_destroy();

    $isLoggedIn = false;

    header("Location: http://192.168.84.183/index.php");
    exit();
?>
