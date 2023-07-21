<?php
    session_start();
    session_unset();
    session_destroy();

    $isLoggedIn = false;

    header("Location: http://192.168.100.4/index.php");
    exit();
?>
