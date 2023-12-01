<?php 


$conn = mysqli_connect('localhost', 'root', '', 'administrative_db');

if (mysqli_connect_errno()) {
    throw new RuntimeException("Connect failed: %s\n", mysqli_connect_error());
}
?>