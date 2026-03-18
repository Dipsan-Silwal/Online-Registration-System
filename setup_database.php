<?php
$host = "localhost";
$user = "root";
$password = "";

$conn = mysqli_connect($host, $user, $password);
if (!$conn) {
    die("Connection failed: ");
}

$sql = "CREATE DATABASE IF NOT EXISTS registration_system";
if (!mysqli_query($conn, $sql)) {
    die("Error creating database: " );
}

$database = "registration_system";

if (!mysqli_select_db($conn, $database)) {
    die("Error selecting database: ");
}

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(10) NOT NULL,
    address VARCHAR(255) NOT NULL,
    course VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
)";

if (!mysqli_query($conn, $sql)) {
    die("Error creating table: ");
}
