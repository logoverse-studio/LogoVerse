<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "logoverse";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    error_log("LogoVerse database connection failed: " . $conn->connect_error);
    die("Unable to connect to the database.");
}

$conn->set_charset("utf8mb4");
?>
