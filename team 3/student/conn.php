<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "reg_db";

    $connect = new mysqli($servername, $username, $password, $database);

    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
?>