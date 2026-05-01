<?php
$conn = new mysqli("localhost", "root", "Mediator24X", "index2_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>